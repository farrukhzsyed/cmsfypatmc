<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Favicon icon-->
{{-- <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/images/favicon/favicon.ico')}}"> --}}
<link rel="apple-touch-icon" sizes="180x180" href="{{asset('assets/images/favicon/apple-touch-icon.png')}}">
<link rel="icon" type="image/png" sizes="32x32" href="{{asset('assets/images/favicon/favicon-32x32.png')}}">
<link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/images/favicon/favicon-16x16.png')}}">
<link rel="manifest" href="{{asset('assets/images/favicon/site.webmanifest')}}">

<!-- Libs CSS -->

<link rel="stylesheet" href="{{asset('assets/libs/prismjs/themes/prism.css')}}">
<link rel="stylesheet" href="{{asset('assets/libs/prismjs/plugins/line-numbers/prism-line-numbers.css')}}">
<link rel="stylesheet" href="{{asset('assets/libs/prismjs/plugins/toolbar/prism-toolbar.css')}}">
<link rel="stylesheet" href="{{asset('assets/libs/bootstrap-icons/font/bootstrap-icons.css')}}">
<link rel="stylesheet" href="{{asset('assets/libs/dropzone/dist/dropzone.css')}}">
<link rel="stylesheet" href="{{asset('assets/libs/@mdi/font/css/materialdesignicons.min.css')}}">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.0/normalize.css">

<!-- Theme CSS -->
<link rel="stylesheet" href="{{asset('assets/css/theme.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/dataTables.bootstrap5.min.css')}}">

  @yield('top_style')

  @yield('top_script')

<title>@yield('title', 'Client')</title>
  </head>

  <body>
    <div id="db-wrapper">
      <!-- navbar vertical -->
       <!-- Sidebar -->
      @include('client.layouts.side_nav')

       <!-- Page content -->
      <div id="page-content">
        <div class="header @@classList">
          <!-- navbar -->
          @include('client.layouts.search_and _user')
        </div>
        <!-- Container fluid -->
        @yield('content')
      </div>
    </div>

<!-- Modal -->
<div class="modal fade" id="resetPassword" tabindex="-1" role="dialog" aria-labelledby="resetPasswordTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="resetPasswordTitle">CHANGE PASSWORD</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
          {{-- <span aria-hidden="true">&times;</span> --}}
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{route('client.reset.password')}}">
          @csrf
            {{-- <div class="form-group row">
              <label for="oldPassword" class="col-md-4 col-form-label text-md-right">{{ __('Old Password') }}</label>

              <div class="col-md-6">
                  <input id="oldPassword" type="password" class="form-control @error('oldPassword') is-invalid @enderror" name="oldPassword" required>

                  @error('oldPassword')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
              </div>
          </div>
            <br> --}}
          <div class="form-group row">
            <label for="newPassword" class="col-md-4 col-form-label text-md-right">{{ __('New Password') }}</label>

            <div class="col-md-6">
                <input id="newPassword" type="password" class="form-control @error('newPassword') is-invalid @enderror" name="newPassword" required>

                @error('newPassword')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
          <br>
          <div class="form-group row">
            <label for="password_confirmation" class="col-md-4 col-form-label text-md-right">{{ __('Confirm New Password') }}</label>

            <div class="col-md-6">
              <input id="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" required>
              @error('password_confirmation')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="reset" class="btn btn-secondary">Clear</button>

        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </form>

  </div>
</div>

    <!-- Scripts -->
    <!-- Libs JS -->
<script src="{{asset('assets/libs/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/libs/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<script src="{{asset('assets/libs/feather-icons/dist/feather.min.js')}}"></script>
<script src="{{asset('assets/libs/prismjs/components/prism-core.min.js')}}"></script>
<script src="{{asset('assets/libs/prismjs/components/prism-markup.min.js')}}"></script>
<script src="{{asset('assets/libs/prismjs/plugins/line-numbers/prism-line-numbers.min.js')}}"></script>
<script src="{{asset('assets/libs/apexcharts/dist/apexcharts.min.js')}}"></script>
<script src="{{asset('assets/libs/dropzone/dist/min/dropzone.min.js')}}"></script>

<!-- clipboard -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.5.12/clipboard.min.js"></script>

<!-- Theme JS -->
<script src="{{asset('assets/js/theme.min.js')}}"></script>

<script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/dataTables.bootstrap5.min.js')}}"></script>

  @yield('bottom_script')

</body>

</html>