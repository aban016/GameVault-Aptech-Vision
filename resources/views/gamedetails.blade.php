@extends('layouts.default')

@section('title', $game->title)

@section('content')
<ul class="uk-breadcrumb">
    <li><a href="{{ back() }}"><span data-uk-icon="chevron-left"></span><span>Back to Home</span></a></li>
    <li><span>Playhub</span></li>
</ul>
<h3 class="uk-text-lead">Playhub</h3>
<div class="uk-grid uk-grid-small" data-uk-grid>
    <div class="uk-width-2-3@s">
        <div class="gallery">
            <div class="js-gallery-big gallery-big">
                <div class="swiper">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            @if($game->video)
                                <iframe width="100%" height="550" src="{{ $game->video }}" title="{{ $game->title }} Trailer" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
                                </iframe>
                            @endif
                        </div>
                        <div class="swiper-slide"><img src="data:image/png;base64,{{ $game->cover }}" alt="{{ $game->title }}"></div>
                    </div>
                </div>
            </div>
            <div class="js-gallery-small gallery-small">
                <div class="swiper">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            @if($game->video)
                                <iframe width="100%" src="{{ $game->video }}" title="{{ $game->title }} Trailer" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
                                </iframe>
                            @endif
                        </div>
                        <div class="swiper-slide"><img src="data:image/png;base64,{{ $game->cover }}" alt="{{ $game->title }}"></div>
                    </div>
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </div>
    <div class="uk-width-1-3@s">
        <div class="game-profile-card">
            <div class="game-profile-card__media">
                <img src="data:image/png;base64,{{ $game->cover }}" alt="{{ $game->title }}">
            </div>
            <div class="game-profile-card__intro">
                <span>{{ $game->description }}</span>
            </div>
            <ul class="game-profile-card__list">
                <li>
                    <div>Reviews:</div>
                    <div class="game-card__rating">
                        <span>{{ $game->rating }}</span>
                        <i class="ico_star"></i>
                    </div>
                </li>

                <li>
                    <div>Release Date</div>
                    @if($game->release_date)
                    <div>{{ $game->release_date->format('d M, Y') }}</div>
                    @else
                    <div>Release date not available</div>
                    @endif
                </li>

                <li>
                    <div>Developer:</div>
                    <div>{{ $game->developer }}</div>
                </li>
                <li>
                    <div>Platforms:</div>
                    <div>{{$game->platform}}</div>
                </li>
            </ul>
            <ul class="game-profile-card__type">
                <li><span>{{ $game->category }}</span></li>
            </ul>
        </div>
        <div class="game-profile-price">
            @if($game->price == null)
            <div class="game-profile-price__value">Free</div>
            @else
            <div class="game-profile-price__value">${{ $game->price }} USD</div>
            @endif
            <a href="{{ route('stripe.checkout',['price' => $game->price,'product' => $game->title]) }}" class="uk-button uk-button-buy uk-width-1-1" type="button"><span class="ico_shopping-cart"></span><span>Buy Now</span></a>
            <button class="uk-button uk-button-favorite uk-width-1-1" type="button"><span class="ico_add-square"></span><span>Add to Favourites</span></button>
        </div>
    </div>
</div>

@stop