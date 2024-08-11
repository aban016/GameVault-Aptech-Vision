@extends('layouts.default')

@section('title', 'Library')

@section('content')
<div class="uk-page-heading uk-height-medium uk-height-max-medium uk-flex uk-flex-column uk-flex-center uk-flex-middle uk-background-cover uk-light" data-src="{{ asset('user/assets/img/fl-heading01.jpg') }}" uk-img uk-parallax="bgy: -70">
    <div class="fl-hd-cover">
        <span class="decore-lt"></span>
        <span class="decore-lb"></span>
        <span class="decore-rt"></span>
        <span class="decore-rb"></span>
    </div>
    <h1 class="uk-page-heading-h">Library</h1>
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
        @foreach($userGames as $game)
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
                        <div class="game-card__bottom p-3 text-center mx-auto">
                            <div class="row">
                                @if($game->installation_file)
                                <a href="{{ asset('storage/' . $game->installation_file) }}" download class="btn btn-default btn-brand" rel="join">Download</a>
                                @elseif($game->installation_file_link)
                                <a href="{{ $game->installation_file_link }}" target="_blank" class="btn btn-default btn-brand" rel="join">Install</a>
                                @else
                                <a href="#" class="btn btn-default btn-brand" rel="join" style="text-decoration: line-through; pointer-events: none; opacity: 0.6;">No Installation Available</a>
                                @endif

                                <a href="{{ route('user.library.remove', ['game_id' => $game->id]) }}" class="text-danger fw-bold p-3">Delete Game</a>
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