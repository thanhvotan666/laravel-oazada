<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CancelOrder extends Model
{
    use HasFactory;
    protected $fillable = ['order_id', 'cause', 'by'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
