<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User
as AuthenticatableBase;
use Illuminate\Notifications\Notifiable;

class User extends AuthenticatableBase implements Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
        'address',
        'phone_number',
        'role',
        'country_id'
    ];
    protected $hidden = [
        'password',
        'remember_token'
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    // Enum for roles
    const ROLE_CUSTOMER = 'customer';
    const ROLE_SUPPLIER = 'supplier';
    const ROLE_ADMIN = 'admin';
    const ROLE_WRITER = 'writer';

    /**
     * Get all available roles
     */
    public function isCustomer()
    {
        return $this->role === self::ROLE_CUSTOMER;
    }

    public function isSupplier()
    {
        return $this->role === self::ROLE_SUPPLIER;
    }

    public function isAdmin()
    {
        return $this->role === self::ROLE_ADMIN;
    }

    public function isWriter()
    {
        return $this->role === self::ROLE_WRITER;
    }
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function supplier()
    {
        return $this->hasOne(Supplier::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function cart()
    {
        return $this->hasOne(Cart::class);
    }

    public function getAuthIdentifierName()
    {
        return 'id';
        // khóa chính
    }
    public function getAuthPassword()
    {
        return $this->password;
    }
    public function favorite()
    {
        return $this->hasMany(Favorite::class);
    }
}
