<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.9.0/dist/css/bootstrap-datepicker.min.css" rel="stylesheet">
</head>
<body>
    <div id="app">

        <!-- Navbar (sit on top) -->
        <div class="w3-top">
            <div class="w3-bar w3-white w3-card" id="myNavbar">
                <a href="{{ url('/') }}" class="w3-bar-item w3-button w3-wide">LOGO</a>

                <!-- Right-sided navbar links -->
                <div class="w3-right w3-hide-small">
                    <a href="{{ url('/') }}" class="w3-bar-item w3-button">Sequence</a>
                    <a href="{{ url('/project-date') }}" class="w3-bar-item w3-button"> Delivery Date</a>
                    <a href="{{ url('/array-search') }}" class="w3-bar-item w3-button"> Array Search</a>
                    <a href="{{ url('/find-second-fourth-saturday') }}" class="w3-bar-item w3-button"> Find Saturdays</a>
                    <a href="{{ url('/random-numbers') }}" class="w3-bar-item w3-button"> Random Numbers</a>
                    <a href="{{ route('highestMarks') }}" class="w3-bar-item w3-button"> Student</a>
                </div>

                <!-- Hide right-floated links on small screens and replace them with a menu icon -->
                <a href="javascript:void(0)" class="w3-bar-item w3-button w3-right w3-hide-large w3-hide-medium" onclick="w3_open()">
                    <i class="fa fa-bars"></i>
                </a>
            </div>
        </div>

        <!-- Sidebar on small screens when clicking the menu icon -->
        <nav class="w3-sidebar w3-bar-block w3-black w3-card w3-animate-left w3-hide-medium w3-hide-large" style="display:none" id="mySidebar">
            <a href="javascript:void(0)" onclick="w3_close()" class="w3-bar-item w3-button w3-large w3-padding-16">Close ×</a>
            <a href="{{ url('/') }}" onclick="w3_close()" class="w3-bar-item w3-button">Sequence</a>
            <a href="{{ url('/project-date') }}" onclick="w3_close()" class="w3-bar-item w3-button"> Delivery Date</a>
            <a href="{{ url('/array-search') }}" onclick="w3_close()" class="w3-bar-item w3-button">Array Search</a>
            <a href="{{ url('/find-second-fourth-saturday') }}" onclick="w3_close()" class="w3-bar-item w3-button">Find Saturdays</a>
            <a href="{{ url('/random-numbers') }}" onclick="w3_close()" class="w3-bar-item w3-button">Random Numbers</a>
            <a href="{{ route('highestMarks') }}" onclick="w3_close()" class="w3-bar-item w3-button">Student</a>
        </nav>

        <main class="py-4 mt-5">
            @yield('content')
        </main>
    </div>

    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.9.0/dist/js/bootstrap-datepicker.min.js"></script>

    <script>

        // Toggle between showing and hiding the sidebar when clicking the menu icon
        var mySidebar = document.getElementById("mySidebar");
        
        function w3_open() {
            if (mySidebar.style.display === 'block') {
                mySidebar.style.display = 'none';
            } else {
                mySidebar.style.display = 'block';
            }
        }
        
        // Close the sidebar with the close button
        function w3_close() {
            mySidebar.style.display = "none";
        }

        $(document).ready(function(){
            $('.date_picker').datepicker({
                format: 'dd-mm-yyyy',
                autoclose: true
            });
        });
    </script>
    
    @yield('scripts')

</body>
</html>
<style>
    .dropdown-menu {
    z-index: 9999 !important;
}
    </style>
