<?php

namespace App\Http\Controllers\Admin\Section\Faq;

use App\DataTables\FaqItemDataTable;
use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\FaqItem;
use Detection\MobileDetect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class FaqItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(FaqItemDataTable $dataTable)
    {
        $faq_title = Faq::first();
        if ($faq_title == null)
        {
            return redirect()->route('admin.faq_title.index')->with('status', 'required');
        }
        return $dataTable->render('admin.pages.sections.faq.faq_item_index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
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

        return view('admin.pages.sections.faq.faq_item_create', compact('detect', 'faq_title', 'faq_items_active'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $faq_item = new FaqItem();

        $validator = Validator::make($request->all(), [
            'question'=> ['required','string', 'max:500'],
            'answer'=> ['required','string', 'max:1000'],
            'status' => ['required'],
        ]);

        if ($validator->fails()) {
            $key = '';
            foreach ($validator->errors()->getMessages() as $keyError => $messageError)
            {
                $key = $keyError;
                break;
            }
            return redirect()->route('admin.faq_item.create', "#$key")->withErrors($validator)->withInput();
        }

        $faq_item->question = $request->question;
        $faq_item->answer = $request->answer;
        $faq_item->status = $request->status;
        $faq_item->save();

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

        $faq_item = FaqItem::findOrFail($id);

        return view('admin.pages.sections.faq.faq_item_edit', compact('detect', 'faq_title', 'faq_items_active', 'faq_item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $faq_item = FaqItem::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'question'=> ['required','string', 'max:500'],
            'answer'=> ['required','string', 'max:1000'],
            'status' => ['required'],
        ]);

        if ($validator->fails()) {
            $key = '';
            foreach ($validator->errors()->getMessages() as $keyError => $messageError)
            {
                $key = $keyError;
                break;
            }
            return redirect()->route('admin.faq_item.create', "#$key")->withErrors($validator)->withInput();
        }

        $faq_item->question = $request->question;
        $faq_item->answer = $request->answer;
        $faq_item->status = $request->status;
        $faq_item->save();

        return redirect()->back()->with('status', 'updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $faq_item = FaqItem::findOrFail($id);
        if($faq_item){
            if(File::exists(public_path($faq_item->image)))
            {
                File::delete(public_path($faq_item->image));
            }
            $faq_item->delete();
        }
    }

    public function changeStatus(Request $request)
    {
        $faq_item = FaqItem::findOrFail($request->id);
        $faq_item->status = $request->status == 'true' ? 1 : 0;
        $faq_item->save();

        return response(['message' => 'Status has been updated']);
    }
}
