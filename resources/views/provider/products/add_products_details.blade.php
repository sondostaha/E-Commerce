@extends('layouts.provider')
@section('content')
@if (session()->has('Add'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>{{ session()->get('Add') }}</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
    <div class="card">
        <div class="card-header">
            <h1>Add More Details to product {{$product->id}}</h1>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        <div class="card-body">
           <form action="{{ route('store.details',$product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="row">
                   
                    <div class="col-md-6">
                        <h1 class="form-control"> Product Name :  {{$product->name}}</h1>
                        
                    </div>
                    <div class="col">
                        <label for="inputName" class="control-label">Color</label>
                        <select name="color" id="color" class="form-control" onchange="myFunction()">
                            <!--placeholder-->
                            <option value="" selected disabled>Select Color of Product</option>
                            <option value="red">red</option>
                            <option value="green">green</option>
                            <option value="black">black</option>
                            <option value="white">white</option>
                            <option value="blue">blue</option>


                        </select>
                    </div>
                    <br>
                   
                    <div class="col">
                        <label for="inputName" class="control-label">Color</label>
                        <select name="size" id="size" class="form-control" onchange="myFunction()">
                            <!--placeholder-->
                            <option value="" selected disabled>Select Color of Product</option>
                            <option value="s">Small</option>
                            <option value="xs">X Small</option>
                            <option value="l">Large</option>
                            <option value="m">Medium</option>
                            <option value="xl">X Large</option>
                            <option value="xxl">XX Large</option>
                            <option value="xxxl">XXX Large</option>



                        </select>
                    </div>

                    <div class="col-md-12">
                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    </div>
            </div>
           </form>
        </div>
    </div>
@endsection