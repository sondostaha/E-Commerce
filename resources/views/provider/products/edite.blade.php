@extends('layouts.provider')
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
        <div class="card-header">
            <h1>Add Category</h1>

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
           <form action="{{ route('upadet.product',$product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="row">
                    <div class="col">
                        <label for="inputName" class="control-label">Categories</label>
                        <select name="category" class="form-control SlectBox" onclick="console.log($(this).val())"
                            onchange="console.log('change is firing')">
                            <!--placeholder-->
                            <option value="{{$product->sub_category->id}}" selected disabled>{{$product->sub_category->name}}</option>
                            @foreach ($sub_categories as $category)
                                <option value="{{ $category->id }}"> {{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="">Name</label>
                        <input type="text" class="form-control" name="name" value="{{$product->name}}">
                    </div>
                    <br>
                    <div class="col-md-6">
                        <textarea name="description"class="form-control" rows="3" placeholder="Description">{{$product->description}}</textarea>
                    </div>
                    <div class="col">
                        <label for="inputName" class="control-label">Original Price </label>
                        <input type="text" class="form-control" id="inputName" name="original_price" value="{{$product->original_price}}"
                            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                    </div>

                    <div class="col">
                        <label for="inputName" class="control-label">Selling Price</label>
                        <input type="text" class="form-control form-control-lg" id="selling_price" value="{{$product->selling_price}}"
                            name="selling_price" title="pleas select commission"
                            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                            value=0
                            required>
                    </div>

                    <div class="col">
                        <label for="inputName" class="control-label">Quantity </label>
                        <input type="text" class="form-control" id="inputName" name="quantity"
                            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" value="{{$product->quantity}}">
                    </div>

                   
                    <div class="col-md-12">
                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    </div>
            </div>
           </form>
        </div>
    </div>
@endsection