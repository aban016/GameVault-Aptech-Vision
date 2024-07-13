@extends('layouts.default')

@section('title', 'Profile')

@section('content')
<div class="uk-grid" data-uk-grid>
    <div class="uk-width-3-4@l uk-width-3-4@m">
        <div class="uk-grid uk-child-width-2-2@l uk-child-width-2-2@m uk-child-width-1-1@s">
            <section class="b-post b-post-full b-post-single clearfix">
                <div class="uk-page-heading uk-page-heading-style-a uk-height-medium uk-height-max-medium uk-flex uk-flex-column uk-flex-center uk-flex-middle uk-background-cover uk-light" data-src="assets/img/heading3.jpg" uk-img uk-parallax="bgy: -20">
                    <div class="fl-hd-cover fl-hd-cover-02">
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

                <div class="fl-subnav">
                    <ul class="uk-subnav uk-subnav-pill" uk-margin>
                        <li class="uk-active"><a href="#"><i class="ico_home"></i>Overview</a></li>
                        <li><a href="#"><i class="ico_report"></i>Info</a></li>
                        <li><a href="#"><i class="icon-speedometer"></i>Activity </a></li>
                        <li><a href="#"><i class="icon-user-following"></i>Friends</a></li>
                        <li><a href="#"><i class="icon-game-controller"></i>Groups</a></li>
                    </ul>
                </div>
                

            </section>
        </div>
    </div>
</div>
@stop