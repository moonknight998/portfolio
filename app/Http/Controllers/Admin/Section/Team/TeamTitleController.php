<?php

namespace App\Http\Controllers\Admin\Section\Team;

use App\Http\Controllers\Controller;
use App\Models\TeamItem;
use App\Models\TeamTitle;
use Detection\MobileDetect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TeamTitleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $detect = new MobileDetect();
        $team_title = TeamTitle::first();
        $team_items = TeamItem::all();
        return view('admin.pages.sections.team.team_title_index', compact('detect', 'team_title', 'team_items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

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
            return redirect()->route('admin.team_title.index', "#$key")->withErrors($validator)->withInput();
        }

        $team_title = new TeamTitle();
        $team_title->section_name = $request->section_name;
        $team_title->title = $request->title;
        $team_title->status = $request->status;
        $team_title->save();

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
            return redirect()->route('admin.team_title.index', "#$key")->withErrors($validator)->withInput();
        }

        $team_title = TeamTitle::findOrFail($id);
        $team_title->section_name = $request->section_name;
        $team_title->title = $request->title;
        $team_title->status = $request->status;
        $team_title->save();

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
