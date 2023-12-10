@extends('layout.app')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">Dashboard</h3>
        </div>
        <div class="row">
            <div class="col-lg-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Total Articles</h4>
                        <p class="card-text">{{$total_posts}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
