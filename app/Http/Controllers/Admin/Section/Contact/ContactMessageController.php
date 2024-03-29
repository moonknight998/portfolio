<?php

namespace App\Http\Controllers\Admin\Section\Contact;

use App\Enums\MessageStatusEnum;
use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ContactMessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contact_messages = ContactMessage::orderBy('created_at', 'desc')->get();
        $contact_messages_unread = ContactMessage::where('status', MessageStatusEnum::SENT->value)->get();
        return view('admin.pages.sections.contact.contact_message_item', compact('contact_messages', 'contact_messages_unread'));
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
            'name' => ['required', 'string', 'max:100'],
            'message_title' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:5000'],
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

        $contact_message = new ContactMessage();
        $contact_message->name = $request->name;
        $contact_message->email = $request->email;
        $contact_message->phone_number = $request->phone_number;
        $contact_message->message_title = $request->message_title;
        $contact_message->slug = Str::slug($request->message_title).'-'.time().'-'.Str::random(10);
        $contact_message->message = $request->message;
        $contact_message->status = MessageStatusEnum::SENT->value;
        $contact_message->save();

        return redirect(url()->previous()."#contact")->with('status', 'sent');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function messageDetails(Request $request)
    {
        $contact_message = ContactMessage::where('slug', $request->slug)->first();
        $contact_message->status = MessageStatusEnum::SEEN->value;
        $contact_message->save();
        return view('admin.pages.sections.contact.contact_message_details', compact('contact_message'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
