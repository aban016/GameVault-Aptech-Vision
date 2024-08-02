@extends('layouts.admindefault')

@section('title', 'Edit Game')

@section('content')
<div class="box-heading">
  <div class="box-title">
    <h3 class="mb-35">Edit Game Profile</h3>
  </div>
  <div class="box-breadcrumb">
    <div class="breadcrumbs">
      <ul>
        <li><a class="icon-home">Admin</a></li>
        <li><span>Edit Game</span></li>
      </ul>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-lg-12">
    <div class="section-box">
      <div class="container">
        <div class="panel-white mb-30">
          <div class="box-padding">
            <h5>Game Profile</h5>
            <form action="{{ route('admin.games.update', $game->id) }}" method="post" enctype="multipart/form-data">
              @csrf
              @method('PUT')
              <div class="row mt-30">
                <!-- Title -->
                <div class="col-lg-6 col-md-6">
                  <div class="form-group mb-30">
                    <label class="font-sm color-text-muted mb-10">Title<span class="text-danger">*</span></label>
                    <input class="form-control" type="text" name="title" placeholder="Game Title" value="{{ old('title', $game->title) }}">
                    @error('title')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                  </div>
                </div>

                <!-- Description -->
                <div class="col-lg-6 col-md-6">
                  <div class="form-group mb-30">
                    <label class="font-sm color-text-muted mb-10">Description<span class="text-danger">*</span></label>
                    <textarea class="form-control" name="description" rows="3" placeholder="Game Description">{{ old('description', $game->description) }}</textarea>
                    @error('description')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                  </div>
                </div>

                <!-- Game Profile Image -->
                <div class="col-lg-6 col-md-6">
                  <div class="form-group mb-30">
                    <label class="font-sm color-text-muted mb-10">Game Cover Image<span class="text-danger">*</span></label>
                    <input class="form-control" type="file" name="cover">
                    @error('cover')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                    <small>Current cover: <img src="data:image/jpeg;base64,{{ $game->cover }}" alt="Cover" width="100"></small>
                  </div>
                </div>

                <!-- Video -->
                <div class="col-lg-6 col-md-6">
                  <div class="form-group mb-30">
                    <label class="font-sm color-text-muted mb-10">Video</label>
                    <input class="form-control" type="text" name="video" placeholder="https://youtube.com/video.xyz" value="{{ old('video', $game->video) }}">
                    @error('video')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                  </div>
                </div>

                <!-- Price -->
                <div class="col-md-6">
                  <div class="form-group mb-30">
                    <label class="font-sm color-text-muted mb-10">Price</label>
                    <input class="form-control" type="text" name="price" placeholder="$13.99 USD" value="{{ old('price', $game->price) }}">
                    @error('price')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                  </div>
                </div>

                <!-- Rating -->
                <div class="col-md-6">
                  <div class="form-group mb-30">
                    <label class="font-sm color-text-muted mb-10">Rating</label>
                    <input class="form-control" type="number" step="0.1" name="rating" placeholder="4.7" value="{{ old('rating', $game->rating) }}">
                    @error('rating')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                  </div>
                </div>

                <!-- Release Year -->
                <div class="col-md-6">
                  <div class="form-group mb-30">
                    <label class="font-sm color-text-muted mb-10">Release Year<span class="text-danger">*</span></label>
                    <input class="form-control" type="text" name="release_year" placeholder="2023" value="{{ old('release_year', $game->release_year) }}">
                    @error('release_year')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                  </div>
                </div>

                <!-- Developer -->
                <div class="col-md-6">
                  <div class="form-group mb-30">
                    <label class="font-sm color-text-muted mb-10">Developer<span class="text-danger">*</span></label>
                    <input class="form-control" type="text" name="developer" placeholder="11 bit studios" value="{{ old('developer', $game->developer) }}">
                    @error('developer')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                  </div>
                </div>

                <!-- Platforms -->
                <div class="col-md-6">
                  <div class="form-group mb-30">
                    <label class="font-sm color-text-muted mb-10">Platforms<span class="text-danger">*</span></label>
                    <select class="form-control" name="platform">
                      <option value="Windows" {{ old('platform', $game->platform) == 'Windows' ? 'selected' : '' }}>Windows</option>
                      <option value="Apple" {{ old('platform', $game->platform) == 'Apple' ? 'selected' : '' }}>Apple</option>
                      <option value="Linux" {{ old('platform', $game->platform) == 'Linux' ? 'selected' : '' }}>Linux</option>
                      <option value="Android" {{ old('platform', $game->platform) == 'Android' ? 'selected' : '' }}>Android</option>
                      <option value="iOS" {{ old('platform', $game->platform) == 'iOS' ? 'selected' : '' }}>iOS</option>
                      <option value="WindowsApple" {{ old('platform', $game->platform) == 'WindowsApple' ? 'selected' : '' }}>Windows / Apple</option>
                    </select>
                    @error('platform')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                  </div>
                </div>

                <!-- Categories -->
                <div class="col-md-6">
                  <div class="form-group mb-30">
                    <label class="font-sm color-text-muted mb-10">Categories<span class="text-danger">*</span></label>
                    <select class="form-control" name="category">
                      @foreach ($categories as $category)
                      <option value="{{ $category->category }}" {{ old('category', $game->category) == $category->category ? 'selected' : '' }}>{{ $category->category }}</option>
                      @endforeach
                    </select>
                    @error('category')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                  </div>
                </div>

                <!-- Installation File -->
                <div class="col-md-6">
                  <div class="form-group mb-30">
                    <label class="font-sm color-text-muted mb-10">Installation File</label>
                    <input class="form-control" type="file" name="installation_file">
                    @error('installation_file')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                    <small>Current file: {{ $game->installation_file }}</small>
                  </div>
                </div>

                <!-- Installation File Link -->
                <div class="col-md-6">
                  <div class="form-group mb-30">
                    <label class="font-sm color-text-muted mb-10">Installation Url</label>
                    <input class="form-control" type="text" name="installation_file_link" placeholder="11 bit studios" value="{{ old('installation_file_link', $game->installation_file_link) }}">
                    @error('installation_file_link')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                  </div>
                </div>

                <!-- Submit Button -->
                <div class="col-lg-12">
                  <div class="form-group mt-10">
                    <button class="btn btn-default btn-brand icon-tick" type="submit">Update Game Profile</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@stop
