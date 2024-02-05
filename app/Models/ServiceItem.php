<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'icon',
        'title',
        'description',
        'button_text',
        'button_url',
        'main_color',
        'extra_color',
        'status',
    ];
}
