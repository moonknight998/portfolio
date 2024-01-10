<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Count;
use App\Models\FeatureIconItem;
use App\Models\FeatureIconTitle;
use App\Models\FeatureList;
use App\Models\FeatureTabItem;
use App\Models\FeatureTabTitle;
use App\Models\FeatureTitle;
use App\Models\Hero;
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
            )
        );
    }
}
