<!DOCTYPE html>
<html lang="en">
<head>
    @include('partials.head')
</head>
<body>

@include('partials.topbar')
@include('partials.navbar')
@include('partials.system-alert')
<main>
    @yield('content')
</main>
@include('partials.login-modal')
@include('partials.footer')
@include('partials.scripts')

</body>
</html>
