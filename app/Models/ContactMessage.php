<?php

namespace App\Models;

use App\Enums\MessageStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    use HasFactory;

    public $fillable = [
        'name',
        'email',
        'phone_number',
        'message_title',
        'slug',
        'message',
        'status',
    ];

    protected $guarded = ['id'];

    protected $casts = [
        'status' => MessageStatusEnum::class,
    ];
}
