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
    <div class="description" id="movieDesc">
        @section('description')
            @include('layouts.description')
        @show
    </div>
    <div class="wrapper">
        @yield('homepage')
        @yield('returnedContent')
    </div>
</body>
</html>
