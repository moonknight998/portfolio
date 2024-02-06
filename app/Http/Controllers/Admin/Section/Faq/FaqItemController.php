<?php

namespace App\Http\Controllers\Admin\Section\Faq;

use App\DataTables\FaqItemDataTable;
use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\FaqItem;
use Illuminate\Http\Request;

class FaqItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(FaqItemDataTable $dataTable)
    {
        $faq_title = Faq::first();
        if ($faq_title == null)
        {
            return redirect()->route('admin.faq_title.index')->with('status', 'required');
        }
        return $dataTable->render('admin.pages.sections.faq.faq_item_index');
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
        //
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
