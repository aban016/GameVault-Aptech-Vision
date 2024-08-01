@extends('layouts.default')

@section('title', 'Premium Games')

@section('content')
<div class="uk-grid" data-uk-grid>
    <div class="widjet --filters">
        <h1>-> Premium Games</h1>
        <div class="widjet__body">
            <div class="uk-grid uk-child-width-1-6@xl uk-child-width-1-3@l uk-child-width-1-2@s uk-flex-middle uk-grid-small" data-uk-grid>
                <div class="uk-width-1-1">
                    <div class="search">
                        <div class="search__input"><i class="ico_search"></i><input type="search" name="search" placeholder="Search" id="search"></div>
                        <div class="search__btn"><button type="button"><i class="ico_microphone"></i></button></div>
                    </div>
                </div>
                <div><select class="js-select" id="priceFilter">
                        <option value="">Sort By: Price</option>
                        <option value="10-100">$10 - $100</option>
                        <option value="100-300">$100 - $300</option>
                        <option value="300-400">$300 - $400</option>
                        <option value="400-1000">$400 - $1000</option>
                    </select></div>
                <div><select class="js-select" id="categoryFilter">
                        <option value="">Category: All</option>
                        @foreach($categories as $category)
                        <option value="{{ strtolower($category->category) }}">{{ $category->category }}</option>
                        @endforeach
                    </select></div>
                <div><select class="js-select" id="platformFilter">
                        <option value="">Platform: All</option>
                        <option value="windows">Windows</option>
                        <option value="apple">Apple</option>
                    </select></div>
                <div class="uk-text-right"><a href="#!">25 items</a></div>
            </div>
        </div>
    </div>
    <div class="uk-width-1-1">
        <div class="js-store">
            <div class="row my-2">
                @foreach($premiumGames as $game)
                <div class="col-md-3">
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
                                        <i class="ico_star"></i> |
                                    </div>
                                    <div class="game-card__price">
                                        <span>
                                            @if($game->price == 0.00)
                                            Free
                                            @else
                                            ${{ $game->price }}
                                            @endif
                                        </span>
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
                                        <a class="fl-gp-button" rel="join" href="#"> Purchase </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('search');
        const categoryFilter = document.getElementById('categoryFilter');
        const platformFilter = document.getElementById('platformFilter');
        const priceFilter = document.getElementById('priceFilter');
        const gameCards = document.querySelectorAll('.col-md-3');

        searchInput.addEventListener('input', filterGames);
        categoryFilter.addEventListener('change', filterGames);
        platformFilter.addEventListener('change', filterGames);
        priceFilter.addEventListener('change', filterGames);

        function filterGames() {
            const searchText = searchInput.value.toLowerCase();
            const selectedCategory = categoryFilter.value.toLowerCase();
            const selectedPlatform = platformFilter.value.toLowerCase();
            const selectedPrice = priceFilter.value;

            gameCards.forEach(card => {
                const title = card.querySelector('.game-card__title').textContent.toLowerCase();
                const genre = card.querySelector('.game-card__genre').textContent.toLowerCase();
                const platformIcons = card.querySelectorAll('.game-card__platform i');
                const priceText = card.querySelector('.game-card__price span').textContent.replace('$', '');
                const price = parseFloat(priceText);

                let matchesSearch = title.includes(searchText);
                let matchesCategory = selectedCategory === '' || genre.includes(selectedCategory);
                let matchesPlatform = selectedPlatform === '' || Array.from(platformIcons).some(icon => icon.classList.contains(`ico_${selectedPlatform}`));
                let matchesPrice = selectedPrice === '' || (price >= parseFloat(selectedPrice.split('-')[0]) && price <= parseFloat(selectedPrice.split('-')[1]));

                if (matchesSearch && matchesCategory && matchesPlatform && matchesPrice) {
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