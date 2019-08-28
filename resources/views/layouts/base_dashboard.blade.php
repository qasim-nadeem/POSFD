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
    <link href= {{ URL::asset( "vendor/bootstrap/css/bootstrap.min.css" )}} rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href={{ URL::asset( "vendor/fontawesome-free/css/all.min.css" )}} rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href= {{ URL::asset( "vendor/datatables/dataTables.bootstrap4.css" )}} rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href= {{ URL::asset( "css/sb-admin.css" )}} rel="stylesheet">

</head>

<body id="page-top">

@yield('body')

<!-- Bootstrap core JavaScript-->
<script src= {{ URL::asset( "vendor/jquery/jquery.min.js" )}} )}}></script>
<script src= {{ URL::asset( "vendor/bootstrap/js/bootstrap.bundle.min.js" )}}></script>

<!-- Core plugin JavaScript-->
<script src= {{ URL::asset( "vendor/jquery-easing/jquery.easing.min.js" )}}></script>

<!-- Page level plugin JavaScript-->
<script src= {{ URL::asset( "vendor/chart.js/Chart.min.js" )}}></script>
<script src= {{ URL::asset( "vendor/datatables/jquery.dataTables.js" )}}></script>
<script src= {{ URL::asset( "vendor/datatables/dataTables.bootstrap4.js" )}}></script>

<!-- Custom scripts for all pages-->
<script src= {{ URL::asset( "js/sb-admin.min.js" )}}></script>

<!-- Demo scripts for this page-->
<script src= {{ URL::asset( "js/demo/datatables-demo.js" )}}></script>
<script src= {{ URL::asset( "js/demo/chart-area-demo.js" )}}></script>

</body>
</html>