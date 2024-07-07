@extends('layouts.admindefault')

@section('title', 'Games')

@section('content')
<div class="box-heading">
  <div class="box-title">
    <h3 class="mb-35">Games List</h3>
  </div>
  <div class="box-breadcrumb">
    <div class="breadcrumbs">
      <ul>
        <li> <a class="icon-home">Admin</a></li>
        <li><span>Games List</span></li>
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
            <div class="box-filters-job">
              <div class="row">
                <div class="col-xl-6 col-lg-5">

                  <div class="header-search">
                    <div class="box-search">
                      <form action="">  
                        <input class="form-control input-search" type="text" name="keyword" placeholder="Search">
                      </form>
                    </div>
                  </div>
                </div>
                <div class="col-xl-6 col-lg-7 text-lg-end mt-sm-15">
                  <div class="display-flex2">
                    <div class="box-border mr-10"><span class="text-sortby">Show:</span>
                      <div class="dropdown dropdown-sort">
                        <button class="btn dropdown-toggle" id="dropdownSort" type="button" data-bs-toggle="dropdown" aria-expanded="false" data-bs-display="static"><span>12</span><i class="fi-rr-angle-small-down"></i></button>
                        <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="dropdownSort">
                          <li><a class="dropdown-item active" href="#">10</a></li>
                          <li><a class="dropdown-item" href="#">12</a></li>
                          <li><a class="dropdown-item" href="#">20</a></li>
                        </ul>
                      </div>
                    </div>
                    <div class="box-border"><span class="text-sortby">Sort by:</span>
                      <div class="dropdown dropdown-sort">
                        <button class="btn dropdown-toggle" id="dropdownSort2" type="button" data-bs-toggle="dropdown" aria-expanded="false" data-bs-display="static"><span>Newest Post</span><i class="fi-rr-angle-small-down"></i></button>
                        <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="dropdownSort2">
                          <li><a class="dropdown-item active" href="#">Newest Post</a></li>
                          <li><a class="dropdown-item" href="#">Oldest Post</a></li>
                          <li><a class="dropdown-item" href="#">Rating Post</a></li>
                        </ul>
                      </div>
                    </div>
                    <div class="box-view-type"><a class="view-type" href="my-job-list.html"><img src="assets/imgs/template/icons/icon-list.svg" alt="jobBox"></a><a class="view-type" href="my-job-grid.html"><img src="assets/imgs/template/icons/icon-grid-hover.svg" alt="jobBox"></a></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 col-12">
                <a class="btn btn-default icon-edit hover-up" href="{{route('admin.games.create')}}">Create New Game</a>
              </div>
            </div>
            <div class="row">
              <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 col-12">
                <div class="card-grid-2 hover-up">
                  <div class="card-grid-2-image-left"><span class="flash"></span>
                    <div class="image-box"><img src="assets/imgs/brands/brand-1.png" alt="jobBox"></div>
                    <div class="right-info"><a class="name-job" href="company-details.html">LinkedIn</a><span class="location-small">New York, US</span></div>
                  </div>
                  <div class="card-block-info">
                    <h6><a href="job-details.html">UI / UX Designer fulltime</a></h6>
                    <div class="mt-5"><span class="card-briefcase">Fulltime</span><span class="card-time">4<span> minutes ago</span></span></div>
                    <p class="font-sm color-text-paragraph mt-15">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Recusandae architecto eveniet, dolor quo repellendus pariatur</p>
                    <div class="mt-30"><a class="btn btn-grey-small mr-5" href="jobs-grid.html">Adobe XD</a><a class="btn btn-grey-small mr-5" href="jobs-grid.html">Figma</a><a class="btn btn-grey-small mr-5" href="jobs-grid.html">Photoshop</a>
                    </div>
                    <div class="card-2-bottom mt-30">
                      <div class="row">
                        <div class="col-lg-7 col-7"><span class="card-text-price">$500</span><span class="text-muted">/Hour</span></div>
                        <div class="col-lg-5 col-5 text-end">
                          <div class="btn btn-apply-now" data-bs-toggle="modal" data-bs-target="#ModalApplyJobForm">Apply now</div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="paginations">
              <ul class="pager">
                <li><a class="pager-prev" href="#"></a></li>
                <li><a class="pager-number" href="#">1</a></li>
                <li><a class="pager-number" href="#">2</a></li>
                <li><a class="pager-number" href="#">3</a></li>
                <li><a class="pager-number" href="#">4</a></li>
                <li><a class="pager-number" href="#">5</a></li>
                <li><a class="pager-number active" href="#">6</a></li>
                <li><a class="pager-number" href="#">7</a></li>
                <li><a class="pager-next" href="#"></a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@stop