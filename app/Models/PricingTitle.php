<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PricingTitle extends Model
{
    use HasFactory;

    protected $fillable = [
        "section_name",
        "title",
        "status",
    ];
}
