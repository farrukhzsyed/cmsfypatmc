<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Session;
use Auth;
use Illuminate\Support\Facades\Validator;
use Hash;
use App\Http\Requests\PasswordRequest;

class ProfileController extends Controller
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
    public function profile() {
        return view('admin.profile');
    }

     /**
     * Show the Admin dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function editProfileForm() {
        return view('admin.edit_profile');
    }

     /**
     * Show the Admin dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function updateProfile(Request $request) {

        $this->validator($request->all())->validate();

        $data = $request->all();

        if($request->hasFile('avatar')){
            $fileName = $request->file('avatar')->store('profile image', ['disk' => 'publicPath']);
            $data['avatar'] = $fileName;
        }

        unset($data['_token']);

        Admin::find(Auth::guard('admin')->user()->id)->update($data);

        $message['type'] = 'success';
        $message['content'] = 'Profile Update Successful';
        Session::flash('message',$message);

        return redirect()->route('admin.profile');
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:admins,email,'.Auth::guard('admin')->user()->id],
            'tel' => ['required', 'string', 'unique:admins,tel,'.Auth::guard('admin')->user()->id],
            'address' => ['required', 'string'],
            'avatar' => ['sometimes', 'mimes:jpeg,jpg,png,gif'],
        ]);
    }

    public function resetPassword(PasswordRequest $request)
    {
        $data['password'] = Hash::make($request->password);        
        
        Admin::find(Auth::guard('admin')->user()->id)->update($data);

        $message['type'] = 'success';
        $message['content'] = 'Password Changed Successfully';
        Session::flash('message',$message);

        return redirect()->route('admin.home');
    }
}
