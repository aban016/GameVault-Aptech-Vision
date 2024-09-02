@extends('layouts.default')

@section('title', 'Profile')

@section('content')
<div class="uk-page-heading uk-height-medium uk-height-max-medium uk-flex uk-flex-column uk-flex-center uk-flex-middle uk-background-cover uk-light" data-src="{{ asset('user/assets/img/fl-heading01.jpg') }}" uk-img uk-parallax="bgy: -70">
    <div class="fl-hd-cover">
        <span class="decore-lt"></span>
        <span class="decore-lb"></span>
        <span class="decore-rt"></span>
        <span class="decore-rb"></span>
    </div>
    <div class="fl-hd-avatar position-relative">
        <a href="#" data-bs-toggle="modal" data-bs-target="#profileModal" class="item-avatar">
            @php
            $profilePic = Auth::user()->profile_pic;
            $profilePicUrl = '';

            if ($profilePic) {
            if (Str::startsWith($profilePic, 'data:image')) {
            $profilePicUrl = $profilePic;
            } elseif (filter_var($profilePic, FILTER_VALIDATE_URL)) {
            $profilePicUrl = $profilePic;
            } else {
            $profilePicUrl = asset('storage/' . $profilePic);
            }
            } else {
            $profilePicUrl = asset('user/assets/img/profile.png');
            }
            @endphp
            <img class="avatar" width="100" height="100" style="border-radius: 50px;" alt="Profile Photo" src="{{ $profilePicUrl }}">
        </a>
    </div>
    <h1 class="uk-page-heading-h">{{ $user->name }}</h1>
    <p class="uk-heading-text">{{ $createdDate }}</p>
</div>

