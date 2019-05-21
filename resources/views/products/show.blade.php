@extends('layouts.app')
@section('content')

<div class="card">
        <div class="card-header">Product: {{$product->name }}</div>

        <div class="card-body">
                  <div class=""><b>Name:</b> {{ $product->name  }}</div>  
                  <div><b>Price:</b> {{ $product->price  }} </div>
                  <div><b>Image:</b>
                    <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" width="100px" height="60px">
                  </div> 
                  <div><b>Description:</b> {{ $product->description }}  </div> 
        </div>
</div>

@endsection