<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['status', 'grand_total', 'item_count', 'payment_status', 'payment_method', 'first_name', 'last_name', 'address', 'city', 'country', 'post_code', 'phone_number', 'notes', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
