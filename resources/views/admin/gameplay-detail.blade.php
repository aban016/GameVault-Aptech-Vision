@extends('layouts.admindefault')

@section('title', 'Gameplay details')

@section('content')

<div class="box-heading">
    <div class="box-title">
        <h3 class="mb-35">{{ $gameplay->title }}</h3>
    </div>
    <div class="box-breadcrumb">
        <div class="breadcrumbs">
            <ul>
                <li><a class="icon-home">Admin</a></li>
                <li><span>Gameplay Details</span></li>
            </ul>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="section-box">
            <div class="container">
                <div class="panel-white">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6">
                                <video src="{{ Storage::url($gameplay->video) }}" style="width: 500px;" controls></video>
                            </div>
                            <div class="col-md-6">
                                <h4 class="my-3">Gameplay Details</h4>
                                <h6 class="mb-2"><strong>Title:</strong> {{ $gameplay->title }}</h6>
                                <h6 class="mb-2"><strong>Uploaded at:</strong> {{ $gameplay->created_at }}</h6>
                                <h6 class="mb-2"><strong>Uploaded by:</strong>
                                    @if($user = \App\Models\User::find($gameplay->uploaded_by))
                                    {{ $user->name }}
                                    @else
                                    Username not found
                                    @endif
                                </h6>
                                <h6 class="mb-2"><strong>Status:</strong>
                                    @if($gameplay->is_approve == false)
                                    <span class="badge bg-danger">Not Approve</span>
                                    @else
                                    <span class="badge bg-success">Approve</span>
                                    @endif
                                </h6>
                                <div class="action mt-5">
                                    @if($gameplay->is_approve == false)
                                    <a href="{{ route('admin.gameplay.approve', $gameplay->id) }}" class="btn btn-primary">Approve</a>
                                    @else
                                    <form action="{{ route('admin.gameplay.delete', $gameplay->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@stop