<?php

namespace App\Http\Controllers\Admin\Section\Testimonial;

use App\DataTables\TestimonialItemDataTable;
use App\Http\Controllers\Controller;
use App\Models\TestimonialItem;
use App\Models\TestimonialTitle;
use Detection\MobileDetect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class TestimonialItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(TestimonialItemDataTable $dataTable)
    {
        $testimonial_title = TestimonialTitle::first();
        if ($testimonial_title == null)
        {
            return redirect()->route('admin.testimonial_title.index')->with('status', 'required');
        }
        return $dataTable->render('admin.pages.sections.testimonial.testimonial_item_index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $detect = new MobileDetect();
        $testimonial_title = TestimonialTitle::first();
        $testimonial_items = TestimonialItem::all();
        return view('admin.pages.sections.testimonial.testimonial_item_create', compact('detect', 'testimonial_title', 'testimonial_items'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $testimonial_item = new TestimonialItem();

        $validator = Validator::make($request->all(), [
            'name'=> ['required','string', 'max:200'],
            'career'=> ['required','string', 'max:500'],
            'image' => ['mimes:jpeg,bmp,png', 'max:2048'], //2MB max
            'rated' => ['required', 'numeric'],
            'feedback' => ['required', 'string', 'max:1500'],
            'status' => ['required'],
        ]);

        if ($validator->fails()) {
            $key = '';
            foreach ($validator->errors()->getMessages() as $keyError => $messageError)
            {
                $key = $keyError;
                break;
            }
            return redirect()->route('admin.testimonial_item.create', "#$key")->withErrors($validator)->withInput();
        }

        if($request->hasFile('image')){
            $image = $request->file('image');
            $imageName = rand().$image->getClientOriginalName();
            $image->move(public_path('/uploads'), $imageName);

            $imagePath = "/uploads/".$imageName;
        }

        $testimonial_item->name = $request->name;
        $testimonial_item->career = $request->career;
        $testimonial_item->image = isset($imagePath) ? $imagePath : asset('frontend/assets/img/testimonials/testimonials-2.jpg');
        $testimonial_item->rated = $request->rated;
        $testimonial_item->feedback = $request->feedback;
        $testimonial_item->status = $request->status;
        $testimonial_item->save();

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
        $testimonial_title = TestimonialTitle::first();
        $testimonial_items = TestimonialItem::all();
        $testimonial_item = TestimonialItem::findOrFail($id);
        return view('admin.pages.sections.testimonial.testimonial_item_edit', compact('detect', 'testimonial_title', 'testimonial_items', 'testimonial_item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $testimonial_item = TestimonialItem::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name'=> ['required','string', 'max:200'],
            'career'=> ['required','string', 'max:500'],
            'image' => ['mimes:jpeg,bmp,png', 'max:2048'], //2MB max
            'rated' => ['required', 'numeric'],
            'feedback' => ['required', 'string', 'max:1500'],
            'status' => ['required'],
        ]);

        if ($validator->fails()) {
            $key = '';
            foreach ($validator->errors()->getMessages() as $keyError => $messageError)
            {
                $key = $keyError;
                break;
            }
            return redirect()->route('admin.testimonial_item.edit', "#$key")->withErrors($validator)->withInput();
        }

        if($request->hasFile('image'))
        {
            if(File::exists(public_path($testimonial_item->image)))
            {
                File::delete(public_path($testimonial_item->image));
            }

            $image = $request->file('image');
            $imageName = rand().$image->getClientOriginalName();
            $image->move(public_path('/uploads'), $imageName);

            $imagePath = "/uploads/".$imageName;
        }

        $testimonial_item->name = $request->name;
        $testimonial_item->career = $request->career;
        $testimonial_item->image = isset($imagePath) ? $imagePath : asset('frontend/assets/img/testimonials/testimonials-2.jpg');
        $testimonial_item->rated = $request->rated;
        $testimonial_item->feedback = $request->feedback;
        $testimonial_item->status = $request->status;
        $testimonial_item->save();

        return redirect()->back()->with('status', 'updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $testimonial_item = TestimonialItem::findOrFail($id);

        if($testimonial_item){
            if(File::exists(public_path($testimonial_item->image)))
            {
                File::delete(public_path($testimonial_item->image));
            }
            $testimonial_item->delete();
        }
    }

    public function changeStatus(Request $request)
    {
        $testimonial_item = TestimonialItem::findOrFail($request->id);
        $testimonial_item->status = $request->status == 'true' ? 1 : 0;
        $testimonial_item->save();

        return response(['message' => 'Status has been updated']);
    }
}
