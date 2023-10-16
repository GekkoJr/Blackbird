<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GlobalMessage extends Model
{
    use HasFactory;

    public $table = 'global_messages';

    protected $fillable = [
        'message',
        'fromUser',
    ];
}
