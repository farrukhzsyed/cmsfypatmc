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

class PaymentController extends Controller
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
        $payments = Invoice::with('project')->with('client')
                            ->where([
                                ['isPayEvidenceApproved', '=', 1],
                                ['paymentEvidence', '!=', NULL]
                            ])->orderBy('updated_at', 'DESC')->get();
        return view('admin.view_payment',compact('payments'));
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
        $message['content'] = 'Data Deleted Successfully';
        Session::flash('message',$message);

        return redirect()->route('admin.view.payments');
    }

    public function downloadReceiptAsPDF($id){
        $payment = Invoice::with('project')->with('client')->find(Crypt::decrypt($id));
        $pdf = PDF::loadView('download.receipt', compact('payment'));
        return $pdf->download($payment->invoiceSerial .'.pdf');
    }
}
