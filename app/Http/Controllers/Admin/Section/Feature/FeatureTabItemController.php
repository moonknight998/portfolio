<?php

namespace App\Http\Controllers\Admin\Section\Feature;

use App\DataTables\FeatureTabItemDataTable;
use App\Http\Controllers\Controller;
use App\Models\FeatureTabItem;
use App\Models\FeatureTabTitle;
use Detection\MobileDetect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FeatureTabItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(FeatureTabItemDataTable $dataTable)
    {
        $feature_tab_title = FeatureTabTitle::first();
        if($feature_tab_title == null)
        {
            return redirect()->route('admin.feature_tab_title.index')->with('status','required');
        }

        $feature_tab_items = FeatureTabItem::all();
        $can_create_new = count($feature_tab_items) < $feature_tab_title->tab_quantity;

        return $dataTable->render('admin.pages.sections.feature.feature_tab_item_index', compact('can_create_new'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $detect = new MobileDetect();
        $feature_tab_items = FeatureTabItem::all();
        $feature_tab_title = FeatureTabTitle::first();
        return view('admin.pages.sections.feature.feature_tab_item_create', compact('detect', 'feature_tab_items', 'feature_tab_title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tab_name'=> ['required','string', 'max:100'],
            'tab_id' => ['required','string','max:10'],
            'first_description'=> ['required','string','max:500'],
            'first_title'=> ['required','string','max:200'],
            'second_description'=> ['required','string','max:500'],
            'second_title'=> ['required','string','max:200'],
            'third_description'=> ['required','string','max:500'],
            'status' => ['required'],
        ]);

        if ($validator->fails()) {
            $key = '';
            foreach ($validator->errors()->getMessages() as $keyError => $messageError)
            {
                $key = $keyError;
                break;
            }
            return redirect()->route('admin.feature_tab_item.create', "#$key")->withErrors($validator)->withInput();
        }

        $feature_tab_item = new FeatureTabItem();
        $feature_tab_item->tab_name = $request->tab_name;
        $feature_tab_item->tab_id = $request->tab_id;
        $feature_tab_item->first_description = $request->first_description;
        $feature_tab_item->first_title = $request->first_title;
        $feature_tab_item->second_description = $request->second_description;
        $feature_tab_item->second_title = $request->second_title;
        $feature_tab_item->third_description = $request->third_description;
        $feature_tab_item->status = $request->status;
        $feature_tab_item->save();

        $feature_tab_items = FeatureTabItem::all();
        $feature_tab_title = FeatureTabTitle::first();

        if (count($feature_tab_items) >= $feature_tab_title->tab_quantity)
        {
            return redirect()->route('admin.feature_tab_item.index');
        }

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
        $feature_tab_title = FeatureTabTitle::first();
        $feature_tab_items = FeatureTabItem::all();
        $feature_tab_item = FeatureTabItem::find($id);
        return view('admin.pages.sections.feature.feature_tab_item_edit', compact('detect', 'feature_tab_title', 'feature_tab_items', 'feature_tab_item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $feature_tab_item = FeatureTabItem::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'tab_name'=> ['required','string', 'max:100'],
            'tab_id' => ['required','string','max:10'],
            'first_description'=> ['required','string','max:500'],
            'first_title'=> ['required','string','max:200'],
            'second_description'=> ['required','string','max:500'],
            'second_title'=> ['required','string','max:200'],
            'third_description'=> ['required','string','max:500'],
            'status' => ['required'],
        ]);

        if ($validator->fails()) {
            $key = '';
            foreach ($validator->errors()->getMessages() as $keyError => $messageError)
            {
                $key = $keyError;
                break;
            }
            return redirect()->route('admin.feature_tab_item.edit', "#$key")->withErrors($validator)->withInput();
        }

        $feature_tab_item->tab_name = $request->tab_name;
        $feature_tab_item->tab_id = $request->tab_id;
        $feature_tab_item->first_description = $request->first_description;
        $feature_tab_item->first_title = $request->first_title;
        $feature_tab_item->second_description = $request->second_description;
        $feature_tab_item->second_title = $request->second_title;
        $feature_tab_item->third_description = $request->third_description;
        $feature_tab_item->status = $request->status;
        $feature_tab_item->save();

        return redirect()->back()->with('status', 'updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $feature_tab_item = FeatureTabItem::findOrFail($id);
        if($feature_tab_item){
            $feature_tab_item->delete();
        }
    }

    public function changeStatus(Request $request)
    {
        $feature_tab_item = FeatureTabItem::findOrFail($request->id);
        $feature_tab_item->status = $request->status == 'true' ? 1 : 0;
        $feature_tab_item->save();

        return response(['message' => 'Status has been updated']);
    }
}
