<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Game;
use App\Models\UserGame;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserGamesController extends Controller
{
    public function index()
    {
        $userGames = UserGame::where('user_games.user_id', auth()->user()->id)
            ->join('games', 'user_games.game_id', '=', 'games.id')
            ->get(['user_games.*', 'games.*']);
        $categories = Category::where('is_active', true)->orderBy('created_at', 'desc')->get();

        return view('library', compact('userGames', 'categories'));
    }

    public function destroy($game_id)
    {
        $userGame = UserGame::where('user_id', Auth::id())
            ->where('game_id', $game_id)
            ->firstOrFail();

        $userGame->delete();

        return redirect()->back()->with('message', 'Game removed from your library!');
    }

    public function soldGames()
    {
        $soldGames = UserGame::join('games', 'user_games.game_id', '=', 'games.id')
            ->join('users', 'user_games.user_id', '=', 'users.id')
            ->get([
                'user_games.*',    // All columns from the user_games table
                'games.title',     // Only the title from the games table
                'users.name'       // Only the name from the users table
            ]);


        return view('admin.soldgames', compact('soldGames'));
    }
}
