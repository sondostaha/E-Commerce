@extends('layouts.frontend')

@section('title')
<h1> E-Commerce  view {{$product->name}}</h1>
@endsection

@section('content')



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
                        </div>


                    </div>
                </div>
            </form>
        </div>
        </div>
    </div>
   </div>

@endsection
