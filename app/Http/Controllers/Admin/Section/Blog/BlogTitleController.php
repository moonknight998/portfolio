<?php

namespace App\Http\Controllers\Admin\Section\Blog;

use App\Http\Controllers\Controller;
use App\Models\BlogTitle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BlogTitleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blog_title = BlogTitle::first();
        return view('admin.pages.sections.blog.blog_title_index', compact('blog_title'));
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
            return redirect()->route('admin.blog_title.index', "#$key")->withErrors($validator)->withInput();
        }

        $blog_title = new BlogTitle();
        $blog_title->section_name = $request->section_name;
        $blog_title->title = $request->title;
        $blog_title->status = $request->status;
        $blog_title->save();

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
        $blog_title = BlogTitle::findOrFail($id);
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
            return redirect()->route('admin.blog_title.index', "#$key")->withErrors($validator)->withInput();
        }

        $blog_title->section_name = $request->section_name;
        $blog_title->title = $request->title;
        $blog_title->status = $request->status;
        $blog_title->save();

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
