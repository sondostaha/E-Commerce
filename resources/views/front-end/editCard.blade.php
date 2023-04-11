@extends('layouts.frontend')
@section('content')

@if (session()->has('Edite'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>{{ session()->get('Edite') }}</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

    <div class="card">
        <div class="card-body">
            <form action="{{ route('update.cart',$cart->id) }}" method="POST">
                @csrf
                <div class="row">
                <table id="example" class="table table-bordered tabel-striped">
                    <thead>
                        <tr>
                            <th class="border-bottom-0">ID</th>
                            <th class="border-bottom-0">Product image</th>
                            <th class="border-bottom-0"> Product Name </th>
                            <th class="border-bottom-0"> Product price </th>
                            <th class="border-bottom-0">Quantity</th>
                        
                            
                        </tr>
                    </thead>
                    <tbody>
                    
                    </tr>
                    <td>{{$cart->id}}</td>
                        <td>  <img src="{{ asset('products/'.$cart->product->image) }}" class="w-20"> </td>


                            <td>
                                <a href="{{ route('show.products',$cart->product->id) }}">{{$cart->product->name}}</a>
                                </td>

                            <td>${{$cart->product->selling_price}}</td>
                            <td>
                            <div class="col-md-2">
                                <label for="inputName" class="control-label">Quantity</label>
                                <select name="quantity" id="quantity"  class="form-control" onchange="myFunction()">
                                    <!--placeholder-->
                                    <option value="{{$cart->quantity}}" selected disabled>{{$cart->quantity}}</option>
                                    
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
                        
                        </td>
                        
                        </tr>
                    
                    </tbody>
                    
                  
                </div>
            </div>
           
            
        </div>
        </table>
        <div class="col-md-10">
            <br/>
               
                <button type="submit"  class="btn btn-primary" > Update </button>

            </div>
    </div>
    </form>
    <a class="btn btn-primary btn-sm" href="{{ route('allcart') }}">Back</a>

</div>
</div>
        </div>
    </div>
@endsection