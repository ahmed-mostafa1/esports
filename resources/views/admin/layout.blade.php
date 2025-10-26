<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="bg-black min-h-screen">
  <div class="flex min-h-screen">
    <!-- Sidebar -->
    <aside class="w-64 bg-white border-r border-gray-200">
      <div class="p-4 border-b border-gray-200">
        <a href="{{ route('admin.dashboard') }}" class="block text-gray-900 font-semibold">Esports Admin</a>
         <form method="POST" action="{{ route('logout') }}" class="nav-logout-form"  style="color: red; text-align: right;">
            @csrf
            <button type="submit">
              {{ content('nav.logout', 'Logout') }}
            </button>
          </form>
      </div>

      <nav class="p-3 space-y-1">
        <!-- Dashboard -->
        <a
          href="{{ route('admin.dashboard') }}"
          class="flex items-center gap-2 rounded-md px-3 py-2
                 {{ request()->routeIs('admin.dashboard') ? 'bg-red-600 text-white' : 'text-gray-700 hover:bg-gray-100' }}
                 transition"
        >
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5v12m8-12v12"></path>
          </svg>
          Dashboard
        </a>

        <!-- All Contents -->
        <a
          href="{{ route('admin.contents.index') }}"
          class="flex items-center gap-2 rounded-md px-3 py-2
                 {{ request()->routeIs('admin.contents.index') && !request()->has('group') ? 'bg-red-600 text-white' : 'text-gray-700 hover:bg-gray-100' }}
                 transition"
        >
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
          </svg>
          All Contents
        </a>

        <!-- Divider -->
        <div class="border-t border-gray-200 my-2"></div>
        <div class="px-3 py-1">
          <span class="text-xs font-medium text-gray-500 uppercase tracking-wider">Pages</span>
        </div>

        <!-- Page-specific buttons -->
        @php
          $pageGroups = [
            'home' => ['label' => 'Home Page', 'icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6'],
            'about' => ['label' => 'About Page', 'icon' => 'M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z'],
            'services' => ['label' => 'Services', 'icon' => 'M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z'],
            'gallery' => ['label' => 'Gallery Page', 'icon' => 'M4.5 4.5h2.121l1.5-1.5h7.758l1.5 1.5H19.5A1.5 1.5 0 0121 6v11.25a1.5 1.5 0 01-1.5 1.5h-15A1.5 1.5 0 013 17.25V6a1.5 1.5 0 011.5-1.5zm7.5 3a4.5 4.5 0 100 9 4.5 4.5 0 000-9z'],
            'tournaments' => ['label' => 'Tournaments', 'icon' => 'M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z'],
            'partners' => ['label' => 'Partners', 'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z'],
            ];
        @endphp

        @foreach($pageGroups as $group => $config)
          <a
            href="{{ route('admin.contents.skeleton', $group) }}"
            class="flex items-center gap-2 rounded-md px-3 py-2
                   {{ request()->routeIs('admin.contents.skeleton') && request()->route('group') === $group ? 'bg-red-600 text-white' : 'text-gray-700 hover:bg-gray-100' }}
                   transition"
          >
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $config['icon'] }}"></path>
            </svg>
            {{ $config['label'] }}
          </a>
        @endforeach
      </nav>
    </aside>

    <!-- Main -->
    <main class="flex-1">
      <header class="px-6 py-4 border-b border-gray-800 sticky top-0 bg-black/80 backdrop-blur">
        <h1 class="text-xl md:text-2xl font-semibold text-white">@yield('title')</h1>
      </header>

      <section class="px-6 py-6 text-white">
        @if(session('status'))
          <div class="bg-green-600/20 text-green-300 px-3 py-2 rounded mb-4 border border-green-700">
            {{ session('status') }}
          </div>
        @endif
        @yield('content')
      </section>
    </main>
  </div>
</body>
</html>
