<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin - Dashboard</title>

    <!-- Bootstrap core CSS-->
    <link href= {{ URL::asset( "vendor-public/bootstrap/css/bootstrap.min.css" )}} rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href={{ URL::asset( "vendor-public/fontawesome-free/css/all.min.css" )}} rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href= {{ URL::asset( "vendor-public/datatables/dataTables.bootstrap4.css" )}} rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href= {{ URL::asset( "css/sb-admin.css" )}} rel="stylesheet">

    <!-- Custome Styling file -->
    <link href= {{ URL::asset( "css/main.css" )}} rel="stylesheet">

    <!-- searchable select box -->
    <link href= {{ URL::asset( "css/jquery-customselect.css" )}} rel="stylesheet">

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

    @yield('style')

</head>

<body id="page-top">


<nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="{{route('page-dashboard')}}">The Auto Point of Sales</a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Navbar Search -->
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
        <div class="input-group">

        </div>
    </form>

    <!-- Navbar -->
    <ul class="navbar-nav ml-auto ml-md-0">
<!--         <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-user-circle fa-fw"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">Settings</a>
                <a class="dropdown-item" href="#">Activity Log</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Logout</a>
            </div>
        </li> -->
        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
    </ul>

</nav>

<div id="wrapper">

    <!-- Sidebar -->
    <ul class="sidebar navbar-nav">
        <li class="nav-item active">
            <a class="nav-link" href="{{route('page-dashboard')}}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-fw fa-folder"></i>
                <span>Customers</span>
            </a>
            <div class="dropdown-menu" aria-labelledby="pagesDropdown">
                <a class="dropdown-item" href="{{ route('customer.add.transactions') }}">Add Transactions</a>
                <a class="dropdown-item" href="{{ route('customer.all.transactions') }}">All Transactions</a>
            </div>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-fw fa-folder"></i>
                <span>Products</span>
            </a>
            <div class="dropdown-menu" aria-labelledby="pagesDropdown">
                <a class="dropdown-item" href="{{ route('product.add') }}">Add Product</a>
                <a class="dropdown-item" href="{{ route('product.show.all') }}">All Products</a>
            </div>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-fw fa-folder"></i>
                <span>Suppliers</span>
            </a>
            <div class="dropdown-menu" aria-labelledby="pagesDropdown">
                <a class="dropdown-item" href="{{ route('supplier.add.transactions') }}">Add Transactions</a>
                <a class="dropdown-item" href="{{ route('supplier.all.transactions') }}">All Transactions</a>
                <a class="dropdown-item" href="{{ route('supplier.add') }}">Add Supplier</a>
                <a class="dropdown-item" href="{{ route('supplier.show.all') }}">All Suppliers</a>

            </div>
        </li>
    </ul>

    <div id="content-wrapper">

        <div class="container-fluid">

            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
            @endif
            @if ($message = Session::get('warning'))
                <div class="alert alert-warning alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
            @endif


            @if ($message = Session::get('info'))
                <div class="alert alert-info alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
            @endif

            @yield('body')

        </div>

        </div>
        <!-- /.container-fluid -->

        <!-- Sticky Footer -->
        <footer class="sticky-footer">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright © Theautops.com 2019</span>
                </div>
            </div>
        </footer>

    </div>
    <!-- /.content-wrapper -->

</div>
<!-- /#wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="login.html">Logout</a>
            </div>
        </div>
    </div>
</div>


<!-- Bootstrap core JavaScript-->
<script src= {{ URL::asset( "vendor-public/jquery/jquery.min.js" )}} )}}></script>
<script src= {{ URL::asset( "vendor-public/bootstrap/js/bootstrap.bundle.min.js" )}}></script>

<!-- Core plugin JavaScript-->
<script src= {{ URL::asset( "vendor-public/jquery-easing/jquery.easing.min.js" )}}></script>

<!-- Page level plugin JavaScript-->
<script src= {{ URL::asset( "vendor-public/chart.js/Chart.min.js" )}}></script>
<script src= {{ URL::asset( "vendor-public/datatables/jquery.dataTables.js" )}}></script>
<script src= {{ URL::asset( "vendor-public/datatables/dataTables.bootstrap4.js" )}}></script>

<!-- Custom scripts for all pages-->
<script src= {{ URL::asset( "js/sb-admin.min.js" )}}></script>

<!-- Demo scripts for this page-->
<script src= {{ URL::asset( "js/demo/datatables-demo.js" )}}></script>
<script src= {{ URL::asset( "js/demo/chart-area-demo.js" )}}></script>
<script src= {{ URL::asset( "js/jquery-customselect.js" )}}></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
@yield('scripts')
</body>
</html>
