<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="{{url('/')}}">E-commerce</a>
      <a class="nav-link" href="{{route('admin.login')}}">Admin Login</a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{url('/')}}">Home</a>
          </li>
        </li>
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
            <a class="nav-link" href="{{route('categories')}}">Categories</a>
          </li>
          <li class="nav-item">
            <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
          </li>
        </ul>
        <form class="d-flex">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
      </div>
    </div>
  </nav>