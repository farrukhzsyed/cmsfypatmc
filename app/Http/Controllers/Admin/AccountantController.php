<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AccountantRequest;
use App\Models\Accountant;
use Session;
use Auth;
use Crypt;
use Storage;
use Hash;

class AccountantController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $accountants = Accountant::orderBy('created_at', 'DESC')->get();
        return view('admin.view_accountant',compact('accountants'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $accountants = Accountant::select('id','fname','username','avatar')->get();
        return view('admin.new_accountant', compact('accountants'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectRequest $request)
    {
        $data = $request->all();

        if($request->hasFile('avatar')){
            $fileName = $request->file('avatar')->store('project files', 'publicDisk');
            $data['avatar'] = $fileName;
        }

        Accountant::create($data);
        
        $message['type'] = 'success';
        $message['content'] = 'Project Created Successfully';
        Session::flash('message',$message);

        return redirect()->route('admin.view.all.accountant');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $accountant = Accountant::find(Crypt::decrypt($id));
        return view('admin.accountant_detail', compact('accountant'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $accountant = Accountant::find(Crypt::decrypt($id));
        return view('admin.edit_accountant', compact('accountant'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AccountantRequest $request, $id)
    {
        $data = $request->all();

        if($request->hasFile('avatar')){
            $fileName = $request->file('avatar')->store('profile image', 'publicPath');
            $data['avatar'] = $fileName;
        }

        Accountant::find(Crypt::decrypt($id))->update($data);
        
        $message['type'] = 'success';
        $message['content'] = 'Accountant Update Successful';
        Session::flash('message',$message);

        return redirect()->route('admin.show.accountant',$id);
    }

    public function resetPassword($id)
    {
        $data['password'] = Hash::make('CMS-Accountant');
        Accountant::find(Crypt::decrypt($id))->update($data);
        
        $message['type'] = 'success';
        $message['content'] = 'Accountant Password Reset To Default';
        Session::flash('message',$message);

        return redirect()->route('admin.show.accountant',$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $accountant = Accountant::find(Crypt::decrypt($id));

        if(Storage::disk('publicPath')->exists($accountant->avatar))
            Storage::disk('publicPath')->delete($accountant->avatar);
        
        $accountant->delete();

        $message['type'] = 'success';
        $message['content'] = 'Accountant Deleted Successfully';
        Session::flash('message',$message);

        return redirect()->route('admin.view.accountants');
    }
}
