<?php

namespace App\Http\Controllers;

use App\Models\Gameplay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GameplayController extends Controller
{
    public function index(){
        $gameplays = Gameplay::all();
        return view('admin.gameplay', compact('gameplays'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'video' => 'required|string',
            'category' => 'required|string|max:255',
        ]);

        $video = new Gameplay();
        $video->title = $request->title;
        $video->video = $request->video;
        $video->category = $request->category;
        $video->uploaded_by = Auth::id();
        $video->save();
        return redirect()->route('gameplays')->with('message', 'Gameplay uploaded successfully!');
    }

    public function delete($id)
    {
        $video = Gameplay::findOrFail($id);
        $video->delete();
        return redirect()->route('gameplays')->with('message', 'Gameplay Deleted successfully!');
    }
}
