<?php

namespace App\Http\Controllers\Admin\Section\Team;

use App\DataTables\TeamItemDataTable;
use App\Http\Controllers\Controller;
use App\Models\TeamItem;
use App\Models\TeamTitle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class TeamItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(TeamItemDataTable $dataTable)
    {
        $team_title = TeamTitle::first();
        if ($team_title == null)
        {
            return redirect()->route('admin.team_title.index')->with('status', 'required');
        }
        return $dataTable->render('admin.pages.sections.team.team_item_index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //Mobile detect moved to helpers.php
        $team_title = TeamTitle::first();
        $team_items = TeamItem::all();
        return view('admin.pages.sections.team.team_item_create', compact('team_title', 'team_items'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $team_item = new TeamItem();

        $validator = Validator::make($request->all(), [
            'name'=> ['required','string', 'max:200'],
            'work_title'=> ['required','string', 'max:200'],
            'description' => ['required', 'string', 'max:500'],
            'image' => ['mimes:jpeg,bmp,png', 'max:2048'], //2MB max
            'facebook_url' => ['url', 'max:250'],
            'instagram_url' => ['url', 'max:250'],
            'telegram_url' => ['url', 'max:250'],
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

        $imagePath = HandleUpload('image', $team_item);

        $team_item->name = $request->name;
        $team_item->work_title = $request->work_title;
        $team_item->description = $request->description;
        $team_item->image = isset($imagePath) ? $imagePath : asset('frontend/assets/img/team/team-1.jpg');
        $team_item->facebook_url = $request->facebook_url;
        $team_item->instagram_url = $request->instagram_url;
        $team_item->telegram_url = $request->telegram_url;
        $team_item->status = $request->status;
        $team_item->save();

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
        $team_title = TeamTitle::first();
        $team_item = TeamItem::findOrFail($id);
        $team_items = TeamItem::all();
        return view('admin.pages.sections.team.team_item_edit', compact('team_title', 'team_item', 'team_items'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $team_item = TeamItem::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name'=> ['required','string', 'max:200'],
            'work_title'=> ['required','string', 'max:200'],
            'description' => ['required', 'string', 'max:500'],
            'image' => ['mimes:jpeg,bmp,png', 'max:2048'], //2MB max
            'facebook_url' => ['url', 'max:250'],
            'instagram_url' => ['url', 'max:250'],
            'telegram_url' => ['url', 'max:250'],
            'status' => ['required'],
        ]);

        if ($validator->fails()) {
            $key = '';
            foreach ($validator->errors()->getMessages() as $keyError => $messageError)
            {
                $key = $keyError;
                break;
            }
            return redirect()->route('admin.team_item.edit', "#$key")->withErrors($validator)->withInput();
        }

        $imagePath = HandleUpload('image', $team_item);

        $team_item->name = $request->name;
        $team_item->work_title = $request->work_title;
        $team_item->description = $request->description;
        $team_item->image = isset($imagePath) ? $imagePath : $team_item->image;
        $team_item->facebook_url = $request->facebook_url;
        $team_item->instagram_url = $request->instagram_url;
        $team_item->telegram_url = $request->telegram_url;
        $team_item->status = $request->status;
        $team_item->save();

        return redirect()->back()->with('status', 'updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $team_item = TeamItem::findOrFail($id);

        if($team_item){
            if(File::exists(public_path($team_item->image)))
            {
                File::delete(public_path($team_item->image));
            }
            $team_item->delete();
        }
    }

    public function changeStatus(Request $request)
    {
        $team_item = TeamItem::findOrFail($request->id);
        $team_item->status = $request->status == 'true' ? 1 : 0;
        $team_item->save();

        return response(['message' => 'Status has been updated']);
    }
}
