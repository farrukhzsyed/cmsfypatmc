<?php

namespace App\Http\Controllers\Accountant\Auth;

use App\Models\Accountant;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new admins as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    // use RegistersUsers;

    /**
     * Where to redirect accountants after registration.
     *
     * @var string
     */
    // protected $redirectTo = '/admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin.guest:admin');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'fname' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:accountants'],
            'tel' => ['required', 'string', 'unique:accountants'],
            // 'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new accountant instance after a valid registration.
     *
     * @param array $data
     *
     * @return \App\Models\Accountant
     */
    protected function create(array $data)
    {
        $accountant = Accountant::create([
            'fname' => $data['fname'],
            'username' => $data['username'],
            'email' => $data['email'],
            'tel' => $data['tel'],
            'password' => Hash::make('CMS-Accountant'),
        ]);

        return $accountant;
    }

    public function register(Request $request)
    {
        dd('here');
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        Session::flash('status','A New School Has Been Added Successfully. <br> 
                                Email Notification Has Been Sent To The Associated Address.'); 

        return redirect()->route('admin.dashboard');
    }

    // /**
    //  * Show the application registration form.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function showRegistrationForm()
    // {
    //     return view('accountant.auth.register');
    // }

    // /**
    //  * Get the guard to be used during registration.
    //  *
    //  * @return \Illuminate\Contracts\Auth\StatefulGuard
    //  */
    // protected function guard()
    // {
    //     return Auth::guard('accountant');
    // }
}
