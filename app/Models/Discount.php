<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Discount extends Model
{
    use HasFactory;

    protected $table = 'discount';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = [
        'name',
        'percentage',
        'start_date',
        'end_date'
    ];

    protected $casts = [
        'name' => 'string',
        'percentage' => 'decimal:2',
        'start_date' => 'datetime',
        'end_date' => 'datetime'
    ];

    public function promotion(): BelongsTo
    {
        return $this->belongsTo(Promotion::class, 'promotion_id', 'id');
    }
}
