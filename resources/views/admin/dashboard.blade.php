@extends('admin.layout')

@section('title', 'Dashboard')

@section('content')

<!-- Quick Modules -->
<div class="mb-8">
  <div class="bg-neutral-900/50 border border-neutral-800 rounded-lg">
    <div class="px-6 py-4 border-b border-neutral-800">
      <h3 class="text-lg font-semibold text-white">🚀 Quick Modules</h3>
      <p class="text-gray-400 text-sm">Jump straight into frequent management areas</p>
    </div>
    <div class="p-6">
      <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-3">
        <a href="{{ route('admin.testimonials.index') }}"
           class="block px-4 py-2 bg-gradient-to-r from-yellow-600 to-yellow-700 hover:from-yellow-700 hover:to-yellow-800 text-white rounded transition-all transform hover:scale-105">
          💬 Manage Testimonials
        </a>
        <a href="{{ route('admin.contents.skeleton', 'reg-single') }}"
           class="block px-4 py-2 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white rounded transition-all transform hover:scale-105">
          👤 Edit Reg-Single Page
        </a>
        <a href="{{ route('admin.contents.skeleton', 'reg-team') }}"
           class="block px-4 py-2 bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white rounded transition-all transform hover:scale-105">
          👥 Edit Reg-Teams Page
        </a>
      </div>
    </div>
  </div>
</div>

<!-- Page Quick Access -->
<div class="grid grid-cols-1mb-8">
  <!-- Skeleton Editor -->
  <div class="bg-neutral-900/50 border border-neutral-800 rounded-lg">
    <div class="px-6 py-4 border-b border-neutral-800">
      <h3 class="text-lg font-semibold text-white">🎨 Complete Skeleton Editor Suite</h3>
      <p class="text-gray-400 text-sm">Visual page-based content editing - ALL PAGES AVAILABLE</p>
    </div>
    <div class="p-6">
      @php
        $skeletonMeta = [
          'home' => ['label' => 'Home Page Editor', 'emoji' => '🏠', 'gradient' => 'from-red-600 to-red-700', 'hover' => 'hover:from-red-700 hover:to-red-800'],
          'about' => ['label' => 'About Page Editor', 'emoji' => '📄', 'gradient' => 'from-blue-600 to-blue-700', 'hover' => 'hover:from-blue-700 hover:to-blue-800'],
          'services' => ['label' => 'Services Page Editor', 'emoji' => '🛠️', 'gradient' => 'from-yellow-600 to-yellow-700', 'hover' => 'hover:from-yellow-700 hover:to-yellow-800'],
          'news' => ['label' => 'News Page Editor', 'emoji' => '📰', 'gradient' => 'from-indigo-600 to-indigo-700', 'hover' => 'hover:from-indigo-700 hover:to-indigo-800'],
          'tournaments' => ['label' => 'Tournaments Page Editor', 'emoji' => '🏆', 'gradient' => 'from-green-600 to-green-700', 'hover' => 'hover:from-green-700 hover:to-green-800'],
          'partners' => ['label' => 'Partners Page Editor', 'emoji' => '🤝', 'gradient' => 'from-purple-600 to-purple-700', 'hover' => 'hover:from-purple-700 hover:to-purple-800'],
          'gallery' => ['label' => 'Gallery Page Editor', 'emoji' => '🖼️', 'gradient' => 'from-pink-600 to-pink-700', 'hover' => 'hover:from-pink-700 hover:to-pink-800'],
          ];

        $availableSkeletons = collect($skeletonPages ?? []);

        $sectionConfigs = collect([
          ['title' => '📄 Main Website Pages', 'pages' => ['home', 'about', 'services', 'news', 'tournaments', 'partners', 'gallery']],
        ]);

        $sections = $sectionConfigs->map(function ($config) use ($availableSkeletons) {
          return [
            'title' => $config['title'],
            'pages' => collect($config['pages'])->filter(fn ($page) => $availableSkeletons->contains($page))->values(),
          ];
        });

        $displayedPages = $sections->pluck('pages')->flatten();
        $additionalSkeletons = $availableSkeletons->diff($displayedPages);
      @endphp

      @foreach($sections as $section)
        @if($section['pages']->isNotEmpty())
          <div class="space-y-3 mb-6 last:mb-4">
            <div class="text-sm font-medium text-gray-300 mb-2">{{ $section['title'] }}</div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
              @foreach($section['pages'] as $page)
                @php
                  $meta = $skeletonMeta[$page] ?? [];
                  $gradient = $meta['gradient'] ?? 'from-slate-600 to-slate-700';
                  $hoverGradient = $meta['hover'] ?? 'hover:from-slate-700 hover:to-slate-800';
                  $emoji = $meta['emoji'] ?? '📄';
                  $label = $meta['label'] ?? (\Illuminate\Support\Str::headline($page) . ' Editor');
                @endphp
                <a href="{{ route('admin.contents.skeleton', $page) }}" 
                   class="block px-4 py-2 bg-gradient-to-r {{ $gradient }} {{ $hoverGradient }} text-white rounded transition-all transform hover:scale-105">
                  {{ $emoji }} {{ $label }}
                </a>
              @endforeach
            </div>
          </div>
        @endif
      @endforeach

      @php
        $customSkeletons = collect(['reg-team', 'reg-single', 'tours-reg'])->filter(fn ($page) => $availableSkeletons->contains($page));
        $standardSkeletons = $availableSkeletons->diff($customSkeletons);
      @endphp

      <div class="text-xs text-gray-500 p-3 bg-green-900/20 border border-green-700 rounded">
        ✅ <strong>AVAILABLE EDITORS:</strong> {{ $availableSkeletons->count() }} skeleton {{ \Illuminate\Support\Str::plural('page', $availableSkeletons->count()) }}
        <br>
        @if($customSkeletons->isNotEmpty())
          🎆 <strong>Custom Skeleton Editors:</strong> {{ $customSkeletons->map(fn ($page) => $skeletonMeta[$page]['label'] ?? \Illuminate\Support\Str::headline($page))->implode(', ') }}
          <br>
        @endif
        @if($standardSkeletons->isNotEmpty())
          📋 <strong>Standard Skeleton Editors:</strong> {{ $standardSkeletons->map(fn ($page) => $skeletonMeta[$page]['label'] ?? \Illuminate\Support\Str::headline($page))->implode(', ') }}
          <br>
        @endif
        💡 <strong>Tip:</strong> Custom skeleton editors include comprehensive form sections with real-time editing!
      </div>
    </div>
  </div>
