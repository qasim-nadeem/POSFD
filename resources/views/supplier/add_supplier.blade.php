@extends('layouts.base_dashboard')

@section('body')

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item">Supplier</li>
        <li class="breadcrumb-item active">Add Supplier</li>
    </ol>

    <!-- form for adding product -->

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="form-container">
        <h4> Add New Supplier </h4><br>
    <form method="post" id="supplier" action="{{ route('supplier.add.action') }}">
        @csrf
        <div class="row">
            <div class="col">
                <input type="text" id="name" name = "supplier_name" class="form-control" placeholder="Supplier name">
            </div>

            <div class="col">
                <input type="number" id="mobile" name = "mobile_no" class="form-control" placeholder="Mobile Number">
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col">
                <input type="text" id="address" name = "address" class="form-control" placeholder="Address">
            </div>
            <div class="col">
                <input type="text" id="company" name = "company_name" class="form-control" placeholder="Company name">
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col">
                <input type="number" id="balance" name = "balance" class="form-control" placeholder="Balance">
            </div>
        </div>
        <br>
        <div class="row" style="float: right; margin: 10px">
            <input type="submit" class="btn btn-primary" name="Add" />
        </div>
        </form>
    </div>


@endsection