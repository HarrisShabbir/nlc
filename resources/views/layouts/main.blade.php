<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>{{ env('APP_NAME') }} {{ isset($pageData['pageTitle']) ? '| '.$pageData['pageTitle'] : '' }}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="" name="description" />
        <meta content="" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

        <!-- Bootstrap Css -->
        <link href="{{ asset('assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="{{ asset('assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/libs/toastr/toastr.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css')}}">
        @stack('style')
    </head>

    <body data-sidebar="dark">

    <!-- <body data-layout="horizontal" data-topbar="dark"> -->

        <!-- Begin page -->
        <div id="layout-wrapper">

            <!-- ========== Header Start ========== -->
            @include('layouts.header')
            <!-- Header End -->

            <!-- ========== Left Sidebar Start ========== -->
            @include('layouts.left-sidebar')
            <!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 font-size-18">{{ $pageData['pageTitle'] }}</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                            <li class="breadcrumb-item"><i class="bx bx-right-arrow"></i></li>
                                            <li class="breadcrumb-item active">{{ $pageData['pageTitle'] }}</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        @yield('content')

                    </div>
                    <!-- container-fluid -->
                </div>
                <!-- End Page-content -->

                <!-- Start Modals -->
                @include('layouts.modals')
                <!-- End Modals -->

                <!-- Start Footer -->
                @include('layouts.footer')
                <!-- End Footer -->
            </div>
            <!-- end main content-->
        </div>
        <!-- END layout-wrapper -->

        <!-- Right Sidebar -->
{{--        @include('layouts.right-sidebar')--}}
        <!-- /Right-bar -->

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        <!-- JAVASCRIPT -->
        <script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('assets/libs/metismenu/metisMenu.min.js') }}"></script>
        <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
        <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>
        <!-- App js -->
        <script src="{{ asset('assets/js/app.js') }}"></script>

        <script src="{{ asset('assets/libs/toastr/toastr.min.js')}}"></script>
        <script src="{{ asset('assets/libs/sweetalert2/sweetalert2.min.js')}}"></script>

        @stack('scripts')

        <script>

        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "slideDown",
            "hideMethod": "slideUp",
            "closeMethod": "slideUp",
            "escapeHtml": true
        };

        !function (t) {
            "use strict";

            function e() {
            }

            e.prototype.init = function () {
                t(".deleteRecord").click(function () {
                    Swal.fire({
                        title: "Are you sure?",
                        text: "You won't be able to revert this!",
                        icon: "warning",
                        showCancelButton: !0,
                        confirmButtonColor: "#34c38f",
                        cancelButtonColor: "#f46a6a",
                        confirmButtonText: "Yes, delete it!"
                    }).then(function (t) {
                        t.value && Swal.fire("Deleted!", "Your file has been deleted.", "success")
                    })
                })
            }, t.SweetAlert = new e, t.SweetAlert.Constructor = e
        }(window.jQuery), function () {
            "use strict";
            window.jQuery.SweetAlert.init()
        }();
    </script>
    @if(Session::has('success'))
        @php
            $SessionType = "success";
            $SessionMessage = Session::get('success');
            $SessionTitle = Session::get('title');
        @endphp
    @elseif(Session::has('error'))
        @php
            $SessionType = "error";
            $SessionMessage = Session::get('error');
        @endphp
    @elseif(Session::has('info'))
        @php
            $SessionType = "info";
            $SessionMessage = Session::get('info');
        @endphp
    @elseif(Session::has('warning'))
        @php
            $SessionType = "warning";
            $SessionMessage = Session::get('warning');
        @endphp
    @endif

    @if(isset($SessionType) && isset($SessionMessage))
        @if(isset($SessionTitle))
            <script type="text/javascript">
                $(document).ready( function () {
                    toastr["{{ $SessionType }}"]("{{ $SessionMessage }}","{{ $SessionTitle }}");
                });
            </script>
        @else
            <script type="text/javascript">
                $(document).ready( function () {
                    toastr["{{ $SessionType }}"]("{{ $SessionMessage }}");
                });
            </script>
        @endif
    @endif
    </body>

</html>
