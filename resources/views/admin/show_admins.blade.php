@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-body">
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<!-- row opened -->
<div class="row row-sm">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header pb-0">
                <div class="col-sm-1 col-md-2">
                   
                        <a class="btn btn-primary btn-sm" href="{{ route('admins.create') }}">Add Admmin</a>
                    
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive hoverable-table">
                    <table class="table table-hover" id="example1" data-page-length='50' style=" text-align: center;">
                        <thead>
                            <tr>
                                <th class="wd-10p border-bottom-0">ID</th>
                                <th class="wd-15p border-bottom-0">Name</th>
                                <th class="wd-20p border-bottom-0">Email </th>
                                <th class="wd-15p border-bottom-0">Type of Admins</th>
                                <th class="wd-10p border-bottom-0">Options</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key => $user)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td><a href="{{ route('admins.show',$user->id) }}">{{ $user->name }}</a></td>
                                    <td>{{ $user->email }}</td>
                                    

                                    <td>
                                       
                                            @foreach ($user->getRoleNames() as $v)
                                                <label class="badge badge-success">{{ $v }}</label>
                                            @endforeach
                                        
                                    </td>

                                    <td>
                                        <div class="dropdown">
                                            <button aria-expanded="false" aria-haspopup="true" class="btn ripple btn-primary"
                                            data-toggle="dropdown" id="dropdownMenuButton" type="button"> Options<i class="fas fa-caret-down ml-1"></i></button>
                                            <div  class="dropdown-menu tx-13">
                                                <a class="dropdown-item" href="{{route('admins.edit',$user->id)}}" class="btn btn-sm btn-info">Edite </a>
            
                                                
                                                <a class="dropdown-item" href="{{ route('admins.destroy',$user->id) }}" class="modal-effect btn btn-sm btn-danger">Delete</a>
                                                
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
    <!--/div-->


</div>
<!-- /row -->
</div>
<!-- Container closed -->


@endsection
