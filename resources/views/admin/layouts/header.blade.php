<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    
    <title>@yield('title')</title>

    @include('admin.layouts.css')

    @yield('page_css')

</head>
<body class="nav-md">
<header id="header" class="header fixed-top">
    <nav class="border-b border-gray-100">
        <!-- Primary Navigation Menu -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <!-- Logo -->
                    <div class="d-flex align-items-center justify-content-between">
                        <a href="/" class="logo d-flex align-items-center">
                            <img src="/assets/back/img/Icon.png" alt="Logo" />
                            <span class="d-none d-lg-block">AlgoLock</span>
                        </a>
                        <i class="bi bi-list toggle-sidebar-btn"></i>
                    </div>
                    <!-- End of Logo -->
                </div>
                <!-- Settings Dropdown -->
                <nav class="header-nav ms-auto mt-2">
                    <ul class="d-flex align-items-center">
                        <!-- End of Messages Navigation -->
                        <nav class="header-nav ms-auto">
                            <div class="hidden sm:flex sm:items-center sm:ms-6">
                                <div class="dropdown">
                                    <button class="btn btn-white dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                        <div>User Name</div>
                                        <div class="ms-1">
                                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                        <li><a class="dropdown-item" href="#">Profile</a></li>
                                        <li><hr class="dropdown-divider"></li>
                                        
                                    </ul>
                                </div>
                            </div>
                            <!-- Hamburger -->
                            <div class="-me-2 flex items-center sm:hidden">
                                <button class="btn" type="button" data-bs-toggle="collapse" data-bs-target="#mobileMenu" aria-expanded="false" aria-controls="mobileMenu">
                                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                        <path class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                        <path class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                        </nav>
                    </ul>
                </nav>
            </div>
        </div>
    </nav>
</header>
