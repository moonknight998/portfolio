<?php

namespace App\Http\Controllers\Admin\Section\Feature;

use App\Http\Controllers\Controller;
use App\Models\FeatureIconTitle;
use Detection\MobileDetect;
use Illuminate\Http\Request;

class FeatureIconTitleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $detect = new MobileDetect();
        $feature_icon_title = FeatureIconTitle::first();
        return view('admin.pages.sections.feature.feature_icon_title_index', compact('detect','feature_icon_title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
