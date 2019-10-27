@extends('layouts.base_dashboard')

@section('body')

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item">Supplier Transactions</li>
        <li class="breadcrumb-item active">All Transactions</li>
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
        <h4>All Transactions</h4>


        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Transaction-ID</th>
                        <th>transaction Date</th>
                        <th>Supplier</th>
                        <th>Amount Paid</th>
                        <th>To Pay</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach( $transactions as $transaction)
                        <tr>
                            <td>{{$transaction->id }}</td>
                            <td>{{$transaction->created_at }}</td>
                            <td>{{$transaction->supplier_name }}</td>
                            <td>{{ $transaction->amount_paid }} Rs</td>
                            <td>{{$transaction->to_be_paid}}
                            <td><a href="{{ route('supplier.detail.transactions',['supplier_id' =>$transaction->supplier_id, 'transaction_id' => $transaction->id ]) }}"> <button class="btn btn-primary"> View Details </button></a> </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

        </div>

    </div>


@endsection
