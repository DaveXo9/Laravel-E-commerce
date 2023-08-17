<?php

namespace App\Models;

use App\Models\ProductAttribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AttributeType extends Model
{
    use HasFactory;

    protected $fillable = ['type'];


    public function attributes()
    {
        return $this->hasMany(ProductAttribute::class);
    }
}
