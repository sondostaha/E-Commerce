@extends('layouts.frontend')

@section('title')
<h1> E-Commerce Category</h1>
@endsection
@section('content')
   

    <div class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
<br>
                    <div class="row">
                        @foreach ($sub_categories as $category )
                        <div class="col-md-4 mb-3">
                            <div class="card">
                                <h5>{{$category->category->name}}</h5>

                                <img src="{{ asset('/category/sub_categories/images/'.$category->image) }}" alt="Product Image">
                                <div class="card-body">

                                    <h5>{{$category->name}}</h5>
                                    <p>{{$category->description}}</p>
                                
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