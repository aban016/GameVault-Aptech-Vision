<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Game;
use App\Models\Gameplay;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::leftJoin('sessions', 'users.id', '=', 'sessions.user_id')
            ->select('users.id', 'users.name', 'users.email', 'users.role', 'users.created_at', DB::raw('MAX(sessions.last_activity) as last_activity'))
            ->groupBy('users.id', 'users.name', 'users.email', 'users.role', 'users.created_at')
            ->orderBy('users.created_at', 'desc')
            ->get();

        return view('admin.users', compact('users'));
    }

    public function dashboard()
    {
        $categories = Category::where('is_active', true)->orderBy('created_at', 'desc')->get();
        $bestGames = Game::where('rating', '>', 4)->orderBy('created_at', 'desc')->get();
        $freeGames = Game::where('price', null)->orderBy('created_at', 'desc')->get();
        return view('dashboard', compact('bestGames', 'categories', 'freeGames'));
    }

    public function profile(Request $request)
    {
        $user = $request->user();
        $categories = Category::where('is_active', true)->orderBy('created_at', 'desc')->get();
        $createdDate = $user->created_at->format('F d, Y');
        $userGameplays = Gameplay::where('uploaded_by', Auth::id())->orderBy('created_at', 'desc')->get();
        $users = User::whereIn('id', $userGameplays->pluck('uploaded_by'))->get()->keyBy('id');
        return view('profile', compact('user', 'createdDate', 'categories', 'userGameplays', 'users'));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'profile_pic' => 'required|image|max:2048',
        ]);

        $user = Auth::user();
        if (!$user) {
            Log::error('User not authenticated.');
            return redirect()->back()->with('error', 'User not authenticated.');
        }

        if ($request->hasFile('profile_pic')) {
            try {
                $image = $request->file('profile_pic');
                $imageData = base64_encode(file_get_contents($image->getRealPath()));
                $user->profile_pic = 'data:image/' . $image->getClientOriginalExtension() . ';base64,' . $imageData;
                $user->save();
            } catch (\Exception $e) {
                Log::error('Error updating profile picture: ' . $e->getMessage());
                return redirect()->back()->with('error', 'Failed to update profile picture.');
            }
        }

        return redirect()->back()->with('success', 'Profile picture updated successfully.');
    }



    public function freeGames()
    {
        $freeGames = Game::where('price', null)->orderBy('created_at', 'desc')->get();
        $totalFreeGames = Game::where('price', null)->count();
        $categories = Category::where('is_active', true)->orderBy('created_at', 'desc')->get();
        return view('free-games', compact('freeGames', 'categories', 'totalFreeGames'));
    }

    public function premiumGames()
    {
        $premiumGames = Game::whereNotNull('price')->orderBy('created_at', 'desc')->get();
        $categories = Category::where('is_active', true)->get();
        return view('premium-games', compact('categories', 'premiumGames'));
    }

    public function gameplays()
    {
        $gameplays = Gameplay::where('is_approve', true)->orderBy('created_at', 'desc')->get();
        $categories = Category::where('is_active', true)->orderBy('created_at', 'desc')->get();
        $users = User::whereIn('id', $gameplays->pluck('uploaded_by'))->get()->keyBy('id');
        return view('watch', compact('gameplays', 'categories', 'users'));
    }

    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users')->with('success', 'User deleted successfully.');
    }
}
