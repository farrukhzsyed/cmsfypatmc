<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Client;
use App\Models\Invoice;
use Auth;

class DashboardController extends Controller
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
    public function index() {
        $userId = Auth::guard('client')->user()->id;
        $invoices = Invoice::with('project')->with('client')
                            ->where('issuedTo', $userId)->orderBy('created_at', 'DESC')->get();
        $project = Project::with('client')
                        ->where('ownBy', $userId)->orderBy('created_at', 'DESC')->get();
        $payments = Invoice::with('project')->with('client')
                            ->where([
                                ['isPayEvidenceApproved', '=', 1],
                                ['paymentEvidence', '!=', NULL]
                            ])->where('issuedTo',  $userId)
                            ->orderBy('updated_at', 'DESC')->get();
        return view('client.index',compact('invoices', 'project', 'payments'));
    }
}
