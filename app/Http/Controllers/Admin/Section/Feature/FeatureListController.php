<?php

namespace App\Http\Controllers\Admin\Section\Feature;

use App\DataTables\FeatureListDataTable;
use App\Http\Controllers\Controller;
use App\Models\FeatureList;
use App\Models\FeatureTitle;
use Detection\MobileDetect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class FeatureListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(FeatureListDataTable $dataTable)
    {
        $feature_title = FeatureTitle::first();
        if ($feature_title == null)
        {
            return redirect()->route('admin.feature_title.index')->with('status', 'required');
        }
        return $dataTable->render('admin.pages.sections.feature.feature_list_index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $detect = new MobileDetect();
        $feature_title = FeatureTitle::first();
        $feature_lists = FeatureList::all();
        return view('admin.pages.sections.feature.feature_list_create', compact('detect', 'feature_title', 'feature_lists'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => ['required','string','max:100'],
            'icon' => ['required'],
            'status' => ['required'],
        ]);

        if ($validator->fails()) {
            $key = '';
            foreach ($validator->errors()->getMessages() as $keyError => $messageError)
            {
                $key = $keyError;
                break;
            }
            return redirect()->route('admin.feature_list.create', "#$key")->withErrors($validator)->withInput();
        }

        $feature_list_item = new FeatureList();
        $feature_list_item->title = $request->title;
        $feature_list_item->icon = $request->icon;
        $feature_list_item->status = $request->status;
        $feature_list_item->save();

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
        $feature_title = FeatureTitle::first();
        $feature_lists = FeatureList::all();
        $feature_list_item = FeatureList::find($id);
        return view('admin.pages.sections.feature.feature_list_edit', compact('detect', 'feature_title', 'feature_lists', 'feature_list_item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $feature_list_item = FeatureList::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'title' => ['required','string','max:100'],
            'icon' => ['required'],
            'status' => ['required'],
        ]);

        if ($validator->fails()) {
            $key = '';
            foreach ($validator->errors()->getMessages() as $keyError => $messageError)
            {
                $key = $keyError;
                break;
            }
            return redirect()->route('admin.feature_list.update', "#$key")->withErrors($validator)->withInput();
        }

        $feature_list_item->title = $request->title;
        $feature_list_item->icon = $request->icon;
        $feature_list_item->status = $request->status;
        $feature_list_item->save();

        return redirect()->back()->with('status', 'updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $feature_list_item = FeatureList::findOrFail($id);
        if($feature_list_item){
            $feature_list_item->delete();
        }
    }

    public function changeStatus(Request $request)
    {
        $feature_list_item = FeatureList::findOrFail($request->id);
        $feature_list_item->status = $request->status == 'true' ? 1 : 0;
        $feature_list_item->save();

        return response(['message' => 'Status has been updated']);
    }
}
