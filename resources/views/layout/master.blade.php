
<!--
=========================================================
* Material Dashboard 2 - v3.0.4
=========================================================

* Product Page: https://www.creative-tim.com/product/material-dashboard
* Copyright 2022 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <title>
        Material Dashboard 2 by Creative Tim
    </title>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <!-- Nucleo Icons -->
    <link href='{{asset('css/nucleo-icons.css')}}' rel="stylesheet" />
    <link href='{{asset('css/nucleo-svg.css')}}' rel="stylesheet" />

    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/b9a286660b.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <!-- CSS Files -->
    <link id="pagestyle" href='{{asset('css/material-dashboard.css?v=3.0.4')}}' rel="stylesheet" />

</head>

<body class="g-sidenav-show  bg-gray-200">
    @include('layout.sidebar')

<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    @include('layout.navbar')
    <!-- End Navbar -->
    <div class="container-fluid py-4">
        @yield('content')
        @include('layout.footer')
    </div>

</main>

<!--   Core JS Files   -->
<script src='{{asset('js/popper.min.js')}}'></script>
<script src='{{asset('js/bootstrap.min.js')}}'></script>
<script src='{{asset('js/perfect-scrollbar.min.js')}}'></script>
<script src='{{asset('js/smooth-scrollbar.min.js')}}'></script>
<script>
    const win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
        const options = {
            damping: '0.5'
        };
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
</script>
<script src='{{asset('js/material-dashboard.min.js')}}'></script>

</body>

</html>
