<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title> @yield('title', 'E-Sports04')</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700&display=swap"
        rel="stylesheet" />

        @stack('styles')
</head>
@include('layouts.header')

<body>
        <main>

            @yield('content')
            
            
        </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-links">
            <div class="col">
                <img
                    src="./img/footer-logo.png"
                    class="footer-logo"
                    alt="Four04 Logo" />
            </div>
            <div class="col">
                <h4>Our Contact</h4>
                <a href="./about.html">Who we are ?</a>
                <a href="./terms.html">Terms and Conditions</a>
                <p>POBOX:123456</p>
            </div>

            <div class="col">
                <h4>Event Management</h4>

                <p>info@four04.com</p>
                <p>+971 50123456</p>
            </div>

            <div class="col">
                <h4>E-spost</h4>
                <p>Bur Dubai</p>
                <p>Esport@four04.com</p>
                <p>+971 50123456</p>
            </div>

            <div class="col">
                <h4>Careers</h4>
                <a href="#">Blog</a>
                <a href="#">Press</a>
                <a href="#">Partnerships</a>
            </div>
        </div>

        <div class="footer-bottom gradient-bar">
            <p>©Copyright 2025</p>
            <p>Designed & Developed by Four04</p>
        </div>
    </footer>
    @stack('scripts')
</body>

</html>