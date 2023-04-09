<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">

        <link id="pagestyle" href="{{asset('admin/css/material-dashboard.css')}}" rel="stylesheet" />


        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
     
  <div class="wrapper ">
    @include('layouts.inc2.sidebar')

    <div class="main-panel">

        @include('layouts.inc2.providernav')

        <div class="content">

            @yield('content')
            
        </div>
        @include('layouts.inc2.providerfooter')

    </div>

  </div>

        <script src="{{asset('admin/js/jquery.min.js')}}"></script>
        <script src="{{asset('admin/js/popper.min.js')}}"></script>
        <script src="{{asset('admin/js/bootstrap-material-design.min.js')}}"></script>
        <script src="{{asset('admin/js/perfect-scrollbar.jquery.min.js')}}"></script>
       
        @yield('scripts')
    </body>
</html>
