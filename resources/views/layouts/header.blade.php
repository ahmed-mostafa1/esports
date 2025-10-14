    <!-- Header -->
    <header class="navbar">
      <div class="logo">
        <img src="./img/logo.png" class="logo-img fluid" alt="Four04 Logo" />
      </div>
      <!-- Hamburger Menu Toggle (hidden checkbox) -->
      <input type="checkbox" id="navbar-toggle" class="navbar-toggle">
      <label for="navbar-toggle" class="navbar-toggler" aria-label="Toggle navigation">
        <span class="hamburger-line"></span>
        <span class="hamburger-line"></span>
        <span class="hamburger-line"></span>
      </label>

      <nav class="nav-links">
        <a href="{{ route('home') }}">Home</a>
        <a href="{{ route('about') }}">About Us</a>
        <a href="{{ route('services') }}">Our Services</a>
        <a href="{{ route('tournaments') }}">E-Sports</a>
        <a href="{{ route('tours-reg') }}">Events Management</a>
        <a href="{{ route('team') }}">Our Team</a>
        <a href="{{ route('login') }}">Login</a>
        <a href="{{ route('register') }}">Sign Up for free</a>
        <a href="{{ route('setLocale', 'en') }}">EN</a>
        <a href="{{ route('setLocale', 'ar') }}">AR</a>

      </nav>
    </header>