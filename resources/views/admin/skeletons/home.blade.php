@extends('admin.layout')

@section('title', 'Edit Home Page - Skeleton View')

@section('content')
<div class="skeleton-editor">
    <!-- Mode Indicator -->
    <div class="skeleton-mode-indicator">
        🎨 SKELETON EDIT MODE - COMPLETE HOME PAGE
    </div>

    <!-- Header -->
    <div class="skeleton-header">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-xl font-semibold text-white">Home Page - Visual Editor (Complete)</h1>
                <p class="text-sm text-gray-400">Click any content element to edit it inline - All 6 sections visible</p>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('admin.contents.page', 'home') }}" 
                   class="px-3 py-1 text-sm bg-neutral-700 text-gray-300 rounded hover:bg-neutral-600">
                    📋 Standard Editor
                </a>
                <a href="{{ route('home') }}" 
                   class="px-3 py-1 text-sm bg-blue-600 text-white rounded hover:bg-blue-700" 
                   target="_blank">
                    👁️ Preview Page
                </a>
                <button onclick="scrollToSection()" 
                        class="px-3 py-1 text-sm bg-green-600 text-white rounded hover:bg-green-700">
                    📍 Jump to Section
                </button>
            </div>
        </div>
    </div>

    <!-- Section Navigation -->
    <div class="skeleton-nav bg-neutral-800/50 border-b border-neutral-700 px-8 py-3">
        <div class="flex flex-wrap gap-2 text-sm">
            <a href="#hero-section" class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700">🏠 Hero</a>
            <a href="#services-section" class="px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700">🛠️ Services</a>
            <a href="#tournaments-section" class="px-3 py-1 bg-green-600 text-white rounded hover:bg-green-700">🏆 Tournaments</a>
            <a href="#partners-section" class="px-3 py-1 bg-purple-600 text-white rounded hover:bg-purple-700">🤝 Partners</a>
            <a href="#testimonials-section" class="px-3 py-1 bg-yellow-600 text-white rounded hover:bg-yellow-700">💬 Testimonials</a>
            <a href="#about-section" class="px-3 py-1 bg-pink-600 text-white rounded hover:bg-pink-700">ℹ️ About</a>
        </div>
    </div>

    <!-- Instructions -->
    <div class="skeleton-content">
        <div class="skeleton-instructions">
            <h3>How to use the Complete Skeleton Editor:</h3>
            <ul>
                <li><span style="color: #60a5fa;">Blue highlighted areas</span> are text content - click to edit text in multiple languages</li>
                <li><span style="color: #34d399;">Green highlighted areas</span> are images - click to upload new images</li>
                <li>Use the section navigation above to quickly jump to different parts of the page</li>
                <li>Changes are saved instantly and will update the live site</li>
                <li>Hover over any content to see its content key identifier</li>
                <li><strong>This skeleton shows ALL 6 sections</strong> of the home page for complete editing</li>
            </ul>
        </div>

        <!-- 1. HERO SECTION -->
        <section id="hero-section" class="hero bg-gradient-to-r from-gray-900 to-gray-800 text-white p-8 mb-8 rounded-lg border-l-4 border-red-500">
            <div class="section-header mb-6">
                <h2 class="text-2xl font-bold text-red-400 mb-2">🏠 HERO SECTION</h2>
                <p class="text-gray-300 text-sm">Main landing area with title, description, countdown and call-to-action</p>
            </div>
            
            <div class="container mx-auto">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
                    <!-- Left Column -->
                    <div>
                        <h1 class="text-4xl font-bold mb-4">
                            <span data-content-key="home.hero.title" 
                                  data-content-type="text"
                                  data-content-value="{{ $contents['home.hero.title']->value ?? '{}' }}">
                                {{ content('home.hero.title', 'Welcome to Esports') }}
                            </span>
                        </h1>
                        
                        <h2 class="text-2xl mb-6">
                            <span data-content-key="home.hero.subtitle" 
                                  data-content-type="text"
                                  data-content-value="{{ $contents['home.hero.subtitle']->value ?? '{}' }}">
                                {{ content('home.hero.subtitle', 'Championship') }}
                            </span>
                        </h2>

                        <p class="text-lg mb-8">
                            <span data-content-key="home.hero.description" 
                                  data-content-type="text"
                                  data-content-value="{{ $contents['home.hero.description']->value ?? '{}' }}">
                                {{ content('home.hero.description', 'Join the ultimate gaming experience') }}
                            </span>
                        </p>

                        @php
                            $skeletonNow = now();
                            $skeletonDefaultTarget = (clone $skeletonNow)->addMonths(3)->startOfMinute();
                            $skeletonTargetRaw = content('home.countdown.target_datetime', $skeletonDefaultTarget->toIso8601String());

                            try {
                                $skeletonTarget = \Carbon\Carbon::parse($skeletonTargetRaw);
                            } catch (\Throwable $e) {
                                $skeletonTarget = clone $skeletonDefaultTarget;
                            }

                            $skeletonTarget = $skeletonTarget->timezone($skeletonNow->timezone);

                            if ($skeletonTarget->lessThanOrEqualTo($skeletonNow)) {
                                $skeletonMonths = $skeletonDays = $skeletonMinutes = 0;
                            } else {
                                $skeletonInterval = $skeletonNow->diff($skeletonTarget);
                                $skeletonMonths = max(0, ($skeletonInterval->y * 12) + $skeletonInterval->m);
                                $skeletonDays = max(0, $skeletonInterval->d);
                                $skeletonMinutes = max(0, $skeletonInterval->i);
                            }
                        @endphp

                        <!-- Countdown -->
                        <div class="countdown flex gap-4 mb-4 p-4 bg-gray-800 rounded">
                            <div class="text-center">
                                <div class="text-2xl font-bold">{{ str_pad($skeletonMonths, 2, '0', STR_PAD_LEFT) }}</div>
                                <div data-content-key="home.countdown.months" 
                                     data-content-type="text"
                                     data-content-value="{{ $contents['home.countdown.months']->value ?? '{}' }}">
                                    {{ content('home.countdown.months', 'Months') }}
                                </div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl font-bold">⭐</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl font-bold">{{ str_pad($skeletonDays, 2, '0', STR_PAD_LEFT) }}</div>
                                <div data-content-key="home.countdown.days" 
                                     data-content-type="text"
                                     data-content-value="{{ $contents['home.countdown.days']->value ?? '{}' }}">
                                    {{ content('home.countdown.days', 'Days') }}
                                </div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl font-bold">⭐</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl font-bold">{{ str_pad($skeletonMinutes, 2, '0', STR_PAD_LEFT) }}</div>
                                <div data-content-key="home.countdown.minutes" 
                                     data-content-type="text"
                                     data-content-value="{{ $contents['home.countdown.minutes']->value ?? '{}' }}">
                                    {{ content('home.countdown.minutes', 'Minutes') }}
                                </div>
                            </div>
                        </div>

                        <div class="bg-gray-800/70 border border-gray-700 rounded p-4 mb-8 text-sm">
                            <p class="text-gray-300 font-semibold mb-2">Countdown Target (ISO 8601 format)</p>
                            <p class="text-gray-400 mb-2">Set the event date &amp; time (e.g. <code>2025-12-31T18:00:00+00:00</code>). The hero countdown automatically recalculates months, days, and minutes based on this value.</p>
                            <div class="inline-flex items-center gap-2 px-3 py-2 bg-gray-900 rounded border border-gray-700">
                                <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2h-1M6 5H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <span data-content-key="home.countdown.target_datetime"
                                      data-content-type="text"
                                      data-content-value="{{ optional($contents->get('home.countdown.target_datetime'))->value ?? '{}' }}">
                                    {{ content('home.countdown.target_datetime', $skeletonDefaultTarget->toIso8601String()) }}
                                </span>
                            </div>
                        </div>

                        <!-- CTA -->
                        <div class="hero-actions flex items-center gap-4 p-4 bg-red-900/20 rounded border border-red-700">
                            <span data-content-key="home.cta.button.image" 
                                  data-content-type="image"
                                  data-content-value="{{ $contents['home.cta.button.image']->value ?? '{}' }}"
                                  data-image-url="{{ content_media('home.cta.button.image', 'img/register-now.png') }}">
                                <img src="{{ content_media('home.cta.button.image', 'img/register-now.png') }}" 
                                     alt="Register Now" 
                                     class="h-12" />
                            </span>
                            
                            <span data-content-key="home.cta.button" 
                                  data-content-type="text"
                                  data-content-value="{{ $contents['home.cta.button']->value ?? '{}' }}">
                                {{ content('home.cta.button', 'Register Now') }}
                            </span>
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="text-center">
                        <span data-content-key="home.hero.image" 
                              data-content-type="image"
                              data-content-value="{{ $contents['home.hero.image']->value ?? '{}' }}"
                              data-image-url="{{ content_media('home.hero.image', 'content-images/home.hero.image.png') }}">
                            <img src="{{ content_media('home.hero.image', 'content-images/home.hero.image.png') }}" 
                                 alt="Hero Image" 
                                 class="w-full max-w-md mx-auto rounded-lg border-4 border-green-500" />
                        </span>

                        <div class="mt-4 bg-gray-800 p-4 rounded border border-gray-600">
                            <small data-content-key="home.hero.tag.ready" 
                                   data-content-type="text"
                                   data-content-value="{{ $contents['home.hero.tag.ready']->value ?? '{}' }}">
                                {{ content('home.hero.tag.ready', 'Ready For The') }}
                            </small>
                            <div class="font-bold">
                                <span data-content-key="home.hero.tag.suspension" 
                                      data-content-type="text"
                                      data-content-value="{{ $contents['home.hero.tag.suspension']->value ?? '{}' }}">
                                    {{ content('home.hero.tag.suspension', 'Suspension') }}
                                </span>
                                <span data-content-key="home.hero.tag.esports" 
                                      data-content-type="text"
                                      data-content-value="{{ $contents['home.hero.tag.esports']->value ?? '{}' }}">
                                    {{ content('home.hero.tag.esports', 'Esports') }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- 2. SERVICES SECTION -->
        <section id="services-section" class="services bg-gradient-to-r from-blue-900 to-blue-800 text-white p-8 mb-8 rounded-lg border-l-4 border-blue-500">
            <div class="section-header mb-6">
                <h2 class="text-2xl font-bold text-blue-400 mb-2">🛠️ SERVICES SECTION</h2>
                <p class="text-gray-300 text-sm">Three service cards showcasing key offerings</p>
            </div>
            
            <div class="container mx-auto">
                <h2 class="text-3xl font-bold text-center mb-8">
                    <span data-content-key="home.services.title" 
                          data-content-type="text"
                          data-content-value="{{ $contents['home.services.title']->value ?? '{}' }}">
                        {{ content('home.services.title', 'Our Services') }}
                    </span>
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Service Card 1 -->
                    <div class="text-center bg-blue-700 p-6 rounded-lg border border-blue-600">
                        <div class="mb-4">
                            <span data-content-key="home.services.card1.icon" 
                                  data-content-type="image"
                                  data-content-value="{{ $contents['home.services.card1.icon']->value ?? '{}' }}"
                                  data-image-url="{{ content_media('home.services.card1.icon', 'img/Subtract(1).png') }}">
                                <img src="{{ content_media('home.services.card1.icon', 'img/Subtract(1).png') }}" 
                                     alt="Service 1" 
                                     class="w-16 h-16 mx-auto border-2 border-green-400 rounded" />
                            </span>
                        </div>
                        <h3 class="text-xl font-semibold mb-3">
                            <span data-content-key="home.services.card1.title" 
                                  data-content-type="text"
                                  data-content-value="{{ $contents['home.services.card1.title']->value ?? '{}' }}">
                                {{ content('home.services.card1.title', 'Experienced Trainers') }}
                            </span>
                        </h3>
                        <p data-content-key="home.services.card1.description" 
                           data-content-type="text"
                           data-content-value="{{ $contents['home.services.card1.description']->value ?? '{}' }}">
                            {{ content('home.services.card1.description', 'Endless action that keeps players coming back.') }}
                        </p>
                    </div>

                    <!-- Service Card 2 -->
                    <div class="text-center bg-blue-700 p-6 rounded-lg border border-blue-600">
                        <div class="mb-4">
                            <span data-content-key="home.services.card2.icon" 
                                  data-content-type="image"
                                  data-content-value="{{ $contents['home.services.card2.icon']->value ?? '{}' }}"
                                  data-image-url="{{ content_media('home.services.card2.icon', 'img/Subtract.png') }}">
                                <img src="{{ content_media('home.services.card2.icon', 'img/Subtract.png') }}" 
                                     alt="Service 2" 
                                     class="w-16 h-16 mx-auto border-2 border-green-400 rounded" />
                            </span>
                        </div>
                        <h3 class="text-xl font-semibold mb-3">
                            <span data-content-key="home.services.card2.title" 
                                  data-content-type="text"
                                  data-content-value="{{ $contents['home.services.card2.title']->value ?? '{}' }}">
                                {{ content('home.services.card2.title', 'Every Console') }}
                            </span>
                        </h3>
                        <p data-content-key="home.services.card2.description" 
                           data-content-type="text"
                           data-content-value="{{ $contents['home.services.card2.description']->value ?? '{}' }}">
                            {{ content('home.services.card2.description', 'We deliver the complete esports experience.') }}
                        </p>
                    </div>

                    <!-- Service Card 3 -->
                    <div class="text-center bg-blue-700 p-6 rounded-lg border border-blue-600">
                        <div class="mb-4">
                            <span data-content-key="home.services.card3.icon" 
                                  data-content-type="image"
                                  data-content-value="{{ $contents['home.services.card3.icon']->value ?? '{}' }}"
                                  data-image-url="{{ content_media('home.services.card3.icon', 'img/Subtract(2).png') }}">
                                <img src="{{ content_media('home.services.card3.icon', 'img/Subtract(2).png') }}" 
                                     alt="Service 3" 
                                     class="w-16 h-16 mx-auto border-2 border-green-400 rounded" />
                            </span>
                        </div>
                        <h3 class="text-xl font-semibold mb-3">
                            <span data-content-key="home.services.card3.title" 
                                  data-content-type="text"
                                  data-content-value="{{ $contents['home.services.card3.title']->value ?? '{}' }}">
                                {{ content('home.services.card3.title', 'Live Streaming') }}
                            </span>
                        </h3>
                        <p data-content-key="home.services.card3.description" 
                           data-content-type="text"
                           data-content-value="{{ $contents['home.services.card3.description']->value ?? '{}' }}">
                            {{ content('home.services.card3.description', 'One destination for unforgettable events.') }}
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- 3. TOURNAMENTS SECTION -->
        <section id="tournaments-section" class="tournaments bg-gradient-to-r from-green-900 to-green-800 text-white p-8 mb-8 rounded-lg border-l-4 border-green-500">
            <div class="section-header mb-6">
                <h2 class="text-2xl font-bold text-green-400 mb-2">🏆 TOURNAMENTS SECTION</h2>
                <p class="text-gray-300 text-sm">Popular tournaments list with badge and descriptions</p>
            </div>
            
            <div class="container mx-auto">
                <div class="text-center mb-8">
                    <h2 class="text-3xl font-bold mb-4">
                        <span data-content-key="home.tournaments.title" 
                              data-content-type="text"
                              data-content-value="{{ $contents['home.tournaments.title']->value ?? '{}' }}">
                            {{ content('home.tournaments.title', 'Popular Tournaments') }}
                        </span>
                    </h2>
                    <p class="text-xl">
                        <span data-content-key="home.tournaments.subtitle" 
                              data-content-type="text"
                              data-content-value="{{ $contents['home.tournaments.subtitle']->value ?? '{}' }}">
                            {{ content('home.tournaments.subtitle', 'Join the competition') }}
                        </span>
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Tournament Column 1 -->
                    <div class="space-y-4">
                        <div class="bg-green-700 p-4 rounded-lg flex items-center gap-3 border border-green-600">
                            <span data-content-key="home.tournament.badge" 
                                  data-content-type="image"
                                  data-content-value="{{ $contents['home.tournament.badge']->value ?? '{}' }}"
                                  data-image-url="{{ content_media('home.tournament.badge', 'img/badge.png') }}">
                                <img src="{{ content_media('home.tournament.badge', 'img/badge.png') }}" 
                                     alt="Tournament Badge" 
                                     class="w-8 h-8 border border-green-400 rounded" />
                            </span>
                            <span data-content-key="home.tournament.dubai_police" 
                                  data-content-type="text"
                                  data-content-value="{{ $contents['home.tournament.dubai_police']->value ?? '{}' }}">
                                {{ content('home.tournament.dubai_police', 'Dubai Police Esports Tournament') }}
                            </span>
                        </div>
                        
                        <div class="bg-green-700 p-4 rounded-lg flex items-center gap-3 border border-green-600">
                            <span data-content-key="home.tournament.badge" 
                                  data-content-type="image"
                                  data-content-value="{{ $contents['home.tournament.badge']->value ?? '{}' }}"
                                  data-image-url="{{ content_media('home.tournament.badge', 'img/badge.png') }}">
                                <img src="{{ content_media('home.tournament.badge', 'img/badge.png') }}" 
                                     alt="Tournament Badge" 
                                     class="w-8 h-8 border border-green-400 rounded" />
                            </span>
                            <span data-content-key="home.tournament.emirates_festival" 
                                  data-content-type="text"
                                  data-content-value="{{ $contents['home.tournament.emirates_festival']->value ?? '{}' }}">
                                {{ content('home.tournament.emirates_festival', 'Emirates Esports Festival 22') }}
                            </span>
                        </div>
                    </div>

                    <!-- Tournament Column 2 -->
                    <div class="space-y-4">
                        <div class="bg-green-700 p-4 rounded-lg flex items-center gap-3 border border-green-600">
                            <span data-content-key="home.tournament.badge" 
                                  data-content-type="image"
                                  data-content-value="{{ $contents['home.tournament.badge']->value ?? '{}' }}"
                                  data-image-url="{{ content_media('home.tournament.badge', 'img/badge.png') }}">
                                <img src="{{ content_media('home.tournament.badge', 'img/badge.png') }}" 
                                     alt="Tournament Badge" 
                                     class="w-8 h-8 border border-green-400 rounded" />
                            </span>
                            <span data-content-key="home.tournament.que_club" 
                                  data-content-type="text"
                                  data-content-value="{{ $contents['home.tournament.que_club']->value ?? '{}' }}">
                                {{ content('home.tournament.que_club', 'Que Club 1v1 League of Legends Showdown') }}
                            </span>
                        </div>
                        
                        <div class="bg-green-700 p-4 rounded-lg flex items-center gap-3 border border-green-600">
                            <span data-content-key="home.tournament.badge" 
                                  data-content-type="image"
                                  data-content-value="{{ $contents['home.tournament.badge']->value ?? '{}' }}"
                                  data-image-url="{{ content_media('home.tournament.badge', 'img/badge.png') }}">
                                <img src="{{ content_media('home.tournament.badge', 'img/badge.png') }}" 
                                     alt="Tournament Badge" 
                                     class="w-8 h-8 border border-green-400 rounded" />
                            </span>
                            <span data-content-key="home.tournament.manchester_fifa" 
                                  data-content-type="text"
                                  data-content-value="{{ $contents['home.tournament.manchester_fifa']->value ?? '{}' }}">
                                {{ content('home.tournament.manchester_fifa', 'Manchester City FIFA Cup') }}
                            </span>
                        </div>
                    </div>

                    <!-- Tournament Column 3 -->
                    <div class="space-y-4">
                        <div class="bg-green-700 p-4 rounded-lg flex items-center gap-3 border border-green-600">
                            <span data-content-key="home.tournament.badge" 
                                  data-content-type="image"
                                  data-content-value="{{ $contents['home.tournament.badge']->value ?? '{}' }}"
                                  data-image-url="{{ content_media('home.tournament.badge', 'img/badge.png') }}">
                                <img src="{{ content_media('home.tournament.badge', 'img/badge.png') }}" 
                                     alt="Tournament Badge" 
                                     class="w-8 h-8 border border-green-400 rounded" />
                            </span>
                            <span data-content-key="home.tournament.dota_mena" 
                                  data-content-type="text"
                                  data-content-value="{{ $contents['home.tournament.dota_mena']->value ?? '{}' }}">
                                {{ content('home.tournament.dota_mena', 'DOTA 2 MENA Tournament') }}
                            </span>
                        </div>
                        
                        <div class="bg-green-700 p-4 rounded-lg flex items-center gap-3 border border-green-600">
                            <span data-content-key="home.tournament.badge" 
                                  data-content-type="image"
                                  data-content-value="{{ $contents['home.tournament.badge']->value ?? '{}' }}"
                                  data-image-url="{{ content_media('home.tournament.badge', 'img/badge.png') }}">
                                <img src="{{ content_media('home.tournament.badge', 'img/badge.png') }}" 
                                     alt="Tournament Badge" 
                                     class="w-8 h-8 border border-green-400 rounded" />
                            </span>
                            <span data-content-key="home.tournament.dubai_police" 
                                  data-content-type="text"
                                  data-content-value="{{ $contents['home.tournament.dubai_police']->value ?? '{}' }}">
                                {{ content('home.tournament.dubai_police', 'Dubai Police Esports Tournament') }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- 4. PARTNERS SECTION -->
        <section id="partners-section" class="partners bg-gradient-to-r from-purple-900 to-purple-800 text-white p-8 mb-8 rounded-lg border-l-4 border-purple-500">
            <div class="section-header mb-6">
                <h2 class="text-2xl font-bold text-purple-400 mb-2">🤝 PARTNERS SECTION</h2>
                <p class="text-gray-300 text-sm">Partner cards with images and live streaming information</p>
            </div>
            
            <div class="container mx-auto">
                <h2 class="text-3xl font-bold text-center mb-8">
                    <span data-content-key="home.partners.title" 
                          data-content-type="text"
                          data-content-value="{{ $contents['home.partners.title']->value ?? '{}' }}">
                        {{ content('home.partners.title', 'Our Partners') }}
                    </span>
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <!-- Partner 1 -->
                    <div class="text-center bg-purple-700 p-6 rounded-lg border border-purple-600">
                        <div class="mb-4 relative">
                            <span data-content-key="home.partners.partner1.image" 
                                  data-content-type="image"
                                  data-content-value="{{ $contents['home.partners.partner1.image']->value ?? '{}' }}"
                                  data-image-url="{{ content_media('home.partners.partner1.image', 'img/dubi.png') }}">
                                <img src="{{ content_media('home.partners.partner1.image', 'img/dubi.png') }}" 
                                     alt="Partner 1" 
                                     class="w-full h-32 mx-auto rounded border-2 border-green-400" />
                            </span>
                            <div class="absolute top-2 left-2 bg-red-600 text-white px-2 py-1 text-xs rounded">
                                <span data-content-key="home.partners.live_indicator" 
                                      data-content-type="text"
                                      data-content-value="{{ $contents['home.partners.live_indicator']->value ?? '{}' }}">
                                    {{ content('home.partners.live_indicator', '● Live') }}
                                </span>
                            </div>
                        </div>
                        <h3 class="text-lg font-semibold mb-2">
                            <span data-content-key="home.partners.partner1.name" 
                                  data-content-type="text"
                                  data-content-value="{{ $contents['home.partners.partner1.name']->value ?? '{}' }}">
                                {{ content('home.partners.partner1.name', 'Dubai Police') }}
                            </span>
                        </h3>
                        <p class="text-sm text-purple-200">
                            <span data-content-key="home.partners.live_title" 
                                  data-content-type="text"
                                  data-content-value="{{ $contents['home.partners.live_title']->value ?? '{}' }}">
                                {{ content('home.partners.live_title', 'LIVE: Nemiga vs Fornite') }}
                            </span>
                        </p>
                    </div>

                    <!-- Partner 2 -->
                    <div class="text-center bg-purple-700 p-6 rounded-lg border border-purple-600">
                        <div class="mb-4 relative">
                            <span data-content-key="home.partners.partner2.image" 
                                  data-content-type="image"
                                  data-content-value="{{ $contents['home.partners.partner2.image']->value ?? '{}' }}"
                                  data-image-url="{{ content_media('home.partners.partner2.image', 'img/que.png') }}">
                                <img src="{{ content_media('home.partners.partner2.image', 'img/que.png') }}" 
                                     alt="Partner 2" 
                                     class="w-full h-32 mx-auto rounded border-2 border-green-400" />
                            </span>
                            <div class="absolute top-2 left-2 bg-red-600 text-white px-2 py-1 text-xs rounded">● Live</div>
                        </div>
                        <h3 class="text-lg font-semibold mb-2">
                            <span data-content-key="home.partners.partner2.name" 
                                  data-content-type="text"
                                  data-content-value="{{ $contents['home.partners.partner2.name']->value ?? '{}' }}">
                                {{ content('home.partners.partner2.name', 'Que Club') }}
                            </span>
                        </h3>
                    </div>

                    <!-- Partner 3 -->
                    <div class="text-center bg-purple-700 p-6 rounded-lg border border-purple-600">
                        <div class="mb-4 relative">
                            <span data-content-key="home.partners.partner3.image" 
                                  data-content-type="image"
                                  data-content-value="{{ $contents['home.partners.partner3.image']->value ?? '{}' }}"
                                  data-image-url="{{ content_media('home.partners.partner3.image', 'img/emirate.png') }}">
                                <img src="{{ content_media('home.partners.partner3.image', 'img/emirate.png') }}" 
                                     alt="Partner 3" 
                                     class="w-full h-32 mx-auto rounded border-2 border-green-400" />
                            </span>
                            <div class="absolute top-2 left-2 bg-red-600 text-white px-2 py-1 text-xs rounded">● Live</div>
                        </div>
                        <h3 class="text-lg font-semibold mb-2">
                            <span data-content-key="home.partners.partner3.name" 
                                  data-content-type="text"
                                  data-content-value="{{ $contents['home.partners.partner3.name']->value ?? '{}' }}">
                                {{ content('home.partners.partner3.name', 'Emirates Esports Festival') }}
                            </span>
                        </h3>
                    </div>

                    <!-- Partner 4 -->
                    <div class="text-center bg-purple-700 p-6 rounded-lg border border-purple-600">
                        <div class="mb-4 relative">
                            <span data-content-key="home.partners.partner4.image" 
                                  data-content-type="image"
                                  data-content-value="{{ $contents['home.partners.partner4.image']->value ?? '{}' }}"
                                  data-image-url="{{ content_media('home.partners.partner4.image', 'img/dotta.png') }}">
                                <img src="{{ content_media('home.partners.partner4.image', 'img/dotta.png') }}" 
                                     alt="Partner 4" 
                                     class="w-full h-32 mx-auto rounded border-2 border-green-400" />
                            </span>
                            <div class="absolute top-2 left-2 bg-red-600 text-white px-2 py-1 text-xs rounded">● Live</div>
                        </div>
                        <h3 class="text-lg font-semibold mb-2">
                            <span data-content-key="home.partners.partner4.name" 
                                  data-content-type="text"
                                  data-content-value="{{ $contents['home.partners.partner4.name']->value ?? '{}' }}">
                                {{ content('home.partners.partner4.name', 'DOTA 2 MENA Tournament') }}
                            </span>
                        </h3>
                    </div>
                </div>
            </div>
        </section>

        <!-- 5. TESTIMONIALS SECTION -->
        <section id="testimonials-section" class="testimonials bg-gradient-to-r from-yellow-900 to-yellow-800 text-white p-8 mb-8 rounded-lg border-l-4 border-yellow-500">
            <div class="section-header mb-6">
                <h2 class="text-2xl font-bold text-yellow-400 mb-2">💬 TESTIMONIALS SECTION</h2>
                <p class="text-gray-300 text-sm">Client testimonials with avatars, names, roles and feedback text</p>
            </div>
            
            <div class="container mx-auto">
                <div class="text-center mb-8">
                    <h2 class="text-3xl font-bold mb-4">
                        <span data-content-key="home.testimonials.title" 
                              data-content-type="text"
                              data-content-value="{{ $contents['home.testimonials.title']->value ?? '{}' }}">
                            {{ content('home.testimonials.title', 'Client') }}
                        </span>
                        <span data-content-key="home.testimonials.subtitle" 
                              data-content-type="text"
                              data-content-value="{{ $contents['home.testimonials.subtitle']->value ?? '{}' }}">
                            {{ content('home.testimonials.subtitle', 'Testimonial') }}
                        </span>
                    </h2>
                    <p class="text-lg">
                        <span data-content-key="home.testimonials.description" 
                              data-content-type="text"
                              data-content-value="{{ $contents['home.testimonials.description']->value ?? '{}' }}">
                            {{ content('home.testimonials.description', 'Our Client feedback is overseas and Localy') }}
                        </span>
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <!-- Testimonial 1 -->
                    <div class="bg-yellow-700 p-6 rounded-lg border border-yellow-600">
                        <div class="flex items-center mb-4">
                            <span data-content-key="home.testimonial1.avatar" 
                                  data-content-type="image"
                                  data-content-value="{{ $contents['home.testimonial1.avatar']->value ?? '{}' }}"
                                  data-image-url="{{ content_media('home.testimonial1.avatar', 'img/Rectangle 28.png') }}">
                                <img src="{{ content_media('home.testimonial1.avatar', 'img/Rectangle 28.png') }}" 
                                     alt="Testimonial 1" 
                                     class="w-12 h-12 rounded-full border-2 border-green-400" />
                            </span>
                            <div class="ml-3">
                                <h4 class="font-semibold">
                                    <span data-content-key="home.testimonial1.name" 
                                          data-content-type="text"
                                          data-content-value="{{ $contents['home.testimonial1.name']->value ?? '{}' }}">
                                        {{ content('home.testimonial1.name', 'Mickdad Abbas') }}
                                    </span>
                                </h4>
                                <p class="text-sm text-yellow-200">
                                    <span data-content-key="home.testimonial1.role" 
                                          data-content-type="text"
                                          data-content-value="{{ $contents['home.testimonial1.role']->value ?? '{}' }}">
                                        {{ content('home.testimonial1.role', 'Founder') }}
                                    </span>
                                </p>
                            </div>
                        </div>
                        <p class="text-sm">
                            <span data-content-key="home.testimonial1.text" 
                                  data-content-type="text"
                                  data-content-value="{{ $contents['home.testimonial1.text']->value ?? '{}' }}">
                                "{{ content('home.testimonial1.text', 'The tournament was organized with such professionalism...') }}"
                            </span>
                        </p>
                    </div>

                    <!-- Testimonial 2 -->
                    <div class="bg-yellow-700 p-6 rounded-lg border border-yellow-600">
                        <div class="flex items-center mb-4">
                            <span data-content-key="home.testimonial2.avatar" 
                                  data-content-type="image"
                                  data-content-value="{{ $contents['home.testimonial2.avatar']->value ?? '{}' }}"
                                  data-image-url="{{ content_media('home.testimonial2.avatar', 'img/Rectangle 28.png') }}">
                                <img src="{{ content_media('home.testimonial2.avatar', 'img/Rectangle 28.png') }}" 
                                     alt="Testimonial 2" 
                                     class="w-12 h-12 rounded-full border-2 border-green-400" />
                            </span>
                            <div class="ml-3">
                                <h4 class="font-semibold">
                                    <span data-content-key="home.testimonial2.name" 
                                          data-content-type="text"
                                          data-content-value="{{ $contents['home.testimonial2.name']->value ?? '{}' }}">
                                        {{ content('home.testimonial2.name', 'Wysten Night') }}
                                    </span>
                                </h4>
                                <p class="text-sm text-yellow-200">
                                    <span data-content-key="home.testimonial2.role" 
                                          data-content-type="text"
                                          data-content-value="{{ $contents['home.testimonial2.role']->value ?? '{}' }}">
                                        {{ content('home.testimonial2.role', 'CEO') }}
                                    </span>
                                </p>
                            </div>
                        </div>
                        <p class="text-sm">
                            <span data-content-key="home.testimonial2.text" 
                                  data-content-type="text"
                                  data-content-value="{{ $contents['home.testimonial2.text']->value ?? '{}' }}">
                                "{{ content('home.testimonial2.text', 'We know how to bring the esports community together...') }}"
                            </span>
                        </p>
                    </div>

                    <!-- Testimonial 3 -->
                    <div class="bg-yellow-700 p-6 rounded-lg border border-yellow-600">
                        <div class="flex items-center mb-4">
                            <span data-content-key="home.testimonial3.avatar" 
                                  data-content-type="image"
                                  data-content-value="{{ $contents['home.testimonial3.avatar']->value ?? '{}' }}"
                                  data-image-url="{{ content_media('home.testimonial3.avatar', 'img/Rectangle 28.png') }}">
                                <img src="{{ content_media('home.testimonial3.avatar', 'img/Rectangle 28.png') }}" 
                                     alt="Testimonial 3" 
                                     class="w-12 h-12 rounded-full border-2 border-green-400" />
                            </span>
                            <div class="ml-3">
                                <h4 class="font-semibold">
                                    <span data-content-key="home.testimonial3.name" 
                                          data-content-type="text"
                                          data-content-value="{{ $contents['home.testimonial3.name']->value ?? '{}' }}">
                                        {{ content('home.testimonial3.name', 'Amira Saeed') }}
                                    </span>
                                </h4>
                                <p class="text-sm text-yellow-200">
                                    <span data-content-key="home.testimonial3.role" 
                                          data-content-type="text"
                                          data-content-value="{{ $contents['home.testimonial3.role']->value ?? '{}' }}">
                                        {{ content('home.testimonial3.role', 'Head of Events') }}
                                    </span>
                                </p>
                            </div>
                        </div>
                        <p class="text-sm">
                            <span data-content-key="home.testimonial3.text" 
                                  data-content-type="text"
                                  data-content-value="{{ $contents['home.testimonial3.text']->value ?? '{}' }}">
                                "{{ content('home.testimonial3.text', 'Top-tier production and smooth scheduling...') }}"
                            </span>
                        </p>
                    </div>

                    <!-- Testimonial 4 -->
                    <div class="bg-yellow-700 p-6 rounded-lg border border-yellow-600">
                        <div class="flex items-center mb-4">
                            <span data-content-key="home.testimonial4.avatar" 
                                  data-content-type="image"
                                  data-content-value="{{ $contents['home.testimonial4.avatar']->value ?? '{}' }}"
                                  data-image-url="{{ content_media('home.testimonial4.avatar', 'img/Rectangle 28.png') }}">
                                <img src="{{ content_media('home.testimonial4.avatar', 'img/Rectangle 28.png') }}" 
                                     alt="Testimonial 4" 
                                     class="w-12 h-12 rounded-full border-2 border-green-400" />
                            </span>
                            <div class="ml-3">
                                <h4 class="font-semibold">
                                    <span data-content-key="home.testimonial4.name" 
                                          data-content-type="text"
                                          data-content-value="{{ $contents['home.testimonial4.name']->value ?? '{}' }}">
                                        {{ content('home.testimonial4.name', 'Rashid Al Nuaimi') }}
                                    </span>
                                </h4>
                                <p class="text-sm text-yellow-200">
                                    <span data-content-key="home.testimonial4.role" 
                                          data-content-type="text"
                                          data-content-value="{{ $contents['home.testimonial4.role']->value ?? '{}' }}">
                                        {{ content('home.testimonial4.role', 'Operations Lead') }}
                                    </span>
                                </p>
                            </div>
                        </div>
                        <p class="text-sm">
                            <span data-content-key="home.testimonial4.text" 
                                  data-content-type="text"
                                  data-content-value="{{ $contents['home.testimonial4.text']->value ?? '{}' }}">
                                "{{ content('home.testimonial4.text', 'Superb coordination and hospitality...') }}"
                            </span>
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- 6. ABOUT SECTION -->
        <section id="about-section" class="about bg-gradient-to-r from-pink-900 to-pink-800 text-white p-8 mb-8 rounded-lg border-l-4 border-pink-500">
            <div class="section-header mb-6">
                <h2 class="text-2xl font-bold text-pink-400 mb-2">ℹ️ ABOUT / WHO WE ARE SECTION</h2>
                <p class="text-gray-300 text-sm">About section with mission, vision, story and subscribe form</p>
            </div>
            
            <div class="container mx-auto">
                <div class="text-center mb-8">
                    <h2 class="text-3xl font-bold mb-4">
                        <span data-content-key="about.header.title" 
                              data-content-type="text"
                              data-content-value="{{ $contents['about.header.title']->value ?? '{}' }}">
                            {{ content('about.header.title', 'WHO WE ARE ?') }}
                        </span>
                    </h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Our Story -->
                    <div class="bg-pink-700 p-6 rounded-lg border border-pink-600">
                        <h3 class="text-xl font-semibold mb-4 text-pink-200">
                            <span data-content-key="about.story.title" 
                                  data-content-type="text"
                                  data-content-value="{{ $contents['about.story.title']->value ?? '{}' }}">
                                {{ content('about.story.title', 'Our Story') }}
                            </span>
                        </h3>
                        <p data-content-key="about.team.description" 
                           data-content-type="text"
                           data-content-value="{{ $contents['about.team.description']->value ?? '{}' }}">
                            {{ content('about.team.description', 'In early winter 2020, amidst a raging pandemic, FOUR04 ESPORTS was born...') }}
                        </p>
                    </div>

                    <!-- Our Mission -->
                    <div class="bg-pink-700 p-6 rounded-lg border border-pink-600">
                        <h3 class="text-xl font-semibold mb-4 text-pink-200">
                            <span data-content-key="about.mission.title" 
                                  data-content-type="text"
                                  data-content-value="{{ $contents['about.mission.title']->value ?? '{}' }}">
                                {{ content('about.mission.title', 'Our Mission') }}
                            </span>
                        </h3>
                        <p data-content-key="about.mission.text" 
                           data-content-type="text"
                           data-content-value="{{ $contents['about.mission.text']->value ?? '{}' }}">
                            {{ content('about.mission.text', 'Establish a self-sustaining and progressively scalable eSports platform...') }}
                        </p>
                    </div>

                    <!-- Our Vision -->
                    <div class="bg-pink-700 p-6 rounded-lg border border-pink-600">
                        <h3 class="text-xl font-semibold mb-4 text-pink-200">
                            <span data-content-key="about.vision.title" 
                                  data-content-type="text"
                                  data-content-value="{{ $contents['about.vision.title']->value ?? '{}' }}">
                                {{ content('about.vision.title', 'Our Vision') }}
                            </span>
                        </h3>
                        <p data-content-key="about.vision.text" 
                           data-content-type="text"
                           data-content-value="{{ $contents['about.vision.text']->value ?? '{}' }}">
                            {{ content('about.vision.text', 'The Healing is fresh!!! can not wait to take my next session...') }}
                        </p>
                    </div>
                </div>

                <!-- Subscribe Form -->
                <div class="mt-8 text-center">
                    <div class="max-w-md mx-auto bg-pink-700 p-6 rounded-lg border border-pink-600">
                        <h3 class="text-lg font-semibold mb-4 text-pink-200">Stay Updated</h3>
                        <div class="flex gap-2">
                            <input type="email" 
                                   placeholder="{{ content('home.subscribe.placeholder', 'Enter your email address') }}" 
                                   class="flex-1 px-3 py-2 bg-pink-800 border border-pink-600 rounded text-white placeholder-pink-300">
                            <button class="px-4 py-2 bg-pink-600 hover:bg-pink-500 text-white rounded font-medium">
                                <span data-content-key="home.subscribe.button" 
                                      data-content-type="text"
                                      data-content-value="{{ $contents['home.subscribe.button']->value ?? '{}' }}">
                                    {{ content('home.subscribe.button', 'Subscribe') }}
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Completion Summary -->
        <div class="completion-summary bg-green-900/30 border border-green-700 rounded-lg p-6 text-center">
            <h3 class="text-xl font-bold text-green-400 mb-4">✅ Complete Home Page Skeleton</h3>
            <p class="text-gray-300 mb-4">All 6 sections of the home page are now visible and editable:</p>
            <div class="grid grid-cols-2 md:grid-cols-3 gap-2 text-sm">
                <div class="bg-red-800/30 px-3 py-2 rounded">🏠 Hero Section</div>
                <div class="bg-blue-800/30 px-3 py-2 rounded">🛠️ Services Section</div>
                <div class="bg-green-800/30 px-3 py-2 rounded">🏆 Tournaments Section</div>
                <div class="bg-purple-800/30 px-3 py-2 rounded">🤝 Partners Section</div>
                <div class="bg-yellow-800/30 px-3 py-2 rounded">💬 Testimonials Section</div>
                <div class="bg-pink-800/30 px-3 py-2 rounded">ℹ️ About Section</div>
            </div>
            <p class="text-gray-400 text-sm mt-4">
                Click any highlighted content to edit. Use section navigation at the top to jump between sections.
            </p>
        </div>
    </div>
</div>

<!-- Include Modal -->
@include('admin.components.edit-modal')

<!-- Include Styles -->
@include('admin.components.skeleton-styles')

<!-- Enhanced Scripts for Complete Skeleton -->
<script>
// Section navigation functionality
function scrollToSection() {
    const sections = [
        { id: 'hero-section', name: '🏠 Hero' },
        { id: 'services-section', name: '🛠️ Services' },
        { id: 'tournaments-section', name: '🏆 Tournaments' },
        { id: 'partners-section', name: '🤝 Partners' },
        { id: 'testimonials-section', name: '💬 Testimonials' },
        { id: 'about-section', name: 'ℹ️ About' }
    ];
    
    const sectionsList = sections.map(s => `${s.name} (#${s.id})`).join('\n');
    const selected = prompt(`Jump to section:\n\n${sectionsList}\n\nEnter section ID:`);
    
    if (selected) {
        const element = document.getElementById(selected.replace('#', ''));
        if (element) {
            element.scrollIntoView({ behavior: 'smooth', block: 'start' });
            element.classList.add('bg-white/10');
            setTimeout(() => element.classList.remove('bg-white/10'), 2000);
        }
    }
}

// Smooth scroll for navigation links
document.addEventListener('DOMContentLoaded', function() {
    const navLinks = document.querySelectorAll('a[href^="#"]');
    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href').substring(1);
            const targetElement = document.getElementById(targetId);
            if (targetElement) {
                targetElement.scrollIntoView({ behavior: 'smooth', block: 'start' });
                // Highlight the section briefly
                targetElement.classList.add('bg-white/10');
                setTimeout(() => targetElement.classList.remove('bg-white/10'), 2000);
            }
        });
    });
});
</script>

<!-- Include Scripts -->
@include('admin.components.skeleton-scripts')
@endsection
