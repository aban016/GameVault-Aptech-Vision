<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GamesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $games = Game::all();
        return view('admin.games.index', compact('games'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where('is_active', true)->get();
        return view('admin.games.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'category' => 'required|string|max:255',
            'price' => 'nullable|numeric|',
            'rating' => 'required|numeric|min:0|max:5',
            'release_year' => 'required|digits:4|integer|min:1900|max:' . (date('Y')),
            'developer' => 'required|string|max:255',
            'platform' => 'required|string|max:255',
            'cover' => 'required|image|max:2048',
            'video' => 'required|string',
        ]);

        $cover = base64_encode(file_get_contents($request->file('cover')->path()));

        $game = new Game();
        $game->title = $request->input('title');
        $game->description = $request->input('description');
        $game->category = $request->input('category');
        $game->price = $request->input('price');
        $game->sale = false;
        $game->rating = $request->input('rating');
        $game->user_id = auth()->user()->id;
        $game->release_year = $request->input('release_year');
        $game->developer = $request->input('developer');
        $game->platform = $request->input('platform');
        $game->installation_file = $request->input('installation_file');
        $game->installation_file_link = $request->input('installation_file_link');
        $game->cover = $cover;
        $game->video = $request->input('video');

        $game->save();

        return redirect()->route('admin.games')->with('success', 'Game created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $game = Game::findOrFail($id);
        return view('gamedetails', compact('game'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $categories = Category::where('is_active', true)->get();
        $game = Game::findOrFail($id);
        return view('admin.games.update', compact('game', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Game $game)
    {
        // Validate the incoming request data
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'category' => 'required|string|max:255',
            'price' => 'nullable|numeric',
            'rating' => 'required|numeric|min:0|max:5',
            'release_year' => 'required|digits:4|integer|min:1900|max:' . (date('Y')),
            'developer' => 'required|string|max:255',
            'platform' => 'required|string|max:255',
            'cover' => 'nullable|image|max:2048', // Make cover nullable for updates
            'video' => 'required|string',
        ]);

        // Check if a new cover image is uploaded and convert it to base64
        if ($request->hasFile('cover')) {
            $cover = base64_encode(file_get_contents($request->file('cover')->path()));
            $game->cover = $cover; // Update the cover only if a new one is uploaded
        }

        // Update the game details
        $game->title = $request->input('title');
        $game->description = $request->input('description');
        $game->category = $request->input('category');
        $game->price = $request->input('price');
        $game->sale = false; // Set sale to false as per your logic
        $game->rating = $request->input('rating');
        $game->user_id = auth()->user()->id; // Update with the ID of the logged-in user
        $game->release_year = $request->input('release_year');
        $game->developer = $request->input('developer');
        $game->platform = $request->input('platform');
        $game->installation_file = $request->input('installation_file');
        $game->installation_file_link = $request->input('installation_file_link');
        $game->video = $request->input('video'); // Update video as text

        // Save the updated game record to the database
        $game->update();

        // Redirect or return a response
        return redirect()->route('admin.games')->with('success', 'Game updated successfully!');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $game = Game::findOrFail($id);
        $game->delete();

        return redirect()->route('admin.games')->with('success', 'Game deleted successfully.');
    }
}
