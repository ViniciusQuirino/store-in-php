<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CartProduct extends Model
{
    use HasUuids;

    protected $table = 'cart_products';

    protected $fillable = [
        'amount',
        'cart_id',
        'product_id',
    ];

    public $timestamps = false;

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function cart(): BelongsTo
    {
        return $this->belongsTo(Cart::class);
    }
}
