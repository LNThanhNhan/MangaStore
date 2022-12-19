<!DOCTYPE html>
<html lang="vi">
{{--<script type="text/javascript" src="../ckeditor/ckeditor.js"></script>--}}

<head>
    <link rel="icon" type="image/x-icon" href="/favicon/mangastore.ico">
    @include('layout.admin.header')
    <script src="http://code.jquery.com/jquery.min.js" type="text/javascript"></script>

    @stack('css')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
    @include('layout.admin.sidebar')
    @yield('content')
    @include('layout.admin.footer')
    @stack('js')
</div>
</body>

