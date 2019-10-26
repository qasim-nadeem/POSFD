@extends('layouts.base_dashboard')

@section('body')

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item">Suppliers</li>
        <li class="breadcrumb-item active">All Suppliers</li>
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
        <h4>All Suppliers</h4>


        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Mobile Number</th>
                        <th>Address</th>
                        <th>Company Name</th>
                        <th>Balance</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach( $suppliers as $supplier)
                        <tr>
                            <td><a href="{{ route('supplier.update',['id' => $supplier->id]) }}">{{ $supplier->name }}</a></td>
                            <td>{{$supplier->mobile_no }}</td>
                            <td>{{$supplier->address }}</td>
                            <td>{{$supplier->company_name }}</td>
                            <td>{{$supplier->balance }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

        </div>

    </div>


@endsection