<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClientProfileRequest;
use App\Http\Requests\PasswordRequest;
use Illuminate\Http\Request;
use App\Models\Client;
use Session;
use Auth;
use Hash;

class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('client.auth:client');
    }

    
    /**
     * Show the Client dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function profile() {
        return view('client.profile');
    }

     /**
     * Show the Client dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function editProfileForm() {
        return view('client.edit_profile');
    }

     /**
     * Show the Client dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function updateProfile(ClientProfileRequest $request) {
        
        $data = $request->validated();
        
        if($request->hasFile('avatar')){
            $fileName = $request->file('avatar')->store('profile image', ['disk' => 'publicPath']);
            $data['avatar'] = $fileName;
        }

        Client::find(Auth::guard('client')->user()->id)->update($data);

        $message['type'] = 'success';
        $message['content'] = 'Profile Update Successful';
        Session::flash('message',$message);

        return redirect()->route('client.profile');
    }

    public function resetPassword(PasswordRequest $request)
    {
        $data['password'] = Hash::make($request->password);        
        Client::find(Auth::guard('client')->user()->id)->update($data);

        $message['type'] = 'success';
        $message['content'] = 'Password Changed Successfully';
        Session::flash('message',$message);

        return redirect()->route('client.home');
    }
}
