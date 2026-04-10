<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories'; // ← FIX

    protected $fillable = ['name', 'product_id'];

    public function product()
    {
        return $this->hasMany(Product::class);
    }
}