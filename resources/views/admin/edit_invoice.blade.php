@extends('admin.layouts.default')

@section('content')
      <div class="container-fluid py-12 px-6 px-xl-0">
        <div class="row">
          <div class="offset-xl-1 col-xl-10 col-lg-12 col-md-12 col-sm-12 col-12">
            <!-- Content -->
              <!-- basic-forms -->
              <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                  <div id="basicForm" class="mb-4">
                    <h2>Edit Invoice</h2>
                  <!-- Card -->
                  <div class="card">
                    <!-- Tab content -->
                    <div class="tab-content p-4" id="pills-tabContent-basic-forms">
                      <div class="tab-pane tab-example-design fade show active" id="pills-basic-forms-design" role="tabpanel" aria-labelledby="pills-basic-forms-design-tab">
                        <form method="POST" action="{{ route('admin.update.invoice', Crypt::encrypt($invoice->id)) }}">
                          @csrf
                          <!-- Input -->
                          <div class="mb-3">
                            <label class="form-label" for="textInput">Invoice Number</label>
                            <input type="text" id="invoiceSerial" name="invoiceSerial" class="form-control @error('invoiceSerial') is-invalid @enderror" value="{{$invoice->invoiceSerial}}" readonly>
                            @error('invoiceSerial')
                              <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                              </span>
                            @enderror
                          </div>
                          <div class="mb-3">
                            <label class="form-label" for="selectOne">Project (Client)</label>
                            <select id="projectId" name="projectId" class="form-select @error('projectId') is-invalid @enderror">
                              <option value="" {{old('projectId') == '' ? 'selected' : ''}}>------</option>
                              @foreach ($projects as $item)
                                <option value="{{$item->id}}" {{$invoice->project->id || old('projectId') == $item->id ? 'selected' : ''}}>
                                  {{$item->title}} ({{$item->client->fname}})
                                </option>
                              @endforeach
                            </select>
                            @error('projectId')
                              <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                              </span>
                            @enderror
                          </div>
                          <div class="mb-3">
                            <label class="form-label" for="textInput">Amount To Pay ($)</label>
                            <input type="number" id="amountToPay" name="amountToPay" class="form-control @error('amountToPay') is-invalid @enderror" value="{{$invoice->amountToPay}}" required>
                            @error('amountToPay')
                              <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                              </span>
                            @enderror
                          </div>
                          <div class="mb-3">
                            <label class="form-label" for="textInput">Due Date</label>
                            <input type="date" id="dueDate" name="dueDate" class="form-control @error('dueDate') is-invalid @enderror" 
                                  value="{{old('dueDate') ? old('dueDate'): Carbon\Carbon::parse($invoice->dueDate)->format('Y-m-d')}}" required>
                            @error('dueDate')
                              <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                              </span>
                            @enderror
                          </div>
                        <div class="col-12" align="center">
                            <button class="btn btn-primary" type="submit">Edit Invoice</button>
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
              </div>
              <!-- basic-forms -->
            </div>
          </div>
        </div>
 @endsection     
