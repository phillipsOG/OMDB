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
    <div class="wrapper">
        @yield('homepage')
    </div>
        @yield('poster')
</body>
</html>
