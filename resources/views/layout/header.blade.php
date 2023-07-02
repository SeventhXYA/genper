<nav class="navbar">
    <a href="#" class="sidebar-toggler">
        <i data-feather="menu"></i>
    </a>
    <div class="navbar-content">
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="wd-30 ht-30 rounded-circle" src="{{ asset('assets/images/user.png') }}" alt="profile">
                </a>
                <div class="dropdown-menu p-0" aria-labelledby="profileDropdown">
                    <div class="d-flex flex-column align-items-center border-bottom px-5 py-3">
                        <div class="mb-3">
                            <img class="wd-80 ht-80 rounded-circle" src="{{ asset('assets/images/user.png') }}"
                                alt="">
                        </div>
                        <div class="text-center">
                            @if (Auth::guard('divisi')->user())
                                <p class="tx-16 fw-bolder">{{ Auth::guard('divisi')->user()->divisi->divisi }}</p>
                                <p class="tx-12 text-muted">{{ Auth::guard('divisi')->user()->divisi->divisi }}</p>
                            @elseif(Auth::user())
                                <p class="tx-16 fw-bolder">
                                    {{ auth()->user()->nm_depan }} {{ auth()->user()->nm_belakang }}</p>
                                <p class="tx-12 text-muted">{{ auth()->user()->email }}</p>
                            @endif
                        </div>
                    </div>
                    <ul class="list-unstyled p-1">
                        @if (Auth::guard('divisi')->user())
                            <form id="myForm" action={{ route('logout') }} method="POST">
                                @csrf
                                <button type="submit" style="display: none;">
                                </button>
                            </form>
                            <li class="dropdown-item py-2">
                                <a href="#" class="text-body ms-0" style="padding-right:100%"
                                    onclick="event.preventDefault(); document.getElementById('myForm').submit();">
                                    <i class="me-2 icon-md" data-feather="log-out"></i>
                                    <span>Log Out</span>
                                </a>
                            </li>
                        @elseif(Auth::user())
                            <li class="dropdown-item py-2">
                                <a href="{{ url('/profile') }}" class="text-body ms-0">
                                    <i class="me-2 icon-md" data-feather="user"></i>
                                    <span>Profile</span>
                                </a>
                            </li>
                            <li class="dropdown-item py-2">
                                <a href="{{ url('/profile/edit') }}" class="text-body ms-0">
                                    <i class="me-2 icon-md" data-feather="edit"></i>
                                    <span>Edit Profile</span>
                                </a>
                            </li>
                            <form id="myForm" action={{ route('logout') }} method="POST">
                                @csrf
                                <button type="submit" style="display: none;">
                                </button>
                            </form>
                            <li class="dropdown-item py-2">
                                <a href="#" class="text-body ms-0" style="padding-right:100%"
                                    onclick="event.preventDefault(); document.getElementById('myForm').submit();">
                                    <i class="me-2 icon-md" data-feather="log-out"></i>
                                    <span>Log Out</span>
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</nav>
