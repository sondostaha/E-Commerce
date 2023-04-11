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
                        <th class="border-bottom-0">User Name</th>
                        <th class="border-bottom-0"> Product Name </th>
                        <th class="border-bottom-0">Quantity</th>
                        <th class="border-bottom-0">Image</th>
                        <th class="border-bottom-0">Delete</th>
                        <th class="border-bottom-0"></th>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php $i=0 ?>
                    @foreach ($wishs as $wish)
                        
                    
                        <?php $i++?>
                    
                    <tr>
                        <td>{{$i}}</td>
                        <td>{{$wish->user->name}}</td>

                        <td>
                            <a href="{{ route('show.products',$wish->product->id) }}">{{$wish->product->name}}</a>
                            </td>
                        <td>{{$wish->quantity}}</td>
                     
                      <td>  <img src="{{ asset('products/'.$wish->product->image) }}" class="w-20"> </td>
                        
                        <td>
                            <div class="pull-right">
                                <a class="btn btn-danger" href="{{ route('delete.wish',$wish->id) }}"> Delete</a>
                            </div>
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