<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


use Illuminate\Database\Eloquent\Relations\belongsTo;


class Product extends Model
{
    use HasFactory;

    protected $table = 'product';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = [
        'title',
        'description',
        'images',
        'type',
        'platform',
        'region',
        'price',
        'rating',
        'visibility',
        'discount_id'
    ];

    protected $casts = [
        'title' => 'string',
        'description' => 'string',
        'images' => 'array', //not sure about this one
        'type' => 'string',
        'platform' => 'string',
        'region' => 'string',
        'price' => 'decimal:2',
        'rating' => 'decimal:2',
        'visibility' => 'boolean',
        'discount_id' => 'integer'
    ];

    public function discount(): BelongsTo
    {
        return $this->belongsTo(Discount::class, 'discount_id', 'id');
    }

}
