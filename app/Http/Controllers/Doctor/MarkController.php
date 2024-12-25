<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Mark;
use Illuminate\Http\Request;

class MarkController extends Controller
{
    public function __construct()
    {
        /* $this->middleware('permission:read_marks')->only('index');
        $this->middleware('permission:create_marks')->only(['create', 'store']);
        $this->middleware('permission:update_marks')->only(['edit', 'update']);
        $this->middleware('permission:delete_marks')->only('destroy'); */
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $marks = Mark::latest()->paginate(10);
        return view('doctor.marks.index', compact('marks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('doctor.marks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate(['name' => 'required']);
        $data['show'] = $request->show ? 1 : 0;
        Mark::create($data);
        return redirect()->route('doctor.marks.index')->with('success', __('Successfully added'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mark  $Mark
     * @return \Illuminate\Http\Response
     */
    public function show(Mark $Mark)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mark  $Mark
     * @return \Illuminate\Http\Response
     */
    public function edit(Mark $mark)
    {
        return view('doctor.marks.edit', compact('mark'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mark  $Mark
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mark $mark)
    {
        $data = $request->validate(['name' => 'required', 'show' => 'nullable']);
        $data['show'] = $request->show ? 1 : 0;
        $mark->update($data);
        return redirect()->route('doctor.marks.index')->with('success', __('Successfully updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mark  $Mark
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mark $mark)
    {
        $mark->delete();
        return back()->with('success', __('Successfully deleted'));
    }
}
