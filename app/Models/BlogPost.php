<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class BlogPost extends Model implements Searchable
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

    public function comments()
    {
        return $this->hasMany(BlogComment::class, 'blog_post_id', 'id')->orderBy('created_at', 'desc');
    }

    /**
     * Get all active blog posts by category
     *
     * @return array
     */
    public function postActiveByCategory()
    {
        // Get all active categories
        $categories = BlogCategory::all()->where('status', 1);

        // Initialize array to store active posts
        $blog_posts = array();

        // Loop through each active category
        foreach ($categories as $category) {

            // Get all active posts of each category
            $posts = $category->posts->where('status', 1);

            // Loop through each active post of each category
            foreach ($posts as $post) {

                // Add active post to array
                array_push($blog_posts, $post);
            }
        }

        // Return array of active posts
        return $blog_posts;
    }

    public function getSearchResult(): SearchResult
    {
        $url = route('blog-details', Crypt::encryptString($this->id));

        return new SearchResult($this, $this->post_title, $url);
    }

    protected $fillable = [
        'post_title',
        'slug',
        'thumbnail',
        'post_content',
        'category_id',
        'post_author',
        'user_id',
        'status',
    ];
}
