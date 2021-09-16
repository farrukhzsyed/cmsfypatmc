@extends('admin.layouts.default')

@section('content')
<!-- Container fluid -->
<div class="container-fluid px-6 py-4">
  <div class="row">
    <div class="col-lg-12 col-md-12 col-12">
      <!-- Page header -->
      <div>
        <div class="border-bottom pb-4 mb-4 ">
          <div class="mb-2 mb-lg-0">
            <h3 class="mb-0 fw-bold">Invoice Detail</h3>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row align-items-center">
    <div class="col-xl-12 col-lg-12 col-md-12 col-12">
      <!-- Bg -->
      <div class="bg-white rounded-bottom smooth-shadow-sm ">
        <div class="d-flex align-items-center justify-content-between
            pt-4 pb-6 px-4">
          <div class="d-flex align-items-center">
            <div class="col-12">
              <h6 class="text-uppercase fs-5 ls-2">Fee To Pay </h6>
              <p class="mb-0"><strong> ${{$invoice->amountToPay}} </strong></p>
            </div>
          </div>
          <div>
            <div class="dropdown dropstart">
              <a class="text-muted text-primary-hover" href="#"
                role="button" id="dropdownTeamOne"
                data-bs-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false"> 
                  <i class="icon-l" data-feather="more-vertical"></i>
              </a>
              <div class="dropdown-menu"
                aria-labelledby="dropdownTeamOne">
                <a class="dropdown-item" href="{{route('admin.download.invoice',Crypt::encrypt($invoice->id))}}">Download</a>
                @if(!($invoice->isPayEvidenceApproved && $invoice->paymentEvidence))
                  @if(!$invoice->isPayEvidenceApproved && $invoice->paymentEvidence )
                    <a class="dropdown-item" href="{{route('admin.confirm.payment.invoice',Crypt::encrypt($invoice->id))}}">
                      Confirm Payment
                    </a>
                  @else
                    <a class="dropdown-item" href="{{route('admin.edit.invoice',Crypt::encrypt($invoice->id))}}">
                      Edit Details
                    </a>
                  @endif
                @endif 
                  <a class="dropdown-item" href="{{route('admin.delete.invoice',Crypt::encrypt($invoice->id))}}" style="color:red;">Delete</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- content -->
  <div class="py-6">
    <!-- row -->
    <div class="row">
        <div class="col-xl-6 col-lg-12 col-md-12 col-12 mb-6">
          <!-- card -->
          <div class="card">
            <!-- card body -->
            <div class="card-body">
              <!-- card title -->
              <!-- row -->
              <div class="row">
                <div class="col-6 mb-5">
                  <h6 class="text-uppercase fs-5 ls-2">Issued To</h6>
                  <p class="mb-0">
                    <span class="avatar avatar-sm">
                      <img alt="avatar"
                        src="{{asset($invoice->client->avatar)}}"
                        class="rounded-circle">
                    </span>
                    {{$invoice->client->fname}}</p>
                </div>
                <div class="col-6 mb-5">
                  <!-- text -->
                  <h6 class="text-uppercase fs-5 ls-2">Invoice Serial
                  </h6>
                  <p class="mb-0">{{$invoice->invoiceSerial}}</p>
                </div>
                <div class="col-6 mb-5">
                  <h6 class="text-uppercase fs-5 ls-2">Due Date
                  </h6>
                  <p class="mb-0">{{Carbon\Carbon::parse($invoice->dueDate)->diffForHumans()}}</p>
                </div>
                <div class="col-6 mb-5">
                  <h6 class="text-uppercase fs-5 ls-2">Status
                  </h6>
                  <p class="mb-0" style="color: {{
                      !$invoice->paymentEvidence ? 'red' : ($invoice->isPayEvidenceApproved && $invoice->paymentEvidence? 'green' : 'brown') }}">
                    <strong> 
                      {{
                        !$invoice->paymentEvidence ? 
                        'UNPAID' : 
                        ($invoice->isPayEvidenceApproved && $invoice->paymentEvidence ? 'Paid & Confirmed' : 'Awaiting Confirmation')
                      }}
                    </strong>
                  </p>
                </div>
              <div class="col-12">
                <h6 class="text-uppercase fs-5 ls-2">Related Project
                </h6>
                <p class="mb-0" align='justify'>{{$invoice->project->title}}</p>
              </div>
            </div>
            </div>
            </div>
          </div>
          <div class="col-xl-6 col-lg-12 col-md-12 col-12 mb-6">
            <!-- card -->
            <div class="card">
              <!-- card body -->
              <div class="card-body">
                <!-- card title -->
                <!-- row -->
                <div class="row">
                  <div class="col-12 mb-5">
                    <h6 class="text-uppercase fs-5 ls-2">Issued / Generated By </h6>
                    <p class="mb-0">{{$invoice->generatedBy->fname ? '(Accountant)-'.$invoice->generatedBy->fname : '(Admin)-'.$invoice->generatedBy->name}}</p>
                  </div>
                  <div class="col-6 mb-5">
                    <!-- text -->
                    <h6 class="text-uppercase fs-5 ls-2">Payment Evidence File
                    </h6>
                    @if($invoice->paymentEvidence)
                      <p class="mb-0"> <a class="button" href="{{route('admin.show.payment.evidence',Crypt::encrypt($invoice->id))}}">
                        View Evidence Of Payment</a></p>
                    @else
                      <p class="mb-0" style="color: red;"> Client Yet To Pay</p>
                    @endif
                  </div>
                  <div class="col-6 mb-5">
                    <h6 class="text-uppercase fs-5 ls-2">Date Of Payment</h6>
                    <p class="mb-0" style="color:{{$invoice->paymentDate ? 'green' : 'brown' }}"> <strong> {{$invoice->paymentDate ? $invoice->paymentDate : 'Yet To Pay' }} </strong></p>
                  </div>
                  <div class="col-12">
                    <h6 class="text-uppercase fs-5 ls-2">Payment Confirmed By </h6>
                    @if($invoice->isPayEvidenceApproved && $invoice->paymentEvidence)
                      <p class="mb-0">{{$invoice->paymentConfirmedBy->fname ? '(Accountant)-'.$invoice->generatedBy->fname : '(Admin)-'.$invoice->generatedBy->name}}</p>
                    @else
                      <p class="mb-0">Not Available</p>
                    @endif
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
  </div>
</div>
@endsection