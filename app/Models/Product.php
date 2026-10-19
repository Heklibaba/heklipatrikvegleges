<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'alcohol_percent',
        'price'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}