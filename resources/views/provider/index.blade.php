@extends('layouts.provider')
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
                        <th class="border-bottom-0">Sun Category name</th>
                        <th class="border-bottom-0"> Product Name </th>
                        <th class="border-bottom-0">Description</th>
                        <th class="border-bottom-0">Original Price</th>
                        <th class="border-bottom-0">Selling Price</th>
                        <th class="border-bottom-0">Quantity</th>
                        <th class="border-bottom-0">Image</th>

                        <th class="border-bottom-0">Options</th>

                        
                    </tr>
                </thead>
                <tbody>
                    <?php $i=0 ?>
                    @foreach ($products as $product)
                        
                    
                        <?php $i++?>
                    
                    <tr>
                        <td>{{$i}}</td>

                        <td>{{$product->sub_category->name}}</td>

                        <td>
                            <a href="{{ route('show.details',$product->id) }}">{{$product->name}}</a>
                            </td>
                        <td>{{$product->description}}</td>

                        <td>{{$product->original_price}}</td>

                        <td>{{$product->selling_price}}</td>
                        <td>{{$product->quantity}}</td>


                     
                      <td> <img src="{{asset('products/'. $product->image)}}" 
                        style="width:150px; height:150px;"> </td>

                      

                        
                        <td>
                            <div class="dropdown">
                                <button aria-expanded="false" aria-haspopup="true" class="btn ripple btn-primary"
                                data-toggle="dropdown" id="dropdownMenuButton" type="button"> Options<i class="fas fa-caret-down ml-1"></i></button>
                                <div  class="dropdown-menu tx-13">
                                    <a class="dropdown-item" href="{{route('add.product.details',$product->id)}}" class="text-info fas fa-trash-alt">Add more details </a>

                                    <a class="dropdown-item" href="{{route('edite.product',$product->id)}}" class="text-info fas fa-trash-alt">Edite </a>

                                    
                                    <a class="dropdown-item" href="{{route('delete.product',$product->id)}}" class="text-danger fas fa-trash-alt">Delete</a>
                                    
                                </div>
                            </div>
                            
                        </td>
                    </tr>
                    

                   
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
        </div>
    </div>
@endsection