<div data-uk-filter="target: .js-filter">
    <div class="fl-subnav">
        <ul class=" uk-subnav uk-subnav-pill">
            <li class="uk-active" data-uk-filter-control="[data-type='info']"><a href="#"><i class="ico_report"></i>Account Info</a></li>
            <li data-uk-filter-control="[data-type='listgameplay']"><a href="#"><i class="icon-game-controller"></i>Your Gameplays</a></li>
            <li data-uk-filter-control="[data-type='uploadgameplay']"><a href="#"><i class="icon-game-controller"></i>Upload Gameplay</a></li>
            <li data-uk-filter-control="[data-type='accountdeletion']"><a href="#">Account Deletion</a></li>
        </ul>
    </div>
    <div class="uk-width-1-1">
        <div class="js-filter" data-uk-grid>

            <div class="row" data-type="info">
                <div class="col-md-6">
                    <div class="section-box">
                        <div class="container">
                            <div class="panel-white mb-30">
                                <div class="box-padding">
                                    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                                        @csrf
                                    </form>

                                    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
                                        @csrf
                                        @method('patch')

                                        <div class="row">
                                            <div class="col-lg-12 col-md-12">
                                                <div class="form-group mb-30">
                                                    <label class="font-sm mb-10">Full Name *</label>
                                                    <input class="form-control" id="name" name="name" type="text" placeholder="Steven Job" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
                                                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12">
                                                <div class="form-group mb-30">
                                                    <label class="font-sm mb-10">Email *</label>
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
                <div class="col-md-6">
                    <div class="section-box">
                        <div class="container">
                            <div class="panel-white mb-30">
                                <div class="box-padding">
                                    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
                                        @csrf
                                        @method('put')

                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group mb-30">
                                                    <label class="font-sm  mb-10">{{ __('Current Password') }}</label>
                                                    <input class="form-control" id="update_password_current_password" name="current_password" type="password" placeholder="Current Password" autocomplete="current-password">
                                                    <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group mb-30">
                                                    <label class="font-sm  mb-10">{{ __('New Password') }}</label>
                                                    <input class="form-control" id="update_password_password" name="password" type="password" placeholder="New Password" autocomplete="new-password">
                                                    <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group mb-30">
                                                    <label class="font-sm  mb-10">{{ __('Confirm Password') }}</label>
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

            <div class="row" data-type="listgameplay">
                <div class="col-xl-12">
                    <div class="row">
                        <div class="col-lg-12">
                            @if($userGameplays->isEmpty())
                            <div class="stream-item">
                                <div class="stream-item__box">
                                    <div class="stream-item__body">
                                        <div class="stream-item__title">No gameplays uploaded.</div>
                                    </div>
                                </div>
                            </div>
                            @else
                            <div class="row">
                                @foreach($userGameplays as $gameplay)

                                <div class="col-md-3">
                                    <div class="stream-item">
                                        <div class="stream-item__box">
                                            <div class="stream-item__media" data-uk-lightbox="video-autoplay: true">
                                                <div class="video">
                                                    <video src="{{ Storage::url($gameplay->video) }}" controls></video>
                                                </div>
                                                <div class="stream-item__info">
                                                    <div class="stream-item__status">New</div>
                                                </div>
                                                <div class="stream-item__body">
                                                    <div class="stream-item__title">{{ $gameplay->title }}</div>
                                                    <div class="stream-item__time"><i class="icon-calendar"></i>{{ $gameplay->created_at->diffForHumans() }}</div>
                                                    <div class="mt-2 text-end">
                                                        <form action="{{ route('gameplays.delete', $gameplay->id) }}" method="POST" style="display:inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                @endforeach
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="row" data-type="uploadgameplay">
                <div class="col-xl-12">
                    <div class="section-box">
                        <div class="container">
                            <div class="panel-white mb-30">
                                <div class="box-padding">
                                    <form method="post" action="{{ route('gameplays.upload') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
                                        @csrf

                                        <div class="row">
                                            <div class="col-lg-12 col-md-12">
                                                <div class="form-group mb-30">
                                                    <label class="font-sm mb-10">Title *</label>
                                                    <input class="form-control" id="title" name="title" type="text" placeholder="Enter game title" value="{{ old('title') }}" required autofocus>
                                                    <x-input-error class="mt-2" :messages="$errors->get('title')" />
                                                </div>
                                            </div>

                                            <div class="col-lg-12 col-md-12">
                                                <div class="form-group mb-30">
                                                    <label class="font-sm mb-10">Thumbnail*</label>
                                                    <input class="form-control" id="thumbnail" name="thumbnail" type="file" required>
                                                    <x-input-error class="mt-2" :messages="$errors->get('thumbnail')" />
                                                </div>
                                            </div>

                                            <div class="col-lg-12 col-md-12">
                                                <div class="form-group mb-30">
                                                    <label class="font-sm mb-10">Video*</label>
                                                    <input class="form-control" id="video" name="video" type="file" required>
                                                    <x-input-error class="mt-2" :messages="$errors->get('video')" />
                                                </div>
                                            </div>

                                            <div class="col-lg-12 col-md-12">
                                                <div class="form-group mb-30">
                                                    <label class="font-sm mb-10">Category *</label>
                                                    <select name="category" class="form-control">
                                                        <option value=""></option>
                                                        @foreach($categories as $category)
                                                        <option value="{{ $category->id }}">{{ $category->category }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>


                                            <div class="col-lg-12">
                                                <div class="form-group mt-10">
                                                    <button class="btn btn-default btn-brand icon-tick">{{ __('Upload Game') }}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="row" data-type="accountdeletion">
                <div class="col-xl-12">
                    <div class="section-box">
                        <div class="container">
                            <div class="panel-white mb-30">
                                <div class="box-padding">
                                    <section class="space-y-6">
                                        <header>
                                            <h2 class="text-lg font-medium text-gray-900">
                                                {{ __('Delete Account') }}
                                            </h2>

                                            <p class="mt-1 text-sm text-gray-600">
                                                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
                                            </p>
                                        </header>

                                        <div class="form-group mt-10">
                                            <button type="button" class="btn btn-default" data-bs-toggle="modal" data-bs-target="#confirmUserDeletionModal">
                                                {{ __('Delete Account') }}
                                            </button>
                                        </div>

                                        <div class="modal fade" id="confirmUserDeletionModal" tabindex="-1" aria-labelledby="confirmUserDeletionLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="confirmUserDeletionLabel">{{ __('Are you sure you want to delete your account?') }}</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>
                                                            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                                                        </p>
                                                        <form method="post" action="{{ route('profile.destroy') }}">
                                                            @csrf
                                                            @method('delete')
                                                            <div class="form-group mb-30">
                                                                <label for="password" class="sr-only">{{ __('Password') }}</label>
                                                                <input
                                                                    class="form-control"
                                                                    id="password"
                                                                    name="password"
                                                                    type="password"
                                                                    placeholder="{{ __('Password') }}"
                                                                    required />
                                                                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                                    {{ __('Cancel') }}
                                                                </button>
                                                                <button type="submit" class="btn btn-danger">
                                                                    {{ __('Delete Account') }}
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </section>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

<!-- Update Profile Pic Modal -->
<div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="profilePicForm" enctype="multipart/form-data" method="POST" action="{{ route('user.profile.update') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="profileModalLabel">Update Profile Picture</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <input type="file" class="form-control" id="profilePicInput" name="profile_pic" accept="image/*">
                    </div>
                    <div class="text-center">
                        <img id="previewImage" src="{{ $profilePicUrl }}" class="img-fluid rounded-circle" width="150" height="150" alt="Preview">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-default btn-brand icon-tick">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.getElementById('profilePicInput').addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('previewImage').setAttribute('src', e.target.result);
            }
            reader.readAsDataURL(file);
        }
    });
</script>
@endpush

@stop