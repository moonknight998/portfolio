<?php

namespace App\Http\Controllers\Admin\Section\Testimonial;

use App\Http\Controllers\Controller;
use App\Models\TestimonialItem;
use App\Models\TestimonialTitle;
use Detection\MobileDetect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TestimonialTitleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $detect = new MobileDetect();
        $testimonial_title = TestimonialTitle::first();
        $testimonial_items = TestimonialItem::all();
        return view('admin.pages.sections.testimonial.testimonial_title_index', compact('detect', 'testimonial_title', 'testimonial_items'));
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
            return redirect()->route('admin.testimonial_title.index', "#$key")->withErrors($validator)->withInput();
        }

        $testimonial_title = new TestimonialTitle();
        $testimonial_title->section_name = $request->section_name;
        $testimonial_title->title = $request->title;
        $testimonial_title->status = $request->status;
        $testimonial_title->save();

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
            return redirect()->route('admin.testimonial_title.index', "#$key")->withErrors($validator)->withInput();
        }

        $testimonial_title = TestimonialTitle::findOrFail($id);
        $testimonial_title->section_name = $request->section_name;
        $testimonial_title->title = $request->title;
        $testimonial_title->status = $request->status;
        $testimonial_title->save();

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
