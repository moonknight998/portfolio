<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PricingItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'pricing_name',
        'color',
        'price_per_month',
        'image',
        'benefit',
        'button_name',
        'button_url',
        'is_featured',
        'status',
    ];
}
