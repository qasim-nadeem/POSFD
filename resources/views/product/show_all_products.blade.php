@extends('layouts.base_dashboard')

@section('body')

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item">Products</li>
        <li class="breadcrumb-item active">All Products</li>
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
        <h4>All Products</h4>


        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Quantity</th>
                        <th>Price Per Unit</th>
                        <th>Code</th>
                        <th>Color</th>
                        <th>Model</th>
                        <th>Manufacture</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach( $products as $product)
                        <tr>
                            <td><a href="{{ route('product.update',['id' => $product->id]) }}">{{ $product->name }}</a></td>
                            <td>{{$product->quantity }}</td>
                            <td>{{$product->price_per_unit }}</td>
                            <td>{{$product->code }}</td>
                            <td>{{ $product->color }}</td>
                            <td>{{$product->model_name }}</td>
                            <td>{{$product->manufacture_name }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

        </div>

    </div>


@endsection