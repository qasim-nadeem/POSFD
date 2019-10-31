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
        top: 35px;
        right: 15px;
    }
</style>

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item"><a href="{{ route('product.show.all') }}">All Products</a></li>
        <li class="breadcrumb-item active">Update Product</li>
    </ol>
    <!-- form for adding product -->

    <div class="form-container">
        <h4> Update Product </h4><br>
        <form method="post" action="{{ route('product.update.action',['id' => $product->id]) }}">
            @csrf
            <div class="row">
            <div class="col">
                <label style="font-weight:bold">Product Name:</label>
                <input type="text" name = "name" class="form-control"  value="{{ $errors->any() ? old('name') : $product->name }}" >
            @if($errors->has('name'))
                <p class="error-container">{{' Enter product name'}}</p>
            @endif
            </div>
            <div class="col">
                <label style="font-weight:bold">Purchase Price:</label>
                <input type="number" name = "purchase_price" class="form-control"  value="{{ $errors->any() ? old('purchase_price') : $product->purchase_price }}">
            @if($errors->has('purchase_price'))
                <p class="error-container">{{' Enter purchase price'}}</p>
            @endif
            </div>
            </div>
            <br>
            <div class="row">
              <div class="col">
                <label style="font-weight:bold">Price Per Unit:</label>
                <input type="number" name = "price_per_unit" class="form-control"  value="{{ $errors->any() ? old('price_per_unit') : $product->price_per_unit }}">
            @if($errors->has('price_per_unit'))
                <p class="error-container">{{' Enter price per unit'}}</p>
            @endif
            </div>
                <div class="col">
                    <label style="font-weight:bold">Product Code:</label>
                    <input type="text" name = "code" class="form-control" value="{{ $errors->any() ? old('code') : $product->code }}" >
                </div>
             <div class="col">
                    <label style="font-weight:bold">Quantity:</label>
                    <input type="number" name = "quantity" class="form-control" value="{{ $errors->any() ? old('quantity') : $product->quantity }}" >
            @if($errors->has('quantity'))
                <p class="error-container">{{' Enter quantity'}}</p>
            @endif 
            </div>
            </div>
            <br>
            <div class="row">
                <div class="col">
                    <label style="font-weight:bold">Manufacture name:</label>
                    <input type="text" name = "manufacture_name" class="form-control" value="{{ $errors->any() ? old('manufacture_name') : $product->manufacture_name }}">
                </div>
                <div class="col">
                    <label style="font-weight:bold">Model name:</label>
                    <input type="text" name = "model_name" class="form-control" value="{{ $errors->any() ? old('model_name') : $product->model_name }}" >
                </div>
                <div class="col">
                    <label style="font-weight:bold">Color:</label>
                    <select name = "color" class="custom-select">
                        <option value="Red" {{ ($product->color == 'Red') ? 'selected' : '' }}>Red</option>
                        <option value="Black" {{ ($product->color == 'Black') ? 'selected' : '' }}>Black</option>
                        <option value="Green" {{ ($product->color == 'Green') ? 'selected' : '' }}>Green</option>
                        <option value="Silver" {{ ($product->color == 'Silver') ? 'selected' : '' }}>Silver</option>
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