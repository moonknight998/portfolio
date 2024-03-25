<?php

namespace App\Http\Controllers\Admin\Section\Contact;

use App\Http\Controllers\Controller;
use App\Models\ContactItem;
use App\Models\ContactTitle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contact_title = ContactTitle::first();
        if($contact_title == null){
            return redirect()->route('admin.contact_title.index')->with('status', 'required');
        }

        $contact_items = ContactItem::all();
        return view('admin.pages.sections.contact.contact_item_index', compact('contact_items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $contact_title = ContactTitle::first();
        if($contact_title == null){
            return redirect()->route('admin.contact_title.index')->with('status', 'required');
        }

        $contact_items = ContactItem::all();
        return view('admin.pages.sections.contact.contact_item_create', compact('contact_title', 'contact_items'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => ['required', 'string', 'max:255'],
            'first_line' => ['required', 'string'],
            'second_line' => ['required', 'string'],
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
            return redirect(url()->previous()."#$key")->withErrors($validator)->withInput();
        }

        $contact_item = new ContactItem();
        $contact_item->title = $request->title;
        $contact_item->first_line = $request->first_line;
        $contact_item->second_line = $request->second_line;
        $contact_item->icon = $request->icon;
        $contact_item->status = $request->status;
        $contact_item->save();
        
        return redirect()->route('admin.contact_item.create')->with('status', 'created');
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
        $contact_title = ContactTitle::first();
        $contact_items = ContactItem::all();
        $contact_item = ContactItem::findOrFail($id);
        return view('admin.pages.sections.contact.contact_item_edit', compact('contact_title', 'contact_items', 'contact_item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
        $contact_item = ContactItem::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'title' => ['required', 'string', 'max:255'],
            'first_line' => ['required', 'string'],
            'second_line' => ['required', 'string'],
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
            return redirect(url()->previous()."#$key")->withErrors($validator)->withInput();
        }

        $contact_item->title = $request->title;
        $contact_item->first_line = $request->first_line;
        $contact_item->second_line = $request->second_line;
        $contact_item->icon = $request->icon;
        $contact_item->status = $request->status;
        $contact_item->save();

        return redirect()->back()->with('status', 'updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $contact_item = ContactItem::findOrFail($id);
        $contact_item->delete();
    }

    public function changeStatus(Request $request)
    {
        $contact_item = ContactItem::findOrFail($request->id);
        $contact_item->status = $request->status == 'true' ? 1 : 0;
        $contact_item->save();

        return response(['message' => 'Status has been updated']);
    }
}
