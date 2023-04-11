@extends('layouts.provider')
@section('content')

    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2> Show Product</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('provider.dashboard') }}"> Back</a>
        </div>
   

    <div class="row">

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Product Name:</strong>
                    {{ $product->name }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Description:</strong>
                    {{ $product->description }}
                </div>
            </div>
        
        
        
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Product Image:</strong>
                    <img src="{{asset('products/'. $product->image)}}" 
                    style="width:150px; height:150px;">
                </div>
            </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Product Sub Category:</strong>
                        {{ $product->sub_category->name }}
                    </div>
                </div>

            
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Selling Price:</strong>
                            <span class="float-start">${{$product->selling_price}}</span>
                            <strong>Original Price:</strong>
                            <span class="float-end"><s>${{$product->original_price}}</s></span>
                        </div>
                    </div>
                    
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Product quantity:</strong>
                                {{ $product->quantity }}
                            </div>
                        </div>
                            
                    <?php $i = 0 ?>
                     
                @foreach ($product->productdetail as $detail )
                    <?php $i++ ?>
                        <h1> </h1>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                       <strong>{{ $i}} - Product Available color:</strong>
                                     {{$detail->color}} 
                                </div>
                            </div>
                       
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                        <strong>{{ $i}} - Product Available size:</strong> 
                                    {{$detail->size }}
                                  
                                </div>
                            </div>
                 @endforeach
        </div>
    
</div>
@endsection