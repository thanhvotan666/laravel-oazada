<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'name', 'description', 'image', 'is_variant', 'category_id', 'supplier_id', 'hidden', 'view'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
    public function attribute()
    {
        return $this->hasOne(ProductAttribute::class);
    }
    public function keyAttributes()
    {
        return $this->hasMany(ProductKeyAttribute::class);
    }
    public function reviews()
    {
        return $this->hasMany(ProductReview::class);
    }

    public function keywords()
    {
        return $this->hasMany(ProductKeyword::class);
    }
}
