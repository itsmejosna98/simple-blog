@extends('layout.app')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title"> Articles </h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('article-create')}}">Add Article</a></li>
                    </ol>
                </nav>
            </div>
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            @if (Session::get('status') == "added")
                                <div class="alert alert-success" role="alert">
                                    Article Added Successfully
                                </div>
                            @endif
                            @if (Session::get('status') == "updated")
                                <div class="alert alert-success" role="alert">
                                    Article Updated Successfully
                                </div>
                            @endif
                            @if (Session::get('status') == "deleted")
                                <div class="alert alert-danger" role="alert">
                                    Article Deleted Successfully
                                </div>
                            @endif
                            <h4 class="card-title">Artcles</h4>
                            <div class="table-responsive">
                                <table class="table" id="tableId">
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <!-- <th>Description</th> -->
                                            <th>Image</th>
                                            <th>View</th>
                                            <th>Edit</th>
                                            <th>Remove</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($articles as $article)
                                            <tr id="dataRow_{{ $article->id }}">
                                                <td>{{$article->title}}</td>
                                                <!-- <td>{{$article->description}}</td> -->
                                                <td><img src="http://127.0.0.1:8000{{$article->image}}" style="width:50px; height:50px;" alt=""></td>
                                                <td><a href="{{ url('article/'.$article->id.'/show') }}">
                                                    <label class="badge badge-danger">View</label></a>
                                                </td>
                                                <td><a href="{{ url('article/'.$article->id.'/edit') }}">
                                                    <label class="badge badge-danger">Edit</label></a>
                                                </td>
                                                <td><a href="{{ url('article/'.$article->id.'/delete') }}">
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
