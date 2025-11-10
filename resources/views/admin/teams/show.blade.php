@extends('admin.layout')

@section('title', 'Team Preview')

@section('content')
<div class="px-6 py-4 space-y-4">
  <div class="flex flex-col gap-1">
    <h1 class="text-xl font-semibold text-white">{{ data_get($team->name, 'en') ?: 'Team Member' }}</h1>
    <p class="text-sm text-gray-400">Quick preview of the published content.</p>
  </div>

  <div class="bg-neutral-900/50 border border-neutral-800 rounded-lg p-6 space-y-4">
    <div class="flex flex-col md:flex-row gap-6">
      @if($team->image_path)
        <img src="{{ asset($team->image_path) }}" alt="{{ data_get($team->name, 'en') }}" class="w-40 h-40 object-cover rounded-lg border border-neutral-800">
      @endif
      <div class="flex-1 space-y-2">
        <div>
          <p class="text-xs uppercase text-gray-400">Name</p>
          <p class="text-base text-white">{{ data_get($team->name, 'en') }}</p>
          @if(data_get($team->name, 'ar'))
            <p class="text-base text-gray-300" dir="rtl">{{ data_get($team->name, 'ar') }}</p>
          @endif
        </div>
        @if($team->role)
          <div>
            <p class="text-xs uppercase text-gray-400">Role</p>
            <p class="text-base text-white">{{ data_get($team->role, 'en') }}</p>
            @if(data_get($team->role, 'ar'))
              <p class="text-base text-gray-300" dir="rtl">{{ data_get($team->role, 'ar') }}</p>
            @endif
          </div>
        @endif
        <div class="flex items-center gap-3">
          <span class="inline-flex items-center px-2 py-1 text-xs rounded {{ $team->is_published ? 'bg-green-700/60 text-white' : 'bg-neutral-700 text-gray-300' }}">
            {{ $team->is_published ? 'Published' : 'Hidden' }}
          </span>
          <span class="text-xs text-gray-400">Sort: {{ $team->sort_order }}</span>
          <span class="text-xs text-gray-500">Slug: {{ $team->slug }}</span>
        </div>
      </div>
    </div>

    @if($team->description)
      <div>
        <p class="text-xs uppercase text-gray-400 mb-1">Description (EN)</p>
        <p class="text-sm text-gray-200 whitespace-pre-line">{{ data_get($team->description, 'en') }}</p>
        @if(data_get($team->description, 'ar'))
          <p class="text-xs uppercase text-gray-400 mt-4 mb-1">Description (AR)</p>
          <p class="text-sm text-gray-200 whitespace-pre-line" dir="rtl">{{ data_get($team->description, 'ar') }}</p>
        @endif
      </div>
    @endif

    @if($team->values)
      <div>
        <p class="text-xs uppercase text-gray-400 mb-1">Values (EN)</p>
        <p class="text-sm text-gray-200 whitespace-pre-line">{{ data_get($team->values, 'en') }}</p>
        @if(data_get($team->values, 'ar'))
          <p class="text-xs uppercase text-gray-400 mt-4 mb-1">Values (AR)</p>
          <p class="text-sm text-gray-200 whitespace-pre-line" dir="rtl">{{ data_get($team->values, 'ar') }}</p>
        @endif
      </div>
    @endif
  </div>

  <div class="flex items-center gap-3">
    <a href="{{ route('admin.teams.edit', $team) }}" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded transition">Edit</a>
    <a href="{{ route('admin.teams.index') }}" class="px-4 py-2 bg-neutral-700 hover:bg-neutral-600 text-gray-200 rounded transition">Back to list</a>
  </div>
</div>
@endsection
