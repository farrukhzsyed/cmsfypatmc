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
            <h3 class="mb-0 fw-bold">Accountant Detail</h3>
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
              <h6 class="text-uppercase fs-5 ls-2">Full Name </h6>
              <div class="d-flex align-items-center">
                <div>
                  <img src="{{asset($accountant->avatar)}}"
                    alt="" class="avatar-md avatar rounded-circle">
                </div>
                <div class="ms-3 lh-1">
                  <h5 class="fw-bold mb-1">{{$accountant->fname}}</h5>
                </div>
              </div>
            </div>
          </div>
          <div>
            <a href="{{route('admin.edit.accountant', Crypt::encrypt($accountant->id))}}" class="btn btn-outline-primary
                d-none d-md-block">Edit Accountant</a>
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
                  <h6 class="text-uppercase fs-5 ls-2">Username
                  </h6>
                  <p class="mb-0">{{$accountant->username ? $accountant->username : 'xxx xx'}}</p>
                </div>
                <div class="col-6 mb-5">
                  <!-- text -->
                  <h6 class="text-uppercase fs-5 ls-2">Gender
                  </h6>
                  <p class="mb-0" align='justify'>{{$accountant->gender}}</p>
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
                  <div class="col-6 mb-5">
                    <h6 class="text-uppercase fs-5 ls-2">Email </h6>
                    <p class="mb-0">{{$accountant->email ? $accountant->email : 'Not Available'}}</p>
                  </div>
                  <div class="col-6 mb-5">
                    <h6 class="text-uppercase fs-5 ls-2">Phone Number
                    </h6>
                    <p class="mb-0">{{$accountant->tel ? $accountant->tel : 'Not Available'}}</p>
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