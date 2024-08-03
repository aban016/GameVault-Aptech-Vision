<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->user();
        $findUser = User::where('google_id', $user->id)->first();
        if ($findUser) {
            Auth::login($findUser);
            if ($findUser->role == 'admin') {
                return redirect()->route('admin.dashboard');
            }
        } else {
            $newUser = User::updateOrCreate([
                'email' => $user->email,
            ], [
                'name' => $user->name,
                'google_id' => $user->id,
                'password' => encrypt('12345678'),
                'profile_pic' => $user->avatar,
            ]);

            Auth::login($newUser);
        }

        return redirect('/dashboard');
    }
}
