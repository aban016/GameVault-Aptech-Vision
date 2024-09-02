<?php

namespace App\Http\Controllers;

use App\Models\Gameplay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class GameplayController extends Controller
{
    public function index()
    {
        $gameplays = Gameplay::all();

        return view('admin.gameplay', compact('gameplays'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'video' => 'required|file|max:102400', // 100 MB
            'thumbnail' => 'required|image',
            'category' => 'required|string|max:255',
        ]);

        $gameplay = new Gameplay();
        $gameplay->title = $request->title;

        if ($request->hasFile('video')) {
            $customPath = 'user/assets/videos';
            $originalFilename = $request->file('video')->getClientOriginalName();
            $path = $request->file('video')->storeAs($customPath, $originalFilename, 'public');
            $gameplay->video = $path;
        }

        if ($request->hasFile('thumbnail')) {
            $image = $request->file('thumbnail');
            $imageData = file_get_contents($image->getRealPath());
            $base64 = base64_encode($imageData);
            $gameplay->thumbnail = $base64;
        }

        $gameplay->category = $request->category;
        $gameplay->uploaded_by = Auth::id();
        $gameplay->save();

        return redirect()->route('gameplays')->with('message', 'Gameplay uploaded successfully!');
    }

    public function show($id)
    {
        $gameplay = Gameplay::findOrFail($id);

        return view('admin.gameplay-detail', compact('gameplay'));
    }

    public function approve($id)
    {
        $gameplay = Gameplay::findOrFail($id);

        $gameplay->is_approve = true;
        $gameplay->save();
        return redirect()->route('admin.gameplay')->with('message', 'Gameplay approved successfully!');
    }


    public function delete($id)
    {
        $gameplay = Gameplay::findOrFail($id);

        if (Storage::exists($gameplay->video)) {
            Storage::delete($gameplay->video);
        }

        $gameplay->delete();

        return redirect()->route('gameplays')->with('message', 'Gameplay deleted successfully!');
    }
}
