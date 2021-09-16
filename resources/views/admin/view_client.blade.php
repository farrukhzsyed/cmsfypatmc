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
          <h4 class="mb-0"> All Clients </h4>
        </div>
        <!-- table  -->
        @if(count($clients) > 0)
        <div class="table-responsive" style="padding: 10px">
          <table class="table text-nowrap" id="dataTable" name='dataTable'>
            <thead class="table-light">
              <tr>
                <th class="align-middle">S/N</th>
                <th class="align-middle">Name</th>
                <th class="align-middle">Gender</th>
                <th class="align-middle">Contact</th>
                <th class="align-middle">No Of Project</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach ($clients as $key => $item)
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
                <td class="align-middle">{{$item->projects->count()}}</td>
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
                      <a class="dropdown-item" href="{{route('admin.show.client',Crypt::encrypt($item->id))}}">Show Details</a>
                      <a class="dropdown-item" href="{{route('admin.edit.client',Crypt::encrypt($item->id))}}">Edit Details</a>
                      <a class="dropdown-item" href="{{route('admin.delete.client',Crypt::encrypt($item->id))}}"
                          onclick=" return confirm('Note: \n\nAll Projects Related To This Client Will Be Deleted. \n\nAre you sure you want to delete Client data? \n\nClick OK to proceed.');"
                        ><strong style="color: red"> Delete </strong>
                      </a>
                      <a class="dropdown-item" href="{{route('admin.reset.client.password',Crypt::encrypt($item->id))}}"
                        onclick=" return confirm('Note: \n\nThis Client Password Will be Changed to CMS-Client. \n\nClick OK to proceed.');"
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
          <p> <strong> No Client To Show At The Moment </strong> </p>
        @endif
      </div>
    </div>
  </div>
</div>
</div>



{{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#deleteAlert">
  Launch demo modal
</button> --}}
<!-- Modal -->
<div class="modal fade" id="deleteAlert" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete Alert
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

        </button>
      </div>
      <div class="modal-body">
        Note: <br><br>
        All Projects Related To This Client Will Be Deleted. <br><br>
        Are you sure you want to delete Client data?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="deleteButton">Save changes</button>
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
