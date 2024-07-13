@extends('layouts.admindefault')

@section('title', 'Categories')

@section('content')

<div class="box-heading">
    <div class="box-title">
        <h3 class="mb-35">Categories</h3>
    </div>
    <div class="box-breadcrumb">
        <div class="breadcrumbs">
            <ul>
                <li> <a class="icon-home">Admin</a></li>
                <li><span>Category List</span></li>
            </ul>
        </div>
    </div>
</div>
<div class="row mb-3">
    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 col-12">
        <a class="btn btn-default icon-edit hover-up" data-bs-toggle="modal" data-bs-target="#categoryModal">Create New Game</a>
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
                        <div class="card-style-3">
                            <table class="table" id="categoryTable">
                                <thead>
                                    <tr>
                                        <th scope="col">S.No</th>
                                        <th scope="col">Category Name</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Added Date</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $num = 1; @endphp
                                    @foreach($categories as $category)
                                    <tr class="table-hover hover-up">
                                        <td>{{ $num++ }}</td>
                                        <td>{{ $category->category }}</td>
                                        <td>
                                            <form action="{{ route('admin.categories.toggleStatus', $category->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('PATCH')
                                                @if ($category->is_active)
                                                <button type="submit" class="btn btn-success btn-sm">Active</button>
                                                @else
                                                <button type="submit" class="btn btn-danger btn-sm">Inactive</button>
                                                @endif
                                            </form>

                                        </td>
                                        <td>{{ $category->created_at->format('Y-m-d') }}</td>
                                        <td>
                                            <form action="{{ route('admin.categories.delete', $category->id) }}" method="POST" style="display:inline;">
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
</div>

<!-- Create Category Modal -->
<div class="modal fade" id="categoryModal" tabindex="-1" aria-labelledby="categoryModal" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="categoryModal">Create Category</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('admin.categories.store') }}" class="mt-6 space-y-6">
                    @csrf
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="form-group mb-30">
                                <label class="font-sm color-text-muted mb-10">Category Name *</label>
                                <input class="form-control" id="category" name="category" type="text" placeholder="Enter category name" required>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group mt-10">
                                <button class="btn btn-default btn-brand icon-tick">Save</button>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#categoryTable').DataTable({
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