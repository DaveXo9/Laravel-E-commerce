<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\ImageUploadService;


class ProductImageController extends Controller
{
    //

    public function __construct(private ImageUploadService $imageUploadService)
    {
        
    }

    public function store(Request $request, Product $product){

        if($request->hasFile('image')){
            
            $image = $this->imageUploadService->uploadOne($request->file('image'), 'products');

            $productImage = new ProductImage([
                'full' => $image
            ]);

            $product->images()->save($productImage);

        }
        return back();

    }

    public function destroy(ProductImage $image){

        if ($image->full != '') {
            $this->imageUploadService->deleteOne($image->full);
        }
        $image->delete();
    
        return redirect()->back();
    }


}
