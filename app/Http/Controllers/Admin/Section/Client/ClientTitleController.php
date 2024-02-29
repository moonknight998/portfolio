<?php

namespace App\Http\Controllers\Admin\Section\Client;

use App\Http\Controllers\Controller;
use App\Models\ClientItem;
use App\Models\ClientTitle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClientTitleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $client_title = ClientTitle::first();
        $client_items = ClientItem::all();
        return view('admin.pages.sections.client.client_title_index', compact('client_title', 'client_items'));
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
            return redirect()->route('admin.client_title.index', "#$key")->withErrors($validator)->withInput();
        }

        $client_title = new ClientTitle();
        $client_title->section_name = $request->section_name;
        $client_title->title = $request->title;
        $client_title->status = $request->status;
        $client_title->save();

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
        $client_title = ClientTitle::findOrFail($id);

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
            return redirect()->route('admin.client_title.index', "#$key")->withErrors($validator)->withInput();
        }

        $client_title->section_name = $request->section_name;
        $client_title->title = $request->title;
        $client_title->status = $request->status;
        $client_title->save();

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
