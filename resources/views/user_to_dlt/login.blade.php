@extends('user.app')
@section('content')
  <div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-bg">
    <div class="card col-lg-4 mx-auto">
    @if($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach($errors->all() as $error)
          <li>{{$error}}</li>
        @endforeach
      </ul>
    </div>
      @endif
      <div class="card-body px-5 py-5">
        <h3 class="card-title text-left mb-3">Login</h3>
        <form method="post" id="login-form" enctype="multipart/form-data" action="{{route('login.check')}}">
          {{csrf_field()}}
          <div class="form-group">
            <label>Email address</label>
            <input type="email" placeholder="Enter email address" name="email" class="form-control p_input" required>
          </div>
          <div class="form-group">
            <label>Password *</label>
            <input type="password" placeholder="Enter your password" name="password" class="form-control p_input" required>
          </div>
          <div class="text-center">
            <button type="submit" name="submit" class="btn btn-primary btn-block enter-btn">Login</button>
          </div>
          <p class="sign-up">New user?<a href="{{url('register')}}">Register</a></p>
        </form>
      </div>
    </div>
  </div>
  @endsection
