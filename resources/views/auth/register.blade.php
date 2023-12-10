@extends('auth.app')
@section('content')
<div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-bg">
  <div class="card col-lg-4 mx-auto">
    <div class="card-body px-5 py-5">
    @if($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops! Something went wrong.</strong>
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

      <h3 class="card-title text-left mb-3">Register</h3>
      <form id="validateForm" method="post" enctype="multipart/form-data" action="{{url('register-submit')}}">
        {{csrf_field()}}
          <div class="form-group">
            <label>Name*</label>
            <input type="text" placeholder="Enter your name" name="name" class="form-control p_input" required>
          </div>
          <div class="form-group">
            <label>Email address*</label>
            <input type="email" placeholder="Enter email address" name="email" class="form-control p_input" required>
          </div>
          <div class="form-group">
            <label>Password*</label>
            <input type="password" placeholder="Enter password" name="password" class="form-control p_input" required>
          </div>
          <div class="form-group">
            <label>Confirm Password*</label>
            <input type="password" placeholder="Enter confirm password" name="confirm_password" class="form-control p_input" required>
          </div>
        <div class="text-center" id="payable">
          <p id="payableAmountMessage"></p>
          <button type="submit" class="btn btn-primary btn-block enter-btn">Submit</button>
        </div>
        <p class="sign-up text-center">Already have account?<a href="{{url('login')}}"> Log In</a></p>
      </form>
    </div>
  </div>
</div>
@endsection