@extends('client.layouts.default')

@section('content')
<div class="bg-primary pt-10 pb-21"></div>

<div class="container-fluid mt-n22 px-6">
  <div class="row">
    <div class="col-lg-12 col-md-12 col-12">
      <!-- Page header -->
      <div>
        <div class="d-flex justify-content-between align-items-center">
          <div class="mb-2 mb-lg-0">
            <h3 class="mb-0 fw-bold text-white">CMS</h3>
          </div>
          <div>
            <a href="{{route('client.view.all.project')}}" class="btn btn-white">View Project</a>
          </div>
          <div>
            <a href="{{route('client.view.invoices')}}" class="btn btn-white">View Invoice</a>
          </div>
          <div>
            <a href="{{route('client.view.invoices')}}" class="btn btn-white">View Receipt</a>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-12 col-12 mt-6">
      <!-- card -->
      <div class="card rounded-3">
        <!-- card body -->
        <div class="card-body">
          <!-- heading -->
          <div class="d-flex justify-content-between align-items-center
            mb-3">
            <div>
              <h4 class="mb-0">Projects</h4>
            </div>
            <div class="icon-shape icon-md bg-light-primary text-primary
              rounded-1">
              <i class="bi bi-layers fs-4"></i>
            </div>
          </div>
          <!-- project number -->
          <div>
            <h1 class="fw-bold">{{$project->count()}}</h1>
            <p class="mb-0"><span class="text-dark me-2">{{$project->where('percentageComplete',100)->count()}}</span>Completed</p>
            <p class="mb-0"><span class="text-dark me-2">{{$project->where('percentageComplete','>',1)->where('percentageComplete','<',100)->count()}}</span>In Progress</p>
            <p class="mb-0"><span class="text-dark me-2">{{$project->where('percentageComplete','<',2)->count()}}</span>New</p>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-12 col-12 mt-6">
      <!-- card -->
      <div class="card rounded-3">
        <!-- card body -->
        <div class="card-body">
          <!-- heading -->
          <div class="d-flex justify-content-between align-items-center
            mb-3">
            <div>
              <h4 class="mb-0">Invioce</h4>
            </div>
            <div class="icon-shape icon-md bg-light-primary text-primary
              rounded-1">
              <i class="bi bi-newspaper fs-4"></i>
            </div>
          </div>
          <!-- project number -->
          <div>
            <h1 class="fw-bold">{{$invoices->count()}}</h1>
            <p class="mb-0"><span class="text-dark me-2">{{$invoices->where('dueDate','<', Carbon::now())->count()}}</span>Due Invoice</p>
            <p class="mb-0"><span class="text-dark me-2">{{$invoices->where('dueDate','>=', Carbon::now())->count()}}</span>Undue Invoice</p>
          </div>
        </div>
      </div>

    </div>
    <div class="col-xl-3 col-lg-6 col-md-12 col-12 mt-6">
      <!-- card -->
      <div class="card rounded-3">
        <!-- card body -->
        <div class="card-body">
          <!-- heading -->
          <div class="d-flex justify-content-between align-items-center
            mb-3">
            <div>
              <h4 class="mb-0">Receipt</h4>
            </div>
            <div class="icon-shape icon-md bg-light-primary text-primary
              rounded-1">
              <i class="bi bi-receipt fs-4"></i>
            </div>
          </div>
          <!-- project number -->
          <div>
            <h1 class="fw-bold">{{$invoices->where('isPayEvidenceApproved',1)->count()}}</h1>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-12 col-12 mt-6">
      <!-- card -->
      <div class="card rounded-3">
        <!-- card body -->
        <div class="card-body">
          <!-- heading -->
          <div class="d-flex justify-content-between align-items-center
            mb-3">
            <div>
              <h4 class="mb-0">Amount Spent</h4>
            </div>
            <div class="icon-shape icon-md bg-light-primary text-primary
              rounded-1">
              <i class="bi bi-currency-dollar fs-4"></i>
            </div>
          </div>
          <!-- project number -->
          <div>
            <h1 class="fw-bold">${{number_format($invoices->where('paymentDate','!=', Null)->sum('amountToPay'))}}</h1>
            <p class="mb-0"><span class="text-success me-2">${{number_format($invoices->where('isPayEvidenceApproved',1)->sum('amountToPay'))}}</span>Confirmed Income</p>
            <p class="mb-0"><span class="text-success me-2">${{number_format($invoices->where('paymentDate','!=', Null)->where('isPayEvidenceApproved',0)->sum('amountToPay'))}}</span>Income Awaiting Confirmation</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- row  -->
  <div class="row mt-6">
    <div class="col-md-12 col-12">
      <!-- card  -->
      <div class="card">
        <!-- card header  -->
        <div class="card-header bg-white border-bottom-0 py-4">
          <h4 class="mb-0">Projects</h4>
        </div>
        <!-- table  -->
        <div class="table-responsive" >
          @if(count($project) > 0)
            <table class="table text-nowrap dataTable" id="dataTable">
              <thead class="table-light">
                <tr>
                  {{-- <th>S/N</th> --}}
                  <th>Title</th>
                  <th>Own By</th>
                  <th>Start Date</th>
                  <th>Is Delivered</th>
                  <th>Progress</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($project->slice(0,3) as $key => $item)
                <tr>
                  {{-- <td class="align-middle">{{$key + 1}}</td> --}}
                  <td class="align-middle">
                    <div class="d-flex align-items-center">
                      <div class="ms-3 lh-1">
                        <h5 class="fw-bold mb-1">{{$item->serialNumber}}</h5>
                        <p class="mb-0">{{Str::limit($item->title, 20,'...' )}}</p>
                      </div>
                    </div>
                  </td>
                  <td class="align-middle">
                    <span class="avatar avatar-sm">
                      <img alt="avatar"
                        src="{{asset($item->client->avatar)}}"
                        class="rounded-circle">
                    </span>
                    {{$item->client->username ? $item->client->username : $item->client->fname}}</td>
                  <td class="align-middle">{{$item->startDate->format('d, m Y')}}</td>
                  <td class="align-middle" style="color: {{$item->isDelivered ? 'green' : 'black' }}">{{$item->isDelivered ? 'Delivered' : 'No' }}</td>
                  <td class="align-middle text-dark"><div
                    class="float-start me-3">{{$item->percentageComplete}}%</div>
                  <div class="mt-2">
                    <div class="progress" style="height: 5px;">
                      <div class="progress-bar" role="progressbar"
                        style="width:{{$item->percentageComplete}}%" aria-valuenow="{{$item->percentageComplete}}"
                        aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
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
                          <a class="dropdown-item" href="{{route('client.show.project', Crypt::encrypt($item->id))}}">Show Details</a>
                        </div>
                      </div>
                    </td>
                </tr>
                @endforeach
              </tbody>
            </table> 
          @else
            <p class="bg-white text-center">Projects Not Avalable At The Moment</p>
          @endif
          
        </div>
        <!-- card footer  -->
        <div class="bg-white text-center" style="padding-bottom: 15px; border-bottom-left-radius:5px; border-bottom-right-radius:5px;">
          <a href="{{route('client.view.all.project')}}">View All Projects</a>
        </div>
      </div>

    </div>
  </div>
  <!-- row  -->
  <div class="row my-6">
    <div class="col-xl-4 col-lg-12 col-md-12 col-12 mb-6 mb-xl-0">
      <!-- card  -->
      <div class="card">
        <!-- card body  -->
        <div class="card-body">
          <div class="d-flex align-items-center
            justify-content-between">
            <div>
              <h4 class="mb-0">Team Members</h4>
            </div>
          </div>
          <!-- chart  -->
          <div class="mb-8">
            <div class="table-responsive">
              <table class="table text-nowrap">
                <tbody>
                  <tr>
                    <td class="align-middle">
                      <div class="d-flex align-items-center">
                        <div>
                          <img src="{{asset('defaultAvatar.png')}}"
                            alt="" class="avatar-md avatar rounded-circle">
                        </div>
                        <div class="ms-3 lh-1">
                          <h5 class="fw-bold mb-1">Syed Farrukh Zia UI Hassan</h5>
                          <p class="mb-0">Back End Developer</p>
                        </div>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td class="align-middle">
                      <div class="d-flex align-items-center">
                        <div>
                          <img src="{{asset('defaultAvatar.png')}}"
                            alt="" class="avatar-md avatar rounded-circle">
                        </div>
                        <div class="ms-3 lh-1">
                          <h5 class="fw-bold mb-1">Manzoor UI Haq Mohammed</h5>
                          <p class="mb-0">Front End Engineer</p>
                        </div>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td class="align-middle">
                      <div class="d-flex align-items-center">
                        <div>
                          <img src="{{asset('defaultAvatar.png')}}"
                            alt="" class="avatar-md avatar rounded-circle">
                        </div>
                        <div class="ms-3 lh-1">
                          <h5 class="fw-bold mb-1">Chang Dai</h5>
                          <p class="mb-0">Scrum Master</p>
                        </div>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td class="align-middle">
                      <div class="d-flex align-items-center">
                        <div>
                          <img src="{{asset('defaultAvatar.png')}}"
                            alt="" class="avatar-md avatar rounded-circle">
                        </div>
                        <div class="ms-3 lh-1">
                          <h5 class="fw-bold mb-1">Ferdous Ahmed</h5>
                          <p class="mb-0">Database Administrator</p>
                        </div>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- card  -->
    <div class="col-xl-8 col-lg-12 col-md-12 col-12">
      <div class="card">
        <!-- card header  -->
        <div class="card-header bg-white border-bottom-0 py-4">
          <h4 class="mb-0">Invoices </h4>
        </div>
        <!-- table  -->
        <div class="table-responsive">
          @if(!count($invoices) > 0)
           <p class="bg-white text-center" style="color: brown"> NO INVOICE TO SHOW </p> 
          @else
          <table class="table text-nowrap" id="dataTable" name='dataTable'>
            <thead class="table-light">
              <tr>
                {{-- <th>S/N</th> --}}
                <th>Serial</th>
                <th>Related Project</th>
                {{-- <th>Issued By</th> --}}
                <th>Due Date</th>
                <th>Status</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach ($invoices->slice(0,4) as $key => $item)
                <tr>
                  {{-- <td class="align-middle">{{$key + 1}}</td> --}}
                  <td class="align-middle">{{$item->invoiceSerial}}</td>
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
                          <a class="dropdown-item" href="{{route('client.download.invoice',Crypt::encrypt($item->id))}}">Download Invoice</a>
                          <a class="dropdown-item" href="{{route('client.show.invoice',Crypt::encrypt($item->id))}}">Show Details</a>
                          @if($item->paymentEvidence == NULL)
                            <a class="dropdown-item" href="{{route('client.edit.invoice',Crypt::encrypt($item->id))}}">Make Payment</a>
                          @endif
                        </div>
                      </div>
                    </td>
                </tr>
              @endforeach
            </tbody>
          </table>
          @endif
          <p class="bg-white text-center"> <a href="{{route('client.view.invoices')}}">View All Clients</a> </p>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection