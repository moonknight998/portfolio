<?php

namespace App\Http\Controllers\Admin\Section\Faq;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\FaqItem;
use Detection\MobileDetect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FaqTitleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $detect = new MobileDetect();
        $faq_title = Faq::first();
        $faq_items = FaqItem::all();
        $faq_items_active = array();
        foreach($faq_items as $faq_item_local)
        {
            if ($faq_item_local->status == 1)
            {
                array_push($faq_items_active, $faq_item_local);
            }
        }
        return view('admin.pages.sections.faq.faq_title_index', compact('detect', 'faq_title', 'faq_items_active'));
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
            return redirect()->route('admin.faq_title.index', "#$key")->withErrors($validator)->withInput();
        }

        $faq_title = new Faq();
        $faq_title->section_name = $request->section_name;
        $faq_title->title = $request->title;
        $faq_title->status = $request->status;
        $faq_title->save();

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
        $faq_title = Faq::findOrFail($id);

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
            return redirect()->route('admin.faq_title.index', "#$key")->withErrors($validator)->withInput();
        }

        $faq_title->section_name = $request->section_name;
        $faq_title->title = $request->title;
        $faq_title->status = $request->status;
        $faq_title->save();

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
