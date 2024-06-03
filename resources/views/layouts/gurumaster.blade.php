<!-- Header -->
@include('layouts.contents.header')
<!-- Header -->
<body class="sb-nav-fixed">
    <!-- navbar -->
    @include('layouts.contents.navbar')
    <!-- navbar -->
    <div id="layoutSidenav">
        <!-- sidebar -->
        @include('layouts.gurucontents.sidebar')
        <!-- sidebar -->
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">@yield('page-title')</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active"></li>
                    </ol>
                    <!-- contents -->
                    @yield('contents')
                    <!-- contents -->
                </div>
            </main>
            <!-- footer -->
            @include('layouts.contents.footer')
            <!-- footer -->
        </div>
    </div>
    <!-- sweet alert -->
    @include('sweetalert::alert')
    <!-- sweet alert -->
    <!-- script -->
    @include('layouts.scripts.script')
    <!-- script -->
</body>

</html>
