@extends('accountant.layouts.default')

@section('content')
<div class="container-fluid py-12 px-6 px-xl-0">
  <div class="row">
    <div class="offset-xl-1 col-xl-10 col-lg-12 col-md-12 col-sm-12 col-12">
            <!-- card  -->
    <div class="col-xl-12 col-lg-12 col-md-12 col-12">
      <div class="card h-100">
        <!-- card header  -->
        <div class="card-header bg-white border-bottom-0 py-4">
          <h4 class="mb-0"> All Invoices </h4>
        </div>
          <!-- table  -->
        <div class="table-responsive" style="padding: 10px">
          @if(!count($invoices) > 0)
            <h4 style="color: brown"> NO INVOICE TO SHOW</h4>
          @else
          <table class="table text-nowrap" id="dataTable" name='dataTable'>
            <thead class="table-light">
              <tr>
                <th>S/N</th>
                <th>Serial</th>
                <th>Issued To</th>
                <th>Related Project</th>
                {{-- <th>Issued By</th> --}}
                <th>Due Date</th>
                <th>Status</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach ($invoices as $key => $item)
                <tr>
                  <td class="align-middle">{{$key + 1}}</td>
                  <td class="align-middle">{{$item->invoiceSerial}}</td>
                  <td class="align-middle">{{Str::limit($item->client->fname, 10,'...' )}}</td>
                  <td class="align-middle">{{Str::limit($item->project->title, 20,'...' )}}</td>
                  {{-- <td class="align-middle">{{$item->generatedBy->fname ? '(Acc)-'.Str::limit($item->generatedBy->fname, 7,'...' ) : '(Adm)-'.Str::limit($item->generatedBy->name, 7,'...' )}}</td> --}}
                  <td class="align-middle">{{Carbon\Carbon::parse($item->dueDate)->diffForHumans()}}</td>
                  <td class="align-middle" style="color: {{!$item->paymentEvidence ? 'red' : 
                            ($item->isPayEvidenceApproved && $item->paymentEvidence? 'green' : 'brown') }}">
                    <strong> 
                      {{
                        !$item->paymentEvidence ? 
                        'UNPAID' : 
                        ($item->isPayEvidenceApproved && $item->paymentEvidence ? 'Paid & Confirmed' : 'Awaiting Confirmation')
                      }}
                    </strong>
                  </td>
                  <td class="align-middle">
                      <div class="dropdown dropstart">
                        <a class="text-muted text-primary-hover" href="#"
                          role="button" id="dropdownTeamOne"
                          data-bs-toggle="dropdown" aria-haspopup="true"
                          aria-expanded="false">
                          <i class="icon-xxs" data-feather="more-vertical"></i>
                        </a>
                        <div class="dropdown-menu"
                          aria-labelledby="dropdownTeamOne">
                          <a class="dropdown-item" href="{{route('accountant.download.invoice',Crypt::encrypt($item->id))}}">Download</a>
                          <a class="dropdown-item" href="{{route('accountant.show.invoice',Crypt::encrypt($item->id))}}">Show Details</a>
                          @if(!($item->isPayEvidenceApproved && $item->paymentEvidence))
                            @if(!$item->isPayEvidenceApproved && $item->paymentEvidence )
                              <a class="dropdown-item" href="{{route('accountant.confirm.payment.invoice',Crypt::encrypt($item->id))}}">
                                Confirm Payment
                              </a>
                            @else
                              <a class="dropdown-item" href="{{route('accountant.edit.invoice',Crypt::encrypt($item->id))}}">
                                Edit Details
                              </a>
                            @endif
                          @endif 
                          <a class="dropdown-item" href="{{route('accountant.delete.invoice',Crypt::encrypt($item->id))}}" style="color:red;">Delete</a>
                        </div>
                      </div>
                    </td>
                </tr>
              @endforeach
            </tbody>
          </table>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>
</div>
 @endsection     

 @section('bottom_script')
 <script>
  $(document).ready(function() {
    $('#dataTable').DataTable();
    });
  </script>
 @endsection

