<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Document</title>

    @vite(['resources/css/app.css',
            'resources/js/app.js'])

</head>
{{-- @if ($username == 'admin'){

<body class="d-flex flex-column min-vh-100">

    @include('components.admin.header')

    <main class="flex-grow-1">

        @yield('maincontent')

    </main>

    @include('components.admin.footer')

</body>
}
@elseif($username !== 'admin'){
<body class="d-flex flex-column min-vh-100">

    @include('components.user.header')

    <main class="flex-grow-1">

        @yield('maincontent')

    </main>

    @include('components.user.footer')

</body>
}
@endif  --}}

<body class="d-flex flex-column min-vh-100">

    @include('components.user.header')

    <main class="flex-grow-1">

        @yield('maincontent')

    </main>

    @include('components.user.footer')

</body>

</html>