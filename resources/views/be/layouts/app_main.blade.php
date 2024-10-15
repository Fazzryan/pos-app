<!doctype html>
<html lang="en">

<head>
    @include('be.layouts.app_head')
</head>


<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        {{-- sidebar --}}
        @include('be.layouts.app_sidebar')

        {{-- main wrapper --}}
        <div class="body-wrapper">
            {{-- navbar --}}
            @include('be.layouts.app_navbar')

            <div class="body-wrapper-inner">
                <div class="container-fluid">

                    @stack('breadcrumb')

                    @yield('content')

                    @include('be.layouts.app_footer')
                </div>
            </div>
        </div>
    </div>
    @include('be.layouts.app_script')
</body>

</html>
