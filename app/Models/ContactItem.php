<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'first_line',
        'second_line',
        'icon',
        'status',
    ];

    protected $guarded = [
        'id',
    ];
}
