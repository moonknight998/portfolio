<?php

namespace App\Http\Controllers\Admin\Section\Service;

use App\DataTables\ServiceItemDataTable;
use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ServiceItem;
use Detection\MobileDetect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use function Termwind\render;

class ServiceItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ServiceItemDataTable $dataTable)
    {
        $service_title = Service::first();
        if ($service_title == null)
        {
            return redirect()->route('admin.service_title.index')->with('status', 'required');
        }
        return $dataTable->render('admin.pages.sections.service.service_item_index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $detect = new MobileDetect();
        $service_title = Service::first();
        $service_items = ServiceItem::all();
        return view('admin.pages.sections.service.service_item_create', compact('detect', 'service_title', 'service_items'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $service_item = new ServiceItem();

        $validator = Validator::make($request->all(), [
            'title'=> ['required','string', 'max:200'],
            'description'=> ['required','string', 'max:500'],
            'icon'=> ['required', 'string', 'max:100'],
            'button_text'=> ['required', 'string', 'max:100'],
            'button_url'=> ['required', 'url', 'max:500'],
            'main_color'=> ['required', 'string', 'max:100'],
            'extra_color'=> ['required', 'string', 'max:100'],
            'status' => ['required'],
        ]);

        if ($validator->fails()) {
            $key = '';
            foreach ($validator->errors()->getMessages() as $keyError => $messageError)
            {
                $key = $keyError;
                break;
            }
            return redirect()->route('admin.service_item.create', "#$key")->withErrors($validator)->withInput();
        }

        $service_item->title = $request->title;
        $service_item->description = $request->description;
        $service_item->icon = $request->icon;
        $service_item->button_text = $request->button_text;
        $service_item->button_url = $request->button_url;
        $service_item->main_color = $request->main_color;
        $service_item->extra_color = $request->extra_color;
        $service_item->status = $request->status;
        $service_item->save();

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
        $service_title = Service::first();
        $service_item = ServiceItem::findOrFail($id);
        $service_items = ServiceItem::all();
        return view('admin.pages.sections.service.service_item_edit', compact('detect', 'service_title', 'service_item', 'service_items'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $service_item = ServiceItem::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'title'=> ['required','string', 'max:200'],
            'description'=> ['required','string', 'max:500'],
            'icon'=> ['required', 'string', 'max:100'],
            'button_text'=> ['required', 'string', 'max:100'],
            'button_url'=> ['required', 'url', 'max:500'],
            'main_color'=> ['required', 'string', 'max:100'],
            'extra_color'=> ['required', 'string', 'max:100'],
            'status' => ['required'],
        ]);

        if ($validator->fails()) {
            $key = '';
            foreach ($validator->errors()->getMessages() as $keyError => $messageError)
            {
                $key = $keyError;
                break;
            }
            return redirect()->route('admin.service_item.edit', "#$key")->withErrors($validator)->withInput();
        }

        $service_item->title = $request->title;
        $service_item->description = $request->description;
        $service_item->icon = $request->icon;
        $service_item->button_text = $request->button_text;
        $service_item->button_url = $request->button_url;
        $service_item->main_color = $request->main_color;
        $service_item->extra_color = $request->extra_color;
        $service_item->status = $request->status;
        $service_item->save();

        return redirect()->back()->with('status', 'updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $service_item = ServiceItem::findOrFail($id);
        if($service_item){
            $service_item->delete();
        }
    }

    public function changeStatus(Request $request)
    {
        $service_item = ServiceItem::findOrFail($request->id);
        $service_item->status = $request->status == 'true' ? 1 : 0;
        $service_item->save();

        return response(['message' => 'Status has been updated']);
    }
}
