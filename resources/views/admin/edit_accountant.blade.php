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
            <h3 class="mb-0 fw-bold">Edit Accountant</h3>
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
          <form action="{{route('admin.update.accountant', Crypt::encrypt($accountant->id))}}" method="POST" enctype="multipart/form-data">
            @csrf
          <div class="card">
            <!-- card body -->
            <div class="card-body">
              <!-- card title -->
              <!-- row -->
              <input type="text" id="accountantId" name="accountantId" value="{{ Crypt::encrypt($accountant->id)}}" hidden >

              <div class="row">
                <div class="col-12 mb-5">
                  <label class="form-label" for="textInput">Full Name</label>
                  <input type="text" id="fname" name="fname" value="{{ old('fname') ? old('fname') : $accountant->fname }}"  class="form-control @error('fname') is-invalid @enderror" placeholder="Student Attendance Automation">
                  @error('fname')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
                <div class="col-6 mb-5">
                  <label class="form-label" for="textInput">Username </label>
                  <input type="text" id="username" name="username" value="{{ old('username') ? old('username') : $accountant->username }}"  class="form-control @error('username') is-invalid @enderror">
                  @error('username')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
                <div class="col-6 mb-5">
                  <label class="form-label" for="textInput">Email</label>
                  <input type="email" id="email" name="email" value="{{ old('email') ? old('email') : $accountant->email }}"  class="form-control @error('email') is-invalid @enderror" placeholder="2001-04-23">
                  @error('email')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
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
                  
                  <div class="col-6 mb-5">
                    <label class="form-label" for="textInput">Phone Number</label>
                    <input type="tel" id="tel" name="tel" value="{{ old('tel') ? old('tel') : $accountant->tel }}"  class="form-control @error('tel') is-invalid @enderror" placeholder="+1 244 388" >
                    @error('tel')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                  <div class="col-6 mb-5">
                    <label class="form-label" for="selectOne">Gender</label>
                    <select id="gender" name="gender" class="form-select @error('gender') is-invalid @enderror">
                      <option value="Male" {{!$accountant->gender == 'Male' ? 'selected' : ''}}>Male</option>
                      <option value="Female" {{$accountant->gender == 'Female' ? 'selected' : ''}}>Female</option>
                    </select>
                    @error('gender')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                  <div class="col-12 mb-5">
                    <label class="form-label" for="textareaInput">Profile Image 
                      <span class="text-secondary"> (.jpg, .png  & .jpeg) optional</span></label>
                    <input type="file" id="avatar" name="avatar" value="{{ old('avatar') ? old('avatar') : ''}}"  class="form-control @error('avatar') is-invalid @enderror">
                    @error('avatar')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-12" align="center">
            <button class="btn btn-primary" type="submit">Submit form</button>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <button class="btn btn-danger" type="reset">Clear</button>
          </div>
        </form>
        </div>
    </div>
  </div>
</div>
@endsection