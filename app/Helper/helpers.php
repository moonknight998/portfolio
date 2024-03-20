<?php

use App\Models\BlogCategory;
use App\Models\BlogPost;
use Detection\MobileDetect;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Faker\Generator as Faker;

function HandleUpload($inputName, $model = null)
{
    try
    {
        if(request()->hasFile($inputName))
        {
            if(File::exists(public_path($model->{$inputName})))
            {
                File::delete(public_path($model->{$inputName}));
            }

            $file = request()->file($inputName);
            $fileName = rand().$file->getClientOriginalName();
            $file->move(public_path('/uploads'), $fileName);

            $filePath = "/uploads/".$fileName;

            return $filePath;
        }
    }
    catch(\Exception $e)
    {
        throw $e;
    }
}

function HandleUploadWithPath($inputName, $path, $model = null)
{
    try
    {
        if(request()->hasFile($inputName))
        {
            if(File::exists(public_path($model->{$inputName})))
            {
                File::delete(public_path($model->{$inputName}));
            }

            $file = request()->file($inputName);
            $fileName = rand().$file->getClientOriginalName();
            $file->move(public_path('/uploads'.'/'.$path), $fileName);

            $filePath = "/uploads/".$path."/".$fileName;

            return $filePath;
        }
    }
    catch(\Exception $e)
    {
        throw $e;
    }
}

function ShowTextData($model, $name, $previewText)
{
    if($model)
    {
        if($model->{$name} === "")
        {
            return $previewText;
        }
        else
        {
            return $model->{$name};
        }
    }
    else
    {
        return $previewText;
    }
}

function ShowFormValue($model, $name)
{
    if($model)
    {
        if($model->{$name} === "")
        {
            return old($name);
        }
        else
        {
            return $model->{$name};
        }
    }
    else
    {
       return "";
    }
}

function MobileDetect()
{
    $detect = new MobileDetect();
    return $detect;
}

function GetMaxFileSizeUpload() : int {
    return 2097152;
}

function ShowLocaleSetting() : string {
    $currentLocale = app()->getLocale();
    switch ($currentLocale) {
        case 'en':
            return __('admin/common.english');
        case 'vi':
            return __('admin/common.vietnamese');
        default:
            return __('admin/common.vietnamese');
    }
}

function ShowLocaleDropdown() : string {
    $currentLocale = app()->getLocale();
    switch ($currentLocale) {
        case 'en':
            return __('admin/common.vietnamese');
        case 'vi':
            return __('admin/common.english');
        default:
            return __('admin/common.vietnamese');
    }
}

function RefeshLocale($locale)
{
    app()->setLocale($locale);
    redirect(Route::currentRouteName());
}


/**
 * Returns a collection of the most recent published blog posts.
 *
 * @param int $limit The number of posts to return
 *
 * @return Illuminate\Support\Collection
 */
function GetMostRecentBlogPosts($limit = 3)
{
    // Get all published blog posts, ordered by creation date
    $all_active_posts = BlogPost::where('status', 1)->latest('created_at')->get();
    $blog_posts = array();
    foreach ($all_active_posts as $post) {
        $category_activate = BlogCategory::find($post->category_id)->status == 1 ? true : false;
        if ($category_activate)
        {
            if (count($blog_posts) < $limit)
            {
                array_push($blog_posts, $post);
            }
        }
    }
    return collect($blog_posts);
}


/**
 * Returns the CSS property pointer-events for the delete category button.
 *
 * @param int $id Id of the category to check
 *
 * @return string
 */
function ActiveDeleteCategoryButton($id)
{
    $category_oldest = BlogCategory::oldest('created_at')->first();
    /**
     * If the category with the given id is the oldest one,
     * the button should be disabled.
     */
    if ($category_oldest->id == $id) {
        return 'display: none;';
    }

    return 'display: inline;';
}

function GetAllActiveBlogPosts()
{
    $all_active_posts = BlogPost::where('status', 1)->latest('created_at')->get();
    $blog_posts = array();
    foreach ($all_active_posts as $post) {
        $category_activate = BlogCategory::find($post->category_id)->status == 1 ? true : false;
        if ($category_activate)
        {
            array_push($blog_posts, $post);
        }
    }
    collect($blog_posts);
    return $blog_posts;
}

function GetBlogPostsPerPage($post_per_page = 5)
{
    $all_active_posts = BlogPost::where('status', 1)->latest('created_at')->get();
    $blog_posts = array();
    foreach ($all_active_posts as $post) {
        $category_activate = BlogCategory::find($post->category_id)->status == 1 ? true : false;
        if ($category_activate)
        {
            array_push($blog_posts, $post);
        }
    }
    $blog_posts_match = collect($blog_posts);
    $blog_posts_per_page = $blog_posts_match->paginate($post_per_page);
    return $blog_posts_per_page;
}

function GetBlogPostsPerPageByCategory($category, $post_per_page = 5)
{
    $all_active_posts = $category->posts()->where('status', 1)->latest('created_at')->get();
    $blog_posts_per_page = $all_active_posts->paginate($post_per_page);
    return $blog_posts_per_page;
}

function GetBlogPostsPerPageByCollect($blog_post_collection, $post_per_page = 5)
{
    $blog_posts_per_page = $blog_post_collection->paginate($post_per_page);
    return $blog_posts_per_page;
}

function PostContentParse($post_content)
{
    $dom = new \DOMDocument();

    @$dom->loadHTML($post_content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD | LIBXML_NOERROR | LIBXML_NOWARNING);

    $paragrahps = $dom->getElementsByTagName('p');

    $post_content_parse = '';

    foreach ($paragrahps as $paragraph) {
        // if ($paragrahp->hasChildNodes())
        // {
        //     $post_content_parse .= $paragrahp->nodeValue.' ';
        // }
        $post_content_parse .= $paragraph->nodeValue.' ';
    }

    return $post_content_parse;
}

function GetBlogPostSearchResult($search_results)
{
    $blog_posts = array();
    foreach ($search_results as $result) {
        $category_activate = BlogCategory::find($result->searchable->category_id)->status == 1 ? true : false;
        if ($category_activate)
        {
            array_push($blog_posts, $result);
        }
    }
    collect($blog_posts);
    return $blog_posts;
}

function faker()
{
    return new Faker();
}

