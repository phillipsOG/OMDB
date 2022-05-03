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
    <div class="sidebar">
        @section('sidebar')
            @include('layouts.sidebar')
        @show
    </div>
    @yield('singlePosterViewNY')
    @yield('singlePosterView')
    @yield('homepage')
    @yield('poster')
</body>
</html>
