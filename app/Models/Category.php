<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'category_type_id'];

    public function categoryType()
    {
        return $this->belongsTo(CategoryType::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
