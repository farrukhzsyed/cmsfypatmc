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
            <h3 class="mb-0 fw-bold">Edit Project</h3>
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
          <form action="{{route('admin.update.project', Crypt::encrypt($project->id))}}" method="POST" enctype="multipart/form-data">
            @csrf
          <div class="card">
            <!-- card body -->
            <div class="card-body">
              <!-- card title -->
              <!-- row -->
              <div class="row">
                <div class="col-12 mb-5">
                  <label class="form-label" for="textInput">Title</label>
                  <input type="text" id="title" name="title" value="{{ old('title') ? old('title') : $project->title }}"  class="form-control @error('title') is-invalid @enderror" placeholder="Student Attendance Automation">
                  @error('title')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
                <div class="col-6 mb-5">
                  <label class="form-label" for="textInput">Serial </label>
                  <input type="text" id="serial" name="serial" value="{{ old('serial') ? old('serial') : $project->serial }}"  class="form-control @error('serial') is-invalid @enderror" readonly>
                  @error('serial')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
                <div class="col-6 mb-5">
                  <label class="form-label" for="textInput">Start Date</label>
                  <input type="date" id="startDate" name="startDate" value="{{ old('startDate') ? old('startDate') : ($project->startDate ? $project->startDate->format('Y-m-d'):'') }}"  class="form-control @error('startDate') is-invalid @enderror" placeholder="2001-04-23">
                  @error('startDate')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
                <div class="col-12 mb-5">
                  <label class="form-label" for="selectOne">Own By</label>
                  <select id="ownBy" name="ownBy" class="form-select @error('ownBy') is-invalid @enderror">
                    <option value="">Choose an option</option>
                    @foreach ($clients as $key => $item)
                      <option value="{{$item->id}}" {{$item->id == $project->ownBy ? 'selected' : ''}}>{{$item->fname}} ({{$item->username}})</option>
                    @endforeach
                  </select>
                  @error('ownBy')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
                <div class="col-12 mb-5">
                  <label class="form-label" for="textareaInput">Project/Supporting File 
                    <span class="text-secondary"> (.docx, .pdf, .xlxs, .jpg, .png  & .jpeg) optional</span></label>
                  <input type="file" id="projectFile" name="projectFile" value="{{ old('percentageComplete') ? old('percentageComplete') : $project->percentageComplete }}"  class="form-control @error('projectFile') is-invalid @enderror">
                  @error('projectFile')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              
              <div class="col-12 mb-5">
                <label class="form-label" for="textareaInput">Description</label>
                <textarea align="justify" id="description" name="description" class="form-control @error('description') is-invalid @enderror" placeholder="Describe Goal of the Project ..." rows="3">{{ old('description') ? old('description') : $project->description }}
                </textarea>
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
                  
                  <div class="col-6 mb-5">
                    <label class="form-label" for="textInput">Status (% Complete)</label>
                    <input type="number" id="percentageComplete" name="percentageComplete" value="{{ old('percentageComplete') ? old('percentageComplete') : $project->percentageComplete }}"  class="form-control @error('percentageComplete') is-invalid @enderror" placeholder="0 - 100" min="0" max="100">
                    @error('percentageComplete')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                  <div class="col-6 mb-5">
                    <label class="form-label" for="selectOne">Is Project Delivered To Client?</label>
                    <select id="isDelivered" name="isDelivered" class="form-select @error('isDelivered') is-invalid @enderror">
                      <option value="0" {{!$project->isDelivered ? 'selected' : ''}}>No</option>
                      <option value="1" {{$project->isDelivered ? 'selected' : ''}}>Yes</option>
                    </select>
                    @error('isDelivered')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                  <div class="col-12 mb-5">
                    <label class="form-label" for="textInput">Completed Date <span class="text-secondary">(optional)</span></label>
                    <input type="date" id="completeDate" name="completeDate" value="{{ old('completeDate') ? old('completeDate') : ($project->completeDate ? $project->completeDate->format('Y-m-d') : '') }}"  class="form-control @error('completeDate') is-invalid @enderror" placeholder="05/04/2001">
                    @error('completeDate')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                  <div class="col-12 mb-5">
                    <label class="form-label" for="textInput">Delivery Date <span class="text-secondary">(optional)</span></label>
                    <input type="date" id="deliveryDate" name="deliveryDate" value="{{ old('deliveryDate') ? old('deliveryDate') : ($project->deliveryDate ? $project->deliveryDate->format('Y-m-d') : '') }}"  class="form-control @error('deliveryDate') is-invalid @enderror" placeholder="05/04/2001">
                    @error('deliveryDate')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>

                  <div class="col-12 mb-5">
                    <label class="form-label" for="textareaInput">Requirements</label>
                    <textarea align="justify" id="requirement" name="requirement" class="form-control @error('requirement') is-invalid @enderror" placeholder="List Major Requirement/Features of the project" rows="4">{{ old('requirement') ? old('requirement') : $project->requirement }}
                    </textarea>
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