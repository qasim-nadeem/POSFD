@extends('layouts.base_dashboard')

@section('body')

<style>
    .error-container{
        font-size: 12px;
        color: white;
        background-color: red;
        width: fit-content;
        margin: 5px;
        padding: 2px 5px;
        border-radius: 4px;
        position: absolute;
        top: 2px;
        right: 15px;
    }
</style>
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item">Products</li>
        <li class="breadcrumb-item active">Add Product</li>
    </ol>
    <!-- form for adding product -->

    <div class="form-container">
        <h4> Add New Product </h4><br>
    <form method="post" action="{{ route('product.add.action') }}">
        @csrf
        <div class="row">
            <div class="col">
                <input type="text" name = "name" class="form-control" placeholder="Product name" value="{{ $errors->any() ? old('name') : '' }}" >
            @if($errors->has('name'))
                <p class="error-container">{{' Enter product name'}}</p>
            @endif
            </div>
            <div class="col">
                <input type="number" name = "purchase_price" class="form-control" placeholder="Purchasing price" value="{{ $errors->any() ? old('purchase_price') : '' }}">
            @if($errors->has('purchase_price'))
                <p class="error-container">{{' Enter purchase price'}}</p>
            @endif
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col">
                <input type="number" name = "price_per_unit" class="form-control" placeholder="Price per unit" value="{{ $errors->any() ? old('price_per_unit') : '' }}">
            @if($errors->has('price_per_unit'))
         <p class="error-container">{{' Enter price per unit'}}</p>
            @endif
            </div>
            <div class="col">
                <input type="text" name = "code" class="form-control" placeholder="Product code" value="{{ $errors->any() ? old('code') : '' }}" >
            </div>
            <div class="col">
                <input type="number" name = "quantity" class="form-control" placeholder="Product quantity" value="{{ $errors->any() ? old('quantity') : '' }}" >
           @if($errors->has('quantity'))
         <p class="error-container">{{' Enter quantity'}}</p>
            @endif 
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col">
                <input type="text" name = "manufacture_name" class="form-control" placeholder="Manufacture name" value="{{ $errors->any() ? old('manufacture_name') : '' }}">
            </div>
            <div class="col">
                <input type="text" name = "model_name" class="form-control" placeholder="Modal name" value="{{ $errors->any() ? old('model_name') : '' }}" >
            </div>
            <div class="col">
            <select name = "color" class="custom-select">
                <option value="" selected>Select Color</option>
                <option value="Red">Red</option>
                <option value="Black">Black</option>
                <option value="Green">Green</option>
                <option value="Silver">Silver</option>
            </select>
            </div>
        </div>
        <br>
        <div class="row" style="float: right; margin: 10px">
            <input type="submit" class="btn btn-primary" name="Add" />
        </div>
    </form>
    </div>


@endsection