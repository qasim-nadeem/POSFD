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
        <li class="breadcrumb-item">Customer</li>
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
                    <div id="receipt-customer-info" style="display: none">
                        <p> <u>Customer information</u> </p>
                        <p> <b>Name</b> :       <span id="receipt-customer-name"></span> </p>
                        <p> <b>Phone</b> :      <span id="receipt-customer-phone"></span> </p>
                        <p> <b>Address</b> :    <span id="receipt-customer-address"></span> </p>
                    </div>
                </div>
            </div>



            <div class="col-md-6">
                <div class="heading">
                    <h5>Item Editor</h5>
                </div>
                <hr>
                <div class="container-form">
                    <form method="post" action="">
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
                                <p id="product-price-label">Price : <span> --- </span></p>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-6">
                                <input type="number" id="tb-product-quantity" name = "quantity" class="form-control" placeholder="Quantity" value="">
                                <p id="product-quantity-label">Quantity : <span> --- </span></p>
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


                <div id="container-customer-info">
                    <br>
                    <a href="#" id="btn-add-customer-info"> Add Customer info </a>
                    <a href="#" id="btn-hide-customer-info"> Remove Customer info </a>
                    <br><br>

                    <div id="container-customer-form" style="display: none">
                        <div class="heading">
                            <h5>Customer Information</h5>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-12">
                                <input type="text" id="tb-customer-name" name = "customer-name" class="form-control" placeholder="Customer Namer" value="">
                            </div>
                            <br><br>

                            <div class="col-12">
                                <input type="number" id="tb-customer-phone" name = "customer-phone" class="form-control" placeholder="Customer Phone Number" value="">
                            </div>
                            <br><br>

                            <div class="col-12">
                                <input type="text" id="tb-customer-address" name = "customer-address" class="form-control" placeholder="Customer Address" value="">
                            </div>
                            <br><br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        $(document).ready(function () {


            var routeGetProduct = "{{ route('api.product.data.json',['id' => 'nan']) }}";
            var routeAddTransaction = "{{ route('api.transaction.add') }}";
            var totalPrice = 0;
            var receipt = [];
            var customerInfo = [];
            var isCustomerInfo = false;
            var itemCounter = 0;


            $(function() {
                $("#dd-product").customselect();
            });


            $('#dd-product').on('change', function () {
              var productId = $('#dd-product option:selected').val();
               $.ajax({url: routeGetProduct.replace('nan',productId), success: function(result){

                   if(result['quantity'] === 0) {
                       alert('Sorry, Product Stock is Nill.');
                   } else {
                       $('#tb-product-price').val(result['price']);
                       $('#tb-product-quantity').val('');
                       if(result['quantity'] === 0)
                           $('#product-quantity-label').css('color','red');
                       else
                           $('#product-quantity-label').css('color','green');

                       $('#product-price-label span').text(result['price']);
                       $('#product-quantity-label span').text(result['quantity']);

                   }

               }});
           });

            /*

                create arra of selected products in js.

            */
           $('#btn-product-add').on('click', function () {
               event.preventDefault();
                if($('#dd-product').val() == 0 || $('#dd-product').val() == '' ){
                alert('Select Product:')
               }else if($('#tb-product-price').val() == 0 || $('#tb-product-price').val() == '' ){
                alert('Enter Price:')
               }
               else if($('#tb-product-quantity').val() == 0 || $('#tb-product-quantity').val() == ''){
                alert('Enter quantity:')
               }
               else{
               total = parseInt($('#tb-product-price').val()) * parseInt($('#tb-product-quantity').val());
               productId = $('#dd-product option:selected').val();
               $('.container-receipt table tbody')
                   .append(
                       '<tr id="receipt-item-'+ itemCounter +'">' +
                       '<td>'+ $('#dd-product option:selected').text() + '</td>' +
                       '<td>'+ $('#tb-product-quantity').val() + ' X ' + parseInt($('#tb-product-price').val()) +'</td>' +
                       '<td>'+ parseInt($('#tb-product-price').val()) * parseInt($('#tb-product-quantity').val()) + ' Rs' +
                       '<a href="#" class="link-remove-item" total='+ total +' productId='+ productId +'> Remove </a>' +
                       '</td>' +
                       '</tr>'
                   );
               receipt.push([$('#dd-product option:selected').val(), parseInt($('#tb-product-price').val()), parseInt($('#tb-product-quantity').val())]);
               itemCounter++;
               console.log(receipt);
               totalPrice += total;
               $('#container-total b').text(totalPrice + ' Rs');
           }
           });


           /*

                        Add the Transaction

            */

           $('#btn-transaction-add').on('click', function () {
               if(isCustomerInfo)
               {
                   customerInfo = [$('#tb-customer-name').val(), $('#tb-customer-phone').val(), $('#tb-customer-address').val()];
               }
               else
               {
                   customerInfo = [];
               }
               console.log(customerInfo);

               event.preventDefault();
               $.ajax({
                   type: 'POST',
                   url: routeAddTransaction,
                   data: {
                       "_token": "{{ csrf_token() }}",
                       'transaction' : receipt,
                       'customerInfo' : customerInfo
                   },
                   success: function(result) {
                        if(result)
                        {
                            location.reload();
                        }
                   }});

           });


            $('#btn-add-customer-info').on('click',function () {
                isCustomerInfo = true;
                $('#receipt-customer-info').show();
                $('#container-customer-form').show();
                $('#btn-add-customer-info').hide();
                $('#btn-hide-customer-info').show();
            });

            $('#btn-hide-customer-info').on('click',function () {
                isCustomerInfo = false;
                customerInfo = [];
                $('#tb-customer-name').val('');
                $('#tb-customer-address').val('');
                $('#tb-customer-phone').val('');
                $('#receipt-customer-info').hide();
                $('#container-customer-form').hide();
                $('#btn-add-customer-info').show();
                $('#btn-hide-customer-info').hide();
            });


            /*
                 Adding customer info to live receipt
             */
            $('#tb-customer-name').on('keyup', function () {
                $('#receipt-customer-name').text($('#tb-customer-name').val());
            });
            $('#tb-customer-phone').on('keyup', function () {
                $('#receipt-customer-phone').text($('#tb-customer-phone').val());
            });
            $('#tb-customer-address').on('keyup', function () {
                $('#receipt-customer-address').text($('#tb-customer-address').val());
            });

            /*
                Removing item from the queue
             */
            $('.container-receipt table tbody').on('click', 'tr a', function () {
                amount = $(this).attr('total');
                productId = $(this).attr('productId');
                updateTotalPriceAfterItemRemoval(amount);
                // receipt.splice(index,1);
                receipt = receipt.filter( function( el ) {
                    if((el[2] * el[1]) == amount && productId == el[0])
                    {

                    }
                    else
                    {
                        return el;
                    }

                } );
                $(this).parent().parent().remove();
                $('#container-total b').text(totalPrice + ' Rs');
                console.log(receipt);
            });



            /*

                Utility functions.

             */

            function updateTotalPriceAfterItemRemoval(amount) {
                    totalPrice -= parseInt(amount);
            }


        });
    </script>
@endsection
