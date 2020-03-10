<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\User;
use App\Student;
use App\Package;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */
    use RegistersUsers;
    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255']            
        ]);
    }
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {        
        // return User::create([
        //     'name' => $data['name'],
        //     'email' => $data['email'],
        //     'password' => Hash::make($data['password']),
        // ]);
        $data['password'] = Student::generateRandomString(6);
        $splittedNames = Student::splitName($data['name']);
        //$student = Student::where('email', '=', $data['email'])->first();
        $student = null;        
        if(User::where('email', '=', $data['email'])->exists()){            
            $student = User::where('email', '=', $data['email'])->first();                        
        }else{            
            $student = User::create($data);
        }     
        
        $package = Package::find($data['package_id']);        
        $student->tests_with_assessment += $package->tests_with_assessment;
        $student->video_tutorials += $package->video_tutorials;
        $student->practice_questions += $package->practice_questions;
        $student->mock_tests += $package->mock_tests;
        $student->pte_vouchers += $package->pte_vouchers;
        $student->webinar_sessions += $package->webinar_sessions;
        $student->personal_feedback_and_assessment = $package->personal_feedback_and_assessment;
        $student->coaching_session_daily += $package->coaching_session_daily;
        $student->type = "student";
        $student->package_id = $data['package_id'];
        $student->first_name = $splittedNames['first_name'];
        $student->middle_name = $splittedNames['middle_name'];
        $student->last_name = $splittedNames['last_name'];
        $student->save();
        return $student;
    }

    public function register(Request $request)
    {
        $validations = $this->validator($request->all())->validate();        
        event(new Registered($user = $this->create($request->all())));

        //$this->guard()->login($user);

        return $this->registered($request, $user)
                        ?: redirect($this->redirectPath());
    }

}