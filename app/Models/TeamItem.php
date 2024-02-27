<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamItem extends Model
{
    use HasFactory;

    protected $fillable = [
      'name',
      'work_title',
      'description',
      'image',
      'facebook_url',
      'instagram_url',
      'telegram_url',
      'status',
    ];
}
