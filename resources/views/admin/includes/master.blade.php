<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">

    <title>Cybernaptics</title>

    <meta name="description" content="OneUI - Bootstrap 5 Admin Template &amp; UI Framework created by pixelcave and published on Themeforest">
    <meta name="author" content="pixelcave">
    <meta name="robots" content="noindex, nofollow">

    <meta property="og:title" content="OneUI - Bootstrap 5 Admin Template &amp; UI Framework">
    <meta property="og:site_name" content="OneUI">
    <meta property="og:description" content="OneUI - Bootstrap 5 Admin Template &amp; UI Framework created by pixelcave and published on Themeforest">
    <meta property="og:type" content="website">
    <meta property="og:url" content="">
    <meta property="og:image" content="">


    @yield('css')

    <link rel="shortcut icon" href="{{asset('assets/media/favicons/favicon.png')}}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{asset('assets/media/favicons/favicon-192x192.png')}}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('assets/media/favicons/apple-touch-icon-180x180.png')}}">

    <link rel="stylesheet" id="css-main" href="{{asset('assets/css/oneui.min.css')}}">

</head>
<body>

<div id="page-container" class=" remember-theme sidebar-o sidebar-dark enable-page-overlay side-scroll page-header-fixed main-content-narrow">

    <nav id="sidebar" aria-label="Main Navigation">

        <div class="content-header">

            <a class="fw-semibold text-dual" href="index.html">
            <span class="smini-visible">
              <i class="fa fa-circle-notch text-primary"></i>
            </span>
                <span class="smini-hide fs-5 tracking-wider">Cybernaptics</span>
            </a>

            <div>

                <button type="button" class="btn btn-sm btn-alt-secondary" data-toggle="layout" data-action="dark_mode_toggle">
                    <i class="far fa-moon"></i>
                </button>

                <a class="d-lg-none btn btn-sm btn-alt-secondary ms-1" data-toggle="layout" data-action="sidebar_close" href="javascript:void(0)">
                    <i class="fa fa-fw fa-times"></i>
                </a>
                <!-- END Dark Mode -->

                <!-- Options -->
                <div class="dropdown d-inline-block ms-1">

                    <div class="dropdown-menu dropdown-menu-end fs-sm smini-hide border-0" aria-labelledby="sidebar-themes-dropdown">


                    </div>
                </div>


                <!-- END Close Sidebar -->
            </div>
            <!-- END Extra -->
        </div>
        <!-- END Side Header -->

        <!-- Sidebar Scrolling -->
        <div class="js-sidebar-scroll">
            <!-- Side Navigation -->
            <div class="content-side">
                <ul class="nav-main">
                    <li class="nav-main-item">
                        <a class="nav-main-link" href="{{route("admin.dashboard")}}">
                            <i class="nav-main-link-icon si si-speedometer"></i>
                            <span class="nav-main-link-name">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link nav-main-link"  aria-haspopup="true" aria-expanded="false" href="{{route("admin.workorders")}}">
                            <i class="nav-main-link-icon far fa-rectangle-list"></i>
                            <span class="nav-main-link-name">Work Orders</span>
                        </a>
                    </li>

                    <li class="nav-main-item">
                        <a class="nav-main-link nav-main-link"  aria-haspopup="true" aria-expanded="false" href="{{route("admin.workorders.create")}}">
                            <i class="nav-main-link-icon far fa-square-plus"></i>
                            <span class="nav-main-link-name">New Work Order</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link nav-main-link"  aria-haspopup="true" aria-expanded="false" href="{{route("admin.clients")}}">
                            <i class="nav-main-link-icon far fa-rectangle-list"></i>
                            <span class="nav-main-link-name">Clients</span>
                        </a>
                    </li>


                    <li class="nav-main-heading">Miscellaneous</li>

                    <li class="nav-main-item">
                        <a class="nav-main-link nav-main-link"  aria-haspopup="true" aria-expanded="false" href="{{route("admin.workorders",['filter'=>'Cancelled'])}}">
                            <i class="nav-main-link-icon far fa-trash-can"></i>
                            <span class="nav-main-link-name">Cancelled Orders</span>
                        </a>
                    </li>

                    <li class="nav-main-item">
                        <a class="nav-main-link nav-main-link"  aria-haspopup="true" aria-expanded="false" href="{{route("admin.slas")}}">
                            <i class="nav-main-link-icon far fa-rectangle-list"></i>
                            <span class="nav-main-link-name">SLA List</span>
                        </a>
                    </li>



                    <li class="nav-main-heading">Other</li>
                    <li class="nav-main-item">
                        <a class="nav-main-link nav-main-link"  aria-haspopup="true" aria-expanded="false" href="{{route("admin.users")}}">
                            <i class="nav-main-link-icon  far fa-user-circle"></i>
                            <span class="nav-main-link-name">Users</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link nav-main-link "  aria-haspopup="true" aria-expanded="false" href="#">
                            <i class="nav-main-link-icon si si-wrench"></i>
                            <span class="nav-main-link-name">Settings</span>
                        </a>

                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link nav-main-link"  aria-haspopup="true" aria-expanded="false" href="{{route("logout")}}">
                            <i class="nav-main-link-icon far fa-circle-left"></i>
                            <span class="nav-main-link-name">Logout</span>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- END Side Navigation -->
        </div>
        <!-- END Sidebar Scrolling -->
    </nav>
    <!-- END Sidebar -->

    <!-- Header -->
    <header id="page-header">
        <!-- Header Content -->
        <div class="content-header">
            <!-- Left Section -->
            <div class="d-flex align-items-center">




                <button type="button" class="btn btn-sm btn-alt-secondary me-2 d-lg-none" data-toggle="layout" data-action="sidebar_toggle">
                    <i class="fa fa-fw fa-bars"></i>
                </button>



                <a  class="btn btn-sm btn-alt-secondary me-2 d-lg-inline-block" data-toggle="layout" href="{{URL::previous()}}">
                    <i class="si si-arrow-left fw-bold"></i>
                </a>

                <button type="button" class="btn btn-sm btn-alt-secondary me-2 d-none d-lg-inline-block" data-toggle="layout" data-action="sidebar_mini_toggle">
                    <i class="fa fa-fw fa-ellipsis-v"></i>
                </button>







            </div>
            <!-- END Left Section -->

            <!-- Right Section -->
            <div class="d-flex align-items-center">
                <!-- User Dropdown -->
                <div class="dropdown d-inline-block ms-2">
                    <button type="button" class="btn btn-sm btn-alt-secondary d-flex align-items-center" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img class="rounded-circle" src="{{ asset('assets/media/avatars/avatar10.jpg') }}" alt="Header Avatar" style="width: 21px;">
                        <span class="d-none d-sm-inline-block ms-2">{{auth()->user()->name}}</span>
                        <i class="fa fa-fw fa-angle-down d-none d-sm-inline-block opacity-50 ms-1 mt-1"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-md dropdown-menu-end p-0 border-0" aria-labelledby="page-header-user-dropdown">
                        <div class="p-3 text-center bg-body-light border-bottom rounded-top">
                            <img class="img-avatar img-avatar48 img-avatar-thumb" src=" {{ asset('assets/media/avatars/avatar10.jpg') }}" alt="">
                            <p class="mt-2 mb-0 fw-medium">{{auth()->user()->name}}</p>
                            <p class="mb-0 text-muted fs-sm fw-medium">{{auth()->user()->name}}</p>
                        </div>
                        <div class="p-2">
                            <a class="dropdown-item d-flex align-items-center justify-content-between" href="javascript:void(0)">
                                <span class="fs-sm fw-medium">Settings</span>
                            </a>
                        </div>
                        <div role="separator" class="dropdown-divider m-0"></div>
                        <div class="p-2">
                            <a class="dropdown-item d-flex align-items-center justify-content-between" href="{{route("logout")}}">
                                <span class="fs-sm fw-medium">Log Out</span>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- END User Dropdown -->

                @php
                    $notifCount = count(auth()->user()->unreadNotifications);




                @endphp

                    <!-- Notifications Dropdown -->
                <div class="dropdown d-inline-block ms-2">
                    <button type="button" class="btn btn-sm btn-alt-secondary" id="page-header-notifications-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-fw fa-bell"></i>
                        @if($notifCount>0)
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="notifCount">{{$notifCount}}<span class="visually-hidden">unread messages</span>
  </span>
                        @endif
                    </button>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0 border-0 fs-sm" aria-labelledby="page-header-notifications-dropdown">
                        <div class="p-2 bg-body-light border-bottom text-center rounded-top">
                            <h5 class="dropdown-header text-uppercase">Notifications</h5>
                        </div>
                        <ul class="nav-items mb-0">


                            @foreach(auth()->user()->unreadNotifications as $items)
                                <li >

                                    <a class="text-dark d-flex py-2 bg-modern-lighter unread-notif" href="{{ route("admin.workorders.details",['id'=>$items['data']['work_id']]) }}">
                                        <div class="flex-shrink-0 me-2 ms-3">
                                            <i class="fa fa-fw fa-plus-circle text-primary"></i>
                                        </div>
                                        <div class="flex-grow-1 pe-2">

                                            <div class="fw-semibold">{{$items['data']['details']}}<span class="badge bg-secondary d-inline-block m-1">BI {{$items['data']['work_id']}}</span></div>
                                            <span class="fw-medium text-muted">{{\Carbon\Carbon::parse($items['created_at'])->diffForHumans()}}</span>
                                        </div>
                                    </a>
                                </li>

                            @endforeach

                            @foreach(auth()->user()->notifications->slice(0, 10) as $items)

                                @if($items['read_at']!=null)
                                    <li >

                                        <a class="text-dark d-flex py-2" href="{{ route("admin.workorders.details",['id'=>$items['data']['work_id']]) }}">
                                            <div class="flex-shrink-0 me-2 ms-3">
                                                <i class="fa fa-fw fa-plus-circle text-primary"></i>
                                            </div>
                                            <div class="flex-grow-1 pe-2">
                                                <div class="fw-semibold">{{$items['data']['details']}}<span class="badge bg-secondary d-inline-block mx-2">BI {{$items['data']['work_id']}}</span></div>
                                                <span class="fw-medium text-muted">{{\Carbon\Carbon::parse($items['created_at'])->diffForHumans()}}</span>
                                            </div>
                                        </a>
                                    </li>
                                @endif

                            @endforeach

                        </ul>

                    </div>
                </div>
                <!-- END Notifications Dropdown -->


            </div>
            <!-- END Right Section -->
        </div>
        <!-- END Header Content -->

        <!-- Header Search -->
        <div id="page-header-search" class="overlay-header bg-body-extra-light">
            <div class="content-header">
                <form class="w-100" action="be_pages_generic_search.html" method="POST">
                    <div class="input-group">
                        <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                        <button type="button" class="btn btn-alt-danger" data-toggle="layout" data-action="header_search_off">
                            <i class="fa fa-fw fa-times-circle"></i>
                        </button>
                        <input type="text" class="form-control" placeholder="Search or hit ESC.." id="page-header-search-input" name="page-header-search-input">
                    </div>
                </form>
            </div>
        </div>
        <!-- END Header Search -->

        <!-- Header Loader -->
        <!-- Please check out the Loaders page under Components category to see examples of showing/hiding it -->
        <div id="page-header-loader" class="overlay-header bg-body-extra-light">
            <div class="content-header">
                <div class="w-100 text-center">
                    <i class="fa fa-fw fa-circle-notch fa-spin"></i>
                </div>
            </div>
        </div>
        <!-- END Header Loader -->
    </header>
    <!-- END Header -->

    <!-- Main Container -->
    @yield('content')


    <!-- END Main Container -->

    <!-- Footer -->
    <footer id="page-footer" class="bg-body-light">
        <div class="content py-3">
            <div class="row fs-sm">
                <div class="col-sm-6 order-sm-2 py-1 text-center text-sm-end">

                </div>
                <div class="col-sm-6 order-sm-1 py-1 text-center text-sm-start">
                    <a class="fw-semibold" href="https://1.envato.market/AVD6j" target="_blank">Cybernaptics</a> &copy; <span data-toggle="year-copy"></span>
                </div>
            </div>
        </div>
    </footer>
    <!-- END Footer -->
</div>
<!-- END Page Container -->

<!--
    OneUI JS

    Core libraries and functionality
    webpack is putting everything together at assets/_js/main/app.js
-->
<script src="{{asset('assets/js/oneui.app.min.js')}}"></script>

<!-- Page JS Plugins -->
<script src="{{asset('assets/js/plugins/chart.js/chart.min.js')}}"></script>

<!-- Page JS Code -->


<script src="{{asset('assets/js/pages/be_pages_dashboard.min.js')}}"></script>

<script src="{{ asset('assets/js/lib/jquery.min.js') }}"></script>

<script>
    $("button#page-header-notifications-dropdown").click(function(){

        $.ajax({
            url: "{{route('read_notifications')}}",
            method:"GET",

            success: function(data){
                $('#notifCount').remove();
                $('.unread-notif').removeClass('bg-modern-lighter');
            }
        });

    });

</script>
@yield('scripts')
</body>
</html>
