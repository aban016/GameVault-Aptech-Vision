<?php

namespace App\Http\Controllers;

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
        return view('admin.games.create');
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
            'sale' => 'required|boolean',
            'availability' => 'required|boolean',
            'rating' => 'required|numeric|min:0|max:5',
            'user_id' => 'required|exists:users,id',
            'release_year' => 'required|date_format:Y',
            'developer' => 'required|string|max:255',
            'platform' => 'required|string|max:255',
            'installation_file' => 'required',
            'image1' => 'required',
            'image2' => 'nullable',
            'image3' => 'nullable',
            'image4' => 'nullable',
            'video' => 'nullable',
        ]);

        Game::create($request->all());

        return redirect()->route('games.index')->with('success', 'Game created successfully.');
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
            'sale' => 'required|boolean',
            'availability' => 'required|boolean',
            'rating' => 'required|numeric|min:0|max:5',
            'user_id' => 'required|exists:users,id',
            'release_year' => 'required|date_format:Y',
            'developer' => 'required|string|max:255',
            'platform' => 'required|string|max:255',
            'installation_file' => 'required',
            'image1' => 'required',
            'image2' => 'nullable',
            'image3' => 'nullable',
            'image4' => 'nullable',
            'video' => 'nullable',
        ]);

        $game = Game::findOrFail($id);
        $game->update($request->all());

        return redirect()->route('games.index')->with('success', 'Game updated successfully.');
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