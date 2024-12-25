<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Feature;
use App\Models\Department;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read_users')->only('index');
        $this->middleware('permission:create_users')->only(['create', 'store']);
        $this->middleware('permission:update_users')->only(['edit', 'update']);
        $this->middleware('permission:delete_users')->only('destroy');
    }

    public function index()
    {
        $users = User::NotAdmin()->with('department')->withTrashed()->latest()->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        $departments = Department::all();
        $roles = Role::get();
        return view('admin.users.create', compact('departments', 'roles'));
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required'],
            'password' => ['required'],
            'email' => ['required', 'unique:users,email', 'email'],
            'type' => ['required'],
            'group' => ['required'],
            'session_duration' => ['nullable', 'integer'],
            'salary' => ['nullable', 'numeric'],
            // 'department_id' => $request->type == 'dr' ? 'required' : 'nullable',
            'rate' => ['nullable', 'numeric'],
            'target' => ['nullable', 'numeric'],
            'is_dentist' => ['nullable'],
            'is_dermatologist' => ['nullable'],
            'is_orthodontics' => ['nullable'],
            'is_optometrist' => 'nullable',
            'is_pregnancy' => 'nullable',
            'departments' => in_array($request->type, ['dr', 'scan', 'lab']) ? 'required' : 'nullable'
        ]);
        try {
            \DB::beginTransaction();
            if ($request->rate_type != "without_rate") {
                if (!$request->rate) {
                    return redirect()->back()->with('error', "rate is required");
                } else {
                    $data['rate'] = 0;
                }
            } else {
                $data['rate'] = $request->rate;
            }
            $data['password'] = Hash::make($request->password);
            $data['rate_type'] = $request->rate_type;
            $data['show_department_products'] = $request->departments;
            $user = User::create($data);

            if ($request->departments) {
                $ids = \DB::table('department_feature')
                    ->whereIn('department_id', $request->departments)
                    ->pluck('feature_id')->toArray();
                $features = array_unique(Feature::whereIn('id', $ids)->pluck('key')->toArray());
                foreach ($features as $feature) {
                    $user->$feature = 1;
                }
                $user->save();
            }

            $user->departments()->sync($request->departments);


            $user->syncRoles($request->group);
            \DB::commit();
            return redirect()->route('admin.users.index')->with('success', __('Successfully added'));
        } catch (\Exception $e) {
            \DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }


    public function show(User $user)
    {
        $departments = Department::all();
        return view('admin.users.show', compact('user', 'departments'));
    }


    public function edit(User $user)
    {
        $departments = Department::all();
        $roles = Role::get();
        return view('admin.users.edit', compact('departments', 'roles', 'user'));
    }


    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => ['required'],
            'password' => ['sometimes'],
            'email' => ['required', 'unique:users,email,' . $user->id, 'email'],
            'type' => ['required'],
            'group' => ['required'],
            'session_duration' => ['nullable', 'integer'],
            'salary' => ['required', 'numeric'],
            // 'department_id' => $request->type == 'dr' ? 'required' : 'nullable',
            'rate' => ['nullable', 'numeric'],
            'target' => ['nullable', 'numeric'],
            'is_dentist' => ['nullable'],
            'is_dermatologist' => ['nullable'],
            'is_orthodontics' => ['nullable'],
            'is_optometrist' => ['nullable'],
            'is_pregnancy' => 'nullable',
            'departments' => in_array($request->type, ['dr', 'scan', 'lab']) ? 'required' : 'nullable'
        ]);

        /* if ($request->rate_type != "without_rate") {
            if (!$request->rate) {
                return redirect()->back()->with('error', "rate is required");
            } else {
                $data['rate'] = 0;
            }
        } */

        $data['password'] = $request->password ? Hash::make($request->password) : $user->password;
        $data['rate_type'] = $request->rate_type;
        $data['rate'] = $request->rate ? $request->rate : 0;
        $data['is_dentist'] = $request->is_dentist ? 1 : 0;
        $data['is_dermatologist'] = $request->is_dermatologist ? 1 : 0;
        $data['is_orthodontics'] = $request->is_orthodontics ? 1 : 0;
        $data['is_optometrist'] = $request->is_optometrist ? 1 : 0;
        $data['is_pregnancy'] = $request->is_pregnancy ? 1 : 0;
        $data['show_department_products'] = $request->departments;

        $user->update($data);
        $user->syncRoles($request->group);
        $user->departments()->sync($request->departments);

        $this->resetUserFeatures($user);

        if ($request->departments) {
            $ids = \DB::table('department_feature')
                ->whereIn('department_id', $request->departments)
                ->pluck('feature_id')->toArray();
            $features = array_unique(Feature::whereIn('id', $ids)->pluck('key')->toArray());
            foreach ($features as $feature) {
                $user->$feature = 1;
            }
            $user->save();
        }


        return redirect()->route('admin.users.index')->with('success', __('Successfully updated'));
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

    public function destroy($id)
    {
        $user = User::withTrashed()->find($id);

        if ($user->deleted_at) {
            $user->restore();
            return back()->with('success', __('Successfully restored'));
        } else {
            $user->delete();
            return back()->with('success', __('Successfully deleted'));
        }
    }
}
