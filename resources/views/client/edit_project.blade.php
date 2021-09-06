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
            <h3 class="mb-0 fw-bold">Give Project Feedback</h3>
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
          <form action="{{route('client.update.project', Crypt::encrypt($project->id))}}" method="POST">
            @csrf
          <div class="card">
            <!-- card body -->
            <div class="card-body">
              <!-- card title -->
              <!-- row -->
              <div class="row">
                <div class="col-12 mb-5">
                  <label class="form-label" for="textInput">Title</label>
                  <input type="text" id="title" name="title" value="{{ old('title') ? old('title') : $project->title }}"  class="form-control @error('title') is-invalid @enderror" placeholder="Student Attendance Automation" readonly>
                  @error('title')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
                <div class="col-12 mb-5">
                  <label class="form-label" for="textareaInput">Feedback</label>
                  <textarea align="justify" id="feedback" name="feedback" class="form-control @error('feedback') is-invalid @enderror" placeholder="List Major feedback/Features of the project" rows="8">{{ old('feedback') ? old('feedback') : $project->feedback }}
                  </textarea>
                  @error('feedback')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
            </div>
            <div class="col-6" align="center">
              <button class="btn btn-primary" type="submit">Submit Feedback</button>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <button class="btn btn-danger" type="reset">Clear</button>
            </div>
          </form>
            </div>
            </div>
          </div>
          
        </div>
    </div>
  </div>
</div>
@endsection