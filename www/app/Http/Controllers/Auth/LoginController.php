<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }
    protected function authenticated(Request $request, $user)
    {
        if (\auth()->user()->is_active == 'N') {
            auth()->logout();
            $errors = new MessageBag(['email' => ['You account is decative, Please contact to administrator.']]); // if Auth::attempt fails (wrong credentials) create a new message bag instance.

            return redirect()->back()->withErrors($errors); // redirect back to the login page, using ->withErrors($errors) you send the error created above
        }

        $user->update([
            'logins' => $user->logins + 1,
            'last_login_ip' => $request->getClientIp(),
            'last_login_at' => Carbon::now()->toDateTimeString()
        ]);
    }

}
