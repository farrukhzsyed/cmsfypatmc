@extends('admin.layouts.default')

@section('content')
<div class="container-fluid py-12 px-6 px-xl-0">
  <div class="row">
    <div class="offset-xl-1 col-xl-10 col-lg-12 col-md-12 col-sm-12 col-12">
            <!-- card  -->
    <div class="col-xl-12 col-lg-12 col-md-12 col-12">
      <div class="card h-100">
        <!-- card header  -->
        <div class="card-header bg-white border-bottom-0 py-4">
          <h4 class="mb-0"> All Payments </h4>
        </div>
          <!-- table  -->
        <div class="table-responsive" style="padding: 10px">
          @if(!count($payments) > 0)
            <h4 style="color: brown"> NO PAYMENTS TO SHOW</h4>
          @else
          <table class="table text-nowrap" id="dataTable" name='dataTable'>
            <thead class="table-light">
              <tr>
                <th>S/N</th>
                <th>Serial</th>
                <th>Paid By</th>
                <th>Related Project</th>
                <th>Amount Paid</th>
                <th>Payment Date</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach ($payments as $key => $item)
                <tr>
                  <td class="align-middle">{{$key + 1}}</td>
                  <td class="align-middle">{{$item->invoiceSerial}}</td>
                  <td class="align-middle">{{Str::limit($item->client->fname, 10,'...' )}}</td>
                  <td class="align-middle">{{Str::limit($item->project->title, 20,'...' )}}</td>
                  <td class="align-middle">${{$item->amountToPay}}</td>
                  <td class="align-middle">{{$item->paymentDate}}</td>
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
                          <a class="dropdown-item" href="{{route('admin.download.payment',Crypt::encrypt($item->id))}}">Download</a>
                          <a class="dropdown-item" href="{{route('admin.delete.payment',Crypt::encrypt($item->id))}}" style="color:red;">Delete</a>
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

