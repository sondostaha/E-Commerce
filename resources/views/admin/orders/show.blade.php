@extends('layouts.admin')

@section('title')
 Orders
@endsection

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h6>My Orders</h6>
                    <a href="{{ route('ashow.order') }}" class="btn btn-warning text-white float-end">Back</a>
                </div>
               <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <label for="">First Name</label>
                        <div class="border py-2">{{$orders->first_name}}</div>
                        <label for="">Last Name</label>
                        <div class="border py-2">{{$orders->last_name}}</div>
                        <label for="">Email</label>
                        <div class="border py-2">{{$orders->email}}</div>
                        <label for="">Contact No.</label>
                        <div class="border py-2">{{$orders->phone}}</div>
                        <label for="">Shopping Adress </label>
                        <div class="border py-2">
                            {{$orders->address_1}}
                            {{$orders->address_2}}
                            {{$orders->city}}
                            {{$orders->state}}
                            {{$orders->country}}
                        </div>
                        <label for="">Zip Code</label>
                        <div class="border py-2">{{$orders->pin_code}}</div>
                      
                    </div>
                      
                    <div class="col-md-6">
                        <table id="example" class="table table-bordered tabel-striped">
                            <thead>
                                <tr>
        
                                    <th class="border-bottom-0">Name</th>
                                    <th class="border-bottom-0">Quantity</th>
                                    <th class="border-bottom-0"> Price </th>
                                    <th class="border-bottom-0"> Image </th>
        
                                    
                                </tr>
                            </thead>
                            <tbody>
                                
                                @foreach ($orders->orderdetail as $order)
                               

                                <tr>
                                <td> {{$order->products->name}} </td>
                                <td>{{$order->quantity}}</td>
                                <td>{{$order->price}}</td>
                                <td><img src="{{ asset('products/'.$order->products->image) }}" class="w-100" alt="Product Image"></td>
                                </tr>
                            @endforeach
                            </tbody>
                       
                        </table>
                        <h4>Grand Total : {{$orders->total_price}}</h4>
                    </div>
                </div>
               
               </div>

            </div>
        </div>
    </div>
</div>

@endsection