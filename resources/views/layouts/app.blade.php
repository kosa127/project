<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    @include('includes.head')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">

                <div class="navbar-header">
                    <!-- Branding Image -->

                    <a class="navbar-brand" href="{{ url('/') }}"> Home </a>

                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->

                    @include('includes.leftNavbar')

                    <!-- Right Side Of Navbar -->

                    @include('includes.rightNavbar')

                </div>
            </div>
        </nav>
        <div style="width: 75%; margin: 0% 10% 0% 10%">
            @yield('content')

        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
