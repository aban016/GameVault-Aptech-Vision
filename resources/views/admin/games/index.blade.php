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
<div class="row mb-3">
  <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 col-12">
    <a class="btn btn-default icon-edit hover-up" href="{{route('admin.games.create')}}">Create New Game</a>
  </div>
</div>
<div class="row">
  @if(session('success'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
  </div>
  @elseif(session('error'))
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ session('error') }}
  </div>
  @endif
</div>
<div class="row">

  <div class="col-xxl-12 col-xl-12 col-lg-12">
    <div class="section-box">
      <div class="container">
        <div class="panel-white">
          <div class="panel-body">
            <table class="table" id="gamesTable">
              <thead>
                <tr>
                  <th scope="col">S.No</th>
                  <th scope="col">Title</th>
                  <th scope="col">Description</th>
                  <th scope="col">Category</th>
                  <th scope="col">Price</th>
                  <th scope="col">Rating</th>
                  <th scope="col">User</th>
                  <th scope="col">Release Year</th>
                  <th scope="col">Developer</th>
                  <th scope="col">Platform</th>
                  <th scope="col">Cover</th>
                  <th scope="col">Actions</th>
                </tr>
              </thead>
              <tbody>
                @php $num = 1; @endphp
                @foreach($games as $game)
                <tr class="table-hover hover-up">
                  <td>{{ $num++ }}</td>
                  <td>{{ $game->title }}</td>
                  <td>{{ $game->description }}</td>
                  <td>{{ $game->category }}</td>
                  <td>
                    @if($game->price == null)
                    Free
                    @else
                    ${{ $game->price }}
                    @endif
                  </td>
                  <td class="text-danger">{{ $game->rating }}</td>
                  <td>{{ $game->user->name }}</td>
                  <td>{{ $game->release_year }}</td>
                  <td>{{ $game->developer }}</td>
                  <td>{{ $game->platform }}</td>
                  <td>
                    <img src="data:image/png;base64,{{ $game->cover }}" alt="{{ $game->title }}" width="50">
                  </td>
                  <td>
                    <form action="{{ route('admin.games.edit', $game->id) }}" method="GET" style="display:inline;">
                      @csrf
                      <button type="submit" class="btn btn-sm btn-success">Edit</button>
                    </form>
                  </td>
                  <td>
                    <form action="{{ route('admin.games.delete', $game->id) }}" method="POST" style="display:inline;">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-sm btn-danger">X</button>
                    </form>
                  </td>
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
    $('#gamesTable').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "order": [
        [0, "asc"]
      ],
      "pageLength": 5,
    });
  });
</script>
@endpush


@stop