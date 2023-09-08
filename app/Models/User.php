<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use DateTime;
use DateTimeZone;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasUuids;

    protected $fillable = ['name', 'email', 'password', 'age', 'cpf', 'type', 'email_verified', 'email_verification_token'];

    protected $hidden = ['password'];

    protected $casts = [
        // 'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [
            'type' => $this->type,
            'id' => $this->id,
        ];
    }

    public function toArray()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'age' => $this->age,
            'cpf' => $this->cpf,
            'type' => $this->type,
            'email_verified' => $this->email_verified,
            'email_verification_token' => $this->email_verification_token,
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

    //inverso = belongsTo
    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class);
    }

    public function cart(): HasOne
    {
        return $this->hasOne(Cart::class);
    }

    public function product(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function order(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
