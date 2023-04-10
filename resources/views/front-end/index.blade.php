@extends('layouts.frontend')

@section('title')
<h1> E-Commerce System</h1>
@endsection
@section('content')
   
    @include('layouts.inc3.slider')

    <div class="py-5">
        <div class="container">
            <div class="row">
                <h2>All Products</h2>
                <br>
                <div class="owl-carousel products-carousel owl-theme">
                    @foreach ($products as $product )
                        <div class="item">
                            <div class="card">
                                <img src="{{ asset('products/'.$product->image) }}" alt="Product Image">
                                <div class="card-body">
                                    <h5>{{$product->name}}</h5>
                                    <span class="float-start">${{$product->selling_price}}</span>
                                    <span class="float-end"><s>${{$product->original_price}}</s></span>

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                

            </div>
        </div>
    </div>
    
    <div class="py-5">
        <div class="container">
            <div class="row">
               
                <h1>All Categories</h1>
<br>
                    <div class="owl-carousel categories-carousel owl-theme">

                        @foreach ($categories as $category )
                        <div class="item">
                            <div class="card">
                                <a href="{{route('show.categories',$category->id)}}">

                                <img src="{{ asset('category/images/'.$category->image) }}" alt="Product Image">
                                <div class="card-body">
                                    <h5>{{$category->name}}</h5>
                                    <p>{{$category->description}}</p>
                                </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    </div>
                
            </div>
        </div>
    </div>

    <div class="py-5">
        <div class="container">
            <div class="row">
                <h2>All Sub Categories</h2>
<br>
                    <div class="owl-carousel sub_categories-carousel owl-theme">

                        @foreach ($sub_categories as $category )
                        <div class="item">
                            <div class="card">
                                <h5>{{$category->category->name}}</h5>
                                <a href="{{route('show.sub_categories',$category->id)}}">

                                <img src="{{ asset('/category/sub_categories/images/'.$category->image) }}" alt="Product Image">
                                <div class="card-body">
                                    <h5>{{$category->name}}</h5>
                                    <p>{{$category->description}}</p>
                                </a>
                                </div>
                            </div>
                        </div>
                         @endforeach
                    </div>
                
            </div>
        </div>
    </div>
    
    @section('scripts')
    <script>
        $('.products-carousel').owlCarousel({
            loop:true,
            margin:10,
            nav:true,
            dots:false,
            responsive:{
                0:{
                    items:1
                },
                600:{
                    items:3
                },
                1000:{
                    items:4
                }
            }
        })
    </script>

<script>
    $('.categories-carousel').owlCarousel({
        loop:true,
        margin:10,
        nav:true,
        dots:false,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:3
            },
            1000:{
                items:4
            }
        }
    })
</script>

<script>
    $('.sub_categories-carousel').owlCarousel({
        loop:true,
        margin:10,
        nav:true,
        dots:false,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:3
            },
            1000:{
                items:4
            }
        }
    })
</script>
    @endsection
@endsection