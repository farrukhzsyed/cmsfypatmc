@extends('client.layouts.default')

@section('content')
<!-- Container fluid -->
<div class="container-fluid px-6 py-4">
  <div class="row">
    <div class="col-lg-12 col-md-12 col-12">
      <!-- Page header -->
      <div>
        <div class="border-bottom pb-4 mb-4 ">
          <div class="mb-2 mb-lg-0">
            <h3 class="mb-0 fw-bold">Project Detail</h3>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row align-items-center">
    <div class="col-xl-12 col-lg-12 col-md-12 col-12">
      <!-- Bg -->
      {{-- <div class="pt-20 rounded-top" style="background:
          url({{asset('assets/images/background/profile-cover.jpg')}}) no-repeat;
          background-size: cover;">
      </div> --}}
      <div class="bg-white rounded-bottom smooth-shadow-sm ">
        <div class="d-flex align-items-center justify-content-between
            pt-4 pb-6 px-4">
          <div class="d-flex align-items-center">
            <div class="col-12">
              <h6 class="text-uppercase fs-5 ls-2">Title </h6>
              <p class="mb-0">{{$project->title}}</p>
            </div>
          </div>
          <div>
            <a href="{{route('client.edit.project', Crypt::encrypt($project->id))}}" class="btn btn-outline-primary
                d-none d-md-block">Give Feedback</a>
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
              {{-- <h4 class="card-title mb-4">About Me</h4> --}}
              <!-- row -->
              <div class="row">
                <div class="col-6 mb-5">
                  <!-- text -->
                  <h6 class="text-uppercase fs-5 ls-2">Serial
                  </h6>
                  <p class="mb-0">{{$project->serial ? $project->serial : 'xxx xx'}}</p>
                </div>
                
                <div class="col-6 mb-5">
                  <h6 class="text-uppercase fs-5 ls-2">Start Date </h6>
                  <p class="mb-0">{{$project->startDate ? $project->startDate->format('D, jS M Y') : 'Not Available'}}</p>
                </div>
                <div class="col-6 mb-5">
                  <h6 class="text-uppercase fs-5 ls-2">Complete Date
                  </h6>
                  <p class="mb-0">{{$project->completeDate ? $project->completeDate->format('D, jS M Y') : 'Not Available'}}</p>
                </div>
                <div class="col-6 mb-5">
                  <h6 class="text-uppercase fs-5 ls-2">Status
                  </h6>
                  <div class="mt-2">
                    {{-- <div class="float-start me-5">{{$project->percentageComplete}}%</div><br> --}}
                    <div class="progress" style="height: 15px;">
                      <div class="progress-bar" role="progressbar"
                        style="width:{{$project->percentageComplete}}%" aria-valuenow="{{$project->percentageComplete}}"
                        aria-valuemin="0" aria-valuemax="100">{{$project->percentageComplete}}%</div>
                    </div>
                  </div>
                  {{-- <p class="mb-0">{{$project->percentageComplete}}</p> --}}
                </div>
              <div class="col-12 mb-5">
                <h6 class="text-uppercase fs-5 ls-2">Requirements
                </h6>
                <p class="mb-0" align='justify'>{{$project->requirement}}</p>
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
                {{-- <h4 class="card-title mb-4">About Me</h4> --}}
                <!-- row -->
                <div class="row">
                  <div class="col-12 mb-5">
                    <!-- text -->
                    <h6 class="text-uppercase fs-5 ls-2">Description
                    </h6>
                    <p class="mb-0" align='justify'>{{$project->description}}</p>
                  </div>
                  <div class="col-6 mb-5">
                    <!-- text -->
                    <h6 class="text-uppercase fs-5 ls-2">Project File
                    </h6>
                    @if($project->projectFile)
                      <p class="mb-0"> <a class="button" href="#">Download File</a></p>
                    @else
                      <p class="mb-0"> Not Available</p>
                    @endif
                  </div>
                  <div class="col-6 mb-5">
                    <h6 class="text-uppercase fs-5 ls-2">Own By</h6>
                    <p class="mb-0">
                      <span class="avatar avatar-sm">
                        <img alt="avatar"
                          src="{{asset($project->client->avatar)}}"
                          class="rounded-circle">
                      </span>
                      {{$project->client->username ? $project->client->username : $project->client->fname  }}</p>
                  </div>
                  <div class="col-6 mb-5">
                    <h6 class="text-uppercase fs-5 ls-2">Delivery Status</h6>
                    <p class="mb-0" style="color:{{$project->isDelivered ? 'green' : 'brown' }}"> <strong> {{$project->isDelivered ? 'Delivered' : 'Not Delivered' }} </strong></p>
                  </div>
                  <div class="col-6 mb-5">
                    <h6 class="text-uppercase fs-5 ls-2">Delivery Date </h6>
                    <p class="mb-0">{{$project->deliveryDate ? $project->deliveryDate->format('D, jS M Y') : 'Not Available'}}</p>
                  </div>
                  <div class="col-12 mb-5">
                    <h6 class="text-uppercase fs-5 ls-2">Feedback
                    </h6>
                    <p class="mb-0">{{$project->feedback ? $project->feedback : 'Not Available'}}</p>
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