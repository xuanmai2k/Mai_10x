<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>MaiVaccine Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('admin/vendors/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/vendors/css/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('admin/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/js/select.dataTables.min.css') }}">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('admin/css/vertical-layout-light/style.css') }}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{ asset('admin/images/favicon.png') }}" />
    <!-- Icon-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"
        integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <!-- sweetalert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.0/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.0/dist/sweetalert2.min.js"></script>
    <!--Jquery-->
    <script src="jquery-3.6.4.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <!-- Description -->
    <script src="https://cdn.ckeditor.com/ckeditor5/38.1.0/classic/ckeditor.js"></script>
    <!-- semantic -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.js"></script>
</head>

<body>
    <!-- container-scroller start -->
    <div class="container-scroller">
        <!-- header->nav start-->
        @include('admin.pages.header')
        <!-- header->nav end-->

        <!-- page-body-wrapper start -->
        <div class="container-fluid page-body-wrapper">
            <!-- sidebar left start -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item">
                        <!-- Home -->
                        <a class="nav-link" href="{{ route('admin.home') }}">
                            <i class="icon-grid menu-icon"></i>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <!-- Appointment -->
                        <a class="nav-link" data-toggle="collapse" href="#appointment" aria-expanded="false"
                            aria-controls="appointment">
                            <i class="mdi mdi-calendar-multiple menu-icon"></i>
                            <span class="menu-title">Appointment</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="appointment">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"><a class="nav-link"
                                        href="{{ route('admin.appointment.index') }}">Appointment</a></li>
                            </ul>
                        </div>
                        <div class="collapse" id="appointment">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"><a class="nav-link"
                                        href="{{ route('admin.used_appointment.index') }}">Used</a></li>
                            </ul>
                        </div>
                        <div class="collapse" id="appointment">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"><a class="nav-link"
                                        href="{{ route('admin.canceled_appointment.index') }}">Canceled</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <!-- Contact -->
                        <a class="nav-link" data-toggle="collapse" href="#contact" aria-expanded="false"
                            aria-controls="contact">
                            <i class="mdi mdi-content-paste menu-icon"></i>
                            <span class="menu-title">Contact</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="contact">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link"
                                        href="{{ route('admin.contact.index') }}">Contact</a></li>
                            </ul>
                        </div>
                        <div class="collapse" id="contact">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link"
                                        href="{{ route('admin.called_contact.index') }}">Called</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <!-- Product Category -->
                        <a class="nav-link" href="{{ route('admin.product-category.index') }}">
                            <i class="mdi mdi-folder-multiple menu-icon"></i>
                            <span class="menu-title">Product Category</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <!-- Vaccine -->
                        <a class="nav-link" href="{{ route('admin.vaccine.index') }}">
                            <i class="icon-anchor menu-icon"></i>
                            <span class="menu-title">Vaccine</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <!-- Service -->
                        <a class="nav-link" href="{{ route('admin.service.index') }}">
                            <i class="icon-command menu-icon"></i>
                            <span class="menu-title">Service</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <!-- Team -->
                        <a class="nav-link" data-toggle="collapse" href="#team" aria-expanded="false"
                            aria-controls="team">
                            <i class="mdi mdi-content-paste menu-icon"></i>
                            <span class="menu-title">Team</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="team">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link"
                                        href="{{ route('admin.doctor.index') }}">Doctor</a></li>
                            </ul>
                        </div>
                        <div class="collapse" id="team">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link"
                                        href="{{ route('admin.nurse.index') }}">Nurse</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <!-- Blog -->
                        <a class="nav-link" href="{{ route('admin.blog.index') }}">
                            <i class="icon-paper-stack menu-icon"></i>
                            <span class="menu-title">Blog</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <!-- User -->
                        <a class="nav-link" href="{{ route('admin.user.index') }}">
                            <i class="mdi mdi-account-card-details menu-icon"></i>
                            <span class="menu-title">User</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <!-- Holiday -->
                        <a class="nav-link" href="{{ route('admin.holiday.index') }}">
                            <i class="mdi mdi-calendar-clock menu-icon"></i>
                            <span class="menu-title">Holiday</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <!-- About Us -->
                        <a class="nav-link" href="{{ route('admin.aboutus.index') }}">
                            <i class="mdi mdi-cards-heart menu-icon"></i>
                            <span class="menu-title">About Us</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <!-- Mai Vaccine -->
                        <a class="nav-link" href="{{ route('client.home.list') }}">
                            <i class="mdi mdi-google-physical-web menu-icon"></i>
                            <span class="menu-title">MaiVaccine</span>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- sidebar left end-->

            <!-- main-panel start -->
            <div class="main-panel">

                @yield('content')

                <!--footer start-->
                @include('admin.pages.footer')
                <!--footer end-->

            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller end -->
    <!-- plugins:js -->
    <script src="{{ asset('admin/vendors/js/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{ asset('admin/vendors/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('admin/vendors/datatables.net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('admin/vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('admin/js/dataTables.select.min.js') }}"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    {{-- <script src="{{ asset('admin/js/off-canvas.js') }}"></script> --}}
    {{-- <script src="{{ asset('admin/js/hoverable-collapse.js') }}"></script> --}}
    <script src="{{ asset('admin/js/template.js') }}"></script> <!-- menu left -->
    {{-- <script src="{{ asset('admin/js/settings.js') }}"></script> --}}
    <script src="{{ asset('admin/js/todolist.js') }}"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="{{ asset('admin/js/dashboard.js') }}"></script>
    <script src="{{ asset('admin/js/Chart.roundedBarCharts.js') }}"></script>
    <!--gg chart-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <!-- End custom js for this page-->
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    {{-- <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- animation -->
    <script>
        AOS.init();
    </script> --}}

    @yield('js-custom') <!-- jquery ajax -->

    @yield('description-ckeditor') <!-- ckeditor -->

    @yield('script-pop-up') <!-- pop up -->
</body>

</html>
