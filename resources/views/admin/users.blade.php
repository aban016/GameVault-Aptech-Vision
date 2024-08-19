@extends('layouts.admindefault')

@section('title', 'Users')

@section('content')

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
            <table class="table" id="userTable">
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
                <tr class="table-hover hover-up">
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

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script>
  $(document).ready(function() {
    $('#userTable').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "order": [
        [0, "asc"]
      ]
    });
  });
</script>
@endpush

@stop