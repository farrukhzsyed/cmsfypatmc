      <!-- navbar vertical -->
       <!-- Sidebar -->
 <nav class="navbar-vertical navbar">
    <div class="nav-scroller">
        <!-- Brand logo -->
        <a class="navbar-brand" href="{{route('client.home')}}">
            <img src="{{asset('assets/images/brand/logo/cms.png')}}" alt="" />
        </a>
        <!-- Navbar nav -->
        <ul class="navbar-nav flex-column" id="sideNavbar">
            <li class="nav-item">
                <a class="nav-link has-arrow  active " href="{{route('client.home')}}">
                    <i data-feather="home" class="nav-icon icon-xs me-2"></i>  Client :: Dashboard
                </a>

            </li>


         <!-- Nav item -->
         <li class="nav-item">
            <div class="navbar-heading">Component</div>
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
                                        <a class="nav-link  " href="{{route('client.view.all.project')}}"> View All Project</a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <!-- Nav item -->
                        <li class="nav-item">
                            <a class="nav-link has-arrow  collapsed " href="#!" data-bs-toggle="collapse" data-bs-target="#navSales" aria-expanded="false" aria-controls="navAuthentication">
                                <i data-feather="dollar-sign" class="nav-icon icon-xs me-2">
                                </i> Transactions
                            </a>
                            <div id="navSales" class="collapse " data-bs-parent="#sideNavbar">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link " href="{{route('client.view.invoices')}}"> View All Invoice</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link  " href="{{route('client.view.payments')}}"> View All Payment</a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                                         <!-- Nav item -->
                        <li class="nav-item">
                            <div class="navbar-heading">Authentication</div>
                        </li>
                            <!-- Authentication Links -->
                            @if (Auth::guard('client')->guest())
                            <li class="nav-item">
                                <a class="nav-link " href="{{ route('client.login') }}"> Login</a>
                            </li>
                        @else
                        <li class="nav-item">
                            <a class="nav-link " href="{{route('client.password.request')}}">
                                Forget Password
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('client.logout') }}"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('client.logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                        @endguest
                    </ul>

                </div>
  </nav>