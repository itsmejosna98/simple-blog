@extends('layout.app')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title"> Category Form  </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('categories')}}">View Categories</a></li>
                    <!-- <li class="breadcrumb-item active" aria-current="page">Form elements</li> -->
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                @if ($messages = Session::get('error'))
            <div class="alert alert-danger">
               <ul>
                  @foreach (json_decode($messages, true) as $field => $errorMessages)
                  @foreach ($errorMessages as $errorMessage)
                  <li>{{$errorMessage}}</li>
                  @endforeach
                  @endforeach
               </ul>
            </div>
            @endif
                    <div class="card-body">
                        <h4 class="card-title">Add Category</h4>
                        <!-- <p class="card-description"> Horizontal form layout </p> -->
                        <form class="forms-sample" method="post" enctype="multipart/form-data" action="{{ url('category-store') }}">
    {{ csrf_field() }}

    <div class="form-group">
        <div class="col-sm-12">
            <div class="row">
            <label for="category" class="col-form-label">Category Name</label>
            <input type="text" class="form-control" id="category" required name="category" value="{{ old('category') }}" placeholder="Add category">
            @if ($errors->has('category'))
                <span class="help-block">
                    <small style="color: red;">{{ $errors->first('category') }}</small>
                </span>
            @endif
            </div><br>
            <div class="row">
            <button type="submit" class="btn btn-primary mr-2">Submit</button>
            </div>
        </div>
    </div><br><br>
</form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
