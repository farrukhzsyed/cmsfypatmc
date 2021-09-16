<?php

namespace App\Http\Controllers\Accountant;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Client;
use App\Models\Invoice;

class DashboardController extends Controller
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
    public function index() {
        $invoices = Invoice::with('project')->with('client')->orderBy('created_at', 'DESC')->get();
        $clients = Client::with('projects')->orderBy('created_at', 'DESC')->get();
        $project = Project::with('client')->orderBy('created_at', 'DESC')->get();
        $payments = Invoice::with('project')->with('client')
                            ->where([
                                ['isPayEvidenceApproved', '=', 1],
                                ['paymentEvidence', '!=', NULL]
                            ])->orderBy('updated_at', 'DESC')->get();
        $clientWithProject = 0; 
        $clientWithOutProject = 0; 
        
        foreach ($clients as $key => $value) {
            if($value->projects->count() < 1){
                $clientWithOutProject += 1; 
            }elseif($value->projects->count() > 0){
                $clientWithProject += 1; 
            }
        }

        return view('accountant.index',compact('invoices', 'clients', 'project', 'payments', 'clientWithProject', 
                                        'clientWithOutProject'));
    }
}
