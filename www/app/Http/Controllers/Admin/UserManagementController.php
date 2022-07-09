<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\UserRequest;
use App\Models\DealerManagement;
use App\Models\TrustManagement;
use App\Models\User;
use App\Notifications\UserCreateNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use League\Flysystem\Exception;
use Spatie\Permission\Models\Role;


class UserManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::latest()->paginate(config('constants.PER_PAGE'));
        return view('admin.usermanagement.user_list', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $skip_roles = [config('constants.SUPER_ADMIN')];
        $roles = Role::whereNotIn('name', $skip_roles)->pluck('name', 'id');
        return view('admin.usermanagement.create_user', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $password = Str::random($length = 8);

            if (!User::where('email', $request['email'])->exists()) {
                $user = User::create([
                    'role_id' => $request->role,
                    'name' => $request['name'],
                    'email' => $request['email'],
                    'password' => Hash::make($password),
                ]);

                $user->assignRole($request->role);

                $params = [];
                $params['user'] = $user->name;
                $params['email'] = $user->email;
                $params['password'] = $password;
                $params['role_name'] = strtolower($user->getRoleNames()->first());

                Mail::send(new \App\Mail\UserCreateNotification($params));

                if (!empty($user)) {
                    DB::commit();
                    toastr()->success('User added successfully');
                    return redirect()->back();

                } else {
                    DB::rollBack();
                    toastr()->error('User not added successfully');
                    return redirect()->back();
                }
            }
            toastr()->error('Username already exists.');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollBack();
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
        $user = User::findorFail($id);
        $skip_roles = [config('constants.SUPER_ADMIN')];
        $roles = Role::whereNotIn('name', $skip_roles)->pluck('name', 'id');
        return view('admin.usermanagement.create_user', compact('user', 'roles'));
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
        DB::beginTransaction();
        try {
            $user = User::findorFail($id);
            $user->role_id = $request->role;
            $user->name = $request->name;
            $user->email = $request->email;

            if ($user->save()) {
                DB::table('model_has_roles')->where('model_id', $id)->delete();
                $user->assignRole($request->role);

                DB::commit();
                toastr()->success('User successfully updated..!');
                return redirect()->route('usermanagement.index');
            } else {
                toastr()->error('User not update try again..!');
                return redirect()->back();
            }
        } catch (\Exception $e) {
            DB::rollBack();
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
        $users = User::findorFail($id);

        if ($users->delete()) {
            toastr()->success('User successfully deleted..!');
            return redirect()->route('usermanagement.index');
        } else {
            toastr()->error('User not delete try again..!');
            return redirect()->back();
        }
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        try {
            $params = [];
            $params['password'] = Hash::make($request->password);
            $user = User::findorFail(auth()->user()->id)->update($params);
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

    public function changeStatus($id)
    {
        try {
            $user = User::find($id);
            if ($user->getRoleNames()->first() == 'Dealer') {
                $dealer = DealerManagement::where('user_id', $user->id)->first();
            }

            if ($user->is_active == 'Y') {
                $user->is_active = 'N';
                if ($user->getRoleNames()->first() == 'Dealer') {
                    $dealer->is_active = 'N';
                }
            } else {
                $user->is_active = 'Y';
                if ($user->getRoleNames()->first() == 'Dealer') {
                    $dealer->is_active = 'Y';
                }
            }
            if ($user->getRoleNames()->first() == 'Dealer') {
                $dealer->save();
            }

            if ($user->save()) {
                toastr()->success('User status changed successfully..!');
            } else {
                toastr()->error('User status not hanged successfully..!');
            }
        } catch (\Exception $e) {
            toastr()->error($e->getMessage());
        }

        return redirect()->route('usermanagement.index');

    }
}
