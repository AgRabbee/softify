@extends('layouts.admin')

@section('page_header')
<h1 class="m-0 text-dark">All Orders</h1>
@endsection

@section('breadcrumb_list')
<li class="breadcrumb-item active">All Orders</li>
@endsection

@section('content')
    <div class="col-12">
      <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">All Orders of Softify</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped display responsive">
            <thead>
            <tr>
                <th width="5%">Sl</th>
                <th width="27%">Customer</th>
                <th width="40%">Order Details</th>
                <th width="8%">Total Amount</th>
                <th width="8%">Payment Status</th>
                <th width="12%">Order Date</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($orderRows as $key => $rows)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $rows['customerName'] }}</td>
                    <td>
                        @foreach( $rows['productDetails'] as $details)
                            <p>{{$details}}</p>
                        @endforeach
                    </td>
                    <td>{{ $rows['totalAmount'] }}</td>
                    <td>{{ $rows['status'] }}</td>
                    <td>{{ $rows['orderDate'] }}</td>
                </tr>
            @endforeach
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    <!-- /.col -->

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
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
  });
</script>

@endsection
