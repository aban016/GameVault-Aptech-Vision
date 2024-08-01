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
                                <a href="#"><img src="{{ asset('user/assets/img/banners/banner1.jpg') }}" alt="banner"></a>

                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="recommend-slide">
                            <div class="tour-slide__box">
                                <a href="#"><img src="{{ asset('user/assets/img/banners/banner2.jpg') }}" alt="banner"></a>

                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="recommend-slide">
                            <div class="tour-slide__box">
                                <a href="#"><img src="{{ asset('user/assets/img/banners/banner3.jpg') }}" alt="banner"></a>

                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="recommend-slide">
                            <div class="tour-slide__box">
                                <a href="#"><img src="{{ asset('user/assets/img/banners/banner4.jpg') }}" alt="banner"></a>

                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="recommend-slide">
                            <div class="tour-slide__box">
                                <a href="#"><img src="{{ asset('user/assets/img/banners/banner5.jpg') }}" alt="banner"></a>

                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="recommend-slide">
                            <div class="tour-slide__box">
                                <a href="#"><img src="{{ asset('user/assets/img/banners/banner6.jpg') }}" alt="banner"></a>

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
    <!-- <div class="uk-width-1-3@l uk-width-3-3@m uk-width-3-3@s">
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
    </div> -->

    <div class="uk-width-1-3@l uk-width-3-3@m uk-width-3-3@s">
        <div class="js-trending">
            <div class="swiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="game-card --horizontal">
                            <div class="game-card__box">
                                <div class="game-card__media"><a href="10_game-profile.html"><img src="{{ asset('user/assets/img/banners/wallpaper.png') }}" alt="Alien Games" /></a></div>
                                <div class="game-card__info"><a class="game-card__title" href="10_game-profile.html"> Online Gaming</a>
                                    <div class="game-card__genre">Warring factions have brought the Origin System to the brink of destruction.</div>

                                    <div class="game-card__bottom">
                                        <a class="uk-button-read-more" href="{{ route('gameplays') }}">View More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </div>
    <div class="uk-width-1-1">
        <h3 class="uk-text-lead">Best Selling Games</h3>
        <div class="js-store">
            <div class="swiper">
                <div class="swiper-wrapper">

                    @foreach($bestGames as $game)
                    <div class="swiper-slide">
                        <div class="game-card">
                            <div class="game-card__box">
                                <div class="game-card__media">
                                    <a href="{{ url('games/' . $game->id) }}">
                                        <img src="{{ asset('user/assets/img/gamecovers/' . $game->cover) }}" alt="{{ $game->title }}" />
                                    </a>
                                </div>
                                <div class="game-card__info">
                                    <a class="game-card__title">{{ $game->title }}</a>
                                    <div class="game-card__genre">{{ $game->genre }}</div>
                                    <div class="game-card__rating-and-price">
                                        <div class="game-card__rating">
                                            <span>{{ $game->rating }}</span>
                                            <i class="ico_star"></i>
                                        </div>
                                    </div>
                                    <div class="game-card__bottom">
                                        <div class="game-card__platform">
                                            @if($game->platform == 'Windows')
                                            <i class="ico_windows"></i>
                                            @elseif($game->platform == 'Apple')
                                            <i class="ico_apple"></i>
                                            @else
                                            <i class="ico_windows"></i>
                                            <i class="ico_apple"></i>
                                            @endif
                                        </div>
                                        <div class="fl-gp-button">
                                        <a class="fl-gp-button" rel="join"> @if($game->price == 0.00)
                                            Free
                                            @else
                                            ${{ $game->price }}
                                            @endif </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>

                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </div>
    <div class="uk-width-1-1">
        <h3 class="uk-text-lead">Simulation Games</h3>
        <div class="js-store">
            <div class="swiper">
                <div class="swiper-wrapper">

                    @foreach($bestGames as $game)
                    <div class="swiper-slide">
                        <div class="game-card">
                            <div class="game-card__box">
                                <div class="game-card__media">
                                    <a href="{{ url('games/' . $game->id) }}">
                                        <img src="{{ asset('user/assets/img/gamecovers/' . $game->cover) }}" alt="{{ $game->title }}" />
                                    </a>
                                </div>
                                <div class="game-card__info">
                                    <a class="game-card__title">{{ $game->title }}</a>
                                    <div class="game-card__genre">{{ $game->genre }}</div>
                                    <div class="game-card__rating-and-price">
                                        <div class="game-card__rating">
                                            <span>{{ $game->rating }}</span>
                                            <i class="ico_star"></i>
                                        </div>
                                    </div>
                                    <div class="game-card__bottom">
                                        <div class="game-card__platform">
                                            @if($game->platform == 'Windows')
                                            <i class="ico_windows"></i>
                                            @elseif($game->platform == 'Apple')
                                            <i class="ico_apple"></i>
                                            @else
                                            <i class="ico_windows"></i>
                                            <i class="ico_apple"></i>
                                            @endif
                                        </div>
                                        <div class="fl-gp-button">
                                        <a class="fl-gp-button" rel="join"> @if($game->price == 0.00)
                                            Free
                                            @else
                                            ${{ $game->price }}
                                            @endif </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>

                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </div>
    <div class="uk-width-1-1">
        <h3 class="uk-text-lead">Arcade Games</h3>
        <div class="js-store">
            <div class="swiper">
                <div class="swiper-wrapper">

                    @foreach($bestGames as $game)
                    <div class="swiper-slide">
                        <div class="game-card">
                            <div class="game-card__box">
                                <div class="game-card__media">
                                    <a href="{{ url('games/' . $game->id) }}">
                                        <img src="{{ asset('user/assets/img/gamecovers/' . $game->cover) }}" alt="{{ $game->title }}" />
                                    </a>
                                </div>
                                <div class="game-card__info">
                                    <a class="game-card__title">{{ $game->title }}</a>
                                    <div class="game-card__genre">{{ $game->genre }}</div>
                                    <div class="game-card__rating-and-price">
                                        <div class="game-card__rating">
                                            <span>{{ $game->rating }}</span>
                                            <i class="ico_star"></i>
                                        </div>
                                    </div>
                                    <div class="game-card__bottom">
                                        <div class="game-card__platform">
                                            @if($game->platform == 'Windows')
                                            <i class="ico_windows"></i>
                                            @elseif($game->platform == 'Apple')
                                            <i class="ico_apple"></i>
                                            @else
                                            <i class="ico_windows"></i>
                                            <i class="ico_apple"></i>
                                            @endif
                                        </div>
                                        <div class="fl-gp-button">
                                        <a class="fl-gp-button" rel="join"> @if($game->price == 0.00)
                                            Free
                                            @else
                                            ${{ $game->price }}
                                            @endif </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>

                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('search');
        const gameCards = document.querySelectorAll('.swiper-slide');

        searchInput.addEventListener('input', filterGames);

        function filterGames() {
            const searchText = searchInput.value.toLowerCase();

            gameCards.forEach(card => {
                const title = card.querySelector('.game-card__title').textContent.toLowerCase();

                let matchesSearch = title.includes(searchText);

                if (matchesSearch) {
                    card.style.display = '';
                } else {
                    card.style.display = 'none';
                }
            });
        }
    });
</script>

@endpush

@stop