<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use App\Models\Role;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::where('show_while_creating_user', 'YES')->latest()->paginate(config('constants.PER_PAGE'));
        return view('admin.rolemanagement.role', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::where('is_active', 'Y')->groupBy('title')->get();

        foreach ($permissions as $key => $list) {
            $permissions_data[$key]['section_title'] = $list->title;
            $permissions_data[$key]['permission'] = Permission::where('is_active', 'Y')->select('id', 'name', 'permission_label')->where('title', $list->title)->get();
        }

        return view('admin.rolemanagement.create_role', compact('permissions_data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        try {
            $role = resolve('role-repo')->create($request);
            toastr()->success($role->name . ' created with permissions successfully..!');
            return redirect()->route('role.index');
        } catch (\Exception $e) {
            toastr()->error($e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = resolve('role-repo')->findByID($id);

        $permissions = Permission::where('is_active', 'Y')->groupBy('title')->get();

        foreach ($permissions as $key => $list) {
            $permissions_data[$key]['section_title'] = $list->title;
            $permissions_data[$key]['permission'] = Permission::select('id', 'name', 'permission_label')->where('title', $list->title)->where('is_active', 'Y')->get();
        }

        return view('admin.rolemanagement.edit_role',compact('role','permissions_data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, $id)
    {
        try {
            $role = resolve('role-repo')->update($request,$id);
            toastr()->success($role->name . ' updated with permissions successfully..!');
            return redirect()->route('role.index');
        } catch (\Exception $e) {
            toastr()->error($e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $role = resolve('role-repo')->findByID($id);
            if (!empty($role)) {
                $role->delete();
                toastr()->success('Role deleted successfully..!');
                return redirect()->route('role.index');
            } else {
                toastr()->error('Role not found.!');
            }
        } catch (\Exception $e) {
            toastr()->error($e->getMessage());
            return redirect()->back();
        }
    }

}
