<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestimonialItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'career',
        'image',
        'rated',
        'feedback',
        'status',
    ];
}
