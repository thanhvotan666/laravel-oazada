<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VariantOption extends Model
{
    use HasFactory;

    protected $fillable = ['product_variant_id', 'name', 'value'];

    public function productVariant()
    {
        return $this->belongsTo(ProductVariant::class);
    }
    
}
