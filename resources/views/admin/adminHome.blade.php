@extends('layouts.admin')

@section('page_header')
<h1 class="m-0 text-dark">Dashboard</h1>
@endsection

@section('breadcrumb_list')
<li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('content')
    <div class="col-lg-4 col-6">
      <div class="small-box bg-success">
        <div class="inner">
            <p>Users</p>
            <h3 class="text-center">{{$userCount}}</h3>
        </div>
      </div>
    </div>

    <div class="col-lg-4 col-6">
      <div class="small-box bg-info">
        <div class="inner">
          <p>Products</p>
          <h3 class="text-center">{{$productCount}}</h3>
        </div>
      </div>
    </div>

    <div class="col-lg-4 col-6">
      <div class="small-box bg-warning">
        <div class="inner">
            <p>Orders</p>
            <h3 class="text-center">{{$orderCount}}</h3>
        </div>
      </div>
    </div>

@endsection



@section('admin_css')

    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/datatables-responsive/css/jquery.dataTables.min.css')}}">


@endsection


@section('admin_scripts')

    <!-- DataTables -->
    <script src="{{ asset('AdminLTE/plugins/datatables/jquery.dataTables.js')}}"></script>
    <script src="{{ asset('AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>
    <script src="{{ asset('AdminLTE/plugins/datatables-responsive/js/dataTables.responsive.js')}}"></script>
    <script src="{{ asset('AdminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.js')}}"></script>

<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
  });
</script>

@endsection
