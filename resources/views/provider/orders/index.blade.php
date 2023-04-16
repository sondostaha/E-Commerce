@extends('layouts.provider')

@section('title')
 Orders
@endsection

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h6>All Orders</h6>
                </div>
               <div class="card-body">
                <table id="example" class="table table-bordered tabel-striped">
                    <thead>
                        <tr>
                            <th class="border-bottom-0"> User Name </th>
                            <th class="border-bottom-0"> Order Date </th>
                            <th class="border-bottom-0"> Traking Number </th>
                            <th class="border-bottom-0">Total Price</th>
                            <th class="border-bottom-0"> Status </th>
                            <th class="border-bottom-0"> Action </th>

                            
                        </tr>
                    </thead>
                    <tbody>
                        
                        @foreach ($orders as $order)
                        
                        <tr>
                         <td>{{$order->users->name}}</td>
                        <td>{{$order->created_at}}</td>
                        <td> {{$order->traking_number}} </td>
                        <td>{{$order->total_price}}</td>
                        <td>{{$order->status == '0' ? 'pandding' : 'completed'}}</td>

                        <td><a href="{{ route('pshow.order',$order->id) }}" class="btn btn-outline-primary">View</a></td>
                            
                        
                        </tr>
                    @endforeach
                    </tbody>
                
                </table>
               </div>

            </div>
        </div>
    </div>
</div>

@endsection