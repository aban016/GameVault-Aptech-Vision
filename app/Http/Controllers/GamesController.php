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
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'price' => 'nullable|numeric',
            'rating' => 'nullable|numeric|min:0|max:5',
            'release_year' => 'required|digits:4|integer|min:1900|max:' . (date('Y') + 1),
            'developer' => 'required|string|max:255',
            'platform' => 'required|string|max:255',
            'installation_file' => 'nullable|file',
            'installation_file_link' => 'nullable|url',
            'cover' => 'required|file',
            'video' => 'nullable|string',
        ]);
        $validatedData['user_id'] = Auth::id();

        try {
            if ($request->hasFile('cover')) {
                $cover = $request->file('cover');
                $coverContent = file_get_contents($cover->getRealPath());
                $coverBase64 = base64_encode($coverContent);
                $validatedData['cover'] = $coverBase64;
            }

            Game::create($validatedData);
            return redirect()->route('admin.games')->with('success', 'Game added successfully!');
        } catch (\Exception $e) {
            return redirect()->route('admin.games')->with('error', 'Failed to add game. Please try again.');
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
        $validatedData = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required',
            'price' => 'sometimes|required|numeric',
            'sale' => 'sometimes|boolean',
            'rating' => 'sometimes|nullable|numeric|min:0|max:5',
            'release_year' => 'sometimes|required|digits:4|integer|min:1900|max:' . (date('Y') + 1),
            'developer' => 'sometimes|required|string|max:255',
            'platform' => 'sometimes|required|string|max:255',
            'installation_file' => 'sometimes|required|string',
            'cover' => 'sometimes|required|file|mimes:jpeg,png,jpg',
            'video' => 'sometimes|nullable|string',
        ]);

        try {
            $game = Game::findOrFail($id);

            if ($game->user_id !== Auth::id()) {
                return redirect()->route('games.index')->with('error', 'Unauthorized access.');
            }

            if ($request->hasFile('cover')) {
                $cover = $request->file('cover');
                $coverContent = file_get_contents($cover->getRealPath());
                $coverBase64 = base64_encode($coverContent);
                $validatedData['cover'] = $coverBase64;
            }

            $game->update($validatedData);

            return redirect()->route('admin.games')->with('success', 'Game updated successfully!');
        } catch (\Exception $e) {
            return redirect()->route('admin.games')->with('error', 'Failed to update game. Please try again.');
        }
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
