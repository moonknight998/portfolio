<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\BlogTitle;
use App\Models\ClientItem;
use App\Models\ClientTitle;
use App\Models\Count;
use App\Models\Faq;
use App\Models\FaqItem;
use App\Models\FeatureIconItem;
use App\Models\FeatureIconTitle;
use App\Models\FeatureList;
use App\Models\FeatureTabItem;
use App\Models\FeatureTabTitle;
use App\Models\FeatureTitle;
use App\Models\Hero;
use App\Models\PricingItem;
use App\Models\PricingTitle;
use App\Models\Service;
use App\Models\ServiceItem;
use App\Models\TeamItem;
use App\Models\TeamTitle;
use App\Models\TestimonialItem;
use App\Models\TestimonialTitle;
use App\Models\ValueCard;
use App\Models\ValueTitle;

class HomeController extends Controller
{
    public function index()
    {
        //Hero
        $hero = Hero::first();
        //About
        $about = About::first();
        //Value title
        $value_title = ValueTitle::first();
        //Value card
        $value_cards = ValueCard::all();
        //Counts
        $counts = Count::all();
        #region Feature
        //Feature title
        $feature_title = FeatureTitle::first();
        //Feature list
        $feature_lists = FeatureList::all();
        //Feature tab title
        $feature_tab_title = FeatureTabTitle::first();
        //Feature tab items
        $feature_tab_items = FeatureTabItem::all();
        //Feature icon title
        $feature_icon_title = FeatureIconTitle::first();
        //Feature icon items
        $feature_icon_items = FeatureIconItem::all();
        #endregion
        #region Service
        //Service title
        $service_title = Service::first();
        //Service item
        $service_items = ServiceItem::all();
        #endregion
        #region Pricing
        //Pricing title
        $pricing_title = PricingTitle::first();
        //Pricing item
        $pricing_items = PricingItem::all();
        #endregion
        #region F.A.Q
        //Faq title
        $faq_title = Faq::first();
        //Faq active items
        $faq_items_active = FaqItem::all()->where('status', 1);
        #endregion
        #region Testimonial
        //Testimonial title
        $testimonial_title = TestimonialTitle::first();
        //Testimonial items
        $testimonial_items = TestimonialItem::all();
        #endregion
        #region Team
        //Team title
        $team_title = TeamTitle::first();
        //Team active items
        $team_items_active = TeamItem::all()->where('status', 1);
        #endregion
        #region Client
        $client_title = ClientTitle::first();
        $client_items_active = ClientItem::all()->where('status', 1);
        #endregion
        #region Blog
        $blog_title = BlogTitle::first();
        //Get most recent 3 blog posts
        $blog_posts = GetMostRecentBlogPosts(3);
        #endregion

        return
            view('frontend.pages.home.home',
            compact(
                'hero',
                'about',
                'value_title',
                'value_cards',
                'counts',
                'feature_title',
                'feature_lists',
                'feature_tab_title',
                'feature_tab_items',
                'feature_icon_title',
                'feature_icon_items',
                'service_title',
                'service_items',
                'pricing_title',
                'pricing_items',
                'faq_title',
                'faq_items_active',
                'testimonial_title',
                'testimonial_items',
                'team_title',
                'team_items_active',
                'client_title',
                'client_items_active',
                'blog_title',
                'blog_posts',
            )
        );
    }
}
