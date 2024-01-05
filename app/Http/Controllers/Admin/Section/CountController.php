<?php

namespace App\Http\Controllers\Admin\Section;

use App\DataTables\CountDataTable;
use App\Http\Controllers\Controller;
use App\Models\Count;
use Detection\MobileDetect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CountDataTable $dataTable)
    {
        return $dataTable->render('admin.pages.sections.count.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $detect = new MobileDetect();
        $counts = Count::all();
        return view('admin.pages.sections.count.create', compact('detect', 'counts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title'=> ['required','string', 'max:200'],
            'quantity'=> ['required', 'numeric'],
            'status' => ['required'],
        ]);

        if ($validator->fails()) {
            $key = '';
            foreach ($validator->errors()->getMessages() as $keyError => $messageError)
            {
                $key = $keyError;
                break;
            }
            return redirect()->route('admin.count.create', "#$key")->withErrors($validator)->withInput();
        }

        $count = new Count();
        $count->title = $request->title;
        $count->quantity = $request->quantity;
        $count->icon = $request->icon ? $request->icon : 'bi bi-question-circle';
        $count->icon_color = $request->icon_color;
        $count->status = $request->status;
        $count->save();

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
        $counts = Count::all();
        $count = Count::findOrFail($id);
        return view('admin.pages.sections.count.edit', compact('detect' ,'counts', 'count'));
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
        $count = Count::findOrFail($id);
        if($count)
        {
            $count->delete();
        }
    }

    public function changeStatus(Request $request)
    {
        $count = Count::findOrFail($request->id);
        $count->status = $request->status == 'true' ? 1 : 0;
        $count->save();

        return response(['message' => 'Status has been updated']);
    }
}
