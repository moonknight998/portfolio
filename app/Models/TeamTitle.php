<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamTitle extends Model
{
    use HasFactory;

    protected $fillale = [
        'section_name',
        'title',
        'status',
    ];
}