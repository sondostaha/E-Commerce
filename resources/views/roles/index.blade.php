@extends('layouts.admin')
@section('content')

@if (session()->has('Add'))
    <script>
        window.onload = function() {
            notif({
                msg: "Permission added successfully",
                type: "success"
            });
        }

    </script>
@endif

@if (session()->has('edit'))
    <script>
        window.onload = function() {
            notif({
                msg: "Permission updated successfully",

                type: "success"
            });
        }

    </script>
@endif

@if (session()->has('delete'))
    <script>
        window.onload = function() {
            notif({
                msg: "Permission deleted successfully",
                type: "error"
            });
        }

    </script>
@endif

    <div class="card">
        <div class="card-body">


<!-- row -->
<div class="row row-sm">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between">
                    <div class="col-lg-12 margin-tb">
                        <div class="pull-right">
                           
                                <a class="btn btn-primary btn-sm" href="{{ route('roles.create') }}">Add</a>
                            
                        </div>
                    </div>
                    <br>
                </div>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table mg-b-0 text-md-nowrap table-hover ">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Options</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $key => $role)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td>
                                      
                                            <a class="btn btn-success btn-sm"
                                                href="{{ route('roles.show', $role->id) }}">Show</a>
                                      
                                        
                                       
                                            <a class="btn btn-primary btn-sm"
                                                href="{{ route('roles.edit', $role->id) }}">Edite</a>
                                     

                                        @if ($role->name !== 'administrator')
                                           
                                                {!! Form::open(['method' => 'DELETE', 'route' => ['roles.destroy',
                                                $role->id], 'style' => 'display:inline']) !!}
                                                {!! Form::submit('delete', ['class' => 'btn btn-danger btn-sm']) !!}
                                                {!! Form::close() !!}
                                          
                                        @endif


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
<!-- row closed -->
</div>
<!-- Container closed -->

@endsection

