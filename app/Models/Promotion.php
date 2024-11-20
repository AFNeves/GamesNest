<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Promotion extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['name', 'description'];

    public function discounts(): HasMany
    {
        return $this->hasMany(Discount::class, 'promotion_id');
    }

    public function products(): HasManyThrough
    {
        return $this->hasManyThrough(Product::class, Discount::class, 'promotion_id', 'discount_id');
    }
}
