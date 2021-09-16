      <!-- navbar vertical -->
       <!-- Sidebar -->
 <nav class="navbar-vertical navbar">
    <div class="nav-scroller">
        <!-- Brand logo -->
        <a class="navbar-brand" href="{{route('accountant.home')}}">
            <img src="{{asset('assets/images/brand/logo/cms.png')}}" alt="" />
        </a>
        <!-- Navbar nav -->
        <ul class="navbar-nav flex-column" id="sideNavbar">
            <li class="nav-item">
                <a class="nav-link has-arrow  active " href="{{route('accountant.home')}}">
                    <i data-feather="home" class="nav-icon icon-xs me-2"></i>  Accountant :: Dashboard
                </a>

            </li>


         <!-- Nav item -->
         <li class="nav-item">
            <div class="navbar-heading">Component</div>
        </li>


             <!-- Nav item -->
             <li class="nav-item">
                <a class="nav-link has-arrow  collapsed " href="#!" data-bs-toggle="collapse" data-bs-target="#navPages" aria-expanded="false" aria-controls="navPages">
                    <i
                    data-feather="users"

                    class="nav-icon icon-xs me-2">
                </i> Clients
                </a>

                <div id="navPages" class="collapse " data-bs-parent="#sideNavbar">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link has-arrow   "  href="{{route('accountant.view.clients')}}" >
                                View All Client
                            </a>
                        </li>
                    </ul>
                </div>

                </li>


                        <!-- Nav item -->
                        <li class="nav-item">
                            <a class="nav-link has-arrow  collapsed " href="#!" data-bs-toggle="collapse" data-bs-target="#navAuthentication" aria-expanded="false" aria-controls="navAuthentication">
                                <i data-feather="layers" class="nav-icon icon-xs me-2">
                                </i> Projects
                            </a>
                            <div id="navAuthentication" class="collapse " data-bs-parent="#sideNavbar">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link  " href="{{route('accountant.view.projects')}}"> View All Project</a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <!-- Nav item -->
                        <li class="nav-item">
                            <a class="nav-link has-arrow  collapsed " href="#!" data-bs-toggle="collapse" data-bs-target="#navSales" aria-expanded="false" aria-controls="navAuthentication">
                                <i data-feather="dollar-sign" class="nav-icon icon-xs me-2">
                                </i> Sales
                            </a>
                            <div id="navSales" class="collapse " data-bs-parent="#sideNavbar">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link " href="{{route('accountant.new.invoice')}}">Add New Invoice</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link " href="{{route('accountant.view.invoices')}}"> View All Invoice</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link  " href="{{route('accountant.view.payments')}}"> View All Payment</a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                                         <!-- Nav item -->
                        <li class="nav-item">
                            <div class="navbar-heading">Authentication</div>
                        </li>
                            <!-- Authentication Links -->
                            @if (Auth::guard('accountant')->guest())
                            <li class="nav-item">
                                <a class="nav-link " href="{{ route('accountant.login') }}"> Login</a>
                            </li>
                        @else
                        <li class="nav-item">
                            <a class="nav-link " href="" data-bs-toggle="modal" data-bs-target="#resetPassword">
                                Reset Password
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('accountant.logout') }}"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('accountant.logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        </li>
                        @endguest
                    </ul>

                </div>
  </nav>