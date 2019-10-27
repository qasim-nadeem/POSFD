@extends('layouts.base_dashboard')

@section('body')

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active"><a href="{{ route('supplier.all.transactions') }}">All Transactions</a></li>
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
                <h4>Supplier Info</h4>
                @if($transactionDetails['supplierInfo'])
                    <p> Name : <span><b> {{ $transactionDetails['supplierInfo']['name'] }} </b></span> </p>
                    <p> To be Paid : <span><b> {{ $transactionDetails['to_be_paid'] }} </b></span> </p>

                @else
                    <p> No Supplier information added at the time of transaction. </p>
                @endif
            </div>

        </div>

    </div>


@endsection
