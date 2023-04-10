@extends('layouts.admin')
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
                        <th class="border-bottom-0">Options</th>
                        <th class="border-bottom-0"></th>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php $i=0 ?>
                    @foreach ($sub_categories as $categori)
                        
                    
                        <?php $i++?>
                    
                    <tr>
                        <td>{{$i}}</td>
                        <td>{{$categori->category->name}}</td>

                        <td>
                            <a href="#">{{$categori->name}}</a>
                            </td>
                        <td>{{$categori->description}}</td>
                     
                      <td> <img src="{{asset('category/sub_categories/images/'.$categori->image)}}" 
                        style="width:150px; height:150px;"> </td>
                        </td>
                        <td>
                            <div class="dropdown">
                                <button aria-expanded="false" aria-haspopup="true" class="btn ripple btn-primary"
                                data-toggle="dropdown" id="dropdownMenuButton" type="button"> Options<i class="fas fa-caret-down ml-1"></i></button>
                                <div  class="dropdown-menu tx-13">
                                    <a class="dropdown-item" href="{{route('edit.sub_category',$categori->id)}}" class="text-info fas fa-trash-alt">Edite </a>

                                    
                                    <a class="dropdown-item" href="{{ route('delete.sub_category',$categori->id) }}" class="text-danger fas fa-trash-alt">Delete</a>
                                    
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