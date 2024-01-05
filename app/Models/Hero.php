<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hero extends Model
{
    use HasFactory;

    protected $fillable = [
        "slogan",
        "short_description",
        "button_text",
        "button_url",
        "image",
        "status",
    ];
}
