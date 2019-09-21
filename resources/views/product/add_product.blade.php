@extends('layouts.base_dashboard')

@section('body')

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item">Products</li>
        <li class="breadcrumb-item active">Add Product</li>
    </ol>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <!-- form for adding product -->

    <div class="form-container">
        <h4> Add New Product </h4><br>
    <form method="post" action="{{ route('product.add.action') }}">
        @csrf
        <div class="row">
            <div class="col">
                <input type="text" name = "name" class="form-control" placeholder="Product name" value="{{ $errors->any() ? old('name') : '' }}" >
            </div>
            <div class="col">
                <input type="number" name = "price_per_unit" class="form-control" placeholder="Price per unit" value="{{ $errors->any() ? old('price_per_unit') : '' }}">
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col">
                <input type="text" name = "code" class="form-control" placeholder="Product code" value="{{ $errors->any() ? old('code') : '' }}" >
            </div>
            <div class="col">
                <input type="number" name = "quantity" class="form-control" placeholder="Product quantity" value="{{ $errors->any() ? old('quantity') : '' }}" >
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