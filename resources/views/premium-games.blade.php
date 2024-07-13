@extends('layouts.default')

@section('title', 'Premium Games')

@section('content')
<div class="uk-grid" data-uk-grid>
    <div class="uk-width-1-1">
        <h3 class="uk-text-lead">Best Premium Games</h3>
        <div class="js-store">
            <div class="swiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="game-card">
                            <div class="game-card__box">
                                <div class="game-card__media"><a href="10_game-profile.html"><img src="assets/img/game-1.jpg" alt="Struggle of Rivalry" /></a></div>
                                <div class="game-card__info"><a class="game-card__title" href="10_game-profile.html"> Struggle of Rivalry</a>
                                    <div class="game-card__genre">Shooter / Platformer</div>
                                    <div class="game-card__rating-and-price">
                                        <div class="game-card__rating"><span>4.8</span><i class="ico_star"></i></div>
                                        <div class="game-card__price"><span>$4.99 </span></div>
                                    </div>
                                    <div class="game-card__bottom">
                                        <div class="game-card__platform"><i class="ico_windows"></i><i class="ico_apple"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </div>
</div>
@stop