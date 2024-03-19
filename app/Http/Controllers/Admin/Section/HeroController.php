<?php

namespace App\Http\Controllers\Admin\Section;

use App\Http\Controllers\Controller;
use App\Models\Hero;
use Detection\MobileDetect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class HeroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $detect = new MobileDetect();
        $hero = Hero::first();
        if (request()->is('api/*')) {
            $arr = [
                'status' => 'success',
                'message' => 'Get hero section data successfully!',
                'data' => isset($hero) ? $hero : empty('No data yet!'),
            ];
            return response()->json($arr, 200);
        }
        return view('admin.pages.sections.hero.index', compact('hero', 'detect'));
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
            'slogan'=> ['required','string', 'max:200'],
            'short_description'=> ['required','string', 'max:500'],
            'button_text'=> ['required','string','max:100'],
            'image' => ['mimes:jpeg,bmp,png', 'max:2048'], //2MB max
            'status' => ['required'],
        ]);

        if ($validator->fails()) {
            $key = '';
            foreach ($validator->errors()->getMessages() as $keyError => $messageError)
            {
                $key = $keyError;
                break;
            }
            return redirect()->route('admin.hero.index', "#$key")->withErrors($validator)->withInput();
        }

        if($request->hasFile('image')){
            $image = $request->file('image');
            $imageName = rand().$image->getClientOriginalName();
            $image->move(public_path('/uploads'), $imageName);

            $imagePath = "/uploads/".$imageName;
        }

        $hero = new Hero();
        $hero->slogan = $request->slogan;
        $hero->short_description = $request->short_description;
        $hero->button_text = $request->button_text;
        $hero->button_url = $request->button_url;
        $hero->image = isset($imagePath) ? $imagePath : '';
        $hero->status = $request->status;
        $hero->save();

        return redirect()->back()->with('status','updated');
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
        $hero = Hero::first();

        $validator = Validator::make($request->all(), [
            'slogan'=> ['required','string', 'max:200'],
            'short_description'=> ['required','string', 'max:500'],
            'button_text'=> ['required','string','max:100'],
            'image' => ['mimes:jpeg,bmp,png', 'max:2048'], //2MB max
            'status' => ['required'],
        ]);

        if ($validator->fails()) {
            $key = '';
            foreach ($validator->errors()->getMessages() as $keyError => $messageError)
            {
                $key = $keyError;
                break;
            }
            return redirect()->route('admin.hero.index', "#$key")->withErrors($validator)->withInput();
        }

        if($request->hasFile('image')){
            if($hero && File::exists(public_path($hero->image))){
                File::delete(public_path($hero->image));
            }
            $image = $request->file('image');
            $imageName = rand().$image->getClientOriginalName();
            $image->move(public_path('/uploads'), $imageName);

            $imagePath = "/uploads/".$imageName;
        }

        Hero::updateOrCreate(
            ["id"=> $id],
            [
                'slogan' => $request->slogan,
                'short_description' => $request->short_description,
                'button_text' => $request->button_text,
                'button_url' => $request->button_url,
                'image' => isset($imagePath) ? $imagePath : $hero->image,
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
