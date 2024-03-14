<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    use HasFactory;

    /**
     * Get the category associated with the blog post.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(BlogCategory::class, 'category_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function published()
    {
        return $this->status == 1;
    }

    protected $fillable = [
        'post_title',
        'thumbnail',
        'post_content',
        'category_id',
        'post_author',
        'user_id',
        'status',
    ];
}
