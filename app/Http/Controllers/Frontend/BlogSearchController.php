<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use Illuminate\Http\Request;
use Spatie\Searchable\ModelSearchAspect;
use Spatie\Searchable\Search;

class BlogSearchController extends Controller
{
    public function search(Request $request)
    {
        $blog_search_keyword = $request->input('keyword');

        $search_results = (new Search())
        ->registerModel(BlogPost::class, function (ModelSearchAspect $model_search_aspect) {
            $model_search_aspect->addSearchableAttribute('post_title')
            ->addExactSearchableAttribute('post_content')
            ->where('status', 1);

        })
        // ->registerModel(BlogCategory::class, function (ModelSearchAspect $model_search_aspect) {
        //     $model_search_aspect->addSearchableAttribute('category_name');
        // })
        ->search($blog_search_keyword);
        //dd($search_results);
        return view('frontend.pages.blog.blog-search-results', compact('search_results', 'blog_search_keyword'));
    }
}
