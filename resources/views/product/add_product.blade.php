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

    <!-- form for adding product -->

    <div class="form-container">
        <h4> Add New Product </h4><br>
    <form method="post" action="{{ route('product.add.action') }}">
        @csrf
        <div class="row">
            <div class="col">
                <input type="text" name = "product_name" class="form-control" placeholder="Product name">
            </div>
            <div class="col">
                <input type="number" name = "product_price" class="form-control" placeholder="Price per unit">
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col">
                <input type="text" name = "product_code" class="form-control" placeholder="Product code">
            </div>
            <div class="col">
                <input type="number" name = "product_quantity" class="form-control" placeholder="Product quantity">
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col">
                <input type="text" name = "product_manufacture" class="form-control" placeholder="Manufacture name">
            </div>
            <div class="col">
                <input type="text" name = "product_modal" class="form-control" placeholder="Modal name">
            </div>
            <div class="col">
            <select name = "product_color" class="custom-select">
                <option selected>Select Color</option>
                <option value="1">Red</option>
                <option value="2">Black</option>
                <option value="3">Green</option>
                <option value="3">Silver</option>
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