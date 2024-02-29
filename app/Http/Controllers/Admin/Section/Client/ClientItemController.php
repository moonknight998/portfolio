<?php

namespace App\Http\Controllers\Admin\Section\Client;

use App\DataTables\ClientItemDataTable;
use App\Http\Controllers\Controller;
use App\Models\ClientItem;
use App\Models\ClientTitle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class ClientItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ClientItemDataTable $dataTable)
    {
        $client_title = ClientTitle::first();
        if ($client_title == null)
        {
            return redirect()->route('admin.client_title.index')->with('status', 'required');
        }
        return $dataTable->render('admin.pages.sections.client.client_item_index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $client_title = ClientTitle::first();
        $client_items = ClientItem::all();
        return view('admin.pages.sections.client.client_item_create', compact('client_title', 'client_items'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $client_item = new ClientItem();

        $validator = Validator::make($request->all(), [
            'brand_name'=> ['required','string', 'max:200'],
            'logo' => ['mimes:jpeg,bmp,png', 'max:2048'], //2MB max
            'status' => ['required'],
        ]);

        if ($validator->fails()) {
            $key = '';
            foreach ($validator->errors()->getMessages() as $keyError => $messageError)
            {
                $key = $keyError;
                break;
            }
            return redirect()->route('admin.team_item.create', "#$key")->withErrors($validator)->withInput();
        }

        $logoPath = HandleUpload('logo', $client_item);

        $client_item->brand_name = $request->brand_name;
        $client_item->logo = isset($logoPath) ? $logoPath : asset('frontend/assets/img/clients/client-1.png');
        $client_item->status = $request->status;
        $client_item->save();

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
        $client_item = ClientItem::findOrFail($id);

        if($client_item){
            if(File::exists(public_path($client_item->logo)))
            {
                File::delete(public_path($client_item->logo));
            }
            $client_item->delete();
        }
    }

    public function changeStatus(Request $request)
    {
        $client_item = ClientItem::findOrFail($request->id);
        $client_item->status = $request->status == 'true' ? 1 : 0;
        $client_item->save();

        return response(['message' => 'Status has been updated']);
    }
}
