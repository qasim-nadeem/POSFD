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
        <li class="breadcrumb-item">Supplier</li>
        <li class="breadcrumb-item active">Add Supplier</li>
    </ol>

    <!-- form for adding product -->

    <div class="form-container">
        <h4> Add New Supplier </h4><br>
    <form method="post" id="supplier" action="{{ route('supplier.add.action') }}">
        @csrf
        <div class="row">
            <div class="col">
                <input type="text" id="name" name = "supplier_name" class="form-control"  placeholder="Supplier name" value="{{ $errors->any() ? old('supplier_name') : '' }}" >
            @if($errors->has('supplier_name'))
                <p class="error-container">{{' Enter supplier name'}}</p>
            @endif
            </div>

            <div class="col">
                <input type="number" id="mobile" name = "mobile_no" class="form-control" placeholder="Mobile Number" value="{{ $errors->any() ? old('mobile_no') : '' }}">
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col">
                <input type="text" id="address" name = "address" class="form-control" placeholder="Address" value="{{ $errors->any() ? old('address') : '' }}">
            </div>
            <div class="col">
                <input type="text" id="company" name = "company_name" class="form-control" placeholder="Company name" value="{{ $errors->any() ? old('company_name') : '' }}">
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col">
                <input type="number" id="balance" name = "balance" class="form-control" placeholder="Balance">
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