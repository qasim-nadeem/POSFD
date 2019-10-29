@extends('layouts.base_dashboard')

@section('body')


    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Overview</li>
    </ol>

    <!-- Icon Cards-->
    <div class="row">
        <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-primary o-hidden h-100">
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
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-warning o-hidden h-100">
                <div class="card-body">
                    <div class="card-body-icon">
                        <i class="fas fa-fw fa-list"></i>
                    </div>
                    <div class="mr-5">Weekly Sales</div>
                </div>
                <a class="card-footer text-white clearfix small z-1">
                    <span class="float-left">{{$weekly}}</span>
                    <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                  </span>
                </a>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-success o-hidden h-100">
                <div class="card-body">
                    <div class="card-body-icon">
                        <i class="fas fa-fw fa-shopping-cart"></i>
                    </div>
                    <div class="mr-5">Monthly Sales</div>
                </div>
                <a class="card-footer text-white clearfix small z-1" >
                    <span class="float-left">{{$monthly}}</span>
                    <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                  </span>
                </a>
            </div>
        </div>
    </div>
</br>
</br>
    <div class="row">
        <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-primary o-hidden h-100">
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
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-warning o-hidden h-100">
                <div class="card-body">
                    <div class="card-body-icon">
                        <i class="fas fa-fw fa-list"></i>
                    </div>
                    <div class="mr-5">Weekly Profit</div>
                </div>
                <a class="card-footer text-white clearfix small z-1">
                    <span class="float-left">{{$weekly_profit}}</span>
                    <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                  </span>
                </a>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-success o-hidden h-100">
                <div class="card-body">
                    <div class="card-body-icon">
                        <i class="fas fa-fw fa-shopping-cart"></i>
                    </div>
                    <div class="mr-5">Monthly Profit</div>
                </div>
                <a class="card-footer text-white clearfix small z-1" >
                    <span class="float-left">{{$monthly_profit}}</span>
                    <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                  </span>
                </a>
            </div>
        </div>
    </div>
@endsection