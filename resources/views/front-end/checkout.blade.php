@extends('layouts.frontend')

@section('title')
<h1> E-Commerce  Checkout Products</h1>
@endsection

@section('content')
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
@if (session()->has('Add'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>{{ session()->get('Add') }}</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

<div class="container mt-8">
    <form action="{{ route('place_order') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-body">
                        <h4>Basic Details</h4>
                        <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="first_name">First Name</label>
                                    <input type="text" name="first_name" value="{{Auth::user()->name}}" class="form-control" placeholder="First name">
                                </div>
                                <div class="col-md-6">
                                    <label for="last_name">Last Name</label>
                                    <input type="text" name="last_name" class="form-control" placeholder="Last name">
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="">Email</label>
                                    <input type="text" name="email" value="{{Auth::user()->email}}" class="form-control" placeholder="email ">
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="">Phone Number</label>
                                    <input type="text" name="phone" class="form-control" placeholder="Phone Number">
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="">Address 1 </label>
                                    <input type="text" name="address_1" class="form-control" placeholder="Address 1">
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="">Address 2 </label>
                                    <input type="text" name="address_2" class="form-control" placeholder="Address 2">
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="">City</label>
                                    <input type="text" name="city" class="form-control" placeholder="City">
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="">State</label>
                                    <input type="text" name="state" class="form-control" placeholder="State">
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="">Country</label>
                                    <input type="text" name="country" class="form-control" placeholder="Country">
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="">Pin Code</label>
                                    <input type="text" name="pin_code" class="form-control" placeholder="Pin Code">
                                </div>
                            </div>
                        
                    
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card">
                    <div class="card-body">
                        <h6>Order Details</h6>
                        <hr>
                        @if($carts->count() > 0)
                        <table id="example" class="table table-bordered tabel-striped">
                            <thead>
                                <tr>

                                    <th class="border-bottom-0"> Product Name </th>
                                    <th class="border-bottom-0">Quantity</th>
                                    <th class="border-bottom-0"> Product price </th>
                                    <th class="border-bottom-0"> Total price </th>
                                    
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $total = 0;
                                @endphp
                                @foreach ($carts as $cart)
                                
                                <tr>
                                <td> {{$cart->product->name}} </td>
                                <td>{{$cart->quantity}}</td>
                                <td>${{$cart->product->selling_price}}</td>
                                <td>{{$total += $cart->product->selling_price * $cart->quantity}}</td>
                                
                                </tr>
                            @endforeach
                            </tbody>
                        
                        </table>
                        <br>
                        <button type="submit" class="btn btn-success">Place Order</button>

                        @else
                        <h1>there is no orders yet</h1>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>


@endsection