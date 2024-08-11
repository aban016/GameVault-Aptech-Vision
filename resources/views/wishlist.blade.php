@extends('layouts.default')

@section('title', 'Faourite Games')

@section('content')
<div class="uk-page-heading uk-height-medium uk-height-max-medium uk-flex uk-flex-column uk-flex-center uk-flex-middle uk-background-cover uk-light" data-src="{{ asset('user/assets/img/fl-heading01.jpg') }}" uk-img uk-parallax="bgy: -70">
    <div class="fl-hd-cover">
        <span class="decore-lt"></span>
        <span class="decore-lb"></span>
        <span class="decore-rt"></span>
        <span class="decore-rb"></span>
    </div>
    <h1 class="uk-page-heading-h">Favourite Games</h1>
    <p class="uk-heading-text">
    <div class="search">
        <div class="search__input"><i class="ico_search"></i><input type="search" name="search" placeholder="Search" id="search"></div>
    </div>
    </p>
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
        @foreach($favourites as $game)
        <li data-type="{{ $game->category }}">
            <div class="game-card">
                <div class="game-card__box">
                    <div class="game-card__media">
                        <a href="{{ route('games.show', ['id' => $game->id]) }}">
                            <img src="data:image/png;base64,{{ $game->cover }}" alt="{{ $game->title }}" />
                        </a>
                    </div>
                    <div class="game-card__info">
                        <a href="{{ route('games.show', ['id' => $game->id]) }}" class="game-card__title">{{ $game->title }}</a>
                        <div class="game-card__genre">{{ $game->category }}</div>
                        <div class="game-card__rating-and-price">
                            <div class="game-card__rating">
                                <span>{{ $game->rating }}</span>
                                <i class="ico_star"></i>
                            </div>
                            <div class="game-card__price">
                                <span style="font-size: 12px; color: grey;">| {{ $game->platform }}</span>
                            </div>
                        </div>
                        <div class="game-card__bottom mt-30">
                            <div class="row">
                                <div class="col-lg-7 col-7">
                                    <p class="game-card__price">
                                        @if($game->price == null)
                                        Free
                                        @else
                                        ${{ $game->price }}
                                        @endif
                                    </p>
                                </div>
                                @php
                                $isPurchased = \App\Models\UserGame::where('user_id', auth()->id())
                                ->where('game_id', $game->id)
                                ->exists();
                                @endphp

                                <div class="col-lg-5 col-5 text-end">
                                    @if($isPurchased)
                                    <a href="{{ route('user.library') }}" class="btn btn-default btn-brand" rel="join" style="text-decoration: line-through; pointer-events: none; opacity: 0.6;">Purchased</a>
                                    @else
                                    <a href="{{ route('games.show', ['id' => $game->id]) }}" class="btn btn-default btn-brand" rel="join">Purchase</a>
                                    @endif
                                </div>
                                
                                <a href="{{ route('user.favourite.remove', ['game_id' => $game->id]) }}" class="text-danger fw-bold p-3">Remove to favourites</a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>


        </li>
        @endforeach
    </ul>
</div>


@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('search');
        const gameCards = document.querySelectorAll('.js-filter > li');

        searchInput.addEventListener('input', filterGames);

        function filterGames() {
            const searchText = searchInput.value.toLowerCase();

            gameCards.forEach(card => {
                const title = card.querySelector('.game-card__title').textContent.toLowerCase();
                const genre = card.querySelector('.game-card__genre').textContent.toLowerCase();
                const category = card.getAttribute('data-type').toLowerCase();
                const priceElement = card.querySelector('.lead.fw-bold');
                const priceText = priceElement ? priceElement.textContent.replace('$', '').toLowerCase() : 'free';
                const price = priceText === 'free' ? 0 : parseFloat(priceText);

                let matchesSearch = title.includes(searchText) || genre.includes(searchText) || category.includes(searchText);
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