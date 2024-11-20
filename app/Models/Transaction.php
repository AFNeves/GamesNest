<?php

namespace App\Models;

use App\Enums\Status;
use App\Enums\Provider;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'date',
        'amount',
        'provider',
        'status',
        'order_id'
    ];

    protected $casts = [
        'date' => 'datetime',
        'status' => Status::class,
        'provider' => Provider::class
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
