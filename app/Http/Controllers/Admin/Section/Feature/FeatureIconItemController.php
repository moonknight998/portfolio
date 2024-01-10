<?php

namespace App\Http\Controllers\Admin\Section\Feature;

use App\DataTables\FeatureIconItemDataTable;
use App\Http\Controllers\Controller;
use App\Models\FeatureIconItem;
use App\Models\FeatureIconTitle;
use Detection\MobileDetect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FeatureIconItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(FeatureIconItemDataTable $dataTable)
    {
        $feature_icon_title = FeatureIconTitle::first();
        if($feature_icon_title == null)
        {
            return redirect()->route('admin.feature_icon_title.index')->with('status', 'required');
        }
        return $dataTable->render('admin.pages.sections.feature.feature_icon_item_index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $detect = new MobileDetect();
        $feature_icon_items = FeatureIconItem::all();
        $feature_icon_title = FeatureIconTitle::first();
        return view('admin.pages.sections.feature.feature_icon_item_create', compact('detect', 'feature_icon_items', 'feature_icon_title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title'=> ['required','string','max:200'],
            'description'=> ['required','string','max:500'],
            'status' => ['required'],
        ]);

        if ($validator->fails()) {
            $key = '';
            foreach ($validator->errors()->getMessages() as $keyError => $messageError)
            {
                $key = $keyError;
                break;
            }
            return redirect()->route('admin.feature_icon_item.create', "#$key")->withErrors($validator)->withInput();
        }

        $feature_icon_item = new FeatureIconItem();
        $feature_icon_item->title = $request->title;
        $feature_icon_item->description = $request->description;
        $feature_icon_item->icon = $request->icon ? $request->icon : 'bi bi-check2-all';
        $feature_icon_item->status = $request->status;
        $feature_icon_item->save();

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
        $feature_icon_title = FeatureIconTitle::first();
        $feature_icon_items = FeatureIconItem::all();
        $feature_icon_item = FeatureIconItem::findOrFail($id);
        return view('admin.pages.sections.feature.feature_icon_item_edit', compact('detect', 'feature_icon_item', 'feature_icon_items', 'feature_icon_title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $feature_icon_item = FeatureIconItem::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'title'=> ['required','string','max:200'],
            'description'=> ['required','string','max:500'],
            'status' => ['required'],
        ]);

        if ($validator->fails()) {
            $key = '';
            foreach ($validator->errors()->getMessages() as $keyError => $messageError)
            {
                $key = $keyError;
                break;
            }
            return redirect()->route('admin.feature_icon_item.create', "#$key")->withErrors($validator)->withInput();
        }

        $feature_icon_item->title = $request->title;
        $feature_icon_item->description = $request->description;
        $feature_icon_item->icon = $request->icon ? $request->icon : 'bi bi-check2-all';
        $feature_icon_item->status = $request->status;
        $feature_icon_item->save();

        return redirect()->back()->with('status', 'updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $feature_icon_item = FeatureIconItem::findOrFail($id);
        if($feature_icon_item)
        {
            $feature_icon_item->delete();
        }
    }

    public function changeStatus(Request $request)
    {
        $feature_icon_item = FeatureIconItem::findOrFail($request->id);
        $feature_icon_item->status = $request->status == 'true' ? 1 : 0;
        $feature_icon_item->save();

        return response(['message' => 'Status has been updated']);
    }
}
