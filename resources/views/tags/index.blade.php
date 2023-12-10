@extends('layout.app')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title"> Tags </h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('tag-create') }}">Add Tag</a></li>
                    </ol>
                </nav>
            </div>
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            @if (Session::get('status') == "added")
                                <div class="alert alert-success" role="alert">
                                    Tag Added Successfully
                                </div>
                            @endif
                            @if (Session::get('status') == "updated")
                                <div class="alert alert-success" role="alert">
                                    Tag Updated Successfully
                                </div>
                            @endif
                            @if (Session::get('status') == "deleted")
                                <div class="alert alert-danger" role="alert">
                                    Tag Deleted Successfully
                                </div>
                            @endif
                            <h4 class="card-title">Tags</h4>
                            <div class="table-responsive">
                                <table class="table" id="tableId">
                                    <thead>
                                        <tr>
                                            <th>Tag Name</th>
                                            <th>Edit</th>
                                            <th>Remove</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($tags as $tag)
                                            <tr id="dataRow_{{ $tag->id }}">
                                                <td>{{$tag->name}}</td>
                                                <td><a href="{{ url('tag/'.$tag->id.'/edit') }}"><label
                                                            class="badge badge-danger">Edit</label></a></td>
                                                <td><a href="{{ url('tag/'.$tag->id.'/delete') }}"><label
                                                            class="badge badge-danger">Remove</label></a></td>
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
@endsection
