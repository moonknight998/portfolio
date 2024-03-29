<?php

namespace App\Http\Controllers\Admin\SinglePage;

use App\Http\Controllers\Controller;
use App\Models\PrivacyPolicy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PrivacyPolicyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $privacy_policy = PrivacyPolicy::first();
        return view('admin.pages.single.privacy_policy_index', compact('privacy_policy'));
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
            'title' => ['required', 'string', 'max:100'],
            'content' => ['required', 'string'],
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

        // Get the content from the request
        $content = $request->content;

        // Create a new DOMDocument and load the post content
        $dom = new \DOMDocument();
        $dom->loadHTML('<meta charset="utf8">'.$content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD | LIBXML_NOERROR | LIBXML_NOWARNING);

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
                $image_name = '/uploads/privacy_policy/'.date("H_i_s").'_'.date('d_m_Y').'_'.uniqid().'.'.$type;
                $image_path = public_path($image_name);

                // Save the image to the specified path
                file_put_contents($image_path, $image_scr);

                // Remove the src attribute and set it to the new image path
                $image_element->removeAttribute('src');
                $image_element->setAttribute('src', $image_name);
                $src = $image_element->getAttribute('src');
            }
        }

        $privacy_policy = new PrivacyPolicy();
        $privacy_policy->title = $request->title;
        $privacy_policy->slug = Str::slug($request->title).'-'.time().'-'.Str::random(10);
        $privacy_policy->content = $content;
        $privacy_policy->status = $request->status;
        $privacy_policy->save();

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
        $privacy_policy = PrivacyPolicy::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'title' => ['required', 'string', 'max:100'],
            'content' => ['required', 'string'],
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

        // Retrieve the content from the $terms_of_service object
        $content_present = $privacy_policy->content;

        // Create a new DOMDocument object
        $dom_present = new \DOMDocument();

        // Load HTML content into the DOMDocument object with specified options
        $dom_present->loadHTML($content_present, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD | LIBXML_NOERROR | LIBXML_NOWARNING);

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

        // Get the content from the request
        $content_to_update = $request->content;

        // Create a new DOMDocument and load the content
        $dom_to_update = new \DOMDocument();

        // Load HTML content into the DOMDocument object with specified options
        $dom_to_update->loadHTML('<meta charset="utf8">'.$content_to_update, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD | LIBXML_NOERROR | LIBXML_NOWARNING);

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
                $image_name = '/uploads/terms_of_service/'.date("H_i_s").'_'.date('d_m_Y').'_'.uniqid().'.'.$type;
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
        $content_to_update = $dom_to_update->saveXML($dom_to_update->documentElement, LIBXML_NOEMPTYTAG);

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

        $privacy_policy->title = $request->title;
        $privacy_policy->slug = Str::slug($request->title).'-'.time().'-'.Str::random(10);
        $privacy_policy->content = $content_to_update;
        $privacy_policy->status = $request->status;
        $privacy_policy->save();

        return redirect()->back()->with('status', 'updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Show content for guest
     */

     public function content()
     {
         $privacy_policy = PrivacyPolicy::first();
         return view('frontend.pages.privacy_policy.privacy_policy', compact('privacy_policy'));
     }
}
