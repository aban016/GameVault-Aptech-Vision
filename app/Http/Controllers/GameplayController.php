<?php

namespace App\Http\Controllers;

use App\Models\Gameplay;
use Illuminate\Http\Request;

class GameplayController extends Controller
{
    public function index(){
        $gameplays = Gameplay::all();
        return view('admin.gameplay', compact('gameplays'));
    }
}
