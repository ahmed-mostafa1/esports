<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title> @yield('title', 'E-Sports04')</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700&display=swap"
        rel="stylesheet" />

        @stack('styles')
        <!-- Navbar CSS loads last to ensure it overrides any conflicts -->
        <link rel="stylesheet" href="{{ asset('css/navbar.css') }}" />
</head>

<body>
@include('layouts.header')
        <main>

            @yield('content')
            
            
        </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-links">
            <div class="col">
                <img
                    src="{{ content_media('logo.footer', 'img/footer-logo.png') }}"
                    class="footer-logo"
                    alt="Four04 Logo" />
            </div>
            <div class="col">
                <h4>{{ content('footer.contact.title', 'Our Contact') }}</h4>
                <a href="{{ route('about') }}">{{ content('footer.contact.who_we_are', 'Who we are ?') }}</a>
                <a href="{{ route('terms') }}">{{ content('footer.contact.terms', 'Terms and Conditions') }}</a>
                <p>{{ content('footer.contact.pobox', 'POBOX:123456') }}</p>
            </div>

            <div class="col">
                <h4>{{ content('footer.event_management.title', 'Event Management') }}</h4>

                <p>{{ content('footer.event_management.email', 'info@four04.com') }}</p>
                <p>{{ content('footer.event_management.phone', '+971 50123456') }}</p>
            </div>

            <div class="col">
                <h4>{{ content('footer.esport.title', 'E-spost') }}</h4>
                <p>{{ content('footer.esport.location', 'Bur Dubai') }}</p>
                <p>{{ content('footer.event_management.email', 'Esport@four04.com') }}</p>
                <p>{{ content('footer.event_management.phone', '+971 50123456') }}</p>
            </div>

            <div class="col">
                <h4>{{ content('footer.careers.title', 'Careers') }}</h4>
                <a href="#">{{ content('footer.careers.blog', 'Blog') }}</a>
                <a href="#">{{ content('footer.careers.press', 'Press') }}</a>
                <a href="#">{{ content('footer.careers.partnerships', 'Partnerships') }}</a>
            </div>
        </div>

        <div class="footer-bottom gradient-bar">
            <p>{{ content('footer.copyright', '©Copyright 2025') }}</p>
            <p>{{ content('footer.developed_by', 'Designed & Developed by Four04') }}</p>
         <a href='https://www.free-counters.org/'>org</a> <script type='text/javascript' src='https://www.freevisitorcounters.com/auth.php?id=2fe6182914f293fe7d0bc45459df8b30818d7855'></script>
<script type="text/javascript" src="https://www.freevisitorcounters.com/en/home/counter/1423638/t/0"></script>
        </div>
    </footer>
    @stack('scripts')
</body>
</html>