</div>

<!-- Recent Edits -->
<div class="bg-neutral-900/50 border border-neutral-800 rounded-lg">
  <div class="px-6 py-4 border-b border-neutral-800">
    <h2 class="text-lg font-semibold text-white">Recent Edits</h2>
    <p class="text-gray-400 text-sm">Latest content modifications</p>
  </div>

  @if($recentEdits->count() > 0)
    <div class="divide-y divide-neutral-800">
      @foreach($recentEdits as $content)
        <div class="px-6 py-4 hover:bg-neutral-900/30 transition-colors">
          <div class="flex items-center justify-between">
            <div class="flex-1 min-w-0">
              <div class="flex items-center gap-3">
                <div class="flex-shrink-0">
                  @if($content->type === 'image')
                    <div class="p-2 bg-green-600/20 rounded-lg">
                      <svg class="w-4 h-4 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                      </svg>
                    </div>
                  @else
                    <div class="p-2 bg-blue-600/20 rounded-lg">
                      <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                      </svg>
                    </div>
                  @endif
                </div>
                
                <div class="min-w-0 flex-1">
                  <p class="text-white font-medium truncate">{{ $content->key }}</p>
                  <div class="flex items-center gap-4 text-sm text-gray-400">
                    <span class="capitalize">{{ $content->group }}</span>
                    <span class="px-2 py-1 bg-neutral-800 rounded text-xs">{{ $content->type }}</span>
                    <span>{{ $content->updated_at->diffForHumans() }}</span>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="flex-shrink-0 ml-4">
              <a href="{{ route('admin.contents.edit', $content->key) }}" 
                 class="inline-flex items-center px-3 py-1 rounded-md text-sm bg-red-600 text-white hover:bg-red-700 transition-colors">
                Edit
              </a>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  @else
    <div class="px-6 py-8 text-center">
      <svg class="mx-auto h-12 w-12 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
      </svg>
      <h3 class="mt-2 text-sm font-medium text-gray-300">No content edits yet</h3>
      <p class="mt-1 text-sm text-gray-500">Start editing content to see recent changes here.</p>
    </div>
  @endif

  @if($recentEdits->count() >= 10)
    <div class="px-6 py-4 border-t border-neutral-800">
      <a href="{{ route('admin.contents.index') }}" 
         class="text-red-400 hover:text-red-300 text-sm font-medium">
        View all content →
      </a>
    </div>
  @endif
</div>
@endsection
