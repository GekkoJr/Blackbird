<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HelpIndex extends Model
{
    use HasFactory;

    protected $table = "help";

    protected $fillable = [
        "name",
        "parent",
        "isDirectory"
    ];
}
