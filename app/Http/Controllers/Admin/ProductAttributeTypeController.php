<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductAttribute;
use App\Models\AttributeType;



class ProductAttributeTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attributes = AttributeType::all();

        return view('admin.attributes.index', compact('attributes'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('admin.attributes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        AttributeType::create([
            'type' => $request->type,
        ]);

        return redirect()->route('admin.attributes.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(AttributeType $attribute)
    {
        $product_attributes = ProductAttribute::where('attribute_type_id', $attribute->id)->get();
        return view('admin.attributes.edit', compact('attribute', 'product_attributes'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AttributeType $attribute)
    {
        $attribute->update([
            'type' => $request->type,
        ]);

        return redirect()->route('admin.attributes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(AttributeType $attribute)
    {
        $attribute->delete();

        return redirect()->route('admin.attributes.index');
    }
}
