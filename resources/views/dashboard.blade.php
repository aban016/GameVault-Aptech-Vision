@extends('layouts.default')

@section('title', 'Home')

@section('content')

<div class="uk-grid" data-uk-grid>
    <div class="uk-width-2-3@l uk-width-3-3@m uk-width-3-3@s">
        <div class="js-recommend">
            <div class="swiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="recommend-slide">
                            <div class="tour-slide__box">
                                <a href="#"><img src="assets/img/t1.jpg" alt="banner"></a>

                            </div>
                        </div>
                    </div>


                    <div class="swiper-slide">
                        <div class="recommend-slide">
                            <div class="tour-slide__box">
                                <a href="#"><img src="assets/img/t2.jpg" alt="banner"></a>


                            </div>
                        </div>
                    </div>


                    <div class="swiper-slide">
                        <div class="recommend-slide">
                            <div class="tour-slide__box">
                                <a href="#"><img src="assets/img/t1.jpg" alt="banner"></a>

                            </div>
                        </div>
                    </div>


                    <div class="swiper-slide">
                        <div class="recommend-slide">
                            <div class="tour-slide__box">
                                <a href="#"><img src="assets/img/t2.jpg" alt="banner"></a>


                            </div>
                        </div>
                    </div>







                </div>
                <div class="swipper-nav">
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </div>
    <div class="uk-width-1-3@l uk-width-3-3@m uk-width-3-3@s">
        <section class="widget section-sidebar bg-light">
            <h3 class="widget-title bg-dark"><i class="ic icon-list"></i>Categories</h3>
            <div class="widget-content">
                <div class="widget-inner">
                    <ul class="widget-list list list-mark-4">
                        @foreach($categories as $category)
                        <li class="widget-list__item"><a class="widget-list__link" href="16_post.html"> {{ $category->category }}</a></li>
                        @endforeach
                    </ul>

                </div>
            </div>
        </section>
    </div>
    <div class="uk-width-1-1">
        <h3 class="uk-text-lead">Best Selling Games</h3>
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