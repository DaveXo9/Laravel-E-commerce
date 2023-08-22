<?php

namespace App\Http\Controllers\Site;

use Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductAttribute;
use App\Http\Controllers\Controller;

class UserProductController extends Controller
{
    public function show($slug)
    {
        $product = Product::where('slug', $slug)->first();
        $attributes = ProductAttribute::all();
        
        return view('site.pages.product', compact('product', 'attributes'));

    }

    public function addToCart(Request $request)
    {
        $product = Product::find($request->productId);
        $options = $request->except('_token', 'productId', 'price', 'qty');

        Cart::add(uniqid(), $product->name, $request->input('price'), $request->input('qty'), $options);

        return redirect()->back()->with('message', 'Item added to cart successfully.');



        
    
    }

}

