<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'image', 'price', 'stock', 'weight'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function options()
    {
        return $this->hasMany(VariantOption::class);
    }
    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }
    public function carts()
    {
        return $this->hasMany(VariantOption::class);
    }
}
