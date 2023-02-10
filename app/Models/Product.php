<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;


    protected $fillable = [
        'pname',
        'price',
        'category_id',
        'manufactor'
    ];

    public function latestComment()
    {
        return $this->morphOne(Comment::class, 'commentable')->latestOfMany();
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
