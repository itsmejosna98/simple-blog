@extends('layout.app')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title"> Categories </h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('category-create') }}">Add Category</a></li>
                    </ol>
                </nav>
            </div>
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            @if (Session::get('status') == "added")
                                <div class="alert alert-success" role="alert">
                                    Category Added Successfully
                                </div>
                            @endif
                            @if (Session::get('status') == "updated")
                                <div class="alert alert-success" role="alert">
                                    Category Updated Successfully
                                </div>
                            @endif
                            @if (Session::get('status') == "deleted")
                                <div class="alert alert-danger" role="alert">
                                    Category Deleted Successfully
                                </div>
                            @endif
                            <h4 class="card-title">Categories</h4>
                            <div class="table-responsive">
                                <table class="table" id="tableId">
                                    <thead>
                                        <tr>
                                            <th>Category Name</th>
                                            <th>Edit</th>
                                            <th>Remove</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($categories as $category)
                                            <tr id="dataRow_{{ $category->id }}">
                                                <td>{{$category->name}}</td>
                                                <td><a href="{{ url('category/'.$category->id.'/edit') }}">
                                                    <label class="badge badge-danger">Edit</label></a></td>
                                                <td><a href="{{ url('category/'.$category->id.'/delete') }}">
                                                    <label class="badge badge-danger">Remove</label></a></td>
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
