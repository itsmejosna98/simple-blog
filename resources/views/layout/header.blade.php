<div class="container-fluid page-body-wrapper">
  <!-- partial:../../partials/_navbar.html -->
  <nav class="navbar p-0 fixed-top d-flex flex-row">
    <div class="navbar-brand-wrapper d-flex d-lg-none align-items-center justify-content-center">
      <a class="navbar-brand brand-logo-mini" href="../../index.html"><img src="{{asset('../../assets/images/logo-mini.svg')}}" alt="logo" /></a>
    </div>
    <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
      <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
        <span class="mdi mdi-menu"></span>
      </button>
      <ul class="navbar-nav navbar-nav-right">
    <li class="nav-item dropdown">
        <a class="nav-link" id="profileDropdown" href="#" data-toggle="dropdown">
            <div class="navbar-profile">
                <img class="img-xs rounded-circle" src="{{ asset('../../assets/images/faces/face15.jpg') }}" alt="">
                @if(Auth::check())
                    <p class="mb-0 d-none d-sm-block navbar-profile-name">{{ Auth::user()->name }}</p>
                @else
                    <p class="mb-0 d-none d-sm-block navbar-profile-name">Guest</p>
                @endif
            </div>
        </a>

        <div class="preview-item-content">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-link" style="text-decoration: none; color: inherit;">
                    {{ __('Log Out') }}
                </button>
            </form>
        </div>
    </li>
</ul>

</div>
</nav>
<!-- partial -->
<!-- main-panel ends -->
</div>