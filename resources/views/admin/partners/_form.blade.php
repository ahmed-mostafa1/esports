@php($partner = $partner ?? null)

@if($errors->any())
  <div class="mb-4 px-4 py-3 bg-red-900/40 border border-red-700 text-red-200 rounded">
    <ul class="list-disc list-inside space-y-1 text-sm">
      @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif

@csrf

<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
  <div>
    <label class="block text-sm text-gray-300 mb-1">Name (EN)</label>
    <input
      name="name[en]"
      value="{{ old('name.en', data_get($partner, 'name.en')) }}"
      class="w-full bg-neutral-800 text-gray-200 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-600"
    >
  </div>
  <div>
    <label class="block text-sm text-gray-300 mb-1">Name (AR)</label>
    <input
      name="name[ar]"
      dir="rtl"
      value="{{ old('name.ar', data_get($partner, 'name.ar')) }}"
      class="w-full bg-neutral-800 text-gray-200 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-600"
    >
  </div>
  <div>
    <label class="block text-sm text-gray-300 mb-1">Media Type</label>
    <select
      name="media_type"
      id="media_type"
      class="w-full bg-neutral-800 text-gray-200 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-600">
      @php($mediaType = old('media_type', $partner->media_type ?? 'image'))
      <option value="image" {{ $mediaType === 'image' ? 'selected' : '' }}>Image</option>
      <option value="video" {{ $mediaType === 'video' ? 'selected' : '' }}>Video</option>
    </select>
  </div>
  <div class="flex items-center gap-2">
    <input
      type="checkbox"
      name="is_published"
      id="is_published"
      value="1"
      {{ old('is_published', data_get($partner, 'is_published', true)) ? 'checked' : '' }}
      class="w-4 h-4 text-red-500 bg-neutral-800 border-neutral-600 rounded focus:ring-red-600"
    >
    <label for="is_published" class="text-sm text-gray-300">Published</label>
  </div>

  <div id="image_fields" class="{{ $mediaType !== 'image' ? 'hidden' : '' }}">
    <label class="block text-sm text-gray-300 mb-1">Partner Image</label>
    <input
      type="file"
      name="image"
      accept=".jpg,.jpeg,.png,.webp,.gif"
      class="w-full text-gray-200"
    >
    @if($partner && $partner->image_path)
      <img src="{{ asset($partner->image_path) }}" alt="Current partner" class="mt-3 h-24 rounded border border-neutral-700 object-cover">
    @endif
  </div>

  <div id="video_fields" class="{{ $mediaType !== 'video' ? 'hidden' : '' }}">
    <label class="block text-sm text-gray-300 mb-1">Video URL</label>
    <input
      type="url"
      name="video_url"
      value="{{ old('video_url', $partner->video_url ?? '') }}"
      placeholder="https://www.youtube.com/watch?v=..."
      class="w-full bg-neutral-800 text-gray-200 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-600"
    >
    <p class="text-xs text-gray-400 mt-1">YouTube links will be converted to embed URLs automatically.</p>
    @if($partner && $partner->media_type === 'video' && $partner->video_url)
      <div class="mt-3 relative pt-[56.25%] rounded overflow-hidden border border-neutral-700">
        <iframe class="absolute inset-0 w-full h-full" src="{{ $partner->video_url }}" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
      </div>
    @endif
  </div>

  @if($partner && isset($partner->sort_order))
    <div>
      <label class="block text-sm text-gray-300 mb-1">Sort Order</label>
      <input
        type="number"
        name="sort_order"
        value="{{ old('sort_order', $partner->sort_order) }}"
        class="w-full bg-neutral-800 text-gray-200 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-600"
        min="0"
      >
    </div>
  @endif
</div>

@push('scripts')
<script>
(function(){
  const mediaSelect = document.getElementById('media_type');
  if (!mediaSelect) return;

  const imageFields = document.getElementById('image_fields');
  const videoFields = document.getElementById('video_fields');

  const toggleFields = () => {
    const type = mediaSelect.value;
    if (type === 'video') {
      imageFields?.classList.add('hidden');
      videoFields?.classList.remove('hidden');
    } else {
      videoFields?.classList.add('hidden');
      imageFields?.classList.remove('hidden');
    }
  };

  mediaSelect.addEventListener('change', toggleFields);
  toggleFields();
})();
</script>
@endpush
