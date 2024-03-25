<?php

namespace App\Http\Controllers\Admin\Section\Contact;

use App\Http\Controllers\Controller;
use App\Models\ContactTitle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactTitleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contact_title = ContactTitle::first();
        return view('admin.pages.sections.contact.contact_title_index', compact('contact_title'));
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
            'title' => ['required','string','max:200'],
            'status' => ['required'], 
        ]);

        if ($validator->fails()) {
            $key = '';
            foreach ($validator->errors()->getMessages() as $keyError => $messageError)
            {
                $key = $keyError;
                break;
            }
            return redirect(url()->previous()."#$key")->withErrors($validator)->withInput();
        }

        $contact_title = new ContactTitle();
        $contact_title->section_name = $request->section_name;
        $contact_title->title = $request->title;
        $contact_title->status = $request->status;
        $contact_title->save();

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
        $contact_title = ContactTitle::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'section_name'=> ['required','string', 'max:200'],
            'title' => ['required','string','max:200'],
            'status' => ['required'], 
        ]);

        if ($validator->fails()) {
            $key = '';
            foreach ($validator->errors()->getMessages() as $keyError => $messageError)
            {
                $key = $keyError;
                break;
            }
            return redirect(url()->previous()."#$key")->withErrors($validator)->withInput();
        }

        $contact_title->section_name = $request->section_name;
        $contact_title->title = $request->title;
        $contact_title->status = $request->status;
        $contact_title->save();
        
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
