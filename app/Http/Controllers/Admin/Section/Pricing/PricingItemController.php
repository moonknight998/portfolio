<?php

namespace App\Http\Controllers\Admin\Section\Pricing;

use App\DataTables\PricingItemDataTable;
use App\Http\Controllers\Controller;
use App\Models\PricingItem;
use App\Models\PricingTitle;
use Detection\MobileDetect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class PricingItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PricingItemDataTable $dataTable)
    {
        $pricing_title = PricingTitle::first();
        if ($pricing_title == null)
        {
            return redirect()->route('admin.pricing_title.index')->with('status', 'required');
        }
        return $dataTable->render('admin.pages.sections.pricing.pricing_item_index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $detect = new MobileDetect();
        $pricing_title = PricingTitle::first();
        $pricing_items = PricingItem::all();
        return view('admin.pages.sections.pricing.pricing_item_create', compact(['detect', 'pricing_title', 'pricing_items']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $pricing_item = new PricingItem();

        $validator = Validator::make($request->all(), [
            'pricing_name'=> ['required','string', 'max:200'],
            'price_per_month'=> ['required','string', 'max:500'],
            'currency' => ['required', 'string', 'max: 10'],
            'image' => ['mimes:jpeg,bmp,png', 'max:2048'], //2MB max
            'benefit' => ['required', 'string', 'max:1500'],
            'button_name'=> ['required', 'string', 'max:100'],
            'button_url'=> ['required', 'url', 'max:500'],
            'is_featured' => ['required'],
            'status' => ['required'],
        ]);

        if ($validator->fails()) {
            $key = '';
            foreach ($validator->errors()->getMessages() as $keyError => $messageError)
            {
                $key = $keyError;
                break;
            }
            return redirect()->route('admin.pricing_item.create', "#$key")->withErrors($validator)->withInput();
        }

        if($request->hasFile('image')){
            $image = $request->file('image');
            $imageName = rand().$image->getClientOriginalName();
            $image->move(public_path('/uploads'), $imageName);

            $imagePath = "/uploads/".$imageName;
        }

        $pricing_item->pricing_name = $request->pricing_name;
        $pricing_item->color = $request->color;
        $pricing_item->price_per_month = $request->price_per_month;
        $pricing_item->currency = $request->currency;
        $pricing_item->image = isset($imagePath) ? $imagePath : asset('frontend/assets/img/pricing-free.png');
        $pricing_item->benefit = $request->benefit;
        $pricing_item->button_name = $request->button_name;
        $pricing_item->button_url = $request->button_url;
        $pricing_item->is_featured = $request->is_featured;
        $pricing_item->status = $request->status;
        $pricing_item->save();

        return redirect()->back()->with('status', 'created');
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
        $detect = new MobileDetect();
        $pricing_title = PricingTitle::first();
        $pricing_item = PricingItem::findOrFail($id);
        $pricing_items = PricingItem::all();
        return view('admin.pages.sections.pricing.pricing_item_edit', compact(['detect', 'pricing_title', 'pricing_item', 'pricing_items']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $pricing_item = PricingItem::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'pricing_name'=> ['required','string', 'max:200'],
            'price_per_month'=> ['required','string', 'max:500'],
            'currency' => ['required', 'string', 'max: 10'],
            'image' => ['mimes:jpeg,bmp,png', 'max:2048'], //2MB max
            'benefit' => ['required', 'string', 'max:1500'],
            'button_name'=> ['required', 'string', 'max:100'],
            'button_url'=> ['required', 'url', 'max:500'],
            'is_featured' => ['required'],
            'status' => ['required'],
        ]);

        if ($validator->fails()) {
            $key = '';
            foreach ($validator->errors()->getMessages() as $keyError => $messageError)
            {
                $key = $keyError;
                break;
            }
            return redirect()->route('admin.pricing_item.edit', "#$key")->withErrors($validator)->withInput();
        }

        if($request->hasFile('image')){
            $image = $request->file('image');
            $imageName = rand().$image->getClientOriginalName();
            $image->move(public_path('/uploads'), $imageName);

            $imagePath = "/uploads/".$imageName;
        }

        $pricing_item->pricing_name = $request->pricing_name;
        $pricing_item->color = $request->color;
        $pricing_item->price_per_month = $request->price_per_month;
        $pricing_item->currency = $request->currency;
        $pricing_item->image = isset($imagePath) ? $imagePath : asset('frontend/assets/img/pricing-free.png');
        $pricing_item->benefit = $request->benefit;
        $pricing_item->button_name = $request->button_name;
        $pricing_item->button_url = $request->button_url;
        $pricing_item->is_featured = $request->is_featured;
        $pricing_item->status = $request->status;
        $pricing_item->save();

        return redirect()->back()->with('status', 'updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pricing_item = PricingItem::findOrFail($id);
        if($pricing_item){
            if(File::exists(public_path($pricing_item->image)))
            {
                File::delete(public_path($pricing_item->image));
            }
            $pricing_item->delete();
        }
    }

    public function changeStatus(Request $request)
    {
        $pricing_item = PricingItem::findOrFail($request->id);
        $pricing_item->status = $request->status == 'true' ? 1 : 0;
        $pricing_item->save();

        return response(['message' => 'Status has been updated']);
    }
}
