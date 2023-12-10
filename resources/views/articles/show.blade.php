@extends('layout.app')
@section('content')
<style>
    /* Style for single select box */
    #category {
        width: 100%; /* Adjust the width as needed */
        padding: 8px; /* Adjust the padding as needed */
        margin-bottom: 10px; /* Adjust the margin as needed */
    }

    /* Style for multiple select box */
    #tags {
        width: 100%; /* Adjust the width as needed */
        height: 120px; /* Adjust the height as needed */
        padding: 8px; /* Adjust the padding as needed */
        margin-bottom: 10px; /* Adjust the margin as needed */
    }
</style>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title"> Article Details  </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('articles')}}">View Articles</a></li>
                    <!-- <li class="breadcrumb-item active" aria-current="page">Form elements</li> -->
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">View Article details</h4>
                        <!-- <p class="card-description"> Horizontal form layout </p> -->
                        <form method="POST" action="{{ url('/article-update') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}

                    <input type="hidden" value="{{$id}}" name="hdn_id">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label> : {{$articles->title}}
                        <!-- <input type="text" readonly value="{{$articles->title}}" class="form-control" id="title" name="title" required> -->
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label> <br>
                         {{$articles->description}}
                        <!-- <textarea class="form-control" readonly value="{{$articles->description}}" id="description" name="description" rows="4" required>{{$articles->description}}</textarea> -->
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label> :   <img src="http://127.0.0.1:8000{{$articles->image}}" style="width:100px; height:100px;" alt="">
                        <!-- <input type="hidden" name="image" value="{{$articles->image}}"> -->
                        <!-- <input type="file" disabled class="form-control" id="image" name="image" accept="image/*"> -->
                    </div>

                    <div class="mb-3">
                        <label for="category" class="form-label">Category</label><br>
                        <select readonly class="form-select" id="category" name="category_id" required>
                        <option value="" readonly>Select category</option>
                              @foreach($categories as $category)
                              <option value="{{ $category->id }}" {{ $articles->tag_id == $category->id ? 'selected' : '' }}>
                                 {{ $category->name }}
                              </option>
                              @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="tags" class="form-label">Tags</label><br>
                        <select multiple readonly class="form-select" id="tags" name="tags[]" required>
                        <option value="" disabled>Select Tag</option>
                              @foreach($tags as $tag)
                              <option value="{{ $tag->id }}" {{ in_array($tag->id, $stored_tags) ? 'selected' : '' }}>
                                 {{ $tag->name }}
                              </option>
                              @endforeach
                        </select>
                    </div>
                </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
