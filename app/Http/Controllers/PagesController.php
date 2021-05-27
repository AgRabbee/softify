<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PagesController extends Controller
{
    public function index()
    {
        return view('customer.index')->with('products',Product::latest()->get());
    }

    public function addToCart(Request $request){
        $products = [];
        array_push($products,$request['product_id']);
        if(!$request->session()->exists('cart')){
            $request->session()->put('cart',$products);
        }else{
            $request->session()->push('cart', $request['product_id']);
        }
        #$request->session()->forget('cart');
        $cart = $request->session()->get('cart');

        return response()->json(['responseCode'=> '1','cart'=>$cart]);
    }

    public function cart(Request $request){
        #$request->session()->forget('cart');
        $cart = $request->session()->get('cart');
        $productDetails = [];
        if($cart){
            $productDetails = Product::find($cart);
        }
        return view('customer.cart')->with('productDetails',$productDetails);
    }

    public function removeFromCart(Request $request){


        $carts = $request->session()->pull('cart', []);
        if(($key = array_search($request['product_id'], $carts)) !== false) {
            unset($carts[$key]);
        }
        $request->session()->put('cart', $carts);
        #$request->session()->forget('cart');
        $cart = $request->session()->get('cart');

        return response()->json(['responseCode'=> '1','cart'=>$cart]);
    }

    public function makePayment(Request $request){
        try {
            DB::beginTransaction();

            $cart = $request->session()->get('cart');
            $totalAmount = $request['totalAmount'];
            $productIds = [];
            $productQuantities = [];
            foreach ($cart as $item){
                array_push($productIds,$item);
                array_push($productQuantities,1);
            }
            $orderObj = new Order;
            $orderObj->user_id = Auth::user()->id;
            $orderObj->product_ids = json_encode($productIds);
            $orderObj->product_quantities = json_encode($productQuantities);
            $orderObj->total_price = $totalAmount;
            $orderObj->order_status = 1;

            if($orderObj->save()){
                Product::whereIn('id', $productIds)->decrement('stock', 1);
            }


            $request->session()->forget('cart');
            DB::commit();
            return response()->json(['responseCode'=> '1']);

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['responseCode'=> '-1']);
        }
    }

}
