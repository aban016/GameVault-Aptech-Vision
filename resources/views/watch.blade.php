@extends('layouts.default')

@section('title', 'Watch')

@section('content')

<div class="uk-page-heading uk-height-medium uk-height-max-medium uk-flex uk-flex-column uk-flex-center uk-flex-middle uk-background-cover uk-light" data-src="{{ asset('user/assets/img/fl-heading01.jpg') }}" uk-img uk-parallax="bgy: -70">
    <div class="fl-hd-cover">
        <span class="decore-lt"></span>
        <span class="decore-lb"></span>
        <span class="decore-rt"></span>
        <span class="decore-rb"></span>
    </div>
    <h1 class="uk-page-heading-h">Watch Gameplays</h1>
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

        @foreach($gameplays as $gameplay)
        <li data-type="{{ $gameplay->category }}">
            <div class="stream-item">
                <div class="stream-item__box">
                    <div class="stream-item__media" data-uk-lightbox="video-autoplay: true">
                        <div class="video">
                            <video src="{{ Storage::url($gameplay->video) }}" controls></video>
                        </div>
                        <div class="stream-item__info">
                        <!-- Show 'New' badge if the game was uploaded within the last 2 days -->
                        @if($gameplay->created_at->diffInDays(now()) <= 1)
                            <div class="stream-item__status">New</div>
                        @endif
                    </div>
                        <div class="stream-item__body">
                            <div class="stream-item__title">{{ $gameplay->title }}</div>
                            <div class="stream-item__nicname">
                                Uploaded by:
                                @if(isset($users[$gameplay->uploaded_by]))
                                <strong>{{ $users[$gameplay->uploaded_by]->name }}</strong>
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

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('search');
        const streamItems = document.querySelectorAll('.stream-item');

        searchInput.addEventListener('input', filterStreams);

        function filterStreams() {
            const searchText = searchInput.value.toLowerCase();

            streamItems.forEach(item => {
                const title = item.querySelector('.stream-item__title').textContent.toLowerCase();
                const uploader = item.querySelector('.stream-item__nicname').textContent.toLowerCase();
                const status = item.querySelector('.stream-item__status').textContent.toLowerCase();

                let matchesSearch = title.includes(searchText) || uploader.includes(searchText) || status.includes(searchText);

                if (matchesSearch) {
                    item.style.display = '';
                } else {
                    item.style.display = 'none';
                }
            });
        }
    });
</script>
@endpush

@stop