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
          <h4 class="mb-0"> All Accountant </h4>
        </div>
        <!-- table  -->
        @if(count($accountants) > 0)
        <div class="table-responsive" style="padding: 10px">
          <table class="table text-nowrap" id="dataTable" name='dataTable'>
            <thead class="table-light">
              <tr>
                <th class="align-middle">S/N</th>
                <th class="align-middle">Name</th>
                <th class="align-middle">Gender</th>
                <th class="align-middle">Contact</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach ($accountants as $key => $item)
              <tr>
                <td class="align-middle">{{$key + 1}}</td>
                <td class="align-middle">
                  <div class="d-flex align-items-center">
                    <div>
                      <img src="{{$item->avatar ? asset($item->avatar) : asset('defaultAvatar.png')}}"
                        alt="" class="avatar-md avatar rounded-circle">
                    </div>
                    <div class="ms-3 lh-1">
                      <h5 class="fw-bold mb-1">{{$item->fname}}</h5>
                      <p class="mb-0">{{$item->email}}</p>
                    </div>
                  </div>
                </td>
                <td class="align-middle">{{$item->gender}}</td>
                <td class="align-middle">{{$item->tel}}</td>
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
                      <a class="dropdown-item" href="{{route('admin.show.accountant',Crypt::encrypt($item->id))}}">Show Details</a>
                      <a class="dropdown-item" href="{{route('admin.edit.accountant',Crypt::encrypt($item->id))}}">Edit Details</a>
                      <a class="dropdown-item" href="{{route('admin.delete.accountant',Crypt::encrypt($item->id))}}"
                          onclick=" return confirm('\n\nAre you sure you want to delete Accountant data? \n\nClick OK to proceed.');">
                          <strong style="color: red"> Delete </strong>
                      </a>
                      <a class="dropdown-item" href="{{route('admin.reset.accountant.password',Crypt::encrypt($item->id))}}"
                        onclick=" return confirm('Note: \n\nThis Accountant Password Will be Changed to CMS-Accountant. \n\nClick OK to proceed.');"
                      ><strong style="color:brown"> Reset Password </strong>
                    </a>
                    </div>
                  </div>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        @else
          <p> <strong> No Accountant To Show At The Moment </strong> </p>
        @endif
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
