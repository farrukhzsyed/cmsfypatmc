      <!-- navbar vertical -->
       <!-- Sidebar -->
 <nav class="navbar-vertical navbar">
    <div class="nav-scroller">
        <!-- Brand logo -->
        <a class="navbar-brand" href="{{route('admin.home')}}">
            <img src="{{asset('assets/images/brand/logo/cms.png')}}" alt="" />
        </a>
        <!-- Navbar nav -->
        <ul class="navbar-nav flex-column" id="sideNavbar">
            <li class="nav-item">
                <a class="nav-link has-arrow  active " href="{{route('admin.home')}}">
                    <i data-feather="home" class="nav-icon icon-xs me-2"></i>  Admin :: Dashboard
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
                            <a class="nav-link " href="{{route('admin.new.client')}}">
                                Add New Client
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link has-arrow   "  href="{{route('admin.view.clients')}}" >
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
                                        <a class="nav-link " href="{{route('admin.new.project')}}"> Add New Project</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link  " href="{{route('admin.view.all.project')}}"> View All Project</a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <!-- Nav item -->
                        <li class="nav-item">
                            <a class="nav-link has-arrow  collapsed " href="#!" data-bs-toggle="collapse" data-bs-target="#navAccountant" aria-expanded="false" aria-controls="navAuthentication">
                                <i data-feather="user" class="nav-icon icon-xs me-2">
                                </i> Accountant
                            </a>
                            <div id="navAccountant" class="collapse " data-bs-parent="#sideNavbar">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link " href="{{route('admin.new.accountant')}}"> Add New Accountant</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link  " href="{{route('admin.view.accountants')}}">  View All Accountant</a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <!-- Nav item -->
                        <li class="nav-item">
                            <a class="nav-link has-arrow  collapsed " href="#!" data-bs-toggle="collapse" data-bs-target="#sales" aria-expanded="false" aria-controls="navAuthentication">
                                <i data-feather="dollar-sign" class="nav-icon icon-xs me-2">
                                </i> Sales
                            </a>
                            <div id="sales" class="collapse " data-bs-parent="#sideNavbar">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link " href="{{route('admin.new.invoice')}}">Add New Invoices</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link " href="{{route('admin.view.invoices')}}">View All Invoices</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link " href="{{route('admin.view.payments')}}">View All Payments</a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <!-- Nav item -->
                        <li class="nav-item">
                            <div class="navbar-heading">Authentication</div>
                        </li>
                            <!-- Authentication Links -->
                        @if (Auth::guard('admin')->guest())
                            <li class="nav-item">
                                <a class="nav-link " href="{{ route('admin.login') }}"> Login</a>
                            </li>
                            @if (Route::has('admin.register'))
                                <li class="nav-item">
                                    <a class="nav-link " href="{{ route('admin.register') }}"> Add New Admin User</a>
                                </li>
                            @endif
                        @else
                        <li class="nav-item">
                            <a class="nav-link " href="" data-bs-toggle="modal" data-bs-target="#resetPassword">
                                Reset Password
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.logout') }}"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        </li>
                        @endguest
                    </ul>

                </div>
  </nav>