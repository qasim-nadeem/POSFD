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
        <h4> Add New Supplier </h4><br>
    <form method="post" action="{{ route('supplier.add.action') }}">
        @csrf
        <div class="row">
            <div class="col">
                <input type="text" name = "supplier_name" class="form-control" placeholder="Supplier name">
            </div>
            <div class="col">
                <input type="number" name = "mobile_no" class="form-control" placeholder="Mobile Number">
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col">
                <input type="text" name = "address" class="form-control" placeholder="Address">
            </div>
            <div class="col">
                <input type="text" name = "company_name" class="form-control" placeholder="Company name">
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col">
                <input type="number" name = "balance" class="form-control" placeholder="Balance">
            </div>
        </div>
        <br>
        <div class="row" style="float: right; margin: 10px">
            <input type="submit" class="btn btn-primary" name="Add" />
        </div>
    </form>
    </div>


@endsection