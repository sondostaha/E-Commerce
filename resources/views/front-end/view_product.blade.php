@extends('layouts.frontend')

@section('title')
<h1> E-Commerce  view {{$product->name}}</h1>
@endsection

@section('head')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@endsection

@section('content')

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{route('save.rating',$product->id)}}" method="POST">
                @csrf
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Rate {{$product->name}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="rating-css">
                            <div class="rate">
                                <input type="radio" id="star5" name="product_rating" value="5" />
                                <label for="star5"  title="text">5 stars</label>
                                <input type="radio" id="star4" name="product_rating" value="4" />
                                <label for="star4" title="text">4 stars</label>
                                <input type="radio" id="star3" name="product_rating" value="3" />
                                <label for="star3" title="text">3 stars</label>
                                <input type="radio" id="star2" name="product_rating" value="2" />
                                <label for="star2" title="text">2 stars</label>
                                <input type="radio" id="star1" name="product_rating" value="1" />
                                <label for="star1" title="text">1 star</label>
                              </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submint" class="btn btn-primary">Submit</button>
                    </div>

            </form>

        </div>
        </div>
    </div>

   <div class="py-3 mb-4 shadow-sm by-warning border-top">
    <div class="container">
        <h6 class="mb-0">
            Colloection/ {{$product->sub_category->name}} / {{$product->name}}
        </h6>
    </div>
   </div>
   @if (session()->has('Add'))
   <div class="alert alert-success alert-dismissible fade show" role="alert">
       <strong>{{ session()->get('Add') }}</strong>
       <button type="button" class="close" data-dismiss="alert" aria-label="Close">
           <span aria-hidden="true">&times;</span>
       </button>
   </div>
   @endif

   @if (count($errors) > 0)
        <div class="alert alert-danger">
            <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                <span aria-hidden="true">&times;</span>
            </button>
            <strong>Wrong</strong>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
   
   @if (session()->has('exist'))
   <div class="alert alert-danger alert-dismissible fade show" role="alert">
       <strong>{{ session()->get('exist') }}</strong>
       <button type="button" class="close" data-dismiss="alert" aria-label="Close">
           <span aria-hidden="true">&times;</span>
       </button>
   </div>
   @endif
   <div class="container">
    <div class="card-shadow product_data">
        <div class="card-body">
            <form action="{{ route('add.product.cart',$product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                <div class="row">
                    <div class="col-md-4 border-right" >
                        <img src="{{ asset('products/'.$product->image) }}" class="w-100" alt="">

                    </div>
                    <div class="col-md-8">
                        <h2 class="mb-0">
                            {{$product->name}}
                            <label style="font-size: 16px;" class="float-end badge bg-danger trending-tag">Tranding</label>
                        </h2>
                        <hr>
                        <label class="me-3">Original Price : <s>Egp{{$product->original_price}}</s></label>
                        <label class="fw-bold">Selling Price : Egp{{$product->selling_price}}</label>
                        @php
                            $ratenum = number_format($rating_value)
                        @endphp
                        <div class="rate">
                     

                            @for ($i = 0 ; $i <= $rating_value ;$i++ )
                            <input type="radio" value="{{$i}}" checked id="star{{$i}}"/>
                            <label for="star{{$i}}"  title="text"></label>
                            @endfor
                            @for ($j = $rating_value+1 ; $j <= 5 ; $j++ )
                            <i class="fa fa-star"></i>
                            @endfor
                            @if($rating->count() > 0)
                            <span>{{$rating->count()}}Rating</span> 

                            @else
                            <span> No Rating yet </span> 

                            @endif
                        </div>
                        <p class="mt-3">
                            {!!$product->description!!}
                        </p>
                        
                      
                        <hr>
                        @if($product->quantity > 0)
                        <label class="badge bg-success">In Stoke</label>
                        @else
                        <label class="badge bg-danger">Out Of Stoke</label>
                        @endif

                       

                       
                        <div class="row mt-2">

                            <div class="col-md-2">
                                <label for="inputName" class="control-label">Quantity</label>
                                <select name="quantity" id="quantity"  class="form-control" onchange="myFunction()">
                                    <!--placeholder-->
                                    <option value="0" selected disabled>0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                </select>
                            </div>
                            <div class="col-md-10">
                            <br/>
                            @if($product->quantity > 0)
                            <button type="submit"  class="btn btn-primary me-3 float-start" aria-placeholder="Add To Card">Add To Card   <i class="fa fa-shopping-cart"></i></button>
                            <a type="button" href="{{ route('add.product.add_wishlist',$product->id) }}" class="btn btn-success me-3 float-start">Add To Wishlist <i class="fa fa-heart"></i></a>

                            @else
                                <a type="button" href="{{ route('add.product.add_wishlist',$product->id) }}" class="btn btn-success me-3 float-start">Add To Wishlist <i class="fa fa-heart"></i></a>
                            @endif
                            </div>
                            <p class="mt-3">
                                {!!$product->description!!}
                            </p>
                           
                            </div>
                            <a type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                Rate this product
                              </a>
                            <a type="button" class="btn btn-link" href="{{ route('add.review',$product->id) }}">
                            Review this product
                            </a>
                        </div>

                        <div class="mt-3">
                            <h1>All Reviews</h1>
                           <h2>{{$reviews->user->name}} : <p>{{$reviews->user_review}}</p></h2>
                           
                        </div>


                    </div>
                </div>
            </form>
        </div>
        </div>
    </div>
   </div>

@endsection
