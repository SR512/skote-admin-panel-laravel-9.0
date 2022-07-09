<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.profile.profile');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $params = [];
            $params['name'] = $request->name;
            // $params['email'] = $request->email;
            if ($request->hasFile('profile')) {

                $fileDir = config('constants.USER_DOC_PATH') . DIRECTORY_SEPARATOR . "profile" . DIRECTORY_SEPARATOR . auth()->id();

                if (!File::exists($fileDir)) {
                    Storage::makeDirectory($fileDir, 0777);
                }
                $params['profile'] = basename($request->file('profile')->store($fileDir));
            }

            $user = User::findorFail(auth()->user()->id)->update($params);
            if ($user) {
                toastr()->success('Profile changed successfully..!');
            } else {
                toastr()->error('Profile not changed successfully..!');

            }
        } catch (\Exception $e) {
            toastr()->error($e->getMessage());
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
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
