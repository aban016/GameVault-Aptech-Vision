@extends('layouts.admindefault')

@section('title', 'Dashboard')

@section('content')
<div class="box-heading">
  <div class="box-title">
    <h3 class="mb-35">Dashboard</h3>
  </div>
  <div class="box-breadcrumb">
    <div class="breadcrumbs">
      <ul>
        <li> <a class="icon-home">Admin</a></li>
        <li><span>Dashboard</span></li>
      </ul>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-xxl-8 col-xl-7 col-lg-7">
    <div class="section-box">
      <div class="row">
        <div class="col-xxl-4 col-xl-6 col-lg-6 col-md-4 col-sm-6">
          <div class="card-style-1 hover-up">
            <div class="card-image"> <img src="assets/imgs/page/dashboard/open-file.svg" alt="jobBox"></div>
            <div class="card-info text-end">
                <h3>2356
                </h3>
              <p class="color-text-paragraph-2">New Messages</p>
            </div>
          </div>
        </div>
        <div class="col-xxl-4 col-xl-6 col-lg-6 col-md-4 col-sm-6">
          <div class="card-style-1 hover-up">
            <div class="card-image"> <img src="assets/imgs/page/dashboard/doc.svg" alt="jobBox"></div>
            <div class="card-info text-end">
                <h3>254
                </h3>
              <p class="color-text-paragraph-2">Total Games</p>
            </div>
          </div>
        </div>
        <div class="col-xxl-4 col-xl-6 col-lg-6 col-md-4 col-sm-6">
          <div class="card-style-1 hover-up">
            <div class="card-image"> <img src="assets/imgs/page/dashboard/man.svg" alt="jobBox"></div>
            <div class="card-info text-end">
                <h3>548
                </h3> 
              <p class="color-text-paragraph-2">Our Users</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@stop