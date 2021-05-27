@extends('layouts.public')

@section('page_header')
@endsection

@section('content')
<div class="col-md-12">
    <div class="card" >
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped text-center display responsive">
                <thead>
                <tr>
                    <th>Sl</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Amount</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @php
                    $totalAmount = 0;
                @endphp
                @if(count($productDetails)>0)
                   @foreach($productDetails as $key => $product)
                       <tr>
                           <td>{{ $key+1 }}</td>
                           <td>{{ $product->name }}</td>
                           <td>{{ $product->price }}/-</td>
                           <td>1</td>
                           <td>{{ $product->price * 1 }}/-</td>
                           <td>
                               <div class="btn-group btn-group-sm">
                                   <button class="btn btn-danger remvFrmCart" id="{{ $product->id }}"><i class="fas fa-trash"></i></button>
                               </div>
                           </td>
                       </tr>
                       @php
                        $totalAmount += $product->price;
                    @endphp
                @endforeach
                    <tr>
                        <td colspan="5" class="text-right">Total = </td>
                        <td>{{ $totalAmount }}/-</td>
                    </tr>
                @else
                    <tr>
                        <td colspan="6" class="text-center">No product in the cart. Please add product to your cart by <a href="{{ url('/') }}">visiting our site</a>.</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
    @if(count($productDetails)>0)
    <div class="text-center">
        <button id="makePayment" class="btn btn-primary">Make Payment</button>
        <input type="hidden" id="totalAmount" value="{{ $totalAmount }}">
    </div>
    @endif
</div>

@endsection

@section('public_scripts')
    <script>
        $(document).ready(function () {
            $('#makePayment').click(function () {
                if(confirm("Are you sure to proceed?")){
                    var totalAmount = $('#totalAmount').val();
                    $.ajax({
                        type:'GET',
                        data:{
                            totalAmount: totalAmount
                        },
                        url:'/makePayment',
                        success:function(data){
                            if(data.responseCode == 1){
                                alert('Payment successful!');
                                window.location.href = "{{ url('/')}}";
                            }
                        }
                    });
                }
            });

            $('.remvFrmCart').click(function () {
                var product_id = $(this).attr('id');
                $.ajax({
                    type:'GET',
                    data:{
                        product_id: product_id
                    },
                    url:'/remove-from-cart',
                    // dataType: 'json',
                    success:function(data){
                        console.log(data);
                        if(data.responseCode == 1){
                            location.reload();
                        }
                        // returnedData = data.success;
                        // doSomething(returnedData);
                    }
                });
            });
        });
    </script>
@endsection
