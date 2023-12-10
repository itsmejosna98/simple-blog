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
            <h3 class="page-title"> Article Form  </h3>
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
                        <h4 class="card-title">Add Article</h4>
                        <!-- <p class="card-description"> Horizontal form layout </p> -->
                        <form method="POST" action="{{ url('/article-store') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}


                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" required rows="4" ></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
                    </div>

                    <div class="mb-3">
                        <label for="category" class="form-label">Category</label><br>
                        <select class="form-select" id="category" name="category_id" required>
                        <option value="" readonly>Select category</option>
                              @foreach($categories as $category)
                              <option value="{{ $category->id }}">
                                 {{ $category->name }}
                              </option>
                              @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="tags" class="form-label">Tags</label><br>
                        <select multiple class="form-select" id="tags" name="tags[]" required>
                        <option value="" disabled>Select category</option>
                              @foreach($tags as $tag)
                              <option value="{{ $tag->id }}">
                                 {{ $tag->name }}
                              </option>
                              @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
