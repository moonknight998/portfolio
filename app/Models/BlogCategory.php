<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class BlogCategory extends Model implements Searchable
{
    use HasFactory;

    protected $fillable = [
        'category_name',
        'slug',
        'status',
    ];

    /**
     * Define a relationship with the BlogPost model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts()
    {
        return $this->hasMany(BlogPost::class, 'category_id', 'id');
    }

    public function getSearchResult(): SearchResult
    {
        $url = route('blog.blog_category.show', $this->id);
        return new SearchResult($this, $this->category_name, $url);
    }
}
