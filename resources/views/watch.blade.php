@extends('layouts.default')

@section('title', 'Watch')

@section('content')

<div class="uk-page-heading uk-height-medium uk-height-max-medium uk-flex uk-flex-column uk-flex-center uk-flex-middle uk-background-cover uk-light" data-src="assets/img/heading8.jpg" uk-img uk-parallax="bgy: -70">
    <div class="fl-hd-cover">
        <span class="decore-lt"></span>
        <span class="decore-lb"></span>
        <span class="decore-rt"></span>
        <span class="decore-rb"></span>
    </div>
    <h1 class="uk-page-heading-h">Watch Gameplays</h1>
    <p class="uk-heading-text">Search members from all around the world!</p>
</div>


<div data-uk-filter="target: .js-filter">
    <div class="fl-subnav">
        <ul class=" uk-subnav uk-subnav-pill">
            <li class="uk-active" data-uk-filter-control><a href="#">All</a></li>
            @foreach($categories as $category)
            <li data-uk-filter-control="[data-type='{{ $category->category }}']"><a href="#">{{ $category->category }}</a></li>
            @endforeach
        </ul>
    </div>
    <ul class="js-filter uk-grid-small uk-child-width-1-1 uk-child-width-1-5@xl uk-child-width-1-4@l uk-child-width-1-3@m uk-child-width-1-2@s" data-uk-grid>

        @foreach($gameplays as $gameplay)
        <li data-type="{{ $gameplay->category }}">
            <div class="stream-item">
                <div class="stream-item__box">
                    <div class="stream-item__media" data-uk-lightbox="video-autoplay: true">
                    <iframe src="{{ $gameplay->video }}" width="800" height="200" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                        <div class="stream-item__info">
                            <div class="stream-item__status">New</div>
                        </div>
                        <div class="stream-item__body">
                            <div class="stream-item__title">{{ $gameplay->title }}</div>
                            <div class="stream-item__nicname">
                                Uploaded by:
                                @if(isset($users[$gameplay->uploaded_by]))
                                {{ $users[$gameplay->uploaded_by]->name }}
                                @else
                                Unknown
                                @endif
                            </div>
                            <div class="stream-item__time"><i class="icon-calendar"></i>{{ $gameplay->created_at->diffForHumans() }}</div>
                        </div>
                    </div>
                </div>
        </li>   
        @endforeach <!-- Gameplays End Loop -->
    </ul>
</div>

@stop