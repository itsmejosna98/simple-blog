@extends('layout.app')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title"> Tag Form  </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('tags')}}">View Tags</a></li>
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
                        <h4 class="card-title">Edit Tag</h4>
                        <!-- <p class="card-description"> Horizontal form layout </p> -->
                        <form class="forms-sample" method="post" enctype="multipart/form-data" action="{{ url('tag-update') }}">
    {{ csrf_field() }}
<input type="hidden" name="hdn_id" value="{{$id}}">
    <div class="form-group">
        <div class="col-sm-12">
            <div class="row">
            <label for="tag" class="col-form-label">Tag Name</label>
            <input type="text" required class="form-control" value="{{$tags->name}}" id="tag" name="tag" value="{{ old('tag') }}" placeholder="Add tag">
            @if ($errors->has('tag'))
                <span class="help-block">
                    <small style="color: red;">{{ $errors->first('tag') }}</small>
                </span>
            @endif
            </div><br>
            <div class="row">
            <button type="submit" class="btn btn-primary mr-2">Update</button>
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
