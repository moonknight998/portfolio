<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogComment extends Model
{
    use HasFactory;

    public function blogPost()
    {
        return $this->belongsTo(BlogPost::class, 'blog_post_id', 'id');
    }

    public $fillable = [
        'name',
        'email',
        'phone_number',
        'comment',
        'blog_post_id',
        'status',
    ];

    protected $guarded = ['id'];
}
