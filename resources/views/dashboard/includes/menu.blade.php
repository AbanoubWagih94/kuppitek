<!-- fixed-top-->
<nav class="navbar navbar-expand-md  fixed-top navbar-semi-light navbar-shadow bg-white">
    <a class="navbar-brand" href="{{ url('/') }}">
        <img src="{{ asset('admin/app-assets/images/logo/logo.png') }}" alt="Kuppitek Logo" class="logo">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="nav navbar-nav mr-auto">
        <li class="nav-item d-none d-md-block"><a href="{{ url('/') }}" class="nav-link nav-menu-main menu-toggle hidden-xs"  title="Homepage"><i class="fas fa-home fa-lg text-primary"></i></a></li>
        <li class="nav-item d-none d-md-block"><a class="nav-link nav-link-expand" href="#" title="Settings"><i class="fas fa-cogs fa-lg text-primary"></i></a></li>
      </ul>
    </div>
  </nav>