<html>
<head>
    @include('includes.head')
</head>
<body>
    <div class="header">
        @section('header')
            @include('includes.header')
        @show
    </div>
    @section('sidebar')
        @include('layouts.sidebar')
    @show
    @yield('singlePosterView')
    @yield('homepage')
    @yield('searchResults')
</body>
</html>
