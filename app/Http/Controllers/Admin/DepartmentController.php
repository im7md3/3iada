<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Feature;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DepartmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read_departments')->only('index');
        $this->middleware('permission:create_departments')->only(['create', 'store']);
        $this->middleware('permission:update_departments')->only(['edit', 'update']);
        $this->middleware('permission:delete_departments')->only('destroy');
        // $this->middleware('company')->only(['create', 'store', 'edit', 'update', 'destroy']);
    }

    public function index()
    {
        $departments = Department::latest()->paginate(10);
        return view('admin.departments.index', compact('departments'));
    }


    public function create()
    {
        $main_departments = Department::whereNull('parent')->get();
        return view('admin.departments.create', compact('main_departments'));
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required'],
            'parent' => ['nullable', 'exists:departments,id'],
            'is_lab' => ['nullable'],
            'is_scan' => ['nullable'],
        ], [], [
            'name' => __('name'),
            'parent' => __('parent'),
        ]);
        $data['is_lab'] = $request->is_lab ? true : false;
        $data['is_scan'] = $request->is_scan ? true : false;
        $data['transferstatus'] = 1;
        $department = Department::create($data);
        $department->features()->sync($request->features);
        return redirect()->route('admin.departments.index')->with('success', __('Successfully added'));
    }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  \App\Models\Department  $department
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show(Department $department)
    // {
    //     //
    // }


    public function edit(Department $department)
    {
        // dd('ww');
        $main_departments = Department::whereNull('parent')->get();
        return view('admin.departments.edit', compact('main_departments', 'department'));
    }


    public function update(Request $request, Department $department)
    {
        $data = $request->validate([
            'name' => ['required'],
            'parent' => ['nullable', 'exists:departments,id'],
            'is_lab' => ['nullable'],
            'is_scan' => ['nullable'],
        ], [], [
            'name' => __('name'),
            'parent' => __('parent'),
        ]);
        $data['is_lab'] = $request->is_lab ? true : false;
        $data['is_scan'] = $request->is_scan ? true : false;
        $department->update($data);
        $department->features()->sync($request->features);

        $features = $request->features ? array_unique(Feature::whereIn('id', $request->features)->pluck('key')->toArray()) : [];
        $users = User::doctors()->whereRelation('departments', 'department_id', $department->id)->get();
        foreach ($users as $user) {
            $this->resetUserFeatures($user);
            if (!empty($features)) {
                foreach ($features as $feature) {
                    $user->$feature = 1;
                }
            }
            $user->save();
        }
        return redirect()->route('admin.departments.index')->with('success', __('Successfully updated'));
    }
    private function resetUserFeatures($user)
    {
        $features_names = [
            'is_dentist',
            'is_dermatologist',
            'is_orthodontics',
            'is_optometrist',
            'is_pregnancy'
        ];
        foreach ($features_names as $name) {
            $user->$name = 0;
        }
        $user->save();
    }

    public function destroy(Department $department)
    {
        $department->delete();
        return back()->with('success', __('Successfully deleted'));
    }
}
