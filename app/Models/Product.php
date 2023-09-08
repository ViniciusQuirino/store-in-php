<?php

namespace App\Models;

use DateTime;
use DateTimeZone;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory, HasUuids;

    //nome da tabela com que faz referencia
    protected $table = 'products';

    //quais são os campos
    //chave primaria nao precisa colocar
    protected $fillable = ['name', 'value', 'stock', 'status', 'imagem', 'category', 'seller_id'];

    public function toArray()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'value' => $this->value,
            'stock' => $this->stock,
            'status' => $this->status,
            'imagem' => $this->imagem,
            'category' => $this->category,
            'seller_id' => $this->seller_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }

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

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function cart_product(): HasMany
    {
        return $this->hasMany(CartProduct::class);
    }

    public function order_product(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
