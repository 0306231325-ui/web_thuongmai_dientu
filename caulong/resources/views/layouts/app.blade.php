<!DOCTYPE html>
<html lang="en">
<head>
    @include('partials.head')
</head>
<body>

@include('partials.topbar')
@include('partials.navbar')


<main>
    @yield('content')
</main>

@include('partials.footer')
@include('partials.scripts')

</body>
</html>
