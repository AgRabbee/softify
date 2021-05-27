@extends('layouts.admin')

@section('page_header')
<h1 class="m-0 text-dark">All Products</h1>
@endsection

@section('breadcrumb_list')
<li class="breadcrumb-item active">All Products</li>
@endsection

@section('content')
    <div class="col-12">
      <div class="card card-info">
        <div class="card-header">
          <h3 class="card-title">All Products of <strong>Softify</strong></h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped display responsive">
            <thead>
            <tr>
                <th>Sl</th>
                <th>Product Name</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($products as $key => $value)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $value->name }}</td>
                    <td>{{ $value->price }}</td>
                    <td>{{ $value->stock }}</td>
                    <td>
                        <div class="btn-group btn-group-sm">
                            <a href="#" class="btn btn-primary mr-2" type="button" data-toggle="modal" data-target="#modal-edit{{ $value->id }}"><i class="fas fa-edit"></i></a>
                            <a href="#" class="btn btn-danger" type="button" data-toggle="modal" data-target="#modal-delete{{ $value->id }}"><i class="fas fa-trash"></i></a>
                      </div>
                    </td>
                </tr>



                <!--edit modal-->
                    <div class="modal fade" id="modal-edit{{ $value->id }}" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog">
                            <form class="" action="{{ url('/dashboard/product/edit/'.$value->id) }}" method="post">
                                @csrf
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Edit Product</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="name" value="{{ $value->name }}">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="price" value="{{ $value->price }}">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="stock" value="{{ $value->stock }}">
                                        </div>

                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <input type="submit" class="btn btn-primary" name="" value="Update product">
                                    </div>
                                </div>
                            <!-- /.modal-content -->
                            </form>
                        </div>
                    <!-- /.modal-dialog -->
                    </div>
                <!--modal-->

                <!--delete modal-->
                    <div class="modal fade" id="modal-delete{{ $value->id }}" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog">
                            <form class="" action="{{ url('/dashboard/product/delete/'.$value->id) }}" method="post">
                                @csrf
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Delete Product</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Are you sure to delete this product #{{$value->name}}??</p>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                        <input type="submit" class="btn btn-primary" name="" value="Proceed">
                                    </div>
                                </div>
                            <!-- /.modal-content -->
                            </form>
                        </div>
                    <!-- /.modal-dialog -->
                    </div>
                <!--modal-->
                @endforeach
            </tbody>
            <tfoot>
            <tr>
                <th>Sl</th>
                <th>Product Name</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Actions</th>
            </tr>
            </tfoot>
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
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
  });
</script>

@endsection
