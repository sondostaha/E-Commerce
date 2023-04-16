<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="{{url('/')}}">E-commerce</a>
      @guest
      <a class="nav-link" href="{{route('admin.login')}}">Admin Login</a>
      @endguest
      @auth
      <a class="navbar-brand" href="{{url('/')}}">wecome {{Auth::user()->name}}</a>
        
      @endauth
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{url('/')}}">Home</a>
          </li>
        </li>
        @guest
          
        <li class="nav-item">
          <a class="nav-link" href="{{route('provider.register')}}">Provider Register</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('provider.login')}}">Provider Login</a>
            </li>
        <li class="nav-item">
        <a class="nav-link" href="{{route('register')}}">User Register</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('login')}}">login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('allcategories')}}">Categories</a>
          </li>
          <li class="nav-item">
            <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
          </li>
        </ul>
        @endguest
        @auth
        <li class="nav-item">
          <a class="nav-link" href="{{route('allcategories')}}">Categories</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('allcart')}}">Carts</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('wishlist')}}">WishList</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('orders')}}">Orders</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('logout')}}">Log Out</a>
          </li>

        <li class="nav-item">
          <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">{{Auth::user()->name}}</a>
        </li>
      </ul>
        @endauth
        <form method="GET" action="{{route('search.all')}}">
          <div class="input-group mb-3">
            <input 
              type="text" 
              name="search" 
              value="{{ request()->get('search') }}" 
              class="form-control" 
              placeholder="Search..." 
              aria-label="Search" 
              aria-describedby="button-addon2">
            <button class="btn btn-info" type="submit" id="button-addon2">Search</button>
          </div>
      </form>
      </div>
    </div>
  </nav>