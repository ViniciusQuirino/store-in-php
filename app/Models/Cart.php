<?php

namespace App\Models;

use DateTime;
use DateTimeZone;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cart extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'carts';

    protected $fillable = [
        'amount',
        'user_id',
        'product_id',
    ];

    public function getCreatedAtAttribute($value)
    {
        $dateTime = new DateTime($value);
        $dateTime->setTimezone(new DateTimeZone('America/Sao_Paulo'));
        return $dateTime->format('d-m-Y, H:i:s');
    }

    public function getUpdatedAtAttribute($value)
    {
        $dateTime = new DateTime($value);
        $dateTime->setTimezone(new DateTimeZone('America/Sao_Paulo'));
        return $dateTime->format('d-m-Y, H:i:s');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cart_product(): HasMany
    {
        return $this->hasMany(CartProduct::class);
    }

    public function order(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
