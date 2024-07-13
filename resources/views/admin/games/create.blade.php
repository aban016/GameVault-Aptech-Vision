@extends('layouts.admindefault')

@section('title', 'Games Create')

@section('content')
<div class="box-heading">
  <div class="box-title">
    <h3 class="mb-35">Add New Games</h3>
  </div>
  <div class="box-breadcrumb">
    <div class="breadcrumbs">
      <ul>
        <li> <a class="icon-home">Admin</a></li>
        <li><span>Games Create</span></li>
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
                    <form action="/update-game-profile" method="post" enctype="multipart/form-data">
                      <div class="row mt-30">
                        <div class="col-lg-6 col-md-6">
                          <div class="form-group mb-30">
                            <label class="font-sm color-text-mutted mb-10">Game Profile Image</label>
                            <div class="box-upload">
                              <div class="add-file-upload">
                                <input class="fileupload" type="file" name="profile_image">
                              </div>
                              <a class="btn btn-default">Upload File</a>
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                          <div class="form-group mb-30">
                            <label class="font-sm color-text-mutted mb-10">Gallery Images</label>
                            <div class="box-upload">
                              <div class="add-file-upload">
                                <input class="fileupload" type="file" name="gallery_images[]" multiple>
                              </div>
                              <a class="btn btn-default">Upload Files</a>
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-12">
                          <div class="form-group mb-30">
                            <label class="font-sm color-text-mutted mb-10">Description</label>
                            <textarea class="form-control" name="description" rows="5">TeamHost is a simulation and strategy game of managing a city struggling to survive after apocalyptic global cooling.</textarea>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group mb-30">
                            <label class="font-sm color-text-mutted mb-10">Rating</label>
                            <input class="form-control" type="number" step="0.1" name="rating" value="4.7">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group mb-30">
                            <label class="font-sm color-text-mutted mb-10">Release Date</label>
                            <input class="form-control" type="date" name="release_date" value="2018-04-24">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group mb-30">
                            <label class="font-sm color-text-mutted mb-10">Developer</label>
                            <input class="form-control" type="text" name="developer" value="11 bit studios">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group mb-30">
                            <label class="font-sm color-text-mutted mb-10">Platforms</label>
                            <input class="form-control" type="text" name="platforms" value="Windows, Apple">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group mb-30">
                            <label class="font-sm color-text-mutted mb-10">Categories</label>
                            <input class="form-control" type="text" name="categories" value="Strategy, Survival, City Builder, Dark">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group mb-30">
                            <label class="font-sm color-text-mutted mb-10">Price</label>
                            <input class="form-control" type="text" name="price" value="$13.99 USD">
                          </div>
                        </div>
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