@extends('admin.layout')

@section('title', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
  <!-- Stats Cards -->
  <div class="bg-neutral-900/50 border border-neutral-800 rounded-lg p-4">
    <div class="flex items-center justify-between">
      <div>
        <p class="text-gray-400 text-sm">Total Content</p>
        <p class="text-2xl font-bold text-white">{{ $stats['total'] }}</p>
      </div>
      <div class="p-3 bg-red-600 rounded-lg">
        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
        </svg>
      </div>
    </div>
  </div>

  <div class="bg-neutral-900/50 border border-neutral-800 rounded-lg p-4">
    <div class="flex items-center justify-between">
      <div>
        <p class="text-gray-400 text-sm">Text Content</p>
        <p class="text-2xl font-bold text-white">{{ $stats['text'] }}</p>
      </div>
      <div class="p-3 bg-blue-600 rounded-lg">
        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
        </svg>
      </div>
    </div>
  </div>

  <div class="bg-neutral-900/50 border border-neutral-800 rounded-lg p-4">
    <div class="flex items-center justify-between">
      <div>
        <p class="text-gray-400 text-sm">Images</p>
        <p class="text-2xl font-bold text-white">{{ $stats['image'] }}</p>
      </div>
      <div class="p-3 bg-green-600 rounded-lg">
        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
        </svg>
      </div>
    </div>
  </div>

  <div class="bg-neutral-900/50 border border-neutral-800 rounded-lg p-4">
    <div class="flex items-center justify-between">
      <div>
        <p class="text-gray-400 text-sm">Videos</p>
        <p class="text-2xl font-bold text-white">{{ $stats['video'] }}</p>
      </div>
      <div class="p-3 bg-purple-600 rounded-lg">
        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14m0-4v4m-6 4h6a2 2 0 002-2V6a2 2 0 00-2-2H9a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
        </svg>
      </div>
    </div>
  </div>
</div>

<!-- Page Quick Access -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
  <!-- Standard Editor -->
  <div class="bg-neutral-900/50 border border-neutral-800 rounded-lg">
    <div class="px-6 py-4 border-b border-neutral-800">
      <h3 class="text-lg font-semibold text-white">Standard Editor</h3>
      <p class="text-gray-400 text-sm">Traditional table-based content editing</p>
    </div>
    <div class="p-6">
      <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 mb-4">
        @foreach($contentGroups as $group)
          <a href="{{ route('admin.contents.page', $group['name']) }}" 
             class="flex justify-between items-center px-4 py-2 bg-neutral-800 hover:bg-neutral-700 text-gray-200 rounded transition-colors">
            <span>📝 {{ $group['label'] }}</span>
            <span class="text-xs bg-neutral-700 px-2 py-1 rounded">{{ $group['count'] }}</span>
          </a>
        @endforeach
      </div>
      <a href="{{ route('admin.contents.index') }}" 
         class="block px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded transition-colors text-center font-medium">
        📋 View All Content ({{ $stats['total'] }} items)
      </a>
    </div>
  </div>

  <!-- Skeleton Editor -->
  <div class="bg-neutral-900/50 border border-neutral-800 rounded-lg">
    <div class="px-6 py-4 border-b border-neutral-800">
      <h3 class="text-lg font-semibold text-white">🎨 Complete Skeleton Editor Suite</h3>
      <p class="text-gray-400 text-sm">Visual page-based content editing - ALL PAGES AVAILABLE</p>
    </div>
    <div class="p-6">
      <!-- Main Pages -->
      <div class="space-y-3 mb-6">
        <div class="text-sm font-medium text-gray-300 mb-2">📄 Main Website Pages</div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
          <a href="{{ route('admin.contents.skeleton', 'home') }}" 
             class="block px-4 py-2 bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white rounded transition-all transform hover:scale-105">
            🏠 Home Page (Standard)
          </a>
          <a href="{{ route('admin.contents.skeleton', 'about') }}" 
             class="block px-4 py-2 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white rounded transition-all transform hover:scale-105">
            📄 About Page (Standard)
          </a>
          <a href="{{ route('admin.contents.skeleton', 'services') }}" 
             class="block px-4 py-2 bg-gradient-to-r from-yellow-600 to-yellow-700 hover:from-yellow-700 hover:to-yellow-800 text-white rounded transition-all transform hover:scale-105">
            🛠️ Services Page (Standard)
          </a>
          <a href="{{ route('admin.contents.skeleton', 'news') }}" 
             class="block px-4 py-2 bg-gradient-to-r from-indigo-600 to-indigo-700 hover:from-indigo-700 hover:to-indigo-800 text-white rounded transition-all transform hover:scale-105">
            📰 News Page (Standard)
          </a>
          <a href="{{ route('admin.contents.skeleton', 'tournaments') }}" 
             class="block px-4 py-2 bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white rounded transition-all transform hover:scale-105">
            🏆 Tournaments Page (Standard)
          </a>
          <a href="{{ route('admin.contents.skeleton', 'partners') }}" 
             class="block px-4 py-2 bg-gradient-to-r from-purple-600 to-purple-700 hover:from-purple-700 hover:to-purple-800 text-white rounded transition-all transform hover:scale-105">
            🤝 Partners Page (Standard)
          </a>
          <a href="{{ route('admin.contents.skeleton', 'gallery') }}" 
             class="block px-4 py-2 bg-gradient-to-r from-pink-600 to-pink-700 hover:from-pink-700 hover:to-pink-800 text-white rounded transition-all transform hover:scale-105">
            🖼️ Gallery Page (Standard)
          </a>
        </div>
      </div>

      <!-- Registration Pages -->
      <div class="space-y-3 mb-4">
        <div class="text-sm font-medium text-gray-300 mb-2">📝 Registration Forms</div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
          <a href="{{ route('admin.contents.skeleton', 'team_registration') }}" 
             class="block px-4 py-2 bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white rounded transition-all transform hover:scale-105">
            👥 Team Registration (Custom)
          </a>
          <a href="{{ route('admin.contents.skeleton', 'single_registration') }}" 
             class="block px-4 py-2 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white rounded transition-all transform hover:scale-105">
            👤 Single Player Registration (Custom)
          </a>
        </div>
      </div>

      <div class="text-xs text-gray-500 p-3 bg-green-900/20 border border-green-700 rounded">
        ✅ <strong>AVAILABLE EDITORS:</strong> 2 custom skeleton editors + standard skeleton editors for all pages!
        <br>
        🎆 <strong>Custom Skeleton Editors:</strong> Team Registration, Single Player Registration (with auto-save & batch update)
        <br>
        📋 <strong>Standard Skeleton Editors:</strong> Home, About, Services, News, Tournaments, Partners, Gallery
        <br>
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
