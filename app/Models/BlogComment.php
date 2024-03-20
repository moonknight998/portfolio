<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogComment extends Model
{
    use HasFactory;

    public $fillable = [
        'name',
        'email',
        'phone_number',
        'comment',
        'blog_post_id'
    ];

    protected $guarded = ['id'];
}
