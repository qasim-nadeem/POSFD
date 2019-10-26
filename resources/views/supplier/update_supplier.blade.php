@extends('layouts.base_dashboard')

@section('body')

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item"><a href="{{ route('product.show.all') }}">All Suppliers</a></li>
        <li class="breadcrumb-item active">Update Supplier</li>
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
        <h4> Update Supplier </h4><br>
        <form method="post" action="{{ route('supplier.update.action',['id' => $supplier->id]) }}">
            @csrf
            <div class="row">
                <div class="col">
                    <input type="text" name = "supplier_name" class="form-control" placeholder="Supplier name" value="{{ $errors->any() ? old('name') : $supplier->name }}" >
                </div>
                <div class="col">
                    <input type="number" name = "mobile_no" class="form-control" placeholder="Mobile Number" value="{{ $errors->any() ? old('mobile_no') : $supplier->mobile_no }}">
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col">
                    <input type="text" name = "address" class="form-control" placeholder="Address" value="{{ $errors->any() ? old('address') : $supplier->address }}" >
                </div>
                <div class="col">
                    <input type="text" name = "company_name" class="form-control" placeholder="Company Name" value="{{ $errors->any() ? old('company_name') : $supplier->company_name }}" >
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col">
                    <input type="text" name = "balance" class="form-control" placeholder="Balance" value="{{ $errors->any() ? old('balance') : $supplier->balance }}">
                </div>
            </div>
            <br>
            <div class="row" style="float: right; margin: 10px">
                <input type="submit" class="btn btn-primary" name="Add" />
            </div>
        </form>
    </div>


@endsection