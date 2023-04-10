@extends('layouts.frontend')

@section('title')
<h1> E-Commerce Category</h1>
@endsection
@section('content')
   
<div class="col-sm-1 col-md-2">
                   

</div>
    <div class="py-5">
        <div class="container">
            <div class="row">
    <a class="btn btn-primary btn-sm" href="{{ url('/') }}">Back</a>

                <div class="col-md-12">
                <h1>{{$sub_categories->name}}</h1>
<br>
                    <div class="row">
                        @foreach ($products as $product )
                        <div class="col-md-4 mb-3">
                            <div class="card">
                                <img src="{{ asset('products/'.$product->image) }}" alt="Product Image">
                                <div class="card-body">
                                    <h5>{{$product->name}}</h5>
                                    <span class="float-start">${{$product->selling_price}}</span>
                                    <span class="float-end"><s>${{$product->original_price}}</s></span>

                                </div>

                                </div>
                            </div>
                        </div>
                    @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection