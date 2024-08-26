<!DOCTYPE html>
<!--
Template Name: NobleUI - Admin & Dashboard Template
Author: NobleUI
Website: https://www.nobleui.com
Contact: nobleui123@gmail.com
Purchase: https://1.envato.market/nobleui_admin
License: You must have a valid license purchased only from above link or https://themeforest.net/user/nobleui/portfolio/ in order to legally use the theme for your project.
-->
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>NobleUI Responsive Bootstrap 4 Dashboard Template</title>
    <!-- core:css -->
    <link rel="stylesheet" href="{{ asset('backend') }}/assets/vendors/core/core.css">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <link rel="stylesheet"
        href="{{ asset('backend') }}/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css">
    <!-- end plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('backend') }}/assets/fonts/feather-font/css/iconfont.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('backend') }}/assets/css/demo_1/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{ asset('backend') }}/assets/images/favicon.png" />

    {{-- selectize jquery --}}
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.13.3/css/selectize.default.min.css">

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
</head>

<body>
    <div class="main-wrapper">

        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar">
            <div class="sidebar-header">
                <a href="#" class="sidebar-brand">
                    Noble<span>UI</span>
                </a>
                <div class="sidebar-toggler not-active">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
            <div class="sidebar-body">
                <ul class="nav">
                    <li class="nav-item nav-category">Main</li>
                    <li class="nav-item">
                        <a href="{{ route('dashboard') }}" class="nav-link">
                            <i class="link-icon" data-feather="box"></i>
                            <span class="link-title">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item nav-category">web apps</li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#emails" role="button" aria-expanded="false"
                            aria-controls="emails">
                            <i class="link-icon" data-feather="mail"></i>
                            <span class="link-title">User</span>
                            <i class="link-arrow" data-feather="chevron-down"></i>
                        </a>
                        <div class="collapse" id="emails">
                            <ul class="nav sub-menu">
                                <li class="nav-item">
                                    <a href="{{ route('user.list') }}" class="nav-link">User List</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a href="pages/apps/chat.html" class="nav-link">
                            <i class="link-icon" data-feather="message-square"></i>
                            <span class="link-title">Chat</span>
                        </a>
                    </li>
                    <li class="nav-item nav-category">Components</li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#uiComponents" role="button"
                            aria-expanded="false" aria-controls="uiComponents">
                            <i class="link-icon" data-feather="feather"></i>
                            <span class="link-title">Category</span>
                            <i class="link-arrow" data-feather="chevron-down"></i>
                        </a>
                        <div class="collapse" id="uiComponents">
                            <ul class="nav sub-menu">
                                <li class="nav-item">
                                    <a href="{{ route('category') }}" class="nav-link">Add Category</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('sub.category') }}" class="nav-link">Add Sub Category</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('category.trash') }}" class="nav-link">Category Trash</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#advancedUI" role="button"
                            aria-expanded="false" aria-controls="advancedUI">
                            <i class="link-icon" data-feather="anchor"></i>
                            <span class="link-title">Products</span>
                            <i class="link-arrow" data-feather="chevron-down"></i>
                        </a>
                        <div class="collapse" id="advancedUI">
                            <ul class="nav sub-menu">
                                <li class="nav-item">
                                    <a href="{{ route('brand') }}" class="nav-link">Brand</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('add.product') }}" class="nav-link">Add New Product</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('product.list') }}" class="nav-link">Product List</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('variation') }}" class="nav-link">Variation</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('coupon') }}">
                            <i class="link-icon" data-feather="inbox"></i>
                            <span class="link-title">Coupon</span>
                            <i class="link-arrow" data-feather="chevron-down"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#orders" role="button"
                            aria-expanded="false" aria-controls="orders">
                            <i class="link-icon" data-feather="pie-chart"></i>
                            <span class="link-title">Orders</span>
                            <i class="link-arrow" data-feather="chevron-down"></i>
                        </a>
                        <div class="collapse" id="orders">
                            <ul class="nav sub-menu">
                                <li class="nav-item">
                                    <a href="{{ route('orders') }}" class="nav-link">Orders</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('order.cancel.list') }}" class="nav-link">Cancel Orders
                                        List</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#role" role="button"
                            aria-expanded="false" aria-controls="role">
                            <i class="link-icon" data-feather="layout"></i>
                            <span class="link-title">Role Manager</span>
                            <i class="link-arrow" data-feather="chevron-down"></i>
                        </a>
                        <div class="collapse" id="role">
                            <ul class="nav sub-menu">
                                <li class="nav-item">
                                    <a href="{{ route('role.manage') }}" class="nav-link">Role</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#icons" role="button"
                            aria-expanded="false" aria-controls="icons">
                            <i class="link-icon" data-feather="smile"></i>
                            <span class="link-title">Icons</span>
                            <i class="link-arrow" data-feather="chevron-down"></i>
                        </a>
                        <div class="collapse" id="icons">
                            <ul class="nav sub-menu">
                                <li class="nav-item">
                                    <a href="pages/icons/feather-icons.html" class="nav-link">Feather Icons</a>
                                </li>
                                <li class="nav-item">
                                    <a href="pages/icons/flag-icons.html" class="nav-link">Flag Icons</a>
                                </li>
                                <li class="nav-item">
                                    <a href="pages/icons/mdi-icons.html" class="nav-link">Mdi Icons</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item nav-category">Pages</li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#general-pages" role="button"
                            aria-expanded="false" aria-controls="general-pages">
                            <i class="link-icon" data-feather="book"></i>
                            <span class="link-title">Banners</span>
                            <i class="link-arrow" data-feather="chevron-down"></i>
                        </a>
                        <div class="collapse" id="general-pages">
                            <ul class="nav sub-menu">
                                <li class="nav-item">
                                    <a href="{{ route('banner') }}" class="nav-link">Add Banner</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#exciting_offers" role="button"
                            aria-expanded="false" aria-controls="exciting_offers">
                            <i class="link-icon" data-feather="layout"></i>
                            <span class="link-title">Exciting Offers</span>
                            <i class="link-arrow" data-feather="chevron-down"></i>
                        </a>
                        <div class="collapse" id="exciting_offers">
                            <ul class="nav sub-menu">
                                <li class="nav-item">
                                    <a href="{{ route('offer') }}" class="nav-link">Add Offer</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#subscribe" role="button"
                            aria-expanded="false" aria-controls="subscribe">
                            <i class="link-icon" data-feather="layout"></i>
                            <span class="link-title">Subscribes</span>
                            <i class="link-arrow" data-feather="chevron-down"></i>
                        </a>
                        <div class="collapse" id="subscribe">
                            <ul class="nav sub-menu">
                                <li class="nav-item">
                                    <a href="{{ route('subscribe.list') }}" class="nav-link">Subscribe List</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#errorPages" role="button"
                            aria-expanded="false" aria-controls="errorPages">
                            <i class="link-icon" data-feather="cloud-off"></i>
                            <span class="link-title">Tags</span>
                            <i class="link-arrow" data-feather="chevron-down"></i>
                        </a>
                        <div class="collapse" id="errorPages">
                            <ul class="nav sub-menu">
                                <li class="nav-item">
                                    <a href="{{ route('tag') }}" class="nav-link">tag</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item nav-category">Docs</li>
                    <li class="nav-item">
                        <a href="https://www.nobleui.com/html/documentation/docs.html" target="_blank"
                            class="nav-link">
                            <i class="link-icon" data-feather="hash"></i>
                            <span class="link-title">Documentation</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
        <nav class="settings-sidebar">
            <div class="sidebar-body">
                <a href="#" class="settings-sidebar-toggler">
                    <i data-feather="settings"></i>
                </a>
                <h6 class="text-muted">Sidebar:</h6>
                <div class="form-group border-bottom">
                    <div class="form-check form-check-inline">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="sidebarThemeSettings"
                                id="sidebarLight" value="sidebar-light" checked>
                            Light
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="sidebarThemeSettings"
                                id="sidebarDark" value="sidebar-dark">
                            Dark
                        </label>
                    </div>
                </div>
                <div class="theme-wrapper">
                    <h6 class="mb-2 text-muted">Light Theme:</h6>
                    <a class="theme-item active" href="{{ asset('backend') }}/demo_1/{{ route('dashboard') }}">
                        <img src="{{ asset('backend') }}/assets/images/screenshots/light.jpg" alt="light theme">
                    </a>
                    <h6 class="mb-2 text-muted">Dark Theme:</h6>
                    <a class="theme-item" href="{{ asset('backend') }}/demo_2/{{ route('dashboard') }}">
                        <img src="{{ asset('backend') }}/assets/images/screenshots/dark.jpg" alt="light theme">
                    </a>
                </div>
            </div>
        </nav>
        <!-- partial -->

        <div class="page-wrapper">

            <!-- partial:partials/_navbar.html -->
            <nav class="navbar">
                <a href="#" class="sidebar-toggler">
                    <i data-feather="menu"></i>
                </a>
                <div class="navbar-content">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown nav-messages">
                            <a class="nav-link dropdown-toggle" href="#" id="messageDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i data-feather="mail"></i>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="messageDropdown">
                                <div class="dropdown-header d-flex align-items-center justify-content-between">
                                    <p class="mb-0 font-weight-medium">9 New Messages</p>
                                    <a href="javascript:;" class="text-muted">Clear all</a>
                                </div>
                                <div class="dropdown-body">
                                    <a href="javascript:;" class="dropdown-item">
                                        <div class="figure">
                                            <img src="https://via.placeholder.com/30x30" alt="userr">
                                        </div>
                                        <div class="content">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <p>Leonardo Payne</p>
                                                <p class="sub-text text-muted">2 min ago</p>
                                            </div>
                                            <p class="sub-text text-muted">Project status</p>
                                        </div>
                                    </a>
                                    <a href="javascript:;" class="dropdown-item">
                                        <div class="figure">
                                            <img src="https://via.placeholder.com/30x30" alt="userr">
                                        </div>
                                        <div class="content">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <p>Carl Henson</p>
                                                <p class="sub-text text-muted">30 min ago</p>
                                            </div>
                                            <p class="sub-text text-muted">Client meeting</p>
                                        </div>
                                    </a>
                                    <a href="javascript:;" class="dropdown-item">
                                        <div class="figure">
                                            <img src="https://via.placeholder.com/30x30" alt="userr">
                                        </div>
                                        <div class="content">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <p>Jensen Combs</p>
                                                <p class="sub-text text-muted">1 hrs ago</p>
                                            </div>
                                            <p class="sub-text text-muted">Project updates</p>
                                        </div>
                                    </a>
                                    <a href="javascript:;" class="dropdown-item">
                                        <div class="figure">
                                            <img src="https://via.placeholder.com/30x30" alt="userr">
                                        </div>
                                        <div class="content">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <p>{{ Auth::user()->name }}</p>
                                                <p class="sub-text text-muted">2 hrs ago</p>
                                            </div>
                                            <p class="sub-text text-muted">Project deadline</p>
                                        </div>
                                    </a>
                                    <a href="javascript:;" class="dropdown-item">
                                        <div class="figure">
                                            <img src="https://via.placeholder.com/30x30" alt="userr">
                                        </div>
                                        <div class="content">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <p>Yaretzi Mayo</p>
                                                <p class="sub-text text-muted">5 hr ago</p>
                                            </div>
                                            <p class="sub-text text-muted">New record</p>
                                        </div>
                                    </a>
                                </div>
                                <div class="dropdown-footer d-flex align-items-center justify-content-center">
                                    <a href="javascript:;">View all</a>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item dropdown nav-notifications">
                            <a class="nav-link dropdown-toggle" href="#" id="notificationDropdown"
                                role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i data-feather="bell"></i>
                                <div class="indicator">
                                    <div class="circle"></div>
                                </div>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="notificationDropdown">
                                <div class="dropdown-header d-flex align-items-center justify-content-between">
                                    <p class="mb-0 font-weight-medium">6 New Notifications</p>
                                    <a href="javascript:;" class="text-muted">Clear all</a>
                                </div>
                                <div class="dropdown-body">
                                    @foreach (App\Models\OrderCancel::all() as $order_cancel)
                                        <a href="" class="dropdown-item">
                                            <div class="icon">
                                                <i data-feather="user-plus"></i>
                                            </div>
                                            <div class="content">
                                                <p>Order Cancel Request</p>
                                                <p>Order ID
                                                    {{ App\Models\Order::find($order_cancel->order_id)->order_id }}</p>
                                                <p class="sub-text text-muted">
                                                    {{ $order_cancel->created_at->diffForHumans() }}</p>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                                <div class="dropdown-footer d-flex align-items-center justify-content-center">
                                    <a href="">View all</a>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item dropdown nav-profile">
                            <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                @if (Auth::user()->photo)
                                    <img src="{{ asset('uploads/user') }}/{{ Auth::user()->photo }}" alt="profile">
                                @else
                                    <img src="{{ Avatar::create(Auth::user()->name)->toBase64() }}" />
                                @endif
                            </a>
                            <div class="dropdown-menu" aria-labelledby="profileDropdown">
                                <div class="dropdown-header d-flex flex-column align-items-center">
                                    <div class="mb-3 figure">
                                        @if (Auth::user()->photo)
                                            <img src="{{ asset('uploads/user') }}/{{ Auth::user()->photo }}"
                                                alt="">
                                        @else
                                            <img src="{{ Avatar::create(Auth::user()->name)->toBase64() }}" />
                                        @endif
                                    </div>
                                    <div class="text-center info">
                                        <p class="mb-0 name font-weight-bold">{{ Auth::user()->name }}</p>
                                        <p class="mb-3 email text-muted">{{ Auth::user()->email }}</p>
                                    </div>
                                </div>
                                <div class="dropdown-body">
                                    <ul class="p-0 pt-3 profile-nav">
                                        <li class="nav-item">
                                            <a href="{{ route('user.update') }}" class="nav-link">
                                                <i data-feather="user"></i>
                                                <span>Profile</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf

                                                <a href="{{ route('logout') }}" class="nav-link"
                                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                                    <i data-feather="log-out"></i>
                                                    <span>Log Out</span>
                                                </a>
                                            </form>

                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
            <!-- partial -->

            <div class="page-content">

                <nav class="page-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Home</li>
                    </ol>
                </nav>

                <div class="flex-wrap justify-content-between align-items-center grid-margin">
                    @yield('content')
                </div>

            </div>

            <!-- partial:partials/_footer.html -->
            <footer class="footer d-flex flex-column flex-md-row align-items-center justify-content-between">
                <p class="text-center text-muted text-md-left">Copyright © 2021 <a href="https://www.nobleui.com"
                        target="_blank">NobleUI</a>. All rights reserved</p>
                <p class="mb-0 text-center text-muted text-md-left d-none d-md-block">Handcrafted With <i
                        class="mb-1 ml-1 text-primary icon-small" data-feather="heart"></i></p>
            </footer>
            <!-- partial -->

        </div>
    </div>

    <!-- core:js -->
    <script src="{{ asset('backend') }}/assets/vendors/core/core.js"></script>
    <!-- endinject -->
    <!-- plugin js for this page -->
    <script src="{{ asset('backend') }}/assets/vendors/chartjs/Chart.min.js"></script>
    <script src="{{ asset('backend') }}/assets/vendors/jquery.flot/jquery.flot.js"></script>
    <script src="{{ asset('backend') }}/assets/vendors/jquery.flot/jquery.flot.resize.js"></script>
    <script src="{{ asset('backend') }}/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <script src="{{ asset('backend') }}/assets/vendors/apexcharts/apexcharts.min.js"></script>
    <script src="{{ asset('backend') }}/assets/vendors/progressbar.js/progressbar.min.js"></script>
    <!-- end plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ asset('backend') }}/assets/vendors/feather-icons/feather.min.js"></script>
    <script src="{{ asset('backend') }}/assets/js/template.js"></script>
    <!-- endinject -->
    <!-- custom js for this page -->
    <script src="{{ asset('backend') }}/assets/js/dashboard.js"></script>
    <script src="{{ asset('backend') }}/assets/js/datepicker.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.13.3/js/standalone/selectize.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <!-- end custom js for this page -->
    @yield('footer_script')
</body>

</html>
