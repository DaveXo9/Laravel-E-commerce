<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'description' => 'required',
            'parent_id' => 'required|not_in:0',
            'featured' => 'nullable|boolean',
            'menu' => 'nullable|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,,svg|max:1000',   
            //
        ];
    }
}
