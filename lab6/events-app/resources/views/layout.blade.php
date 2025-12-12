<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
</head>
<body>
<header>
    <h1>Welcome to the Admin Dashboard</h1>
    <nav>
        <ul>
            <li><a href="{{ route('events.index') }}">Events</a></li>
            <li><a href="{{ route('organizers.index') }}">Organizers</a></li>
        </ul>
    </nav>
</header>

{{--<main class="container mt-4">--}}
{{--    @if(session('message'))--}}
{{--        <div class="alert alert-success">--}}
{{--            {{ session('message') }}--}}
{{--        </div>--}}
{{--    @endif--}}

{{--    @if(session('warning'))--}}
{{--        <div class="alert alert-danger">--}}
{{--            {{ session('warning') }}--}}
{{--        </div>--}}
{{--    @endif--}}

{{--    @yield('content')--}}
{{--</main>--}}
<main>
    @if(session('message'))
     <div class="alert alert-success">
            {{ session('message') }}
        </div>
   @endif

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
   @endif

    @if(session('warning'))
        <div class="alert alert-danger">
            {{ session('warning') }}
        </div>
   @endif

        @yield('content')
</main>


</body>
</html>

