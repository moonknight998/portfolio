<?php

namespace App\Http\Controllers\Admin\Section;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Detection\MobileDetect;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $detect = new MobileDetect();
        $about = About::first();

        if ($request->is('api/*'))
        {
            $arr = [
                'status' => 'success',
                'message' => 'Get about data successfully!',
                'data' => $about ? $about : 'Seem like there is no data yet!',
            ];
            return response()->json($arr, 200);
        }
        else
        {
            return view('admin.pages.sections.about.index', compact('about', 'detect'));
        }
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
            'question'=> ['required','string', 'max:200'],
            'title'=> ['required','string', 'max:500'],
            'summary' => ['required','string', 'max:1000'],
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
            return redirect()->route('admin.about.index', "#$key")->withErrors($validator)->withInput();
        }

        if($request->hasFile('image')){
            $image = $request->file('image');
            $imageName = rand().$image->getClientOriginalName();
            $image->move(public_path('/uploads'), $imageName);

            $imagePath = "/uploads/".$imageName;
        }

        $about = new About();
        $about->question = $request->question;
        $about->title = $request->title;
        $about->summary = $request->summary;
        $about->button_text = $request->button_text;
        $about->button_url = $request->button_url;
        $about->image = isset($imagePath) ? $imagePath : '';
        $about->status = $request->status;
        $about->save();
        
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
        $about = About::first();

        $validator = Validator::make($request->all(), [
            'question'=> ['required','string', 'max:200'],
            'title'=> ['required','string', 'max:500'],
            'summary' => ['required','string', 'max:1000'],
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
            return redirect()->route('admin.about.index', "#$key")->withErrors($validator)->withInput();
        }

        if($request->hasFile('image')){
            if($about && File::exists(public_path($about->image))){
                File::delete(public_path($about->image));
            }
            $image = $request->file('image');
            $imageName = rand().$image->getClientOriginalName();
            $image->move(public_path('/uploads'), $imageName);

            $imagePath = "/uploads/".$imageName;
        }

        About::updateOrCreate(
            ["id"=> $id],
            [
                'question' => $request->question,
                'title' => $request->title,
                'summary' => $request->summary,
                'button_text' => $request->button_text,
                'button_url' => $request->button_url,
                'image' => isset($imagePath) ? $imagePath : $about->image,
                'status' => $request->status,
            ]
        );

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
