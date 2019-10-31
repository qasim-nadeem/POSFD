@extends('layouts.base_dashboard')

@section('body')

    <div class="row">

        <div class="col-md-8 col-sm-8" id="filter-container">
            <h5> Sales Filter </h5><hr>

            <form action="{{ route('profit.filter') }}" method="post" id="form-profit-filter">
                @csrf
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <p>From Date: <input type="text" name="date-from" id="datepicker-from" autocomplete="off"></p>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <p>To Date: <input type="text" name="date-to" id="datepicker-to" autocomplete="off"></p>
                    </div>
                </div>
                <div class="row">
                    <button type="submit" class="btn btn-primary" id="btn-filter"> Filter </button>
                </div>
            </form>


            @isset($total_profit)
            <div class="card text-white bg-success o-hidden date-range-profit-container">
                <div class="card-body">
                    <div class="card-body-icon">
                        <i class="fas fa-fw fa-comments"></i>
                    </div>
                    <div class="mr-5">Total Sales For Date Range</div>
                </div>
                <a class="card-footer text-white clearfix small z-1" >
                    <span class="float-left">{{ $total_profit }}</span>
                    <span class="float-right">
                        <i class="fas fa-angle-right"></i>
                    </span>
                </a>
            </div><br>
            @endisset


        </div>

        <div class="col-md-4 col-sm-4" id="sales-states-container">
            <h5> Sales Stats </h5>

            <div class="card text-white bg-primary o-hidden">
                <div class="card-body">
                    <div class="card-body-icon">
                        <i class="fas fa-fw fa-comments"></i>
                    </div>
                    <div class="mr-5">Daily Sales</div>
                </div>
                <a class="card-footer text-white clearfix small z-1" >
                    <span class="float-left">{{$daily}}</span>
                    <span class="float-right">
                        <i class="fas fa-angle-right"></i>
                    </span>
                </a>
            </div><br>

            <div class="card text-white bg-primary o-hidden">
                <div class="card-body">
                    <div class="card-body-icon">
                        <i class="fas fa-fw fa-comments"></i>
                    </div>
                    <div class="mr-5">Weekly Sales</div>
                </div>
                <a class="card-footer text-white clearfix small z-1" >
                    <span class="float-left">{{$weekly}}</span>
                    <span class="float-right">
                        <i class="fas fa-angle-right"></i>
                    </span>
                </a>
            </div><br>

            <div class="card text-white bg-primary o-hidden">
                <div class="card-body">
                    <div class="card-body-icon">
                        <i class="fas fa-fw fa-comments"></i>
                    </div>
                    <div class="mr-5">Monthly Sales</div>
                </div>
                <a class="card-footer text-white clearfix small z-1" >
                    <span class="float-left">{{$monthly}}</span>
                    <span class="float-right">
                        <i class="fas fa-angle-right"></i>
                    </span>
                </a>
            </div><br>


        </div>


        <div class="col-md-2 col-sm-2" id="profit-stats-container" style="display: none">

            <h5> Profit Stats </h5>

            <div class="card text-white bg-success o-hidden">
                <div class="card-body">
                    <div class="card-body-icon">
                        <i class="fas fa-fw fa-comments"></i>
                    </div>
                    <div class="mr-5">Daily Profit</div>
                </div>
                <a class="card-footer text-white clearfix small z-1" >
                    <span class="float-left">{{$daily_profit}}</span>
                    <span class="float-right">
                        <i class="fas fa-angle-right"></i>
                    </span>
                </a>
            </div><br>

            <div class="card text-white bg-success o-hidden">
                <div class="card-body">
                    <div class="card-body-icon">
                        <i class="fas fa-fw fa-comments"></i>
                    </div>
                    <div class="mr-5">Weekly Profit</div>
                </div>
                <a class="card-footer text-white clearfix small z-1" >
                    <span class="float-left">{{$weekly_profit}}</span>
                    <span class="float-right">
                        <i class="fas fa-angle-right"></i>
                    </span>
                </a>
            </div><br>

            <div class="card text-white bg-success o-hidden">
                <div class="card-body">
                    <div class="card-body-icon">
                        <i class="fas fa-fw fa-comments"></i>
                    </div>
                    <div class="mr-5">Monthly Profit</div>
                </div>
                <a class="card-footer text-white clearfix small z-1" >
                    <span class="float-left">{{$monthly_profit}}</span>
                    <span class="float-right">
                        <i class="fas fa-angle-right"></i>
                    </span>
                </a>
            </div><br>

        </div>

    </div>
    <div class="row">
        <div class="col-md-12">
            <span id="btn-show-profit-stats"> Show Profits </span>
            <span id="btn-hide-profit-stats" style="display: none"> Hide Profits </span>
        </div>
    </div>
    <hr>
    <div class="row">

        <div class="col-md-12">
            <a href="{{ route('customer.add.transactions') }}"><button class="btn btn-success" id="generate-bill">Generate Bill</button></a>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            $(function () {
                $("#datepicker-from").datepicker({
                    changeYear: true
                });
                $("#datepicker-to").datepicker({
                    changeYear: true
                });
            });

            $('#btn-filter').click(function () {
                if($('#datepicker-from').val() === '' || $('#datepicker-to').val() === '') {
                    alert('Please select both dates.');
                    event.preventDefault();
                }
                else{
                    $('#form-profit-filter').submit();
                }
            });

            $('#btn-show-profit-stats').click(function () {
                $('#sales-states-container').removeClass('col-md-4')
                    .removeClass('col-sm-4')
                    .addClass('col-md-2')
                    .addClass('col-sm-2');
                $('#btn-show-profit-stats').hide();
                $('#btn-hide-profit-stats').show();
               $('#profit-stats-container').fadeIn();
            });

            $('#btn-hide-profit-stats').click(function () {
                $('#sales-states-container').removeClass('col-md-2')
                    .removeClass('col-sm-2')
                    .addClass('col-md-4')
                    .addClass('col-sm-4');
                $('#btn-show-profit-stats').show();
                $('#btn-hide-profit-stats').hide();
                $('#profit-stats-container').hide();
            });


        });
    </script>
@endsection
