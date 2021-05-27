@extends('layouts.public')

@section('page_header')
@endsection

@section('content')
<div class="row">
    @if(count($products)>0)
    @foreach($products as $key => $product)
    <div class="col-md-3">
        <div class="card" >
            <img class="card-img-top" src="{{asset('/').'storage/'.$product->product_image}}" style="width:200px; height: 200px; margin: 10px auto;" alt="Card image cap">
            <div class="card-body" style="background: #ddd;">
                <h5 class="card-title"><strong>{{ $product->name }}</strong></h5>
                <br>
                <div class="d-flex justify-content-between" >
                    <div><strong> Price : </strong> {{ $product->price }}</div>
                    <div><strong>Stock : </strong>{{ $product->stock }}</div>
                </div>
                <button class="btn btn-default float-right mt-3 border border-dark addToCart" id="{{$product->id}}">Add to Cart</button>
            </div>
        </div>
    </div>
    @endforeach
    @else
        <p class="text-center">No product available</p>
    @endif
</div>

@endsection

@section('public_scripts')
    <script>
        $(document).ready(function () {
            $('.addToCart').click(function () {
                var btn = $(this);
                var product_id = $(this).attr('id');
                $.ajax({
                    type:'GET',
                    data:{
                      product_id: product_id
                    },
                    url:'/add-to-cart',
                    // dataType: 'json',
                    success:function(data){
                        if(data.responseCode == 1){
                            btn.prop('disabled', true);
                        }
                        // returnedData = data.success;
                        // doSomething(returnedData);
                    }
                });
            });
        });
    </script>
@endsection
