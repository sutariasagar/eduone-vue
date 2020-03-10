<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Socialite;
use Auth;
use App\User;

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
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function showLoginForm() {
	    return view('authhome');
    }

    public function login( Request $request ) {
	    $credentials = $request->only('email', 'password');
	    if(\Illuminate\Support\Facades\Auth::attempt(['email' => $request->email, 'password' => $request->password])){

            //Login Successful
            if(Auth::user()->type == "student"){
                $response = array('success'=>true, 'redirect_to'=>'/admin/dashboard');
            }else{
                $response = array('success' => true, 'redirect_to'=>$this->redirectTo);
            }
		    

		    //return a JSON response
		    return response()->json($response);
	    }
	    else{

		    $response = array('success' => false, 'message' => 'Invalid login credentials');

		    return response()->json($response);
	    }

    }


}
