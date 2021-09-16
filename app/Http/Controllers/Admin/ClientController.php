<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ClientRequest;
use App\Models\Project;
use App\Models\Client;
use Session;
use Auth;
use Crypt;
use Storage;
use Hash;

class ClientController extends Controller
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
        $clients = Client::with('projects')->orderBy('created_at', 'DESC')->get();
        return view('admin.view_client',compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clients = Client::select('id','fname','username','avatar')->get();
        return view('admin.new_project', compact('clients'));
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
        $total = Project::all()->count();
        $data['serial'] = 'Proj-'.$total.$this->generateRandomString(3);

        Project::create($data);
        
        $message['type'] = 'success';
        $message['content'] = 'Project Created Successfully';
        Session::flash('message',$message);

        return redirect()->route('admin.view.all.project');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $client = Client::with('projects')->where('id',Crypt::decrypt($id))->first();
        return view('admin.client_detail', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $client = Client::find(Crypt::decrypt($id));
        return view('admin.edit_client', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ClientRequest $request, $id)
    {
        $data = $request->all();

        if($request->hasFile('avatar')){
            $fileName = $request->file('avatar')->store('profile image', 'publicPath');
            $data['avatar'] = $fileName;
        }

        Client::find(Crypt::decrypt($id))->update($data);
        
        $message['type'] = 'success';
        $message['content'] = 'Client Update Successful';
        Session::flash('message',$message);

        return redirect()->route('admin.show.client',$id);
    }

    public function resetPassword($id)
    {
        $data['password'] = Hash::make('CMS-Client');
        Client::find(Crypt::decrypt($id))->update($data);
        
        $message['type'] = 'success';
        $message['content'] = 'Client Password Reset To Default';
        Session::flash('message',$message);

        return redirect()->route('admin.show.client',$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $client = Client::with('projects')->find(Crypt::decrypt($id));

        if(Storage::disk('publicPath')->exists($client->avatar))
            Storage::disk('publicPath')->delete($client->avatar);

        foreach($client->projects as $project){
            if(Storage::disk('publicDisk')->exists($project->projectFile))
                Storage::disk('publicDisk')->delete($project->projectFile);
        }
        
        $client->delete();

        $message['type'] = 'success';
        $message['content'] = 'Client Deleted Successfully';
        Session::flash('message',$message);

        return redirect()->route('admin.view.clients');
    }
}
