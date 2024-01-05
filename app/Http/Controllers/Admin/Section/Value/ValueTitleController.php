<?php

namespace App\Http\Controllers\Admin\Section\Value;

use App\Http\Controllers\Controller;
use App\Models\ValueCard;
use App\Models\ValueTitle;
use Detection\MobileDetect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ValueTitleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $detect = new MobileDetect();
        $value_title = ValueTitle::first();
        $value_cards = ValueCard::all();
        return view('admin.pages.sections.value.value_title_index', compact('value_title', 'detect', 'value_cards'));
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
            'section_name'=> ['required','string', 'max:100'],
            'title' => ['required','string','max:400'],
        ]);

        if ($validator->fails()) {
            $key = '';
            foreach ($validator->errors()->getMessages() as $keyError => $messageError)
            {
                $key = $keyError;
                break;
            }
            return redirect()->route('admin.value_title.index', "#$key")->withErrors($validator)->withInput();
        }

        $value_title = new ValueTitle();
        $value_title->section_name = $request->section_name;
        $value_title->title = $request->title;
        $value_title->status = $request->status;
        $value_title->save();

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
        $value_title = ValueTitle::find($id);
        $validator = Validator::make($request->all(), [
            'section_name'=> ['required','string', 'max:100'],
            'title' => ['required','string','max:400'],
        ]);

        if ($validator->fails()) {
            $key = '';
            foreach ($validator->errors()->getMessages() as $keyError => $messageError)
            {
                $key = $keyError;
                break;
            }
            return redirect()->route('admin.value_title.index', "#$key")->withErrors($validator)->withInput();
        }

        $value_title::updateOrCreate(
            ["id"=> $id],
            [
                'section_name' => $request->section_name,
                'title' => $request->title,
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
