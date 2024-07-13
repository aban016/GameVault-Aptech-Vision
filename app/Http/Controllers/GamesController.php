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
            'image1' => 'required|image|max:2048',
            'image2' => 'nullable|image|max:2048',
            'image3' => 'nullable|image|max:2048',
            'image4' => 'nullable|image|max:2048',
            'video' => 'nullable|mimes:mp4,mov,ogg,qt|max:20000',
        ]);

        $images = [];
        for ($i = 1; $i <= 4; $i++) {
            $imageField = 'image' . $i;
            if ($request->hasFile($imageField)) {
                $images[$imageField] = base64_encode(file_get_contents($request->file($imageField)));
            } else {
                $images[$imageField] = null;
            }
        }

        $videoBase64 = null;
        if ($request->hasFile('video')) {
            $videoBase64 = base64_encode(file_get_contents($request->file('video')));
        }

        $game = new Game();
        $game->title = $request->title;
        $game->description = $request->description;
        $game->price = $request->price;
        $game->sale = $request->sale;
        $game->availability = $request->availability;
        $game->rating = $request->rating;
        $game->user_id = $request->user_id;
        $game->release_year = $request->release_year;
        $game->developer = $request->developer;
        $game->platform = $request->platform;
        $game->installation_file = $request->installation_file;
        $game->image1 = $images['image1'];
        $game->image2 = $images['image2'];
        $game->image3 = $images['image3'];
        $game->image4 = $images['image4'];
        $game->video = $videoBase64;
        $game->save();

        return redirect()->route('admin.games.index')->with('success', 'Game created successfully.');
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
            'image1' => 'required|image|max:2048',
            'image2' => 'nullable|image|max:2048',
            'image3' => 'nullable|image|max:2048',
            'image4' => 'nullable|image|max:2048',
            'video' => 'nullable|mimes:mp4,mov,ogg,qt|max:20000',
        ]);

        $game = Game::findOrFail($id);

        if ($request->has('title')) {
            $game->title = $request->input('title');
        }
        if ($request->has('description')) {
            $game->description = $request->input('description');
        }
        if ($request->has('price')) {
            $game->price = $request->input('price');
        }
        if ($request->has('sale')) {
            $game->sale = $request->input('sale');
        }
        if ($request->has('availability')) {
            $game->availability = $request->input('availability');
        }
        if ($request->has('rating')) {
            $game->rating = $request->input('rating');
        }
        if ($request->has('user_id')) {
            $game->user_id = $request->input('user_id');
        }
        if ($request->has('release_year')) {
            $game->release_year = $request->input('release_year');
        }
        if ($request->has('developer')) {
            $game->developer = $request->input('developer');
        }
        if ($request->has('platform')) {
            $game->platform = $request->input('platform');
        }
        if ($request->has('installation_file')) {
            $game->installation_file = $request->input('installation_file');
        }

        for ($i = 1; $i <= 4; $i++) {
            $imageField = 'image' . $i;
            if ($request->hasFile($imageField)) {
                $game->{$imageField} = base64_encode(file_get_contents($request->file($imageField)));
            }
        }

        if ($request->hasFile('video')) {
            $game->video = base64_encode(file_get_contents($request->file('video')));
        }

        $game->save();

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
