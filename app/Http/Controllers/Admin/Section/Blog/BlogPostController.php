<?php

namespace App\Http\Controllers\Admin\Section\Blog;

use App\DataTables\BlogPostDataTable;
use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BlogPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(BlogPostDataTable $dataTable)
    {
        return $dataTable->render('admin.pages.sections.blog.blog_post_index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $blog_categories = BlogCategory::all();
        return view('admin.pages.sections.blog.blog_post_create', compact('blog_categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $blog_post = new BlogPost();

        $validator = Validator::make($request->all(), [
            'title'=> ['required', 'string', 'max:250',],
            'thumbnail' => ['required', 'mimes:jpg,jpeg,png', 'max:2048'],
            'post_content' => ['required'],
            'category_id' => [
                // The field is required
                'required',
                // The field must be a number
                'numeric',
                // The field value must exist in the blog_categories table under the id column
                'exists:blog_categories,id'
            ],
            'post_author' => ['required', 'string', 'max:250'],
            'status' => ['required'],
        ]);

        if ($validator->fails()) {
            $key = '';
            foreach ($validator->errors()->getMessages() as $keyError => $messageError)
            {
                $key = $keyError;
                break;
            }
            return redirect()->route('admin.blog_post.create', "#$key")->withErrors($validator)->withInput();
        }

        $post_content = $request->post_content;

        // Create a new DOMDocument object
        $dom = new \DOMDocument();

        // Load HTML content from the request into the DOMDocument object, with specific options
        $dom->loadHtml($post_content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

        // Get all the 'img' elements from the loaded HTML
        $images = $dom->getElementsByTagName('img');

        // Iterate through each image element
        foreach ($images as $item => $image) {
            // Get the 'src' attribute value of the image
            $data = $image->getAttribute('src');

            // Check if the 'src' attribute value starts with 'data:image'
            if (strpos($data, 'data:image') === 0) {
                // Split the 'data' part from the 'data:image' format
                list($type, $data) = explode(';', $data);
                list(, $data) = explode(',', $data);

                // Decode the base64 encoded data
                $data = base64_decode($data);

                // Generate a unique image name and path
                $image_name= "/upload/".time().$item.'.png';
                $path = public_path().$image_name;

                // Save the decoded data to the specified path
                file_put_contents($path, $data);

                // Remove the 'src' attribute from the image
                $image->removeAttribute('src');

                // Set the 'src' attribute to the new image path
                $image->setAttribute('src', $image_name);
            }
        }

        $post_content = $dom->saveHTML();

        $thumbnailPath = HandleUpload('thumbnail', $blog_post);

        $blog_post->title = $request->title;
        $blog_post->thumbnail = $thumbnailPath;
        $blog_post->post_content = $post_content;
        $blog_post->category_id = $request->category_id;
        $blog_post->post_author = $request->post_author;
        $blog_post->status = $request->status;
        $blog_post->save();

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
        //
    }
}
