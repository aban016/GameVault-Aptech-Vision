<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Contact;
use App\Models\Game;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
{
    public function index(){
        $totalMessages = Contact::where('is_new', 'true')->count();
        $totalUsers = User::where('role', 'user')->count();
        $totalGames = Game::count(); 
        return view('admin.dashboard', compact('totalUsers', 'totalGames', 'totalMessages'));
    }

    public function profile(Request $request){
        return view('admin.profile', [
            'user' => $request->user(),
        ]);
    }

    public function profileUpdate(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('admin.profile')->with('status', 'profile-updated');
    }

}
