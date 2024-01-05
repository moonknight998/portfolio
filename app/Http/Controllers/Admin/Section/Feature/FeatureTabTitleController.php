<?php

namespace App\Http\Controllers\Admin\Section\Feature;

use App\Http\Controllers\Controller;
use App\Models\FeatureTabTitle;
use Detection\MobileDetect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class FeatureTabTitleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $detect = new MobileDetect();
        $feature_tab_title = FeatureTabTitle::first();
        return view('admin.pages.sections.feature.feature_tab_title_index', compact('detect', 'feature_tab_title'));
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
            'title'=> ['required','string', 'max:500'],
            'image' => ['mimes:jpeg,bmp,png', 'max:4096'], //4MB max
            'status' => ['required'],
        ]);

        if ($validator->fails()) {
            $key = '';
            foreach ($validator->errors()->getMessages() as $keyError => $messageError)
            {
                $key = $keyError;
                break;
            }
            return redirect()->route('admin.feature_tab_title.index', "#$key")->withErrors($validator)->withInput();
        }

        if($request->hasFile('image')){
            $image = $request->file('image');
            $imageName = rand().$image->getClientOriginalName();
            $image->move(public_path('/uploads'), $imageName);

            $imagePath = "/uploads/".$imageName;
        }

        $feature_tab_title = new FeatureTabTitle();
        $feature_tab_title->title = $request->title;
        $feature_tab_title->image = isset($imagePath) ? $imagePath : '';
        $feature_tab_title->tab_quantity = $request->tab_quantity;
        $feature_tab_title->status = $request->status;
        $feature_tab_title->save();

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
        $feature_tab_title = FeatureTabTitle::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'title'=> ['required','string', 'max:500'],
            'image' => ['mimes:jpeg,bmp,png', 'max:4096'], //4MB max
            'status' => ['required'],
        ]);

        if ($validator->fails()) {
            $key = '';
            foreach ($validator->errors()->getMessages() as $keyError => $messageError)
            {
                $key = $keyError;
                break;
            }
            return redirect()->route('admin.feature_tab_title.index', "#$key")->withErrors($validator)->withInput();
        }

        if($request->hasFile('image')){
            if($feature_tab_title && File::exists(public_path($feature_tab_title->image))){
                File::delete(public_path($feature_tab_title->image));
            }
            $image = $request->file('image');
            $imageName = rand().$image->getClientOriginalName();
            $image->move(public_path('/uploads'), $imageName);

            $imagePath = "/uploads/".$imageName;
        }

        $feature_tab_title->title = $request->title;
        $feature_tab_title->image = isset($imagePath) ? $imagePath : '';
        $feature_tab_title->tab_quantity = $request->tab_quantity;
        $feature_tab_title->status = $request->status;
        $feature_tab_title->save();

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
