<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\About;
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
        //Faq items
        $faq_items = FaqItem::all();
        //Faq active items
        $faq_items_active = array();
        foreach($faq_items as $faq_item_local)
        {
            if ($faq_item_local->status == 1)
            {
                array_push($faq_items_active, $faq_item_local);
            }
        }
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
        //Team items
        $team_items = TeamItem::all();
        //Team active items
        $team_items_active = array();
        foreach($team_items as $team_item_local)
        {
            if($team_item_local->status == 1)
            {
                array_push($team_items_active, $team_item_local);
            }
        }
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
            )
        );
    }
}
