<?php

namespace App\Models;

use App\Enums\Status;
use App\Casts\Address;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'price',
        'status',
        'order_date',
        'deliver_date',
        'billing_address',
        'user_id'
    ];

    protected $casts = [
        'status' => Status::class,
        'billing_address' => Address::class,
        'order_date' => 'datetime',
        'deliver_date' => 'datetime'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function transaction(): HasOne
    {
        return $this->hasOne(Transaction::class, 'order_id');
    }

    public function keys(): HasMany
    {
        return $this->hasMany(ProductKey::class, 'order_id');
    }
}
