@extends('layouts.base_dashboard')

@section('style')

    <style>
        .container-receipt table th{
            padding: 0px 45px;
        }
        .container-receipt table td{
             padding: 0px 45px;
         }
        #btn-product-add, #btn-transaction-add
        {
            width: 100%;
        }
    </style>

@endsection

@section('body')

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item">Supplier</li>
        <li class="breadcrumb-item active">Add Transactions</li>
    </ol>

    <div class="container-add-transaction">
        <div class="row">
            <div class="col-md-6">
                <div class="heading">
                    <h5>Receipt View</h5>
                </div>
                <hr>
                <div class="container-receipt">
                    <table>
                        <thead>
                        <th> Item </th>
                        <th> Quantity</th>
                        <th> Price</th>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    <hr>
                    <div class="container row">
                        <div class="col-md-6">
                            <b>Total</b>
                        </div>
                        <div class="col-md-6" id="container-total">
                            <b> --- </b>
                        </div>
                    </div>
                </div>
            </div>



            <div class="col-md-6">
                <div class="heading">
                    <h5>Item Editor</h5>
                </div>
                <hr>
                <div class="container-form">
                    <form method="post" action="{{ route('product.add.action') }}">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <select name = "color" class="custom-select" id="dd-product">
                                    <option value="" selected>Select Product</option>
                                    @foreach( $products as $product)
                                        <option value="{{ $product->id  }}">{{ $product->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <input type="number" id="tb-product-price" name = "price_per_unit" class="form-control" placeholder="Price per unit" value="">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-6">
                                <input type="number" id="tb-product-quantity" name = "quantity" class="form-control" placeholder="Quantity" value="">
                            </div>
                            <div class="col-3">
                                <button id="btn-product-add" name = "add-product" class="btn btn-primary"> Add </button>
                            </div>
                            <div class="col-3">
                                <input type="submit" id="btn-transaction-add" name = "add-product" class="btn btn-primary" value="Finish"/>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        $(document).ready(function () {


            var routeGetProduct = "{{ route('api.product.data.json',['id' => 'nan']) }}";
            var routeAddTransaction = "{{ route('api.transaction_supplier.add') }}";
            var totalPrice = 0;
            var receipt = [];
           $('#dd-product').on('change', function () {
              var productId = $('#dd-product option:selected').val();
               $.ajax({url: routeGetProduct.replace('nan',productId), success: function(result){

                   if(result['quantity'] === 0) {
                       alert('Sorry, Product Stock is Nill.');
                   } else {
                       $('#tb-product-price').val(result['price']);
                       $('#tb-product-quantity').val(result['quantity']);
                   }

               }});
           });

            $('#btn-product-remove').on('click', function () {
                alert('sdf');
            });

            /*

                create arra of selected products in js.

            */
           $('#btn-product-add').on('click', function () {
               event.preventDefault();
               $('.container-receipt table tbody')
                   .append(
                       '<tr>' +
                       '<td>'+ $('#dd-product option:selected').text() + '</td>' +
                       '<td>'+ $('#tb-product-quantity').val() + ' X ' + parseInt($('#tb-product-price').val()) +'</td>' +
                       '<td>'+ parseInt($('#tb-product-price').val()) * parseInt($('#tb-product-quantity').val()) + ' Rs' +
                       '<i class="fa fa-user-times" id="btn-product-remove"></i>' +
                       '</td>' +
                       '</tr>'
                   );
               receipt.push([$('#dd-product option:selected').val(), parseInt($('#tb-product-price').val()), parseInt($('#tb-product-quantity').val())]);
               console.log(receipt);
               totalPrice += parseInt($('#tb-product-price').val()) * parseInt($('#tb-product-quantity').val());
               $('#container-total b').text(totalPrice + ' Rs');
           });


           /*

                        Add the Transaction

            */

           $('#btn-transaction-add').on('click', function () {
               event.preventDefault();
               console.log(routeAddTransaction);
               $.ajax({
                   type: 'POST',
                   url: routeAddTransaction,
                   data: {
                       "_token": "{{ csrf_token() }}",
                       'transaction' : receipt
                   },
                   success: function(result) {
                        console.log('transaction added success.');
                   }});

           })

        });
    </script>
@endsection
