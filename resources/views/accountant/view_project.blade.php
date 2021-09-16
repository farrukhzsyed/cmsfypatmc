@extends('accountant.layouts.default')

@section('content')
<div class="container-fluid py-12 px-6 px-xl-0">
  <div class="row">
    <div class="offset-xl-1 col-xl-10 col-lg-12 col-md-12 col-sm-12 col-12">
            <!-- card  -->
    <div class="col-xl-12 col-lg-12 col-md-12 col-12">
      <div class="card h-100">
        <!-- card header  -->
        <div class="card-header bg-white border-bottom-0 py-4">
          <h4 class="mb-0"> All Projects </h4>
        </div>
        <!-- table  -->
        <div class="table-responsive" style="padding: 10px;">
          @if(count($project) > 0)
            <table class="table text-nowrap dataTable" id="dataTable">
              <thead class="table-light">
                <tr>
                  <th>S/N</th>
                  <th>Title</th>
                  <th>Own By</th>
                  <th>Start Date</th>
                  <th>Is Delivered</th>
                  <th>Progress</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($project as $key => $item)
                <tr>
                  <td class="align-middle">{{$key + 1}}</td>
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
                        src="{{$item->client->avatar ? asset($item->client->avatar) : asset('defaultAvatar.png') }}"
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
                          <a class="dropdown-item" href="{{route('accountant.show.project', Crypt::encrypt($item->id))}}">Show Details</a>
                        </div>
                      </div>
                    </td>
                </tr>
                @endforeach
              </tbody>
            </table> 
          @else
            <p>Projects Not Avalable At The Moment</p>
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
