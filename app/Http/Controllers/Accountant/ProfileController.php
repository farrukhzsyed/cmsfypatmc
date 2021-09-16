<?php

namespace App\Http\Controllers\Accountant;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClientProfileRequest;
use Illuminate\Http\Request;
use App\Models\Accountant;
use App\Http\Requests\PasswordRequest;
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
        $this->middleware('accountant.auth:accountant');
    }

    
    /**
     * Show the Accountant dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function profile() {
        return view('accountant.profile');
    }

     /**
     * Show the Accountant dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function editProfileForm() {
        return view('accountant.edit_profile');
    }

     /**
     * Show the Accountant dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function updateProfile(ClientProfileRequest $request) {
        
        $data = $request->validated();
        
        if($request->hasFile('avatar')){
            $fileName = $request->file('avatar')->store('profile image', ['disk' => 'publicPath']);
            $data['avatar'] = $fileName;
        }

        Accountant::find(Auth::guard('accountant')->user()->id)->update($data);

        $message['type'] = 'success';
        $message['content'] = 'Profile Update Successful';
        Session::flash('message',$message);

        return redirect()->route('accountant.profile');
    }

    public function resetPassword(PasswordRequest $request)
    {
        $data['password'] = Hash::make($request->password);        
        Accountant::find(Auth::guard('accountant')->user()->id)->update($data);

        $message['type'] = 'success';
        $message['content'] = 'Password Changed Successfully';
        Session::flash('message',$message);

        return redirect()->route('accountant.home');
    }
}
