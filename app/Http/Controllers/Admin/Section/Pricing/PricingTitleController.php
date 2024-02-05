<?php

namespace App\Http\Controllers\Admin\Section\Pricing;

use App\Http\Controllers\Controller;
use App\Models\PricingItem;
use App\Models\PricingTitle;
use Detection\MobileDetect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PricingTitleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $detect = new MobileDetect();
        $pricing_title = PricingTitle::first();
        $pricing_items = PricingItem::all();
        return view('admin.pages.sections.pricing.pricing_title_index', compact(['detect', 'pricing_title', 'pricing_items']));
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
        $validator = Validator::make($request->all(), [
            'section_name'=> ['required','string', 'max:200'],
            'title'=> ['required','string', 'max:500'],
            'status' => ['required'],
        ]);

        if ($validator->fails()) {
            $key = '';
            foreach ($validator->errors()->getMessages() as $keyError => $messageError)
            {
                $key = $keyError;
                break;
            }
            return redirect()->route('admin.pricing_title.index', "#$key")->withErrors($validator)->withInput();
        }

        $pricing_title = new PricingTitle();
        $pricing_title->section_name = $request->section_name;
        $pricing_title->title = $request->title;
        $pricing_title->status = $request->status;
        $pricing_title->save();

        return redirect()->back()->with('status', 'updated');
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
        $pricing_title = PricingTitle::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'section_name'=> ['required','string', 'max:200'],
            'title'=> ['required','string', 'max:500'],
            'status' => ['required'],
        ]);

        if ($validator->fails()) {
            $key = '';
            foreach ($validator->errors()->getMessages() as $keyError => $messageError)
            {
                $key = $keyError;
                break;
            }
            return redirect()->route('admin.pricing_title.index', "#$key")->withErrors($validator)->withInput();
        }

        $pricing_title->section_name = $request->section_name;
        $pricing_title->title = $request->title;
        $pricing_title->status = $request->status;
        $pricing_title->save();

        return redirect()->back()->with('status', 'updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
