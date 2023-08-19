<?php

namespace App\Models;

use App\Models\Product;
use App\Models\AttributeType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductAttribute extends Model
{
    use HasFactory;

    protected  $fillable = ['name', 'price', 'attribute_type_id'];

    public function product()
    {
        return $this->belongsToMany(Product::class, 'product_attributes_pivot', 'product_attribute_id', 'product_id');
    }

    public function attributeType()
    {
        return $this->belongsTo(AttributeType::class);
    }
    
}
