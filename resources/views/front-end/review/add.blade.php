@extends('layouts.frontend')
@section('content')

@if (session()->has('Add'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>{{ session()->get('Add') }}</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
<div class="container py-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    @if($orders->count() > 0 )

                        <h4>You Are Writing A Review For {{$product->name}}</h4>
                        <form action="{{ route('store.review',$product->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{$product->id}}">
                            <textarea name="user_review" class="form-control" cols="30" rows="5" placeholder="Write a review"></textarea>
                            <button type="submit" class="btn btn-primary mt-3">Submit</button>
                        </form>

                    @else
                    <div class="alert alert-danger">
                        <h5>You Are Not Able To Write A Review</h5>
                        <p>
                            Only Customers Can Make A Review Please Try When You Add Order 
                        </p>
                        <a href="{{url('/')}}"> Go Back</a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection