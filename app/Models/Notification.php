<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Notification extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['title', 'message'];

    public function usersNotified(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'users_notified', 'notification_id', 'user_id');
    }
}
