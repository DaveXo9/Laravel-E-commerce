<?php

namespace App\Http\Controllers\Site;

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
        
        dd($request->all());
    
    }

}

