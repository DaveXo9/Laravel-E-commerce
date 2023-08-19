<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductAttribute;
use Illuminate\Http\Request;
use App\Models\AttributeType;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminProductsRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::latest()->paginate(10);

        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brands = Brand::all();
        $categories = Category::all();

        return view('admin.products.create', compact('brands', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminProductsRequest $productRequest)
    {
        $formFields = $productRequest->validated();
    
        $formFields['featured'] = $productRequest->has('featured') ? 1 : 0;
        $formFields['status'] = $productRequest->has('status') ? 1 : 0;
    
        $product = Product::create($formFields);

        if ($productRequest->has('categories')) {
            $product->categories()->attach($productRequest->input('categories'));
        }
    
    
        return redirect('/admin/products');
    }
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $brands = Brand::all();
        $categories = Category::all();
        $attributes = AttributeType::all();
        $allProductAttributes = ProductAttribute::all();
        $productAttributes = $product->attributes()->get();
    
        return view('admin.products.edit', compact('product', 'brands', 'categories', 'attributes', 'allProductAttributes', 'productAttributes'));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminProductsRequest $productRequest, Product $product)
    {
        $formFields = $productRequest->validated();
    
        $formFields['featured'] = $productRequest->has('featured') ? 1 : 0;
        $formFields['status'] = $productRequest->has('status') ? 1 : 0;
    
        $product->update($formFields);

        if ($productRequest->has('categories')) {
            $product->categories()->attach($productRequest->input('categories'));
        }
    
    
        return redirect('/admin/products');
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect('/admin/products');
        //
    }
}
