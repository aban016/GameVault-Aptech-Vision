@extends('layouts.default')

@section('title', 'Profile')

@section('content')
<div class="uk-page-heading uk-height-medium uk-height-max-medium uk-flex uk-flex-column uk-flex-center uk-flex-middle uk-background-cover uk-light" data-src="assets/img/heading8.jpg" uk-img uk-parallax="bgy: -70">
    <div class="fl-hd-cover">
        <span class="decore-lt"></span>
        <span class="decore-lb"></span>
        <span class="decore-rt"></span>
        <span class="decore-rb"></span>
    </div>
    <div class="fl-hd-avatar">
        <a href="04_profile.html" class="item-avatar">@php
            $profilePic = Auth::user()->profile_pic;
            $profilePicUrl = '';

            if ($profilePic) {
            if (Str::startsWith($profilePic, 'data:image')) {
            // Base64 encoded image
            $profilePicUrl = $profilePic;
            } elseif (filter_var($profilePic, FILTER_VALIDATE_URL)) {
            // URL (from Google OAuth)
            $profilePicUrl = $profilePic;
            } else {
            // Local storage path
            $profilePicUrl = asset('storage/' . $profilePic);
            }
            } else {
            // Default profile picture
            $profilePicUrl = asset('user/assets/img/profile.png');
            }
            @endphp
            <img class="avatar" width="100" height="100" alt="Profile Photo" src="{{ $profilePicUrl }}">
        </a>
    </div>
    <h1 class="uk-page-heading-h">{{ $user->name }}</h1>
    <p class="uk-heading-text">{{ $createdDate }}</p>
</div>

<div data-uk-filter="target: .js-filter">
    <div class="fl-subnav">
        <ul class=" uk-subnav uk-subnav-pill">
            <li class="uk-active" data-uk-filter-control="[data-type='info']"><a href="#"><i class="ico_report"></i>Account Info</a></li>
            <li data-uk-filter-control="[data-type='changepassword']"><a href="#">Change Password</a></li>
            <li data-uk-filter-control="[data-type='uploadgameplay']"><a href="#"><i class="icon-game-controller"></i>Upload Gameplay</a></li>
        </ul>
    </div>
    <div class="uk-width-1-1">
        <div class="js-filter" data-uk-grid>

            <div class="row" data-type="info">
                <div class="col-xl-12">
                    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                        @csrf
                    </form>

                    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
                        @csrf
                        @method('patch')

                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <div class="form-group mb-30">
                                    <label class="font-sm color-text-mutted mb-10">Full Name *</label>
                                    <input class="form-control" id="name" name="name" type="text" placeholder="Steven Job" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
                                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="form-group mb-30">
                                    <label class="font-sm color-text-mutted mb-10">Email *</label>
                                    <input class="form-control" id="email" name="email" type="email" placeholder="stevenjob@gmail.com" value="{{ old('email', $user->email) }}" required autocomplete="username">
                                    <x-input-error class="mt-2" :messages="$errors->get('email')" />
                                    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                                    <div>
                                        <p class="text-sm mt-2 text-gray-800">
                                            {{ __('Your email address is unverified.') }}
                                            <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                {{ __('Click here to re-send the verification email.') }}
                                            </button>
                                        </p>
                                        @if (session('status') === 'verification-link-sent')
                                        <p class="mt-2 font-medium text-sm text-green-600">
                                            {{ __('A new verification link has been sent to your email address.') }}
                                        </p>
                                        @endif
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group mt-10">
                                    <button class="btn btn-default btn-brand icon-tick">{{ __('Save') }}</button>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                @if (session('status') === 'profile-updated')
                                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-gray-600">{{ __('Saved.') }}</p>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="row" data-type="changepassword">
                <div class="col-xl-12">
                    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
                        @csrf
                        @method('put')

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group mb-30">
                                    <label class="font-sm color-text-mutted mb-10">{{ __('Current Password') }}</label>
                                    <input class="form-control" id="update_password_current_password" name="current_password" type="password" placeholder="Current Password" autocomplete="current-password">
                                    <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group mb-30">
                                    <label class="font-sm color-text-mutted mb-10">{{ __('New Password') }}</label>
                                    <input class="form-control" id="update_password_password" name="password" type="password" placeholder="New Password" autocomplete="new-password">
                                    <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group mb-30">
                                    <label class="font-sm color-text-mutted mb-10">{{ __('Confirm Password') }}</label>
                                    <input class="form-control" id="update_password_password_confirmation" name="password_confirmation" type="password" placeholder="Confirm Password" autocomplete="new-password">
                                    <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group mt-0">
                                    <button class="btn btn-default btn-brand icon-tick">{{ __('Save') }}</button>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                @if (session('status') === 'password-updated')
                                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-gray-600">{{ __('Saved.') }}</p>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@stop