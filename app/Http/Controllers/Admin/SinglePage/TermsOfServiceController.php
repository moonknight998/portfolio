<?php

namespace App\Http\Controllers\Admin\SinglePage;

use App\Http\Controllers\Controller;
use App\Models\TermsOfService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class TermsOfServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $terms_of_service = TermsOfService::first();
        return view('admin.pages.single.terms_of_service_index', compact('terms_of_service'));
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

        $terms_of_service = new TermsOfService();
        $terms_of_service->title = $request->title;
        $terms_of_service->slug = Str::slug($request->title).'-'.time().'-'.Str::random(10);
        $terms_of_service->content = $content;
        $terms_of_service->status = $request->status;
        $terms_of_service->save();

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
