<div class="sidebar" data-color="purple" data-background-color="white" data-image="../assets/img/sidebar-1.jpg">
    <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->
    <div class="logo"><a href="http://www.creative-tim.com" class="simple-text logo-normal">
        E-Commerce
      </a></div>
    <div class="sidebar-wrapper">
      <ul class="nav">
        <li class="nav-item active  ">
          <a class="nav-link" href="{{ route('admin.dashboard') }}">
            <i class="material-icons">dashboard</i>
            <p>Dashboard</p>
          </a>
        </li>
        @can('categories')
       
        <li class="nav-item ">
          <a class="nav-link" href="{{ route('admin.category') }}">
            <i class="material-icons">Categories</i>
            <p>Categories</p>
          </a>
        </li>
        @endcan
        @can('add-category')
        <li class="nav-item ">
          <a class="nav-link" href="{{ route('admin.addCategory') }}">
            <i class="material-icons">Add</i>
            <p>Add Categories</p>
          </a>
        </li>
        @endcan

        @can('sub-categories')
          
      
        <li class="nav-item ">
          <a class="nav-link" href="{{ route('admin.sub_categories') }}">
            <i class="material-icons">Sub</i>
            <p>Sub Categories</p>
          </a>
        </li>
        @endcan
        @can('add-sub-category')
        <li class="nav-item ">
          <a class="nav-link" href="{{ route('admin.add.sub_categories') }}">
            <i class="material-icons">Add</i>
            <p>Add Sub Categories</p>
          </a>
        </li>

        @endcan
       
        @can('add-admin')
        <li class="nav-item ">
          <a class="nav-link" href="{{ route('admins.create') }}">
            <i class="material-icons">Add</i>
            <p>Add Admin </p>
          </a>
        </li>

        @endcan
       
        @can('show-admin')
        <li class="nav-item ">
          <a class="nav-link" href="{{ route('admins.index') }}">
            <i class="material-icons">Show</i>
            <p> Show Admins</p>
          </a>
        </li>

        @endcan
       
        @can('role-list')
          
        
        <li class="nav-item ">
          <a class="nav-link" href="{{ route('roles.index') }}">
            <i class="material-icons">P</i>
            <p>Admin Permission</p>
          </a>
        </li>
        @endcan

        <li class="nav-item ">
          <a class="nav-link" href="{{ route('aallorders') }}">
            <i class="material-icons">Orders</i>
            <p>Orders</p>
          </a>
        </li>
        <li class="nav-item active-pro ">
          <a class="nav-link" href="./upgrade.html">
            <i class="material-icons">unarchive</i>
            <p>Upgrade to PRO</p>
          </a>
        </li>
      </ul>
    </div>
  </div>