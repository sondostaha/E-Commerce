  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
    <div class="container-fluid">
      <div class="navbar-wrapper">
        <a class="navbar-brand" href="javascript:;">Admin {{Auth::user()->name}} Dashboard </a>
      </div>
      <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
        <span class="sr-only">Toggle navigation</span>
        <span class="navbar-toggler-icon icon-bar"></span>
        <span class="navbar-toggler-icon icon-bar"></span>
        <span class="navbar-toggler-icon icon-bar"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end">
        <form class="navbar-form">
          <div class="input-group no-border">
            <input type="text" value="" class="form-control" placeholder="Search...">
            <button type="submit" class="btn btn-white btn-round btn-just-icon">
              <i class="material-icons">search</i>
              <div class="ripple-container"></div>
            </button>
          </div>
        </form>
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="javascript:;">
              <i class="material-icons">Admin Dashboard </i>
              <p class="d-lg-none d-md-block">
                Stats
              </p>
            </a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="material-icons">notifications</i>
              <span class="notification">{{ auth()->user()->unreadNotifications->count() }}</span>
              <p class="d-lg-none d-md-block">
                Some Actions
              </p>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
              @foreach (auth()->user()->unreadNotifications as $notification )

              <a class="dropdown-item" href="{{$notification->data['url']}}">
                <div class="notifyimg bg-pink">
                  <i class="la la-file-alt text-white"></i>
                </div>
                
                <div class="mr-3">

                  <h5 class="notification-label mb-1" id="unraedtest">
                    {{$notification->data['title']}} {{$notification->data['user']}}
                  </h5>
                  <div class="notification-subtext">
                    {{$notification->created_at}}
                    </div>
                </div>
                
                <div class="mr-auto" >
                  <i class="las la-angle-left text-left text-muted"></i>
                </div>
                @endforeach
              </a>
              
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link" href="javascript:;" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="material-icons">person</i>
              <p class="d-lg-none d-md-block">
                Account
              </p>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
              <a class="dropdown-item" href="#">Profile</a>
              <a class="dropdown-item" href="#">Settings</a>
              <div class="dropdown-divider"></div>
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
              <a class="dropdown-item" href="{{route('admin.logout')}}"
              onclick="event.preventDefault();this.closest('form').submit();">
                {{ __('Log Out') }}
             </a>
            </form>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- End Navbar -->