<?php

namespace App\Http\Controllers\Admin;

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
use DB;

class InvoiceController extends Controller
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
        $invoices = Invoice::with('project')->with('client')->orderBy('created_at', 'DESC')->get();
        return view('admin.view_invoice',compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $projects = Project::with('client')->get();
        $serial = $this->generateSerial();
        return view('admin.new_invoice', compact('projects','serial'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InvoiceRequest $request)
    {
        $data = $request->all();
        $data['issuedTo'] = Project::find($data['projectId'])->ownBy;
        $data['user_id'] = Auth::guard('admin')->user()->id;
        $data['user_type'] = 'App\Models\Admin';
        Invoice::create($data);
        
        $message['type'] = 'success';
        $message['content'] = 'Invoice Created Successfully';
        Session::flash('message',$message);

        return redirect()->route('admin.view.invoices');
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
        return view('admin.invoice_detail', compact('invoice'));
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
        return view('admin.edit_invoice', compact('invoice','projects'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(InvoiceRequest $request, $id)
    {
        $data = $request->all();
        $data['issuedTo'] = Project::find($data['projectId'])->ownBy;
        $data['user_id'] = Auth::guard('admin')->user()->id;
        $data['user_type'] = 'App\Models\Admin';

        Invoice::find(Crypt::decrypt($id))->update($data);
        
        $message['type'] = 'success';
        $message['content'] = 'Invoice Update Successful';
        Session::flash('message',$message);

        return redirect()->route('admin.show.invoice',$id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function confirmPayment($id)
    {
        $data['paymentDate'] = Carbon::now();
        $data['isPayEvidenceApproved'] = 1;
        $data['confirmed_user_id'] = Auth::guard('admin')->user()->id;
        $data['confirmed_user_type'] = 'App\Models\Admin';

        Invoice::find(Crypt::decrypt($id))->update($data);
        
        $message['type'] = 'success';
        $message['content'] = 'Payment Confirmed & Receipt Generated Successfully';
        Session::flash('message',$message);

        return redirect()->route('admin.show.invoice',$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $invoice = Invoice::find(Crypt::decrypt($id));
        
        Storage::disk('publicDisk')->delete($invoice->paymentEvidence);
        
        $invoice->delete();

        $message['type'] = 'success';
        $message['content'] = 'Invoice Deleted Successfully';
        Session::flash('message',$message);

        return redirect()->route('admin.view.invoices');
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
        // return view('download.invoice', compact('invoice'));
    }

    public function generateSerial(){
        $statement = DB::select("SHOW TABLE STATUS LIKE 'invoices'");
        $nextId = $statement[0]->Auto_increment;
        $digitLength = $nextId == 999 ? 4 : 3;
        $nextId . '' ;
        while (strlen($nextId) < $digitLength) {
            $nextId = 0 . $nextId;
        }
        $serial = 'INV'.$nextId;
        return $serial;
    }
}
