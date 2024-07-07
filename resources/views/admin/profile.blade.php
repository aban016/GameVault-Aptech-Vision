@extends('layouts.admindefault')

@section('title', 'Profile')

@section('content')
<div class="box-heading">
    <div class="box-title">
        <h3 class="mb-35">My Profile</h3>
    </div>
    <div class="box-breadcrumb">
        <div class="breadcrumbs">
            <ul>
                <li> <a class="icon-home">Admin</a></li>
                <li><span>My Profile</span></li>
            </ul>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xxl-9 col-xl-8 col-lg-8">
        <div class="section-box">
            <div class="container">
                <div class="panel-white mb-30">
                    <div class="box-padding">
                        <h6 class="color-text-paragraph-2 mb-3">Update your profile</h6>
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

            </div>
        </div>
    </div>
    <div class="col-xxl-3 col-xl-4 col-lg-4">
        <div class="section-box">
            <div class="container">
                <div class="panel-white">
                    <div class="panel-head">
                        <h5>{{ __('Update Password') }}</h5>
                    </div>
                    <div class="panel-body pt-20">
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
</div>
@stop