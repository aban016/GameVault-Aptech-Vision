<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Game;
use Illuminate\Http\Request;


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
            'price' => 'required|numeric',
            'sale' => 'boolean',
            'availability' => 'boolean',
            'rating' => 'nullable|numeric|min:0|max:5',
            'user_id' => 'required|exists:users,id',
            'release_year' => 'required|digits:4|integer|min:1900|max:' . (date('Y') + 1),
            'developer' => 'required|string|max:255',
            'platform' => 'required|string|max:255',
            'installation_file' => 'required|string',
            'cover' => 'required|string',
            'video' => 'nullable|string',
        ]);

        try {
            $data = $request->all();
    
            if ($request->hasFile('cover')) {
                $cover = $request->file('cover');
                $coverName = time() . '_' . $cover->getClientOriginalName();
                $cover->move(public_path('user/assets/img/gamecovers'), $coverName);
                $data['cover'] = $coverName;
            }
    
            if ($request->hasFile('video')) {
                $video = $request->file('video');
                $videoName = time() . '_' . $video->getClientOriginalName();
                $video->move(public_path('user/assets/img/gamevideos'), $videoName);
                $data['video'] = $videoName;
            }
    
            Game::create($data);
    
            return redirect()->route('games.index')->with('success', 'Game added successfully!');
        } catch (\Exception $e) {
            return redirect()->route('games.index')->with('error', 'Failed to add game. Please try again.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $game = Game::findOrFail($id);
        return view('admin.games.show', compact('game'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $game = Game::findOrFail($id);
        return view('admin.games.edit', compact('game'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'price' => 'required|numeric',
            'sale' => 'boolean',
            'availability' => 'boolean',
            'rating' => 'nullable|numeric|min:0|max:5',
            'user_id' => 'required|exists:users,id',
            'release_year' => 'required|digits:4|integer|min:1900|max:' . (date('Y') + 1),
            'developer' => 'required|string|max:255',
            'platform' => 'required|string|max:255',
            'installation_file' => 'required|string',
            'cover' => 'required|string',
            'video' => 'nullable|string',
        ]);

        try {
            $game = Game::findOrFail($id);
            $game->update($request->all());
            return redirect()->route('games.index')->with('success', 'Game updated successfully!');
        } catch (\Exception $e) {
            return redirect()->route('games.index')->with('error', 'Failed to update game. Please try again.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $game = Game::findOrFail($id);
        $game->delete();

        return redirect()->route('games.index')->with('success', 'Game deleted successfully.');
    }
}
