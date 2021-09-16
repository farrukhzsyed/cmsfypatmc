<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ProjectRequest;
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
        $this->middleware('admin.auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $project = Project::with('client')->orderBy('created_at', 'DESC')->get();
        return view('admin.view_project',compact('project'));
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

        if($request->hasFile('projectFile')){
            $fileName = $request->file('projectFile')->store('project files', 'publicDisk');
            $data['projectFile'] = $fileName;
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
        $project = Project::with('client')->where('id',Crypt::decrypt($id))->first();
        return view('admin.project_detail', compact('project'));
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
        return view('admin.edit_project', compact('project', 'clients'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProjectRequest $request, $id)
    {
        $data = $request->all();
        if($request->hasFile('projectFile')){
            $fileName = $request->file('projectFile')->store('project files', 'public');
            $data['projectFile'] = $fileName;
        }

        Project::find(Crypt::decrypt($id))->update($data);
        
        $message['type'] = 'success';
        $message['content'] = 'Project Update Successful';
        Session::flash('message',$message);

        return redirect()->route('admin.show.project',$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = Project::find(Crypt::decrypt($id));
        
        Storage::disk('publicDisk')->delete($project->projectFile);
        
        $project->delete();

        $message['type'] = 'success';
        $message['content'] = 'Project Deleted Successfully';
        Session::flash('message',$message);

        return redirect()->route('admin.view.all.project');
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

    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
