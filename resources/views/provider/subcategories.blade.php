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
          
            <table id="example" class="table key-buttons text-md-nowrap">
                <thead>
                    <tr>
                        <th class="border-bottom-0">ID</th>
                        <th class="border-bottom-0">Category name</th>
                        <th class="border-bottom-0"> Name </th>
                        <th class="border-bottom-0">Description</th>
                        <th class="border-bottom-0">Image</th>
                        <th class="border-bottom-0">Add Product</th>
                        <th class="border-bottom-0"></th>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php $i=0 ?>
                    @foreach ($sub_categories as $category)
                        
                    
                        <?php $i++?>
                    
                    <tr>
                        <td>{{$i}}</td>
                        <td>{{$category->category->name}}</td>

                        <td>
                            <a href="#">{{$category->name}}</a>
                            </td>
                        <td>{{$category->description}}</td>
                     
                      <td> <img src="{{asset('category/sub_categories/images/'.$category->image)}}" 
                        style="width:150px; height:150px;"> </td>
                        
                        <td>
                            <div class="pull-right">
                                <a class="btn btn-primary" href="#"> Add</a>
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