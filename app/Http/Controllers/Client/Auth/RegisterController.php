<?php

namespace App\Http\Controllers\Client\Auth;

use App\Models\Client;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Session;

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

    use RegistersUsers;

    /**
     * Where to redirect clients after registration.
     *
     * @var string
     */
    protected $redirectTo = '/admin';

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
     * Create a new client instance after a valid registration.
     *
     * @param array $data
     *
     * @return \App\Models\Client
     */
    protected function create(array $data)
    {
        $client = Client::create([
            'fname' => $data['fname'],
            'username' => $data['username'],
            'email' => $data['email'],
            'tel' => $data['tel'],
            'password' => Hash::make('CMS-Client'),
        ]);

        $message['type'] = 'success';
        $message['content'] = 'Client Created Successfully';
        Session::flash('message', $message);

        return $client;
    }

    // /**
    //  * Show the application registration form.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function showRegistrationForm()
    // {
    //     return view('client.auth.register');
    // }

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('client');
    }
}
