<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Message extends Model
{
    use HasFactory;

    public $table = 'messages';

    protected $fillable = [
        'message',
        'user_id',
        'channel',
        'created_at',
    ];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }
}
