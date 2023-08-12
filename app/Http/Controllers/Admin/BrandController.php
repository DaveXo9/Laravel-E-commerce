<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\ImageUploadService;
use App\Http\Requests\AdminBrandRequest;

class BrandController extends Controller
{

    public function __construct(private ImageUploadService $imageUploadService)
    {
        
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::all();

        return view('admin.brands.index', compact('brands'));
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('admin.brands.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminBrandRequest $brandRequest)
    {
        $formField = $brandRequest->validated();
        $formField['image'] = $this->imageUploadService->uploadOne($brandRequest->file('image'), 'brands');

        $brand = Brand::create($formField);

        return redirect()->route('admin.brands.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        return view ('admin.brands.edit', compact('brand'));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminBrandRequest $brandRequest, Brand $brand)
    {
        $formField = $brandRequest->validated();
        $formField['image'] = $this->imageUploadService->uploadOne($brandRequest->file('image'), 'brands');

        $brand->update($formField);

        return redirect()->route('admin.brands.index');

        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        $brand -> delete();

        return redirect()->route('admin.brands.index');
        //
    }
}
