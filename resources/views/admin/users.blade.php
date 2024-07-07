@extends('layouts.admindefault')

@section('title', 'Users')

@section('content')

<link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.css">

<div class="box-heading">
  <div class="box-title">
    <h3 class="mb-35">Our Users</h3>
  </div>
  <div class="box-breadcrumb">
    <div class="breadcrumbs">
      <ul>
        <li> <a class="icon-home">Admin</a></li>
        <li><span>Users List</span></li>
      </ul>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-xxl-12 col-xl-12 col-lg-12">
    <div class="section-box">
      <div class="container">
        <div class="panel-white">
          <div class="panel-body">
            <div class="card-style-3 hover-up">
              <table class="table table-hover" id="userTable">
                <thead>
                  <tr>
                    <th scope="col">S.No</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Role</th>
                    <th scope="col">Last Activity</th>
                    <th scope="col">Registered Date</th>
                  </tr>
                </thead>
                <tbody>
                @php $num = 1; @endphp
                @foreach($users as $user)
                    <tr>
                        <td>{{ $num++ }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role }}</td>
                        <td>{{ $user->last_activity ? \Carbon\Carbon::parse($user->last_activity)->diffForHumans() : 'No activity yet' }}</td>
                        <td>{{ $user->created_at->format('Y-m-d') }}</td>
                    </tr>
                @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>

<script>
  let table = new DataTable('#userTable');
</script>
@stop