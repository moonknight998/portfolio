<?php

namespace App\Http\Controllers\Admin\Section\Blog;

use App\DataTables\BlogCategoryDataTable;
use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class BlogCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(BlogCategoryDataTable $dataTable)
    {
        $categories = BlogCategory::all();
        if (request()->is('api/*')) {
            $arr = [
                'status' => 'success',
                'message' => 'Get blog category data successfully!',
                'data' => count($categories) > 0 ? $categories : empty('No data found!'),
            ];
            return response()->json($arr, 200);
        }
        else {
            return $dataTable->render('admin.pages.sections.blog.blog_category_index');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.sections.blog.blog_category_create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_name'=> ['required', 'string', 'max:200',],
            'status' => ['required'],
        ]);

        if ($validator->fails()) {
            $key = '';
            foreach ($validator->errors()->getMessages() as $keyError => $messageError)
            {
                $key = $keyError;
                break;
            }
            return redirect()->route('admin.blog_category.create', "#$key")->withErrors($validator)->withInput();
        }

        $blog_category = new BlogCategory();
        $blog_category->category_name = $request->category_name;
        $blog_category->slug = Str::slug($request->category_name);
        $blog_category->status = $request->status;
        $blog_category->save();

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
        $blog_category = BlogCategory::findOrFail($id);
        return view('admin.pages.sections.blog.blog_category_edit', compact('blog_category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $blog_category = BlogCategory::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'category_name'=> ['required','string', 'max:200'],
            'status' => ['required'],
        ]);

        if ($validator->fails()) {
            $key = '';
            foreach ($validator->errors()->getMessages() as $keyError => $messageError)
            {
                $key = $keyError;
                break;
            }
            return redirect()->route('admin.blog_category.create', "#$key")->withErrors($validator)->withInput();
        }

        $blog_category->category_name = $request->category_name;
        $blog_category->slug = Str::slug($request->category_name);
        $blog_category->status = $request->status;
        $blog_category->save();

        return redirect()->back()->with('status', 'updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $blog_category = BlogCategory::findOrFail($id);
        if($blog_category)
        {
            $blog_category->delete();
        }
    }

    public function changeStatus(Request $request)
    {
        $blog_category = BlogCategory::findOrFail($request->id);
        $blog_category->status = $request->status == 'true' ? 1 : 0;
        $blog_category->save();

        return response(['message' => 'Status has been updated']);
    }
}
