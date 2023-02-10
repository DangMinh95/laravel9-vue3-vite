<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id'
    ];

    protected $hidden = [
        'user_id'
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, "product_order", "order_id", "product_id")->withPivot('quantity')->withTimestamps();
    }
}
