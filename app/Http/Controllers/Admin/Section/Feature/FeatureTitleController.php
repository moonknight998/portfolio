<?php

namespace App\Http\Controllers\Admin\Section\Feature;

use App\Http\Controllers\Controller;
use App\Models\FeatureList;
use App\Models\FeatureTitle;
use Detection\MobileDetect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class FeatureTitleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $detect = new MobileDetect();
        $feature_title = FeatureTitle::first();
        $feature_lists = FeatureList::all();
        return view('admin.pages.sections.feature.feature_title_index', compact("detect", "feature_title", "feature_lists"));
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
            return redirect()->route('admin.feature_title.index', "#$key")->withErrors($validator)->withInput();
        }

        if($request->hasFile('image')){
            $image = $request->file('image');
            $imageName = rand().$image->getClientOriginalName();
            $image->move(public_path('/uploads'), $imageName);

            $imagePath = "/uploads/".$imageName;
        }

        $feature_title = new FeatureTitle();
        $feature_title->section_name = $request->section_name;
        $feature_title->title = $request->title;
        $feature_title->image = isset($imagePath) ? $imagePath : '';
        $feature_title->status = $request->status;
        $feature_title->save();

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
        $feature_title = FeatureTitle::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'section_name'=> ['required','string', 'max:200'],
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
            return redirect()->route('admin.feature_title.index', "#$key")->withErrors($validator)->withInput();
        }

        if($request->hasFile('image')){
            if($feature_title && File::exists(public_path($feature_title->image))){
                File::delete(public_path($feature_title->image));
            }
            $image = $request->file('image');
            $imageName = rand().$image->getClientOriginalName();
            $image->move(public_path('/uploads'), $imageName);

            $imagePath = "/uploads/".$imageName;
        }

        $feature_title->section_name = $request->section_name;
        $feature_title->title = $request->title;
        $feature_title->image = isset($imagePath) ? $imagePath : '';
        $feature_title->status = $request->status;
        $feature_title->save();

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
