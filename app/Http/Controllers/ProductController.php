<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return view('admin.allProducts')->with('products',Product::latest()->get());
    }

    public function create()
    {
        return view('admin.addProducts');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'product_name' => 'required|string',
            'product_price' => 'required|integer',
            'product_stock' => 'required|integer',
            'product_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1999',
        ]);

        //handle product_image upload
        if ($request->hasFile('product_image')) {
            //get filename with the extension
            $fileNamewithExt = $request->file('product_image')->getClientOriginalName();
            //get just filename
            $fileName = pathinfo($fileNamewithExt, PATHINFO_FILENAME);
            //get just ext
            $extension = $request->file('product_image')->getClientOriginalExtension();
            //file name to store
            $fileNameToStore = $fileName.'_'.time().'_.'.$extension;
            //upload image
            $path = $request->file('product_image')->storeAs('public/product_image', $fileNameToStore);
        }else {
            $fileNameToStore = 'noimage.jpg';
        }

        $productObj = new Product();
        $productObj->name = $request['product_name'];
        $productObj->price = $request['product_price'];
        $productObj->stock = $request['product_stock'];
        $productObj->product_image = 'product_image/'.$fileNameToStore;
        $productObj->product_status = 1;

        $product_details = Product::where('name',$request['product_name'])
                        ->count();
        if ($product_details) {
            return redirect()->back()->withInfoMessage('Product : '.$request['product_name']. ' has already added. Try another one.')->withInput();
        }else {
            $productObj->save();
            return redirect()->back()->withSuccessMessage('Product Added Successfully');
        }
    }
    public function update(Request $request,$id)
    {
        $this->validate($request,[
            'name' => 'required|string',
            'price' => 'required|integer',
            'stock' => 'required|integer',
        ]);
        $update_product = Product::find($id);
        $update_product->name = $request['name'];
        $update_product->price = $request['price'];
        $update_product->stock = $request['stock'];

        $update_product->save();
        return redirect()->back()->withSuccessMessage('Product Updated Successfully');

    }

    public function destroy($id)
    {
        $delete_product = Product::find($id);
        $delete_product->delete();
        return redirect()->back()->withSuccessMessage('Product Deleted Successfully');
    }

}
