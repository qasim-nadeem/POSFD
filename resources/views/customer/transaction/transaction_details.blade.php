@extends('layouts.base_dashboard')

@section('body')

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active"><a href="{{ route('customer.all.transactions') }}">All Transactions</a></li>
        <li class="breadcrumb-item active">Transaction Details</li>
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
        <h4>Transaction Details</h4>

        <div class="card-body">

            <div class="table-responsive">
                <table class="table" width="100%">
                    <th>
                        <tr>
                        <td> Product Name </td>
                        <td> Quantity </td>
                        <td> Price </td>
                        </tr>
                    </th>
                    @foreach($transactionDetails['productDetails'] as $product)
                    <tr>
                        <td>{{ $product['product_name'] }}</td>
                        <td>{{ $product['product_quantity'] }} X {{ $product['product_price'] }}</td>
                        <td>{{ $product['total_item_price'] }}</td>
                    </tr>
                    @endforeach
                    <tr>
                        <td>  </td>
                        <td> <b>Total</b> </td>
                        <td>{{ $transactionDetails['totalAmount']  }}</td>
                    </tr>
                </table>
            </div>

            <div class="customer-info">
                <h4>Customer Info</h4>
                @if($transactionDetails['customerInfo'])
                    <p> Name : <span><b> {{ $transactionDetails['customerInfo']['name'] }} </b></span> </p>
                    <p> Phone : <span><b> {{ $transactionDetails['customerInfo']['phone'] }} </b></span> </p>
                    <p> Address : <span><b>{{ $transactionDetails['customerInfo']['address'] }}</b></span> </p>
                @else
                    <p> No Customer information added at the time of transaction. </p>
                @endif
            </div>

        </div>

    </div>


@endsection
