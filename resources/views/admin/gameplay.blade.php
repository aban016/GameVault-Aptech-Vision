@extends('layouts.admindefault')

@section('title', 'Gameplays')

@section('content')

<div class="box-heading">
    <div class="box-title">
        <h3 class="mb-35">Gameplays</h3>
    </div>
    <div class="box-breadcrumb">
        <div class="breadcrumbs">
            <ul>
                <li><a class="icon-home">Admin</a></li>
                <li><span>Gameplays List</span></li>
            </ul>
        </div>
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
    <div class="col-xxl-12 col-xl-12 col-lg-12">
        <div class="section-box">
            <div class="container">
                <div class="panel-white">
                    <div class="panel-body">
                        <table class="table" id="gameplaysTable">
                            <thead>
                                <tr>
                                    <th scope="col">S.No</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Video</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Uploaded By</th>
                                    <th scope="col">Added Date</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $num = 1; @endphp
                                @foreach($gameplays as $gameplay)
                                <tr class="table-hover hover-up">
                                    <td>{{ $num++ }}</td>
                                    <td>{{ $gameplay->title }}</td>
                                    <td><iframe src="{{ $gameplay->video }}" width="80" height="80" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe></td>
                                    <td>{{ $gameplay->category }}</td>
                                    <td>{{ $gameplay->uploaded_by }}</td>
                                    <td>{{ $gameplay->created_at->format('Y-m-d') }}</td>
                                    <td>
                                        <form action="{{ route('admin.gameplay.delete', $gameplay->id) }}" method="POST" style="display:inline;">
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
        $('#gameplaysTable').DataTable({
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