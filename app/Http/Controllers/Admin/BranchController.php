<?php

namespace App\Http\Controllers\Admin;

use App\Models\Branch;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BranchController extends Controller
{
    public function index()
    {
        $branches = Branch::paginate(10);
        $branchesCount = Branch::count();
        return view('admin.branches.index', compact('branches', 'branchesCount'));
    }
    public function create()
    {
        $branch = null;
        $branchesCount = Branch::count();

        return view('admin.branches.create', compact('branch', 'branchesCount'));
    }
    public function edit(Branch $branch)
    {
        return view('admin.branches.edit', compact('branch'));
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required'
        ]);
        Branch::create($data);
        return redirect()->route('admin.branches.index')->with('success', 'تم حفظ الفرع بنجاح');
    }
    public function update(Request $request, Branch $branch)
    {
        $data = $request->validate([
            'name' => 'required'
        ]);
        $branch->update($data);
        return redirect()->route('admin.branches.index')->with('success', 'تم تحديث الفرع بنجاح');
    }

    public function destroy(Branch $branch)
    {
        $branch->delete();
        return redirect()->route('admin.branches.index')->with('success', 'تم حذف الفرع بنجاح');
    }
}
