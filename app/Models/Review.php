<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    use HasFactory;

    // Disable automatic timestamps if not required
    public $timestamps = false;

    // Make sure these fields are fillable
    protected $fillable = [
        'text',
        'rating',
        'review_date',
        'product_id',
        'user_id'
    ];

    // Ensure that review_date is properly cast to a datetime object
    protected $casts = [
        'review_date' => 'datetime'
    ];

    // Define relationship to User model (a review belongs to a user)
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Define relationship to Product model (a review belongs to a product)
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

}
