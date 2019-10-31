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
        <li class="breadcrumb-item"><a href="{{ route('product.show.all') }}">All Suppliers</a></li>
        <li class="breadcrumb-item active">Update Supplier</li>
    </ol>

    <!-- form for adding product -->

    <div class="form-container">
        <h4> Update Supplier </h4><br>
        <form method="post" action="{{ route('supplier.update.action',['id' => $supplier->id]) }}">
            @csrf
            <div class="row">
                <div class="col">
                <label style="font-weight:bold">Supplier Name:</label>
                    <input type="text" name = "supplier_name" class="form-control" value="{{ $errors->any() ? old('name') : $supplier->name }}" >
                @if($errors->has('supplier_name'))
                <p class="error-container">{{' Enter supplier name'}}</p>
                @endif
                </div>
                <div class="col">
                <label style="font-weight:bold">Mobile No:</label>
                    <input type="number" name = "mobile_no" class="form-control" value="{{ $errors->any() ? old('mobile_no') : $supplier->mobile_no }}">
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col">
                <label style="font-weight:bold">Address:</label>
                    <input type="text" name = "address" class="form-control" value="{{ $errors->any() ? old('address') : $supplier->address }}" >
                </div>
                <div class="col">
                <label style="font-weight:bold">Company Name:</label>
                    <input type="text" name = "company_name" class="form-control" value="{{ $errors->any() ? old('company_name') : $supplier->company_name }}" >
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col">
                <label style="font-weight:bold">Balance:</label>
                    <input type="text" name = "balance" class="form-control" value="{{ $errors->any() ? old('balance') : $supplier->balance }}">
                @if($errors->has('balance'))
                <p class="error-container">{{' Enter balance'}}</p>
                @endif
                </div>
            </div>
            <br>
            <div class="row" style="float: right; margin: 10px">
                <input type="submit" class="btn btn-primary" name="Add" />
            </div>
        </form>
    </div>


@endsection