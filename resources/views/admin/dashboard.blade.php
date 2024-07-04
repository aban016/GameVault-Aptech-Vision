@extends('layouts.admindefault')

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
        <div class="col-xxl-3 col-xl-6 col-lg-6 col-md-4 col-sm-6">
          <div class="card-style-1 hover-up">
            <div class="card-image"> <img src="assets/imgs/page/dashboard/computer.svg" alt="jobBox"></div>
            <div class="card-info">
              <div class="card-title">
                <h3>1568<span class="font-sm status up">25<span>%</span></span>
                </h3>
              </div>
              <p class="color-text-paragraph-2">Interview Schedules</p>
            </div>
          </div>
        </div>
        <div class="col-xxl-3 col-xl-6 col-lg-6 col-md-4 col-sm-6">
          <div class="card-style-1 hover-up">
            <div class="card-image"> <img src="assets/imgs/page/dashboard/bank.svg" alt="jobBox"></div>
            <div class="card-info">
              <div class="card-title">
                <h3>284<span class="font-sm status up">5<span>%</span></span>
                </h3>
              </div>
              <p class="color-text-paragraph-2">Applied Jobs</p>
            </div>
          </div>
        </div>
        <div class="col-xxl-3 col-xl-6 col-lg-6 col-md-4 col-sm-6">
          <div class="card-style-1 hover-up">
            <div class="card-image"> <img src="assets/imgs/page/dashboard/lamp.svg" alt="jobBox"></div>
            <div class="card-info">
              <div class="card-title">
                <h3>136<span class="font-sm status up">12<span>%</span></span>
                </h3>
              </div>
              <p class="color-text-paragraph-2">Task Bids Won</p>
            </div>
          </div>
        </div>
        <div class="col-xxl-3 col-xl-6 col-lg-6 col-md-4 col-sm-6">
          <div class="card-style-1 hover-up">
            <div class="card-image"> <img src="assets/imgs/page/dashboard/headphone.svg" alt="jobBox"></div>
            <div class="card-info">
              <div class="card-title">
                <h3>985<span class="font-sm status up">5<span>%</span></span>
                </h3>
              </div>
              <p class="color-text-paragraph-2">Application Sent</p>
            </div>
          </div>
        </div>
        <div class="col-xxl-3 col-xl-6 col-lg-6 col-md-4 col-sm-6">
          <div class="card-style-1 hover-up">
            <div class="card-image"> <img src="assets/imgs/page/dashboard/look.svg" alt="jobBox"></div>
            <div class="card-info">
              <div class="card-title">
                <h3>165<span class="font-sm status up">15<span>%</span></span>
                </h3>
              </div>
              <p class="color-text-paragraph-2">Profile Viewed</p>
            </div>
          </div>
        </div>
        <div class="col-xxl-3 col-xl-6 col-lg-6 col-md-4 col-sm-6">
          <div class="card-style-1 hover-up">
            <div class="card-image"> <img src="assets/imgs/page/dashboard/open-file.svg" alt="jobBox"></div>
            <div class="card-info">
              <div class="card-title">
                <h3>2356<span class="font-sm status down">- 2%</span>
                </h3>
              </div>
              <p class="color-text-paragraph-2">New Messages</p>
            </div>
          </div>
        </div>
        <div class="col-xxl-3 col-xl-6 col-lg-6 col-md-4 col-sm-6">
          <div class="card-style-1 hover-up">
            <div class="card-image"> <img src="assets/imgs/page/dashboard/doc.svg" alt="jobBox"></div>
            <div class="card-info">
              <div class="card-title">
                <h3>254<span class="font-sm status up">2<span>%</span></span>
                </h3>
              </div>
              <p class="color-text-paragraph-2">Articles Added</p>
            </div>
          </div>
        </div>
        <div class="col-xxl-3 col-xl-6 col-lg-6 col-md-4 col-sm-6">
          <div class="card-style-1 hover-up">
            <div class="card-image"> <img src="assets/imgs/page/dashboard/man.svg" alt="jobBox"></div>
            <div class="card-info">
              <div class="card-title">
                <h3>548<span class="font-sm status up">48<span>%</span></span>
                </h3>
              </div>
              <p class="color-text-paragraph-2">CV Added</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@stop