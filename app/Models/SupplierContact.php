<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierContact extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'supplier_id',
        'requirement',
        'recommend',
        'business_card'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
    public function reply()
    {
        return $this->hasOne(SupplierReply::class);
    }
}
