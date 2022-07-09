<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UserRequest;
use App\Mail\UserCreateNotification;
use App\Models\City;
use App\Models\Language;
use App\Models\Role;
use App\Models\State;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = resolve('user-repo')->getAll();
        return view('user.user', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $roles = Role::all()->pluck('name', 'id');
        return view('user.create_user', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            // Create user
            $params = [];
            $params['role'] = $request->role;
            $params['name'] = $request->name;
            $params['email'] = $request->email;
            $params['password'] = Hash::make($request->password);

            $user = resolve('user-repo')->create($params);

            if (!empty($user)) {

                // Send Mail Username and Password
                $params = [];
                $params['user'] = $user->name;
                $params['email'] = $request->email;
                $params['password'] = $request->password;

                //Mail::send(new UserCreateNotification($params));

                toastr()->success($user->name . ' created successfully..!');
                return redirect()->route('user.index');

            }
            toastr()->error('User not created successfully..!');
            return redirect()->back();
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
        $user = resolve('user-repo')->findByID($id);
        $roles = Role::all()->pluck('name', 'id');
        return view('user.create_user', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {

            // Update user
            $params = [];
            $params['role'] = $request->role;
            $params['name'] = $request->name;
            $params['email'] = $request->email;

            if (!empty($request->password)) {
                $params['password'] = Hash::make($request->password);
            }

            $user = resolve('user-repo')->update($params, $id);

            if (!empty($user)) {
                toastr()->success('User updated successfully..!');
                return redirect()->route('user.index');
            }
            toastr()->error('User not created successfully..!');
            return redirect()->back();
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
            $user = resolve('user-repo')->findById($id);
            if (!empty($user)) {

                $user->delete();
                toastr()->success($user->name . ' deleted successfully..!');
                return redirect()->route('user.index');
            } else {
                toastr()->error('User not found.!');
            }
        } catch (\Exception $e) {
            toastr()->error($e->getMessage());
            return redirect()->back();
        }
    }

    public function changeStatus($id)
    {
        try {
            $user = resolve('user-repo')->changeStatus($id);
            toastr()->success($user->name . ' status changed successfully..!');
            return redirect()->route('user.index');
        } catch (\Exception $e) {
            toastr()->error($e->getMessage());
            return redirect()->back();
        }
    }

    // Change Password

    public function changePassword(ChangePasswordRequest $request)
    {
        try {
            $params = [];
            $params['password'] = Hash::make($request->password);
            $user = resolve('user-repo')->changePassword($params, auth()->user()->id);
            if ($user) {
                toastr()->success('Password changed successfully..!');
            } else {
                toastr()->error('Password not changed successfully..!');

            }
        } catch (\Exception $e) {
            toastr()->error($e->getMessage());
        }
        return redirect()->back();
    }
}
