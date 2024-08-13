<nav class="layout-navbar container shadow-none py-0">
    <div class="navbar navbar-expand-lg landing-navbar border-top-0 px-4 px-md-8">
        <!-- Menu logo wrapper: Start -->
        <div class="navbar-brand app-brand demo d-flex py-0 py-lg-2 me-6">
            <!-- Mobile menu toggle: Start-->
            <button class="navbar-toggler border-0 px-0 me-2" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <i class="tf-icons ri-menu-fill ri-24px align-middle"></i>
            </button>
            <a href="{{ route('landing') }}" class="app-brand-link">
                <span class="app-brand-logo demo">
                    <span style="color: #666cff">
                        <svg width="268" height="150" viewBox="0 0 38 20" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M30.0944 2.22569C29.0511 0.444187 26.7508 -0.172113 24.9566 0.849138C23.1623 1.87039 22.5536 4.14247 23.5969 5.92397L30.5368 17.7743C31.5801 19.5558 33.8804 20.1721 35.6746 19.1509C37.4689 18.1296 38.0776 15.8575 37.0343 14.076L30.0944 2.22569Z"
                                fill="currentColor" />
                            <path
                                d="M30.171 2.22569C29.1277 0.444187 26.8274 -0.172113 25.0332 0.849138C23.2389 1.87039 22.6302 4.14247 23.6735 5.92397L30.6134 17.7743C31.6567 19.5558 33.957 20.1721 35.7512 19.1509C37.5455 18.1296 38.1542 15.8575 37.1109 14.076L30.171 2.22569Z"
                                fill="url(#paint0_linear_2989_100980)" fill-opacity="0.4" />
                            <path
                                d="M22.9676 2.22569C24.0109 0.444187 26.3112 -0.172113 28.1054 0.849138C29.8996 1.87039 30.5084 4.14247 29.4651 5.92397L22.5251 17.7743C21.4818 19.5558 19.1816 20.1721 17.3873 19.1509C15.5931 18.1296 14.9843 15.8575 16.0276 14.076L22.9676 2.22569Z"
                                fill="currentColor" />
                            <path
                                d="M14.9558 2.22569C13.9125 0.444187 11.6122 -0.172113 9.818 0.849138C8.02377 1.87039 7.41502 4.14247 8.45833 5.92397L15.3983 17.7743C16.4416 19.5558 18.7418 20.1721 20.5361 19.1509C22.3303 18.1296 22.9391 15.8575 21.8958 14.076L14.9558 2.22569Z"
                                fill="currentColor" />
                            <path
                                d="M14.9558 2.22569C13.9125 0.444187 11.6122 -0.172113 9.818 0.849138C8.02377 1.87039 7.41502 4.14247 8.45833 5.92397L15.3983 17.7743C16.4416 19.5558 18.7418 20.1721 20.5361 19.1509C22.3303 18.1296 22.9391 15.8575 21.8958 14.076L14.9558 2.22569Z"
                                fill="url(#paint1_linear_2989_100980)" fill-opacity="0.4" />
                            <path
                                d="M7.82901 2.22569C8.87231 0.444187 11.1726 -0.172113 12.9668 0.849138C14.7611 1.87039 15.3698 4.14247 14.3265 5.92397L7.38656 17.7743C6.34325 19.5558 4.04298 20.1721 2.24875 19.1509C0.454514 18.1296 -0.154233 15.8575 0.88907 14.076L7.82901 2.22569Z"
                                fill="currentColor" />
                            <defs>
                                <linearGradient id="paint0_linear_2989_100980" x1="5.36642" y1="0.849138"
                                    x2="10.532" y2="24.104" gradientUnits="userSpaceOnUse">
                                    <stop offset="0" stop-opacity="1" />
                                    <stop offset="1" stop-opacity="0" />
                                </linearGradient>
                                <linearGradient id="paint1_linear_2989_100980" x1="5.19475" y1="0.849139"
                                    x2="10.3357" y2="24.1155" gradientUnits="userSpaceOnUse">
                                    <stop offset="0" stop-opacity="1" />
                                    <stop offset="1" stop-opacity="0" />
                                </linearGradient>
                            </defs>
                        </svg>
                    </span>
                </span>
                <span class="app-brand-text demo menu-text fw-semibold ms-2 ps-1">CBT-Online</span>
            </a>
        </div>
        <div class="collapse navbar-collapse landing-nav-menu" id="navbarSupportedContent">
            <button class="navbar-toggler border-0 text-heading position-absolute end-0 top-0 scaleX-n1-rtl"
                type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="tf-icons ri-close-fill"></i>
            </button>
            <ul class="navbar-nav me-auto p-4 p-lg-0">
                <li class="nav-item">
                    <a class="nav-link fw-medium" aria-current="page" href="{{ url('/') }}">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-medium" href="{{ url('/kategori') }}">Kategori</a>
                </li>
            </ul>
        </div>
        <div class="landing-menu-overlay d-lg-none"></div>
        <ul class="navbar-nav flex-row align-items-center ms-auto">
            <!-- Style Switcher -->
            <li class="nav-item dropdown-style-switcher dropdown me-2 me-xl-0">
                <a class="nav-link btn btn-text-secondary rounded-pill btn-icon dropdown-toggle hide-arrow me-sm-4"
                    href="javascript:void(0);" data-bs-toggle="dropdown">
                    <i class="ri-22px text-heading"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-styles">
                    <li>
                        <a class="dropdown-item" href="javascript:void(0);" data-theme="light">
                            <span class="align-middle"><i class="ri-sun-line ri-22px me-3"></i>Light</span>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="javascript:void(0);" data-theme="dark">
                            <span class="align-middle"><i class="ri-moon-clear-line ri-22px me-3"></i>Dark</span>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="javascript:void(0);" data-theme="system">
                            <span class="align-middle"><i class="ri-computer-line ri-22px me-3"></i>System</span>
                        </a>
                    </li>
                </ul>
            </li>
            <!-- / Style Switcher-->

            <!-- navbar button: Start -->
            @if (Auth::check())
                <li>
                    <a href="{{ route('dashboard') }}" class="btn btn-primary px-2 px-sm-4 px-lg-2 px-xl-4"><span
                            class="tf-icons ri-home-4-line me-md-1"></span><span
                            class="d-none d-md-block">Beranda</span></a>
                </li>
                <li>
                    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                        <ul class="navbar-nav flex-row align-items-center ms-auto">
                            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);"
                                    data-bs-toggle="dropdown">
                                    <div class="avatar avatar-online">
                                        <img src="../../assets/img/avatars/1.png" alt class="rounded-circle" />
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="pages-account-settings-account.html">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 me-2">
                                                    <div class="avatar avatar-online">
                                                        <img src="../../assets/img/avatars/1.png" alt
                                                            class="rounded-circle" />
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <span class="fw-medium d-block small">John Doe</span>
                                                    <small class="text-muted">Admin</small>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="d-grid px-4 pt-2 pb-1">
                                            <a class="btn btn-sm btn-danger d-flex" href="{ route('logout') }}"
                                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                <small class="align-middle">Logout</small>
                                                <i class="ri-logout-box-r-line ms-2 ri-16px"></i>
                                            </a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                class="d-none">
                                                @csrf
                                            </form>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </li>
            @else
                <li>
                    <a href="{{ route('login') }}" class="btn btn-primary px-2 px-sm-4 px-lg-2 px-xl-4"><span
                            class="tf-icons ri-user-line me-md-1"></span><span
                            class="d-none d-md-block">Login/Register</span></a>
                </li>
            @endif
            <!-- navbar button: End -->
        </ul>
    </div>
</nav>
