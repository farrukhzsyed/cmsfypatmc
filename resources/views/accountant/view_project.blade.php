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
        <div class="table-responsive">
          <table class="table text-nowrap">
            <thead class="table-light">
              <tr>
                <th>S/N</th>
                <th>Title</th>
                <th>Own By</th>
                <th>Delivery Date</th>
                <th>Progress</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="align-middle">1</td>
                <td class="align-middle">
                  <div class="d-flex align-items-center">
                    <div class="ms-3 lh-1">
                      <h5 class="fw-bold mb-1">PG126y ID</h5>
                      <p class="mb-0">Automating Studnet Attendance</p>
                    </div>
                  </div>
                </td>
                <td class="align-middle">Smith Welder</td>
                <td class="align-middle">3 May, 2021</td>
                <td class="align-middle text-dark"><div
                  class="float-start me-3">15%</div>
                <div class="mt-2">
                  <div class="progress" style="height: 5px;">
                    <div class="progress-bar" role="progressbar"
                      style="width:15%" aria-valuenow="15"
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
                        <a class="dropdown-item" href="#">Show Details</a>
                        <a class="dropdown-item" href="#">Edit Details</a>
                        <a class="dropdown-item" href="#">Delete</a>
                      </div>
                    </div>
                  </td>
              </tr>
              <tr>
                <td class="align-middle">1</td>
                <td class="align-middle">
                  <div class="d-flex align-items-center">
                    <div class="ms-3 lh-1">
                      <h5 class="fw-bold mb-1">PG126y ID</h5>
                      <p class="mb-0">Automating Studnet Attendance</p>
                    </div>
                  </div>
                </td>
                <td class="align-middle">Smith Welder</td>
                <td class="align-middle">3 May, 2021</td>
                <td class="align-middle text-dark"><div
                  class="float-start me-3">15%</div>
                <div class="mt-2">
                  <div class="progress" style="height: 5px;">
                    <div class="progress-bar" role="progressbar"
                      style="width:15%" aria-valuenow="15"
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
                        <a class="dropdown-item" href="#">Show Details</a>
                        <a class="dropdown-item" href="#">Edit Details</a>
                        <a class="dropdown-item" href="#">Delete</a>
                      </div>
                    </div>
                  </td>
              </tr>
              <tr>
                <td class="align-middle">1</td>
                <td class="align-middle">
                  <div class="d-flex align-items-center">
                    <div class="ms-3 lh-1">
                      <h5 class="fw-bold mb-1">PG126y ID</h5>
                      <p class="mb-0">Automating Studnet Attendance</p>
                    </div>
                  </div>
                </td>
                <td class="align-middle">Smith Welder</td>
                <td class="align-middle">3 May, 2021</td>
                <td class="align-middle text-dark"><div
                  class="float-start me-3">15%</div>
                <div class="mt-2">
                  <div class="progress" style="height: 5px;">
                    <div class="progress-bar" role="progressbar"
                      style="width:15%" aria-valuenow="15"
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
                        <a class="dropdown-item" href="#">Show Details</a>
                        <a class="dropdown-item" href="#">Edit Details</a>
                        <a class="dropdown-item" href="#">Delete</a>
                      </div>
                    </div>
                  </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
 @endsection     
