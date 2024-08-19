@extends('layouts.admindefault')

@section('title', 'Reports')

@section('content')

<div class="box-heading">
    <div class="box-title">
        <h3 class="mb-35">All Reports</h3>
    </div>
    <div class="box-breadcrumb">
        <div class="breadcrumbs">
            <ul>
                <li> <a class="icon-home">Admin</a></li>
                <li><span>Report List</span></li>
            </ul>
        </div>
    </div>
</div>

<div class="row">
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
    </div>
    @elseif(session('error')){
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
    </div>
    }
    @endif
    <div class="col-xxl-12 col-xl-12 col-lg-12">
        <div class="section-box">
            <div class="container">
                <div class="panel-white">
                    <div class="panel-body">
                        <table class="table" id="reportsTable">
                            <thead>
                                <tr>
                                    <th scope="col">S.No</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Subject</th>
                                    <th scope="col">Details</th>
                                    <th scope="col">ScreenShot</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $num = 1; @endphp
                                @foreach($contacts as $contact)
                                <tr class="table-hover hover-up">
                                    <td>{{ $num++ }}</td>
                                    <td>{{ $contact->name }}</td>
                                    <td>{{ $contact->email }}</td>
                                    <td>{{ $contact->subject }}</td>
                                    <td>{{ $contact->detail }}</td>
                                    <td><img src="data:image/png;base64,{{ $contact->attach_file }}" style="width: 50px; height: 50px;" alt=""></td>
                                    <td>{{ $contact->created_at->format('Y-m-d') }}</td>
                                    <td>
                                        <form action="{{ route('admin.report.delete', $contact->id) }}" method="POST" style="display:inline;">
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
        $('#reportsTable').DataTable({
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