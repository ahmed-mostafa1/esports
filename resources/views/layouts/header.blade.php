    <!-- Header Navigation -->
    <header class="navbar">
      <!-- Logo Section -->
      <div class="logo">
        <a href="{{ route('home') }}" aria-label="Four04 Esports Home">
          <img src="{{ content_media('logo.main', 'img/logo.png') }}" class="logo-img" alt="Four04 Esports Logo" />
        </a>
      </div>
      
      <!-- Mobile Menu Toggle -->
      <input type="checkbox" id="navbar-toggle" class="navbar-toggle" aria-hidden="true">
      <label for="navbar-toggle" class="navbar-toggler" aria-label="Toggle navigation menu">
        <span class="hamburger-line"></span>
        <span class="hamburger-line"></span>
        <span class="hamburger-line"></span>
      </label>

      <!-- Navigation Menu -->
      <nav class="nav-links" role="navigation" aria-label="Main navigation">
        <a href="{{ route('home') }}" {{ request()->routeIs('home') ? 'aria-current=page' : '' }}>{{ content('nav.home', 'Home') }}</a>
        <a href="{{ route('about') }}" {{ request()->routeIs('about') ? 'aria-current=page' : '' }}>{{ content('nav.about', 'About Us') }}</a>
        <a href="{{ route('services') }}" {{ request()->routeIs('services') ? 'aria-current=page' : '' }}>{{ content('nav.services', 'Our Services') }}</a>
        <a href="{{ route('tournaments') }}" {{ request()->routeIs('tournaments') ? 'aria-current=page' : '' }}>{{ content('nav.esports', 'E-Sports') }}</a>
        <a href="{{ route('tours-reg') }}" {{ request()->routeIs('tours-reg') ? 'aria-current=page' : '' }}>{{ content('nav.events', 'Events Management') }}</a>
        <a href="{{ route('team') }}" {{ request()->routeIs('team') ? 'aria-current=page' : '' }}>{{ content('nav.team', 'Our Team') }}</a>
        @auth
          <a href="{{ route('profile.edit') }}" {{ request()->routeIs('profile.*') ? 'aria-current=page' : '' }}>
            {{ content('nav.profile', 'My Profile') }}
          </a>
          <form method="POST" action="{{ route('logout') }}" class="nav-logout-form">
            @csrf
            <button type="submit">
              {{ content('nav.logout', 'Logout') }}
            </button>
          </form>
        @else
          <a href="{{ route('login') }}" {{ request()->routeIs('login') ? 'aria-current=page' : '' }}>{{ content('nav.login', 'Login') }}</a>
        @endauth
        <a href="{{ route('setLocale', 'en') }}" class="lang-switch {{ app()->getLocale() === 'en' ? 'active' : '' }}">EN</a>
        <a href="{{ route('setLocale', 'ar') }}" class="lang-switch {{ app()->getLocale() === 'ar' ? 'active' : '' }}">AR</a>
      </nav>
    </header>
