@extends('layouts.admin')
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
           <form action="{{ route('update.sub_category',$sub_categories->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col">
                    <label for="inputName" class="control-label">Categories</label>
                    <select name="category" class="form-control SlectBox" onclick="console.log($(this).val())"
                        onchange="console.log('change is firing')">
                        <!--placeholder-->
                        <option value="{{$sub_categories->category->id}}" selected disabled>{{$sub_categories->category->name}}</option>
                        @foreach ($categories as $category)
                            <option value="{{$category->id}}"> {{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="">Name</label>
                    <input type="text" class="form-control" name="name" value="{{$sub_categories->name}}">
                </div>
                <div class="col-md-6">
                    <textarea name="description"class="form-control" rows="3" placeholder="Description">{{$sub_categories->description}}</textarea>
                </div>
                <p class="text-danger">pleas add photo with this types  jpeg ,.jpg , png </p>
                
                <div class="col-sm-12 col-md-12">
                    <input type="file" name="image" class="dropify" accept=".jpg, .png, image/jpeg, image/png">
                </div><br>
                <div class="col-md-12">
                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
           </form>
        </div>
    </div>
@endsection