<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\Section\AboutController;
use App\Http\Controllers\Admin\Section\Blog\BlogCategoryController;
use App\Http\Controllers\Admin\Section\Blog\BlogCommentController;
use App\Http\Controllers\Admin\Section\Blog\BlogPostController;
use App\Http\Controllers\Admin\Section\Blog\BlogTitleController;
use App\Http\Controllers\Admin\Section\Client\ClientItemController;
use App\Http\Controllers\Admin\Section\Client\ClientTitleController;
use App\Http\Controllers\Admin\Section\CountController;
use App\Http\Controllers\Admin\Section\Faq\FaqItemController;
use App\Http\Controllers\Admin\Section\Faq\FaqTitleController;
use App\Http\Controllers\Admin\Section\Feature\FeatureIconItemController;
use App\Http\Controllers\Admin\Section\Feature\FeatureIconTitleController;
use App\Http\Controllers\Admin\Section\Feature\FeatureListController;
use App\Http\Controllers\Admin\Section\Feature\FeatureTabItemController;
use App\Http\Controllers\Admin\Section\Feature\FeatureTabTitleController;
use App\Http\Controllers\Admin\Section\Feature\FeatureTitleController;
use App\Http\Controllers\Admin\Section\HeroController;
use App\Http\Controllers\Admin\Section\Pricing\PricingItemController;
use App\Http\Controllers\Admin\Section\Pricing\PricingTitleController;
use App\Http\Controllers\Admin\Section\Service\ServiceItemController;
use App\Http\Controllers\Admin\Section\Service\ServiceTitleController;
use App\Http\Controllers\Admin\Section\Team\TeamItemController;
use App\Http\Controllers\Admin\Section\Team\TeamTitleController;
use App\Http\Controllers\Admin\Section\Testimonial\TestimonialItemController;
use App\Http\Controllers\Admin\Section\Testimonial\TestimonialTitleController;
use App\Http\Controllers\Admin\Section\Value\ValueCardController;
use App\Http\Controllers\Admin\Section\Value\ValueTitleController;
use App\Http\Controllers\Frontend\BlogSearchController;
use App\Http\Controllers\Frontend\HomeController;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

#region None middleware
Route::get('/', [HomeController::class,'index'])->name('home');
// Route::get('/', function () {return 'Your web application under maintenance';})->name('home');

Route::get('/blogs', function () {
    return view('frontend.pages.blog.blog');
})->name('blogs');

Route::get('/blogs/category={slug}', function (string $slug) {
    $blog_category = BlogCategory::where('slug', $slug)->first();
    $posts_by_category = $blog_category->posts->where('status', 1);
    return view('frontend.pages.blog.blog-by-category', compact('posts_by_category', 'blog_category'));
})->name('blogs.by-category');

Route::get('blogs/search-results', [BlogSearchController::class, 'search'])->name('blogs.search-results');

Route::get('/blog-details/{slug}', function (string $slug){
    $blog_post = BlogPost::where('slug', $slug)->first();
    $blog_categories = BlogCategory::all()->where('status', 1);
    return view('frontend.pages.blog.blog-details', compact('blog_post', 'blog_categories'));
})->name('blog-details');

Route::post('/blog/blog_comment', [BlogCommentController::class, 'store'])->name('blog.blog_comment.store');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/change-language/{lang}', [DashboardController::class, 'changeLanguage'])->name('change-language');
#endregion

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Resource controller alway register last
Route::group(['middleware'=> ['auth'], 'prefix' => 'admin', 'as' => 'admin.'], function(){
    Route::resource('hero', HeroController::class);
    Route::resource('about', AboutController::class);
    Route::resource('value_title', ValueTitleController::class);
    Route::put('value_card/change-status', [ValueCardController::class, 'changeStatus'])->name('value_card.change-status');
    Route::resource('value_card', ValueCardController::class);
    Route::put('count/change-status', [CountController::class,'changeStatus'])->name('count.change-status');
    Route::resource('count', CountController::class);
    Route::resource('feature_title', FeatureTitleController::class);
    Route::put('feature_list/change-status', [FeatureListController::class,'changeStatus'])->name('feature_list.change-status');
    Route::resource('feature_list', FeatureListController::class);
    Route::resource('feature_tab_title', FeatureTabTitleController::class);
    Route::put('feature_tab_item/change-status', [FeatureTabItemController::class,'changeStatus'])->name('feature_tab_item.change-status');
    Route::resource('feature_tab_item', FeatureTabItemController::class);
    Route::resource('feature_icon_title', FeatureIconTitleController::class);
    Route::put('feature_icon_item/change-status', [FeatureIconItemController::class,'changeStatus'])->name('feature_icon_item.change-status');
    Route::resource('feature_icon_item', FeatureIconItemController::class);
    Route::resource('service_title', ServiceTitleController::class);
    Route::put('service_item/change-status', [ServiceItemController::class, 'changeStatus'])->name('service_item.change-status');
    Route::resource('service_item', ServiceItemController::class);
    Route::resource('pricing_title', PricingTitleController::class);
    Route::put('pricing_item/change-status', [PricingItemController::class, 'changeStatus'])->name('pricing_item.change-status');
    Route::resource('pricing_item', PricingItemController::class);
    Route::resource('faq_title', FaqTitleController::class);
    Route::put('faq_item/change-status', [FaqItemController::class, 'changeStatus'])->name('faq_item.change-status');
    Route::resource('faq_item', FaqItemController::class);
    Route::resource('testimonial_title', TestimonialTitleController::class);
    Route::put('testimonial_item/change-status', [TestimonialItemController::class, 'changeStatus'])->name('testimonial_item.change-status');
    Route::resource('testimonial_item', TestimonialItemController::class);
    Route::resource('team_title', TeamTitleController::class);
    Route::put('team_item/change-status', [TeamItemController::class, 'changeStatus'])->name('team_item.change-status');
    Route::resource('team_item', TeamItemController::class);
    Route::resource('client_title', ClientTitleController::class);
    Route::put('client_item/change-status', [ClientItemController::class, 'changeStatus'])->name('client_item.change-status');
    Route::resource('client_item', ClientItemController::class);
    Route::resource('blog_title', BlogTitleController::class);
});

Route::group(['middleware'=> ['auth'], 'prefix' => 'blog', 'as' => 'blog.'], function(){
    Route::put('blog_category/change-status', [BlogCategoryController::class, 'changeStatus'])->name('blog_category.change-status');
    Route::resource('blog_category', BlogCategoryController::class);
    Route::put('blog_post/change-status', [BlogPostController::class, 'changeStatus'])->name('blog_post.change-status');
    Route::get('blog_post_2', [BlogPostController::class, 'index2'])->name('blog_post_2');
    Route::get('blog_post/comment_of={slug}', [BlogPostController::class, 'comment'])->name('blog_post.comment');
    Route::resource('blog_post', BlogPostController::class);
    Route::resource('blog_comment', BlogCommentController::class)->except(['index', 'create', 'store', 'show', 'edit', 'update',]);
    Route::put('blog_comment/change-status', [BlogCommentController::class, 'changeStatus'])->name('blog_comment.change-status');
});

require __DIR__.'/auth.php';
