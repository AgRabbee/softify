<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\User;

class DashboardController extends Controller
{

    public function index()
    {
        $data = array(
            'productCount' => Product::all()->count(),
            'orderCount' => Order::all()->count(),
            'userCount' => User::all()->except(1)->count(),
        );
        return view('admin.adminHome')->with($data);
    }

    public function allOrders()
    {
        $orders = Order::all();
        $orderRows = [];

        foreach ($orders as $key => $order){
            $userDetails = User::where('id',$order->user_id)->select(['name'])->first();
            $orderRows[$key]['customerName'] = $userDetails['name'];

            $productArr = json_decode($order->product_ids);
            $quantityArr = json_decode($order->product_quantities);

            $productRows = [];
            foreach ( $productArr as $key2 => $product){
                $productDetails = Product::where('id',$product)->select(['name'])->first();
                $productRows[$key2] = 'Product : ' . $productDetails['name'] . '; Quantity : '. $quantityArr[$key2];
            }
            $orderRows[$key]['productDetails'] = $productRows;
            $orderRows[$key]['totalAmount'] = $order['total_price'];
            $orderRows[$key]['status'] = $order['order_status'] == 1 ? 'Paid' : 'Not Paid';
            $orderRows[$key]['orderDate'] = date('Y-m-d', strtotime($order['created_at']));
        }
        return view('admin.allOrders')->with('orderRows',$orderRows);
    }

}
