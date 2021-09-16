<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Client;
use Session;
use Auth;
use Crypt;
use Storage;

class ProjectController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $project = Project::where('ownBy', Auth::guard('client')->user()->id)->with('client')->get();
        return view('client.view_project',compact('project'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $project = Project::with('client')->where('id',Crypt::decrypt($id))->first();
        return view('client.project_detail', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project = Project::find(Crypt::decrypt($id));
        $clients = Client::select('id','fname','username','avatar')->get();
        return view('client.edit_project', compact('project', 'clients'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();

        Project::find(Crypt::decrypt($id))->update($data);
        
        $message['type'] = 'success';
        $message['content'] = 'Project Feedback Update Successful';
        Session::flash('message',$message);

        return redirect()->route('client.show.project',$id);
    }

    public function downloadProjectFile($id) {
        $project = Project::find(Crypt::decrypt($id));
        $headers = array(
            'Content-Type: '.Storage::disk('publicDisk')->mimeType($project->projectFile),
        );
        $exe = explode('.', $project->projectFile)[1];
        return Storage::disk('publicDisk')->download($project->projectFile, 
                                'payment Evidence For Invoice'.$project->id.'.'.$exe, 
                                $headers);
    }

}
