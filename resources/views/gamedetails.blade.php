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
            <button data-bs-toggle="modal" data-bs-target="#exampleModal" class="uk-button uk-button-buy uk-width-1-1" type="button"><span class="ico_shopping-cart"></span><span>Buy Now</span></button>
            <button class="uk-button uk-button-favorite uk-width-1-1" type="button"><span class="ico_add-square"></span><span>Add to Favourites</span></button>
        </div>
    </div>
</div>

<!-- Checkout Platforms Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Select Payment Method</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row p-2">
                    <div class="col-md-6">
                        <a href="{{ route('stripe.checkout',['price' => $game->price,'product' => $game->title]) }}">
                            <div class="card shadow border-0 p-3 text-center" style="border-radius: 2rem;">
                                <img src="{{ asset('user/assets/img/payment/stripe.png') }}" class="mx-auto" width="150px" alt="Stripe">
                                <h5>Pay with Stripe</h5>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a href="{{ route('paypal.checkout',['price' => $game->price,'product' => $game->title]) }}">
                            <div class="card shadow border-0 p-3 text-center" style="border-radius: 2rem;">
                                <img src="{{ asset('user/assets/img/payment/paypal.png') }}" class="mx-auto" width="150px" alt="PayPal">
                                <h5>Pay with PayPal</h5>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@stop