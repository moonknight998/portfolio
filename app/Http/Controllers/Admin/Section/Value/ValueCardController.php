<?php

namespace App\Http\Controllers\Admin\Section\Value;

use App\DataTables\ValueCardDataTable;
use App\Http\Controllers\Controller;
use App\Models\ValueCard;
use App\Models\ValueTitle;
use Detection\MobileDetect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

use function PHPUnit\Framework\isEmpty;

class ValueCardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $value_title = ValueTitle::first();
        $value_cards_paginate = ValueCard::orderBy('id', 'desc')->paginate(10);
        if ($value_title == null)
        {
            return redirect()->route('admin.value_title.index')->with('status','required');
        }
        return view('admin.pages.sections.value.value_card_index', compact('value_cards_paginate'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $detect = new MobileDetect();
        $value_title = ValueTitle::first();
        $value_cards = ValueCard::all();
        return view('admin.pages.sections.value.value_card_create', compact('detect', 'value_cards', 'value_title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => ['required','string','max:100'],
            'description' => ['required','string','max:400'],
        ]);

        if ($validator->fails()) {
            $key = '';
            foreach ($validator->errors()->getMessages() as $keyError => $messageError)
            {
                $key = $keyError;
                break;
            }
            return redirect()->route('admin.value_card.create', "#$key")->withErrors($validator)->withInput();
        }

        $imagePath = '';

        if($request->hasFile('image')){
            $image = $request->file('image');
            $imageName = rand().$image->getClientOriginalName();
            $image->move(public_path('/uploads'), $imageName);

            $imagePath = "/uploads/".$imageName;
        }

        $value_card = new ValueCard();
        $value_card->title = $request->title;
        $value_card->description = $request->description;
        $value_card->image = $imagePath;
        $value_card->status = $request->status;
        $value_card->save();

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
        $value_card = ValueCard::findOrFail($id);
        $value_cards = ValueCard::all();
        $detect = new MobileDetect();
        $value_title = ValueTitle::first();
        return view('admin.pages.sections.value.value_card_edit', compact('value_card', 'value_title', 'detect', 'value_cards'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $value_card = ValueCard::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'title' => ['required','string','max:100'],
            'description' => ['required','string','max:400'],
        ]);

        if ($validator->fails()) {
            $key = '';
            foreach ($validator->errors()->getMessages() as $keyError => $messageError)
            {
                $key = $keyError;
                break;
            }
            return redirect()->route('admin.value_card.edit', "#$key")->withErrors($validator)->withInput();
        }

        $imagePath = '';

        if($request->hasFile('image')){
            if($value_card && File::exists(public_path($value_card->image))){
                File::delete(public_path($value_card->image));
            }
            $image = $request->file('image');
            $imageName = rand().$image->getClientOriginalName();
            $image->move(public_path('/uploads'), $imageName);

            $imagePath = "/uploads/".$imageName;
        }

        $value_card->title = $request->title;
        $value_card->description = $request->description;
        $value_card->image = $imagePath;
        $value_card->status = $request->status;
        $value_card->save();

        return redirect()->back()->with('status', 'updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $value_card = ValueCard::findOrFail($id);
        if($value_card){
            if(File::exists(public_path($value_card->image)))
            {
                File::delete(public_path($value_card->image));
            }
            $value_card->delete();
        }
    }

    public function changeStatus(Request $request)
    {
        $value_card = ValueCard::findOrFail($request->id);
        $value_card->status = $request->status == 'true' ? 1 : 0;
        $value_card->save();

        return response(['message' => 'Status has been updated']);
    }
}
