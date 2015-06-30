<html>
    <head>
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('vendor/bootstrap/dist/css/bootstrap.min.css') }}"></script>
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('vendor/datetimepicker/jquery.datetimepicker.css') }}"></script>
        <title>Appointment reminders - @yield('title', 'reminders')</title>
    </head>
    <body>
        <nav class="navbar navbar-default">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">Appointment reminders</a>
            </div>
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li><a href="{{ route('appointment.index') }}">Index</a></li>
                    <li><a href="{{ route('appointment.new') }}">New appointment</a></li>
                </ul>
            </div>
        </nav>
        <div class="container">
            @yield('content')
        </div>
        <footer class="container">
            Made with <i class="fa fa-heart"></i> by your pals
            <a href="http://www.twilio.com">@twilio</a>
        </footer>
        <script src="{{ URL::asset('vendor/jquery/dist/jquery.min.js') }}"></script>
        <script src="{{ URL::asset('vendor/datetimepicker/jquery.datetimepicker.js') }}"></script>
        @yield('scripts')
    </body>
</html>
