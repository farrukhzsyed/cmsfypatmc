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
            <h3 class="mb-0 fw-bold">Create New Project</h3>
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
          <form action="{{route('admin.store.project')}}" method="POST" enctype="multipart/form-data">
            @csrf
          <div class="card">
            <!-- card body -->
            <div class="card-body">
              <!-- card title -->
              <!-- row -->
              <div class="row">
                <div class="col-12 mb-5">
                  <label class="form-label" for="textInput">Title</label>
                  <input type="text" id="title" name="title" value="{{ old('title')}}"  class="form-control @error('title') is-invalid @enderror" placeholder="Student Attendance Automation" required>
                  @error('title')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
                <div class="col-12 mb-5">
                  <label class="form-label" for="textInput">Start Date</label>
                  <input type="date" id="startDate" name="startDate" value="{{ old('startDate') }}"  class="form-control @error('startDate') is-invalid @enderror" placeholder="2001-04-23" required>
                  @error('startDate')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
                
                <div class="col-12 mb-5">
                  <label class="form-label" for="textareaInput">Project/Supporting File 
                    <span class="text-secondary"> (.docx, .pdf, .xlxs, .jpg, .png  & .jpeg) optional</span></label>
                  <input type="file" id="projectFile" name="projectFile" value="{{ old('percentageComplete') }}"  class="form-control @error('projectFile') is-invalid @enderror">
                  @error('projectFile')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              
              <div class="col-12 mb-5">
                <label class="form-label" for="textareaInput">Description</label>
                <textarea align="justify" id="description" name="description" class="form-control @error('description') is-invalid @enderror" placeholder="Describe Goal of the Project ..." rows="3" required>{{ old('description') }}</textarea>
                @error('description')
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
                  <div class="col-12 mb-5">
                    <label class="form-label" for="selectOne">Own By</label>
                    <select id="ownBy" name="ownBy" class="form-select @error('ownBy') is-invalid @enderror" required>
                      <option value="">Choose an option</option>
                      @foreach ($clients as $key => $item)
                        <option value="{{$item->id}}">{{$item->fname}} ({{$item->username}})</option>
                      @endforeach
                    </select>
                    @error('ownBy')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                  <div class="col-12 mb-5">
                    <label class="form-label" for="textInput">Status (% Complete)</label>
                    <input type="number" id="percentageComplete" name="percentageComplete" value="{{ old('percentageComplete') }}"  class="form-control @error('percentageComplete') is-invalid @enderror" placeholder="0 - 100" min="0" max="100" required>
                    @error('percentageComplete')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                  <div class="col-12 mb-5">
                    <label class="form-label" for="textareaInput">Requirements</label>
                    <textarea align="justify" id="requirement" name="requirement" class="form-control @error('requirement') is-invalid @enderror" placeholder="List Major Requirement/Features of the project" rows="4" required>{{ old('requirement') }}</textarea>
                    @error('requirement')
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