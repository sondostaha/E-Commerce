@extends('layouts.frontend')
@section('content')

@if (session()->has('Delete'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>{{ session()->get('Delete') }}</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

    <div class="card">
        <div class="card-body">
          
            <table id="example" class="table table-bordered tabel-striped">
                <thead>
                    <tr>
                        <th class="border-bottom-0">ID</th>
                        <th class="border-bottom-0">Product image</th>
                        <th class="border-bottom-0"> Product Name </th>
                        <th class="border-bottom-0"> Product price </th>
                        <th class="border-bottom-0">Quantity</th>
                        <th class="border-bottom-0">Delete</th>
                        <th class="border-bottom-0"></th>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php $i=0 ?>
                    @php
                        $total =0;
                    @endphp
                    @foreach ($carts as $cart)
                        
                    
                        <?php $i++?>
                    
                    <tr>
                        <td>{{$i}}</td>
                      <td>  <img src="{{ asset('products/'.$cart->product->image) }}" class="w-20"> </td>


                        <td>
                            <a href="{{ route('show.products',$cart->product->id) }}">{{$cart->product->name}}</a>
                            </td>
                        <td>${{$cart->product->selling_price}}</td>
                        <td>{{$cart->quantity}}
                            <br>
                            <a href="{{ route('edite.cart',$cart->id) }}" class="btn btn-info">Edite</a>
                        </td>
                     
                        
                        <td>
                            <div class="pull-right">
                                <a class="btn btn-danger" href="{{ route('delete.cart',$cart->id) }}"> Delete</a>
                            </div>
                    </tr>
                    @php $total += $cart->product->selling_price * $cart->quantity; @endphp
                   
                    @endforeach
                </tbody>
                <div class="card-footer">
                    <h1>Total Price = {{$total}}</h1>
                </div>
            </table>
            
        </div>
        
        
    </div>
</div>
</div>
        </div>
    </div>
@endsection