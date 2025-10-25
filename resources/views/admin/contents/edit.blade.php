@extends('admin.layout')

@section('title', 'Edit: '.$content->key)

@section('content')
  <div class="mb-4 text-sm">
    <div><strong class="text-gray-300">Key:</strong> <span class="font-mono text-gray-100">{{ $content->key }}</span></div>
    <div class="text-gray-300">
      <strong>Group:</strong> <span class="text-gray-200">{{ $content->group }}</span>
      <span class="mx-2">|</span>
      <strong>Type:</strong> <span class="text-gray-200">{{ $content->type }}</span>
    </div>
    <div class="text-gray-400"><strong>Updated:</strong> {{ $content->updated_at?->diffForHumans() }}</div>
    @if($meta)
      <div class="mt-2 text-gray-100">{{ $meta['label'] ?? '' }}</div>
      @if(!empty($meta['help']))<div class="text-gray-400">{{ $meta['help'] }}</div>@endif
    @endif
  </div>

  @if ($errors->any())
    <div class="bg-red-900/40 text-red-200 px-3 py-2 rounded mb-4 border border-red-800">
      <ul class="list-disc list-inside">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form method="post" action="{{ route('admin.contents.update', $content->key) }}" enctype="multipart/form-data" class="space-y-4">
    @csrf

    @if($content->type === 'text')
      <div>
        <label class="block text-sm font-medium mb-1 text-gray-200">English (required)</label>
        <textarea name="value[en]" rows="4"
                  class="w-full border border-neutral-700 rounded p-2 bg-neutral-900 text-white"
                  required>{{ old('value.en', $content->getTranslation('value','en')) }}</textarea>
      </div>
      <div>
        <label class="block text-sm font-medium mb-1 text-gray-200">Arabic (optional)</label>
        <textarea name="value[ar]" dir="rtl" rows="4"
                  class="w-full border border-neutral-700 rounded p-2 bg-neutral-900 text-white">{{ old('value.ar', $content->getTranslation('value','ar')) }}</textarea>
      </div>
    @endif

    @if(in_array($content->type, ['image', 'video'], true))
      @php
        $isVideo = $content->type === 'video';
        $filename = $content->value['path'] ?? null;
      @endphp
      <div class="flex flex-col md:flex-row md:items-center gap-6">
        <div class="flex-1">
          <label class="block text-sm font-medium mb-1 text-gray-200">
            Upload {{ $isVideo ? 'video (mp4/mov/webm/ogg)' : 'image (png/jpg/webp/gif)' }}
          </label>
          <input type="file" name="image" accept="image/*,video/*"
                 class="block text-sm file:mr-4 file:py-2 file:px-4 file:rounded
                        file:border-0 file:text-sm file:font-semibold
                        file:bg-red-600 file:text-white hover:file:bg-red-700
                        text-gray-200">
          <div class="text-xs text-gray-400 mt-1">
            Saved as <code class="font-mono">{{ $content->key }}.&lt;ext&gt;</code>
          </div>
          <div class="text-xs text-gray-400">
            Accepted formats:
            @if($isVideo)
              MP4, MOV, WebM, OGG (max 100MB)
            @else
              PNG, JPG, JPEG, WebP, GIF (max 15MB)
            @endif
          </div>
          @if(!$isVideo && !empty($meta['image']['preferredWidth']) && !empty($meta['image']['preferredHeight']))
            <div class="text-xs text-gray-400">
              Recommended: {{ $meta['image']['preferredWidth'] }}×{{ $meta['image']['preferredHeight'] }} px
            </div>
          @endif
        </div>
        <div>
          <div class="text-sm mb-1 text-gray-300">Current</div>
          @if($filename)
            @if($isVideo)
              <video src="{{ asset('content-images/'.$filename) }}" controls class="max-h-40 border border-neutral-800 rounded w-full"></video>
            @else
              <img src="{{ asset('content-images/'.$filename) }}" alt="" class="max-h-40 border border-neutral-800 rounded">
            @endif
          @else
            <div class="text-gray-500">No file</div>
          @endif
        </div>
      </div>
    @endif

    <div class="flex gap-2">
      <button class="px-4 py-2 rounded bg-red-600 text-white hover:bg-red-700 transition">Save</button>
      <a href="{{ route('admin.contents.index') }}" class="px-4 py-2 rounded border border-neutral-700 text-gray-200 hover:bg-neutral-900">Cancel</a>
    </div>
  </form>
@endsection
