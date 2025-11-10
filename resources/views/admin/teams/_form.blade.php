@php($team = $team ?? null)
@php($defaultSortOrder = $defaultSortOrder ?? 0)

@if($errors->any())
  <div class="mb-4 px-4 py-3 bg-red-900/40 border border-red-700 text-red-200 rounded">
    <ul class="list-disc list-inside space-y-1 text-sm">
      @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif

<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
  <div>
    <label class="block text-sm text-gray-300 mb-1">Name (EN)</label>
    <input
      type="text"
      name="name[en]"
      value="{{ old('name.en', data_get($team, 'name.en')) }}"
      class="w-full bg-neutral-800 text-gray-200 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-600"
      required
    >
  </div>
  <div>
    <label class="block text-sm text-gray-300 mb-1">Name (AR)</label>
    <input
      type="text"
      name="name[ar]"
      dir="rtl"
      value="{{ old('name.ar', data_get($team, 'name.ar')) }}"
      class="w-full bg-neutral-800 text-gray-200 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-600"
    >
  </div>

  <div>
    <label class="block text-sm text-gray-300 mb-1">Role (EN)</label>
    <input
      type="text"
      name="role[en]"
      value="{{ old('role.en', data_get($team, 'role.en')) }}"
      class="w-full bg-neutral-800 text-gray-200 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-600"
    >
  </div>
  <div>
    <label class="block text-sm text-gray-300 mb-1">Role (AR)</label>
    <input
      type="text"
      name="role[ar]"
      dir="rtl"
      value="{{ old('role.ar', data_get($team, 'role.ar')) }}"
      class="w-full bg-neutral-800 text-gray-200 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-600"
    >
  </div>

  <div>
    <label class="block text-sm text-gray-300 mb-1">Description (EN)</label>
    <textarea
      name="description[en]"
      rows="4"
      class="w-full bg-neutral-800 text-gray-200 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-600"
    >{{ old('description.en', data_get($team, 'description.en')) }}</textarea>
  </div>
  <div>
    <label class="block text-sm text-gray-300 mb-1">Description (AR)</label>
    <textarea
      name="description[ar]"
      dir="rtl"
      rows="4"
      class="w-full bg-neutral-800 text-gray-200 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-600"
    >{{ old('description.ar', data_get($team, 'description.ar')) }}</textarea>
  </div>

  <div>
    <label class="block text-sm text-gray-300 mb-1">Values (EN)</label>
    <textarea
      name="values[en]"
      rows="4"
      placeholder="Bullet list or paragraph"
      class="w-full bg-neutral-800 text-gray-200 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-600"
    >{{ old('values.en', data_get($team, 'values.en')) }}</textarea>
  </div>
  <div>
    <label class="block text-sm text-gray-300 mb-1">Values (AR)</label>
    <textarea
      name="values[ar]"
      dir="rtl"
      rows="4"
      class="w-full bg-neutral-800 text-gray-200 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-600"
    >{{ old('values.ar', data_get($team, 'values.ar')) }}</textarea>
  </div>

  <div class="md:col-span-2">
    <label class="block text-sm text-gray-300 mb-1">Profile Image</label>
    <input
      type="file"
      name="image"
      accept=".png,.jpg,.jpeg,.webp"
      class="w-full text-gray-200"
    >
    <p class="text-xs text-gray-400 mt-1">Recommended ratio 1:1. Stored under <code>content-images/teams</code>.</p>
    @if($team && $team->image_path)
      <img src="{{ asset($team->image_path) }}" alt="Current team image" class="mt-3 h-24 w-24 object-cover rounded border border-neutral-700">
    @endif
  </div>

  <div class="flex items-center gap-2">
    <input
      type="checkbox"
      name="is_published"
      id="is_published"
      value="1"
      {{ old('is_published', data_get($team, 'is_published', true)) ? 'checked' : '' }}
      class="w-4 h-4 text-red-500 bg-neutral-800 border-neutral-600 rounded focus:ring-red-600"
    >
    <label for="is_published" class="text-sm text-gray-300">Published</label>
  </div>

  <div>
    <label class="block text-sm text-gray-300 mb-1">Sort Order</label>
    <input
      type="number"
      name="sort_order"
      min="0"
      value="{{ old('sort_order', $team->sort_order ?? $defaultSortOrder) }}"
      class="w-full bg-neutral-800 text-gray-200 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-600"
    >
  </div>

  @if($team)
    <div>
      <label class="block text-sm text-gray-300 mb-1">Slug (auto)</label>
      <input
        type="text"
        value="{{ $team->slug }}"
        readonly
        class="w-full bg-neutral-900 text-gray-400 rounded px-3 py-2 border border-neutral-700"
      >
    </div>
  @endif
</div>
