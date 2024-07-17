@extends('layouts.default')

@section('title', 'Premium Games')

@section('content')
<div class="uk-grid" data-uk-grid>
<div class="widjet --filters">
        <div class="uk-page-heading uk-height-medium uk-height-max-medium uk-flex uk-flex-column uk-flex-center uk-flex-middle uk-background-cover uk-light" data-src="assets/img/heading8.jpg" uk-img uk-parallax="bgy: -70">
            <div class="fl-hd-cover">
                <span class="decore-lt"></span>
                <span class="decore-lb"></span>
                <span class="decore-rt"></span>
                <span class="decore-rb"></span>
            </div>
            <h1 class="uk-page-heading-h">Premium Games</h1>
            <p class="uk-heading-text">Play like real and enjoy!</p>
        </div>
        <div class="widjet__body">
            <div class="uk-grid uk-child-width-1-6@xl uk-child-width-1-3@l uk-child-width-1-2@s uk-flex-middle uk-grid-small" data-uk-grid>
                <div class="uk-width-1-1">
                    <div class="search">
                        <div class="search__input"><i class="ico_search"></i><input type="search" name="search" placeholder="Search"></div>
                        <div class="search__btn"><button type="button"><i class="ico_microphone"></i></button></div>
                    </div>
                </div>
                <div><select class="js-select">
                        <option value="">Sort By: Price</option>
                        <option value="Price 1">Price 1</option>
                        <option value="Price 2">Price 2</option>
                        <option value="Price 3">Price 3</option>
                    </select></div>
                <div><select class="js-select">
                        <option value="">Category: Strategy</option>
                        <option value="Category 1">Category 1</option>
                        <option value="Category 2">Category 2</option>
                        <option value="Category 3">Category 3</option>
                    </select></div>
                <div><select class="js-select">
                        <option value="">Platform: All</option>
                        <option value="Platform 1">Platform 1</option>
                        <option value="Platform 2">Platform 2</option>
                        <option value="Platform 3">Platform 3</option>
                    </select></div>
                <div><select class="js-select">
                        <option value=""># of Players: All</option>
                        <option value="Platform 1">Platform 1</option>
                        <option value="Platform 2">Platform 2</option>
                        <option value="Platform 3">Platform 3</option>
                    </select></div>
                <div>
                    <div class="price-range"><label>Price</label><input class="uk-range" type="range" value="2" min="0" max="10" step="0.1"></div>
                </div>
                <div class="uk-text-right"><a href="#!">25 items</a></div>
            </div>
        </div>
    </div>
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