<?php

namespace App\Http\Controllers\Accountant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ClientRequest;
use App\Models\Project;
use App\Models\Client;
use Session;
use Auth;
use Crypt;
use Storage;

class ClientController extends Controller
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
        $clients = Client::with('projects')->orderBy('created_at', 'DESC')->get();
        return view('accountant.view_client',compact('clients'));
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
        return view('accountant.client_detail', compact('client'));
    }
}
