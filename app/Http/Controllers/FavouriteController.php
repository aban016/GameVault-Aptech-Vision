<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Favourite;
use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavouriteController extends Controller
{
    public function index()
    {
        $favourites = Favourite::where('favourites.user_id', auth()->user()->id)
            ->join('games', 'favourites.game_id', '=', 'games.id')
            ->get(['favourites.*', 'games.*']);
        $categories = Category::where('is_active', true)->orderBy('created_at', 'desc')->get();

        return view('wishlist', compact('favourites', 'categories'));
    }

    public function store($game_id)
    {
        $game = Favourite::findOrFail($game_id);

        $favourite = new Favourite();
        $favourite->user_id = Auth::id();
        $favourite->game_id = $game_id;
        $favourite->save();

        return redirect()->back()->with('message', 'Game added to favourites!');
    }

    public function destroy($game_id)
    {
        $favgame = Favourite::findOrFail($game_id);
        $favgame->delete();
        return redirect()->back()->with('message', 'Game remove to favourites!');
    }
}
