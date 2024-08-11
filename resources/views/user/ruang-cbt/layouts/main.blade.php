<!doctype html>

<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact" dir="ltr"
    data-theme="theme-default" data-assets-path="../../assets/" data-template="vertical-menu-template-no-customizer"
    data-style="light">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}
    <title>@yield('title') |CBT Online</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('/assets/img/favicon/favicon.ico') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&ampdisplay=swap"
        rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('/assets/vendor/fonts/remixicon/remixicon.css') }}" />
    <link rel="stylesheet" href="{{ asset('/assets/vendor/fonts/flag-icons.css') }}" />

    <!-- Menu waves for no-customizer fix -->
    <link rel="stylesheet" href="{{ asset('/assets/vendor/libs/node-waves/node-waves.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('/assets/vendor/css/rtl/core.css') }}" />
    <link rel="stylesheet" href="{{ asset('/assets/vendor/css/rtl/theme-default.css') }}" />
    <link rel="stylesheet" href="{{ asset('/assets/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href=""{{ asset('/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }} />
    <link rel="stylesheet" href="{{ asset('/assets/vendor/libs/typeahead-js/typeahead.css') }}" />
    <link rel="stylesheet" href="{{ asset('/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}" />
    <link rel="stylesheet"
        href="{{ asset('/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}" />
    <link rel="stylesheet"
        href="{{ asset('/assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css') }}" />
    <link rel="stylesheet" href="{{ asset('/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('/assets/vendor/libs/animate-css/animate.css') }}" />
    <link rel="stylesheet" href="{{ asset('/assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />
    <link rel="stylesheet" href="{{ asset('/assets/vendor/libs/spinkit/spinkit.css') }}" />
    <link rel="stylesheet" href="{{ asset('/assets/vendor/libs/bootstrap-select/bootstrap-select.css') }}" />

    <!-- Page CSS -->
    @yield('css')

    <!-- Helpers -->
    <script src="{{ asset('/assets/vendor/js/helpers.js') }}"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('/assets/js/config.js') }}"></script>
</head>

<body>

    @yield('content')

    <script src="{{ asset('/assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('/assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('/assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('/assets/vendor/libs/node-waves/node-waves.js') }}"></script>
    <script src="{{ asset('/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('/assets/vendor/libs/hammer/hammer.js') }}"></script>
    <script src="{{ asset('/assets/vendor/libs/i18n/i18n.js') }}"></script>
    <script src="{{ asset('/assets/vendor/libs/typeahead-js/typeahead.js') }}"></script>
    <script src="{{ asset('/assets/vendor/js/menu.js') }}"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ asset('/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
    <script src="{{ asset('/assets/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
    <script src="{{ asset('/assets/vendor/libs/block-ui/block-ui.js') }}"></script>
    <script src="{{ asset('/assets/vendor/libs/@form-validation/popular.js') }}"></script>
    <script src="{{ asset('/assets/vendor/libs/@form-validation/bootstrap5.js') }}"></script>
    <script src="{{ asset('/assets/vendor/libs/@form-validation/auto-focus.js') }}"></script>
    <script src="{{ asset('/assets/vendor/libs/bootstrap-select/bootstrap-select.js') }}"></script>
    <!-- Main JS -->
    <script src="{{ asset('/assets/js/main.js') }}"></script>
    <script src="{{ asset('/assets/js/ajax.js') }}"></script>

    <!-- Page JS -->
    @yield('js')
</body>

</html>
