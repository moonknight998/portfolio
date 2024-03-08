<?php

namespace App\Http\Controllers\Admin\Section\Blog;

use App\DataTables\BlogPostDataTable;
use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
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
        $validator = Validator::make($request->all(), [
            'post_title'=> ['required', 'string',],
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
            return redirect()->route('blog.blog_post.create', "#$key")->withErrors($validator)->withInput();
        }

        $blog_post = new BlogPost();

        $thumbnailPath = HandleUpload('thumbnail', $blog_post);

        // Get the post content from the request
        $post_content = $request->post_content;

        // Create a new DOMDocument and load the post content
        $dom = new \DOMDocument();
        $dom->loadHTML('<meta charset="utf8">'.$post_content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD | LIBXML_NOERROR | LIBXML_NOWARNING);

        // Get all image elements from the DOM
        $image_elements = $dom->getElementsByTagName('img');

        // Iterate through each image element
        foreach ($image_elements as $image_element)
        {
            // Get the source and data-filename attributes
            $src = $image_element->getAttribute('src');

            // Extract the base64 image data
            if(strpos($src, ';') !== false) // Check if the ';' character exists in the $src string
            {
                list($data_type, $src) = explode(';', $src); // Explode the $src string by the ';' delimiter and assign the first part to $type and the second part to $src
                list(, $type) = explode('/', $data_type); // Explode the string by '/' and assign the second part to $type
                list(, $src) = explode(',', $src); // Explode the string by comma and assign the second element to $src
                $image_scr = base64_decode($src); // Decode the base64 encoded image source

                // Generate a unique image name and path
                $image_name = '/uploads/blogs/'.date("H_i_s").'_'.date('d_m_Y').'_'.uniqid().'.'.$type;
                $image_path = public_path($image_name);

                // Save the image to the specified path
                file_put_contents($image_path, $image_scr);

                // Remove the src attribute and set it to the new image path
                $image_element->removeAttribute('src');
                $image_element->setAttribute('src', $image_name);
                $src = $image_element->getAttribute('src');
            }
        }

        // Save the modified HTML content
        $post_content = $dom->saveXML($dom->documentElement, LIBXML_NOEMPTYTAG);

        $blog_post->post_title = $request->post_title;
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
        $blog_categories = BlogCategory::all();
        $blog_post = BlogPost::findOrFail($id);
        return view('admin.pages.sections.blog.blog_post_edit', compact('blog_categories', 'blog_post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $blog_post = BlogPost::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'post_title'=> ['required', 'string',],
            // 'thumbnail' => ['required', 'mimes:jpg,jpeg,png', 'max:2048'],
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
            return redirect()->route('blog.blog_post.edit', "#$key")->withErrors($validator)->withInput();
        }


        $thumbnailPath = HandleUpload('thumbnail', $blog_post);

        // Retrieve the post content from the $blog_post object
        $post_content_present = $blog_post->post_content;

        // Create a new DOMDocument object
        $dom_present = new \DOMDocument();

        // Load HTML content into the DOMDocument object with specified options
        $dom_present->loadHTML($post_content_present, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD | LIBXML_NOERROR | LIBXML_NOWARNING);

        // Get all image elements present in the DOM
        $image_elements_present = $dom_present->getElementsByTagName('img');
        // Initialize an empty array to store the paths of the present images
        $image_paths_present = array();

        foreach ($image_elements_present as $image_element_present)
        {
            // Get the 'src' attribute of the image element and add it to the $image_paths_present array
            $image_paths_present[] = $image_element_present->getAttribute('src');
        }
        // Initialize an empty array to hold the image paths to delete
        $image_paths_to_delete = array();

        // Get the post content from the request
        $post_content_to_update = $request->post_content;

        // Create a new DOMDocument and load the post content
        $dom_to_update = new \DOMDocument();

        // Load HTML content into the DOMDocument object with specified options
        $dom_to_update->loadHTML('<meta charset="utf8">'.$post_content_to_update, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD | LIBXML_NOERROR | LIBXML_NOWARNING);

        // Get all image elements from the DOM
        $image_elements = $dom_to_update->getElementsByTagName('img');

        // Iterate through each image element
        foreach ($image_elements as $image_element)
        {
            // Get the source attribute
            $src = $image_element->getAttribute('src');

            // Extract the base64 image data
            if(strpos($src, ';') !== false) // Check if the ';' character exists in the $src string
            {
                list($data_type, $src) = explode(';', $src); // Explode the $src string by the ';' delimiter and assign the first part to $type and the second part to $src
                list(, $type) = explode('/', $data_type); // Explode the string by '/' and assign the second part to $type
                list(, $src) = explode(',', $src); // Explode the string by comma and assign the second element to $src
                $image_scr = base64_decode($src); // Decode the base64 encoded image source

                // Generate a unique image name and path
                $image_name = '/uploads/blogs/'.date("H_i_s").'_'.date('d_m_Y').'_'.uniqid().'.'.$type;
                $image_path = public_path($image_name);

                // Save the image to the specified path
                file_put_contents($image_path, $image_scr);

                // Remove the src attribute and set it to the new image path
                $image_element->removeAttribute('src');
                $image_element->setAttribute('src', $image_name);
                $src = $image_element->getAttribute('src');
            }
        }

        // Save the modified HTML content
        $post_content_to_update = $dom_to_update->saveXML($dom_to_update->documentElement, LIBXML_NOEMPTYTAG);

        // Get all image elements after conversion
        $image_elements_after_convert = $dom_to_update->getElementsByTagName('img');

        //Define an empty array to store source paths
        $src_path = array();

        // Iterate through each image element after conversion
        foreach ($image_elements_after_convert as $image_element_after_convert)
        {
            // Get the 'src' attribute of the image element and add it to the src_path array
            $src_path[] = $image_element_after_convert->getAttribute('src');
        }

        // Iterate through the array of image paths present
        foreach ($image_paths_present as $image_path_present)
        {
            // Check if the image element's src attribute is not present in the array of image paths
            if(!in_array($image_path_present, $src_path))
            {
                // If not present, add the image path to the array of paths to delete
                $image_paths_to_delete[] = $image_path_present;
            }
        }

        // Iterate through the array of image paths to delete
        foreach ($image_paths_to_delete as $image_path_to_delete)
        {
            // Check if the file exists
            if(File::exists(public_path($image_path_to_delete)))
            {
                // If the file exists, delete it
                File::delete(public_path($image_path_to_delete));
            }
        }

        $blog_post->post_title = $request->post_title;
        $blog_post->thumbnail = isset($thumbnailPath) ? $thumbnailPath : $blog_post->thumbnail;
        $blog_post->post_content = $post_content_to_update;
        $blog_post->category_id = $request->category_id;
        $blog_post->post_author = $request->post_author;
        $blog_post->status = $request->status;
        $blog_post->save();

        return redirect()->back()->with('status', 'updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the blog post by its ID
        $blog_post = BlogPost::findOrFail($id);
        $blog_post->delete();
        dd($blog_post);

        // // Check if the thumbnail file exists and delete it if it does
        // if(File::exists(public_path($blog_post->thumbnail)))
        // {
        //     File::delete(public_path($blog_post->thumbnail));
        // }

        // // Load the post content into a DOMDocument
        // $dom = new \DOMDocument();
        // $dom->loadHTML($blog_post->post_content);

        // // Get all image elements from the post content
        // $image_elements = $dom->getElementsByTagName('img');
        // $image_paths = array();

        // // Extract the src attribute from each image element and store it in the image_paths array
        // foreach ($image_elements as $image_element)
        // {
        //     $image_paths[] = $image_element->getAttribute('src');
        // }

        // // Iterate through the image paths and delete the files if they exist
        // foreach ($image_paths as $image_path)
        // {
        //     if(File::exists(public_path($image_path)))
        //     {
        //         File::delete(public_path($image_path));
        //     }
        // }

        // // Delete the blog post
        // $blog_post->delete();
    }

    public function changeStatus(Request $request)
    {
        $blog_post = BlogPost::findOrFail($request->id);
        $blog_post->status = $request->status == 'true' ? 1 : 0;
        $blog_post->save();

        return response(['message' => 'Status has been updated']);
    }
}
