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
use Validator;

class InvoiceController extends Controller
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
        $invoices = Invoice::with('project')->where('issuedTo', Auth::guard('client')->user()->id)->get();
        return view('client.view_invoice',compact('invoices'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $invoice = Invoice::with('project')->with('client')->find(Crypt::decrypt($id));
        return view('client.invoice_detail', compact('invoice'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $invoice = Invoice::with('project')->with('client')->find(Crypt::decrypt($id));
        $projects = Project::with('client')->get();
        return view('client.edit_invoice', compact('invoice','projects'));
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
        Validator::make($request->all(), [
            'paymentEvidence' => [
                                'required',
                                'file',
                                'mimes:pdf,docx,doc,jpeg,jpg,png,gif'
                                ]
            ])->validate();

        if($request->hasFile('paymentEvidence')){
            $fileName = $request->file('paymentEvidence')->store('payment evidence files', 'publicDisk');
            $data['paymentEvidence'] = $fileName;
            $data['paymentDate'] = Carbon::now();
        }

        Invoice::find(Crypt::decrypt($id))->update($data);
        
        $message['type'] = 'success';
        $message['content'] = 'Payment Evidence Uploaded Successful';
        Session::flash('message',$message);

        return redirect()->route('client.show.invoice',$id);
    }

    public function showPaymentEvidence($id) {
        $invoice = Invoice::find(Crypt::decrypt($id));
        $headers = array(
            'Content-Type: '.Storage::disk('publicDisk')->mimeType($invoice->paymentEvidence),
        );
        $exe = explode('.', $invoice->paymentEvidence)[1];
        return Storage::disk('publicDisk')->download($invoice->paymentEvidence, 
                                'payment Evidence For Invoice'.$invoice->id.'.'.$exe, 
                                $headers);
    }

    public function downloadInvoiceAsPDF($id){
        $invoice = Invoice::with('project')->with('client')->find(Crypt::decrypt($id));
        $pdf = PDF::loadView('download.invoice', compact('invoice'));
        return $pdf->download($invoice->invoiceSerial .'.pdf');
    }
}
