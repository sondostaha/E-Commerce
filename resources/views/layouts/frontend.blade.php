<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
        
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" 
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

        <link id="pagestyle" href="{{asset('frontend/css/bootstrap.min.css')}}" rel="stylesheet" />
        <link id="pagestyle" href="{{asset('frontend/css/bootstrap.css')}}" rel="stylesheet" />
        {{-- <link id="pagestyle" href="{{asset('frontend/css/bootstrap.rlt.css')}}" rel="stylesheet" />
        <link id="pagestyle" href="{{asset('frontend/css/bootstrap.rlt.min.css')}}" rel="stylesheet" /> --}}
        <link id="pagestyle" href="{{asset('frontend/css/owl.carousel.min.css')}}" rel="stylesheet" />
        <link id="pagestyle" href="{{asset('frontend/css/owl.theme.default.min.css')}}" rel="stylesheet" />







        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
     @include('layouts.inc3.frontendnav')
  <div class="wrapper ">
   
        <div class="content">

            @yield('content')
            
        </div>
       
    </div>

  </div>
  <script src="{{asset('frontend/js/jquery-3.6.4.min.js')}}"></script>

        <script src="{{asset('frontend/js/bootstrap.bundle.js')}}"></script>
        <script src="{{asset('frontend/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{asset('frontend/js/owl.carousel.min.js')}}"></script>
   
        <script src="{{asset('frontend/js/bootstrap.js')}}"></script>

        <script src="{{asset('frontend/js/bootstrap.min.js')}}"></script>


     
        @yield('scripts')
    </body>
</html>
