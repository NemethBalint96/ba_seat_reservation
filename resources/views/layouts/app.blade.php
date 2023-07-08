<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cinema Seat Reservation</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <header>
        <nav>
            {{-- <a href="{{ route('home') }}">Home</a> --}}
            {{-- <a href="{{ route('seats') }}">Seats</a> --}}
        </nav>
    </header>

    <main>
        <div class="container">
            @yield('content')
        </div>
    </main>

    <footer>
        <p>&copy; {{ date('Y') }} Cinema Seat Reservation. All rights reserved.</p>
    </footer>

    {{-- <script src="{{ asset('js/app.js') }}"></script> --}}
</body>
</html>