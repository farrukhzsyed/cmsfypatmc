<?php

namespace App\Http\Controllers\Accountant;

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
        $this->middleware('accountant.auth:accountant');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $project = Project::with('client')->orderBy('created_at', 'DESC')->get();
        return view('accountant.view_project',compact('project'));
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
        return view('accountant.project_detail', compact('project'));
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
