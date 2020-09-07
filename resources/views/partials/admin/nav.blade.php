<nav class="sb-topnav navbar navbar-expand navbar-dark">
        <a class="navbar-brand" href="{{ url('/') }}">eChurch</a>
        <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fa fa-bars fa-lg" aria-hidden="true"></i></button>

        <!-- Navbar-->
        <ul class="navbar-nav ml-auto">
                <li class="nav-item admin-bell-dropdown dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        <span class="fa fa-bell fa-lg">
                            {{-- @php
                                $user = Auth::user() ;
                            @endphp
                                @if(count(adminNotify($user)) > 0) --}}
                                <sup class="text-warning bg-white border-0 rounded" style="margin-left:-10px; padding:2px;">0</sup>
                                {{-- @endif --}}
                        </span>
                        </a> 
                        <div class="dropdown-menu">
                            {{-- @if (adminNotify($user)->count() == 0)
                            <a class="dropdown-item">No Notification(s)</a>
                            @endif
                            @php
                                $k = 0;
                            @endphp
                            @foreach (adminNotify($user) as $order)
                            @php
                                $k++;
                            @endphp
                            <a href="{{ url('order/notification/'.$order->id ) }}" class="dropdown-item text-primary">{{ __('#'.$k . ' View Order status') }}</a>
                            @endforeach --}}
                        </div> 
                </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user fa-fw"></i></a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                @if (Auth::user()->hasRole('admin'))
                <a class="dropdown-item" href="{{ url('/admin/settings') }}">Settings</a>
                <div class="dropdown-divider"></div>
                @endif
                    <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();">
                     {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                     @csrf
                    </form>
                </div>
            </li>
        </ul>
</nav>