<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use App\Http\Requests\NewAccountantRequest;
use App\Http\Requests\NewClientRequest;
use App\Models\Accountant;
use App\Models\Client;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CreateUserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin.auth:admin');
    }


    /**
     * Show the Admin dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function newClient() {
        return view('admin.new_client');
    }

    /**
     * Show the Admin dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function newAccountant() {
        return view('admin.new_accountant');
    }

//  /**
//      * Get a validator for an incoming registration request.
//      *
//      * @param array $data
//      *
//      * @return \Illuminate\Contracts\Validation\Validator
//      */
//     protected function accountantValidator(array $data)
//     {
//         return Validator::make($data, [
//             'fname' => ['required', 'string', 'max:255'],
//             'username' => ['required', 'string', 'max:255'],
//             'gender' => ['required', 'string'],
//             'email' => ['required', 'string', 'email', 'max:255', 'unique:accountants'],
//             'tel' => ['required', 'string', 'unique:accountants'],
//             // 'password' => ['required', 'string', 'min:8', 'confirmed'],
//         ]);
//     }

    /**
     * Create a new accountant instance after a valid registration.
     *
     * @param array $data
     *
     * @return \App\Models\Accountant
     */
    protected function createAccountant(array $data)
    {
        return Accountant::create([
            'fname' => $data['fname'],
            'username' => $data['username'],
            'gender' => $data['gender'],
            'email' => $data['email'],
            'tel' => $data['tel'],
            'password' => Hash::make('CMS-Accountant'),
        ]);

    }

    public function registerAccountant(NewAccountantRequest $request)
    {
        // $this->accountantValidator($request->all())->validate();

        event(new Registered($user = $this->createAccountant($request->all())));

        Session::flash('status','Accountant Created Successfully.'); 

        $message['type'] = 'success';
        $message['content'] = 'Accountant Created Successfully';
        Session::flash('message',$message);

        return redirect()->route('admin.view.accountants');
    }

    //  /**
    //  * Get a validator for an incoming registration request.
    //  *
    //  * @param array $data
    //  *
    //  * @return \Illuminate\Contracts\Validation\Validator
    //  */
    // protected function clientValidator(array $data)
    // {
    //     return Validator::make($data, [
    //         'fname' => ['required', 'string', 'max:255', new Alpha_spaces()],
    //         'username' => ['required', 'string', 'max:255', 'alpha_dash','unique:clients'],
    //         'gender' => ['required', 'string'],
    //         'email' => ['required', 'string', 'email',new Email(),'max:255', 'unique:clients'],
    //         'tel' => ['required', 'numeric', 'max:9999999999999999', 'unique:clients'],
    //         // 'password' => ['required', 'string', 'min:8', 'confirmed'],
    //     ]);
    // }

    /**
     * Create a new accountant instance after a valid registration.
     *
     * @param array $data
     *
     * @return \App\Models\Accountant
     */
    protected function createClient(array $data)
    {
        return Client::create([
            'fname' => $data['fname'],
            'username' => $data['username'],
            'gender' => $data['gender'],
            'email' => $data['email'],
            'tel' => $data['tel'],
            'password' => Hash::make('CMS-Client'),
        ]);

    }

    public function registerClient(NewClientRequest $request)
    {
        // $this->clientValidator($request->all())->validate();

        event(new Registered($user = $this->createClient($request->all())));

        $message['type'] = 'success';
        $message['content'] = 'Client Created Successfully';
        Session::flash('message',$message);

        return redirect()->route('admin.view.clients');
    }

}
