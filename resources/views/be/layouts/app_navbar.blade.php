<header class="app-header">
    <nav class="navbar navbar-expand-lg navbar-light">
        <ul class="navbar-nav align-items-center w-100">
            <li class="nav-item d-block d-xl-none">
                <a class="nav-link sidebartoggler " id="headerCollapse" href="javascript:void(0)">
                    <i class="ti ti-menu-2"></i>
                </a>
            </li>
            <li class="nav-item">
                <h6 class="text-dark fw-bold mb-0">
                    {{-- <span class="text-capitalize">Hello, {{ Session::get('user_session')['username'] }}</span> --}}
                    <span class="text-capitalize">{{ $dateNow }}</span>
                </h6>
            </li>
            {{-- <li class="nav-item">
                <a class="nav-link " href="javascript:void(0)">
                    <iconify-icon icon="solar:bell-linear" class="fs-6"></iconify-icon>
                    <div class="notification bg-primary rounded-circle"></div>
                </a>
            </li> --}}
        </ul>
        <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
                <li class="nav-item dropdown">
                    <a class="dropdown-toggle text-capitalize btn btn-light fw-semibold border" href="#"
                        id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        @php
                            $arrName = explode(' ', $username);
                            $name = '';
                            if (count($arrName) > 1) {
                                $name = $arrName[0] . ' ' . $arrName[1];
                            } else {
                                $name = $arrName[0];
                            }
                            echo $name;
                        @endphp
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                        <div class="message-body">
                            @php
                                $userId = Session::get('user_session')['user_id'];
                            @endphp
                            <a href="javascript:void(0)" onclick="showDetail({{ $userId }})"
                                class="d-flex align-items-center gap-2 dropdown-item">
                                <i class="ti ti-user fs-6"></i>
                                <p class="mb-0 fs-3">My Profile</p>
                            </a>
                            <a href="{{ route('auth.act_logout') }}"
                                class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</header>

@push('js')
    <script>
        function showDetail(id) {
            window.location.replace("{{ route('be.petugas.act_show') }}" + "/" + btoa(id));
        }
    </script>
@endpush
