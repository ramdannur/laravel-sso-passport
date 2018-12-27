<?php

namespace App\Http\Controllers\Auth;

use Session;
use Cookie;
use Hash;
use Auth;
use Route;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    protected $redirectTo = '/redirect';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Handle an authentication attempt.
     *
     * @return Response
     */

    public function login(Request $request)
    {
        // $this->validateLogin($request);
        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        // if ($this->hasTooManyLoginAttempts($request)) {
        //     $this->fireLockoutEvent($request);
        //     return $this->sendLockoutResponse($request);
        // }
        // Customization: Validate if client status is active (1)
        // if ($this->attemptLogin($request)) {
        //     return $this->sendLoginResponse($request);
        // }
        // Customization: Validate if client status is active (1)
        $inpUsername = $request->get($this->username());
        $inpPass = $request->get('password');
        $isHasRemember = "on";
        $isRedirectUrl = $request->get('_continue');

        // Customization: It's assumed that email field should be an unique field 
        $client = User::where('email', $inpUsername)->first();

        if (!empty($client)) {
            if (Hash::check($inpPass, $client->password)) {
                Auth::loginUsingId($client->id, $isHasRemember);

                $accessToken =  $client->createToken(config('constants.MYAPP'))->accessToken;

                // Session::put('passport_token', $accessToken);
                Cookie::queue('passport_token', $accessToken, 2628000);

                if(!empty($isRedirectUrl)){
                    $redirectUrl = $this->redirectTo."?continue=".$this->getUrlRedirect($isRedirectUrl);
                }else{
                    $redirectUrl = $this->redirectTo;
                }

                return redirect($redirectUrl);
            }else{
                return $this->sendFailedLoginResponse($request, 'auth.failed');
            }
        }else{
            return $this->sendFailedLoginResponse($request, 'auth.failed');
        }


        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);
        // Customization: If client status is inactive (0) return failed_status error.
        if ($client->status === 0) {
            return $this->sendFailedLoginResponse($request, 'auth.failed_status');
        }

        return $this->sendFailedLoginResponse($request);
    }

    /**
     * Get the failed login response instance.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $field
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function sendFailedLoginResponse(Request $request, $trans = 'auth.failed')
    {
        $errors = [$this->username() => trans($trans)];
        if ($request->expectsJson()) {
            return response()->json($errors, 422);
        }
        return redirect()->back()
            ->withInput($request->only($this->username(), 'remember'))
            ->withErrors($errors);
    }
}
