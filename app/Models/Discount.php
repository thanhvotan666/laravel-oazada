<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'name', 'type', 'value', 'quantity', 'status'];

    // Enum for type and status
    public const TYPES = [
        'direct' => 'Direct',
        'percent' => 'Percent',
    ];

    public const STATUSES = [
        'still' => 'Still Valid',
        'expired' => 'Expired',
    ];

    /**
     * Get all available types
     */
    public static function getTypes()
    {
        return self::TYPES;
    }

    /**
     * Get all available statuses
     */
    public static function getStatuses()
    {
        return self::STATUSES;
    }
}
