<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Requests\AdminCategoryRequest;
use App\Services\ImageUploadService;


class CategoryController extends Controller
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
        $categories = Category::where('id', '!=', 1)->get();
        // $this->setPageTitle('Categories', 'List of all categories');

        return view('admin.categories.index', compact('categories'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderByRaw('-name ASC')->get()->nest()->listsFlattened('name');

        return view('admin.categories.create', compact('categories')); 

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminCategoryRequest $categoryRequest)
    {


        $formFields = $categoryRequest->only(['name', 'description', 'parent_id']);

        $formFields['featured'] = $categoryRequest->has('featured') ? 1 : 0;
        $formFields['menu'] = $categoryRequest->has('menu') ? 1 : 0;
        
        if($categoryRequest->hasFile('image')){

        $formFields['image'] = $this->imageUploadService->uploadOne($categoryRequest->file('image'),'categories');
        
        }
        Category::create($formFields);

        return redirect('admin/categories')->with('success', 'Category has been added successfully!');
        

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        // Retrive all categories, every single one of them
        $categories = Category::orderByRaw('-name ASC')->get()->nest()->listsFlattened('name');
        $targetCategory = $category;
        return  view('admin.categories.edit', compact('categories', 'targetCategory'));
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminCategoryRequest $categoryRequest, Category $category)
    {
        $formFields = $categoryRequest->only(['name', 'description', 'parent_id']);

        $formFields['featured'] = $categoryRequest->has('featured') ? 1 : 0;
        $formFields['menu'] = $categoryRequest->has('menu') ? 1 : 0;
        
        if($categoryRequest->hasFile('image')){

        $formFields['image'] = $this->imageUploadService->uploadOne($categoryRequest->file('image'),'categories');
        
        }
        $category->update($formFields);

        return redirect('admin/categories')->with('success', 'Category has been added successfully!');
        

        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect('/admin/categories')->with('success', 'Category has been deleted successfully!');
        //
    }

        /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('admin.categories.show', compact('category'));
        //
    }

}
