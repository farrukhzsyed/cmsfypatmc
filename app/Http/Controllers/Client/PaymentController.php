<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\InvoiceRequest;
use App\Models\Project;
use App\Models\Client;
use App\Models\Invoice;
use Session;
use Auth;
use Crypt;
use Storage;
use Carbon\Carbon;
use PDF;

class PaymentController extends Controller
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
        $payments = Invoice::with('project')->with('client')
                            ->where([
                                ['issuedTo', '=', Auth::guard('client')->user()->id],
                                ['isPayEvidenceApproved', '=', 1],
                                ['paymentEvidence', '!=', NULL]
                            ])->orderBy('paymentDate', 'DESC')->get();
        return view('client.view_payment',compact('payments'));
    }

    public function downloadReceiptAsPDF($id){
        $payment = Invoice::with('project')->with('client')->find(Crypt::decrypt($id));
        $pdf = PDF::loadView('download.receipt', compact('payment'));
        return $pdf->download($payment->invoiceSerial .'.pdf');
    }
}
