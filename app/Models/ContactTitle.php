<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactTitle extends Model
{
    use HasFactory;

    public $fillable = [
        'section_name',
        'title',
        'status'
    ];

    protected $guarded = [
        'id',
    ];
}
