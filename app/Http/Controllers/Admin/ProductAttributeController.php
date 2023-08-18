<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductAttribute;
use App\Http\Controllers\Controller;

class ProductAttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attributes = ProductAttribute::all();

        return view('admin.product-attributes.index', compact('attributes'));
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        ProductAttribute::create([
            'attribute_type_id' => $request->attribute_id,
            'name' => $request->name,
            'price' => $request->price,
        ]);
        
        return redirect()->route('admin.attributes.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductAttribute $product_attribute)
    {
        $product_attribute->update([
            'attribute_type_id' => $request->attribute_id,
            'name' => $request->name,
            'price' => $request->price,
        ]);

        return redirect()->route('admin.attributes.index');

    }

    public function addAttributeToProduct(Request $request, Product $product)
    {
        $product->attributes()->attach($request->attribute_id);

        return redirect()->route('admin.products.edit', $product->id);
    }

    public function removeAttributeFromProduct(Request $request, Product $product)
    {
        $product->attributes()->detach($request->attribute_id);

        return redirect()->route('admin.products.edit', $product->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductAttribute $product_attribute)
    {
        $product_attribute->delete();

        return redirect()->route('admin.attributes.index');
    }

}
