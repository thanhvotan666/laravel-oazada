<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'country_id',
        'supplier_id',
        'name',
        'email',
        'phone',
        'address_1',
        'address_2',
        'country',
        'delivery_method',
        'discount_code',
        'discount_type',
        'discount_value',
        'total',
        'items_subtotal',
        'shipping_cost',
        'status',
        'created_at',
    ];
    // Enum for status
    public const STATUSES = [
        'pending' => 'Pending',
        'processing' => 'Processing',
        'shipping' => 'Shipping',
        'shipped' => 'Shipped',
        'canceled' => 'Canceled',
    ];

    /**
     * Get all available statuses
     */
    public static function getStatuses()
    {
        return self::STATUSES;
    }
    public function detail()
    {
        return $this->hasOne(OrderDetail::class);
    }
    public function cancel()
    {
        return $this->hasOne(CancelOrder::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
