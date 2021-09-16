@extends('client.layouts.default')

@section('content')
      <div class="container-fluid py-12 px-6 px-xl-0">
        <div class="row">
          <div class="offset-xl-1 col-xl-10 col-lg-12 col-md-12 col-sm-12 col-12">
            <!-- Content -->
              <!-- basic-forms -->
              <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                  <div id="basicForm" class="mb-4">
                    <h2>Make Payment</h2>
                  <!-- Card -->
                  <div class="card">
                    <!-- Tab content -->
                    <div class="tab-content p-4" id="pills-tabContent-basic-forms">
                      <div class="tab-pane tab-example-design fade show active" id="pills-basic-forms-design" role="tabpanel" aria-labelledby="pills-basic-forms-design-tab">
                        <table class="table">
                          <tr>
                            <td>Serial</td>
                            <td>{{$invoice->invoiceSerial}}</td>
                          </tr>
                          <tr>
                            <td>Amount To Pay</td>
                            <td>{{$invoice->amountToPay}}</td>
                          </tr>
                          <tr>
                            <td>Due Date</td>
                            <td>{{$invoice->dueDate}}</td>
                          </tr>
                          <tr>
                            <td>Related Project</td>
                            <td>{{$invoice->project->title}}</td>
                          </tr>
                        </table> <br><br>
                        <form method="POST" action="{{ route('client.update.invoice', Crypt::encrypt($invoice->id)) }}" enctype="multipart/form-data">
                          @csrf
                          <!-- Input -->
                          <div class="mb-3">
                            <label class="form-label" for="textInput">Evidence Of Payment</label>
                            <input type="file" id="paymentEvidence" name="paymentEvidence" class="form-control @error('paymentEvidence') is-invalid @enderror" required>
                            @error('paymentEvidence')
                              <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                              </span>
                            @enderror
                          </div>
                          
                        <div class="col-12" align="center">
                            <button class="btn btn-primary" type="submit">Upload Evidence Of Payment</button>
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
