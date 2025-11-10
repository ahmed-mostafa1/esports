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

<div class="space-y-8">
  <!-- Hero profile block -->
  <section class="bg-neutral-900/60 border border-neutral-800 rounded-xl p-6 space-y-6">
    <header class="flex flex-col md:flex-row md:items-center md:justify-between gap-3">
      <div>
        <h3 class="text-lg font-semibold text-white">Hero Card</h3>
        <p class="text-sm text-gray-400">
          This data feeds the big avatar, red name tag, and hero copy on the public page.
        </p>
      </div>
      <span class="text-xs uppercase tracking-widest text-gray-500">Matches the left column in the mock</span>
    </header>

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
        <label class="block text-sm text-gray-300 mb-1">Role / Title (EN)</label>
        <input
          type="text"
          name="role[en]"
          value="{{ old('role.en', data_get($team, 'role.en')) }}"
          class="w-full bg-neutral-800 text-gray-200 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-600"
        >
      </div>
      <div>
        <label class="block text-sm text-gray-300 mb-1">Role / Title (AR)</label>
        <input
          type="text"
          name="role[ar]"
          dir="rtl"
          value="{{ old('role.ar', data_get($team, 'role.ar')) }}"
          class="w-full bg-neutral-800 text-gray-200 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-600"
        >
      </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
      <div>
        <label class="block text-sm text-gray-300 mb-1">Hero Image</label>
        <input
          type="file"
          name="image"
          accept=".png,.jpg,.jpeg,.webp"
          class="w-full text-gray-200"
        >
        <p class="text-xs text-gray-400 mt-1">
          Square crop works best (600x600). File is saved under <code>content-images/teams</code>.
        </p>
        @if($team && $team->image_path)
          <img src="{{ asset($team->image_path) }}" alt="Current team image" class="mt-3 h-32 w-32 object-cover rounded-2xl border border-neutral-700 shadow-lg">
        @endif
      </div>
      <div class="bg-neutral-900/70 border border-neutral-800 rounded-lg p-4 text-sm text-gray-400">
        <p class="font-semibold text-gray-200 mb-2">Hero Copy Tips</p>
        <p>
          The hero section mirrors the mock: bold name, red pillow, and a short focus paragraph.
          Keep it punchy: 2–3 sentences max describing achievements, focus, or mission.
        </p>
      </div>
    </div>
  </section>

  <!-- Focused description -->
  <section class="bg-neutral-900/60 border border-neutral-800 rounded-xl p-6 space-y-4">
    <header>
      <h3 class="text-lg font-semibold text-white">Focus Statement</h3>
      <p class="text-sm text-gray-400">
        Appears beneath the hero card (bold white copy). Use this to explain their public role.
      </p>
    </header>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <div>
        <label class="block text-sm text-gray-300 mb-1">Focus Statement (EN)</label>
        <textarea
          name="description[en]"
          rows="4"
          class="w-full bg-neutral-800 text-gray-200 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-600"
        >{{ old('description.en', data_get($team, 'description.en')) }}</textarea>
      </div>
      <div>
        <label class="block text-sm text-gray-300 mb-1">Focus Statement (AR)</label>
        <textarea
          name="description[ar]"
          dir="rtl"
          rows="4"
          class="w-full bg-neutral-800 text-gray-200 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-600"
        >{{ old('description.ar', data_get($team, 'description.ar')) }}</textarea>
      </div>
    </div>
  </section>

  <!-- Highlight cards -->
  <section class="bg-neutral-900/60 border border-neutral-800 rounded-xl p-6 space-y-4">
    <header class="flex flex-col gap-1">
      <h3 class="text-lg font-semibold text-white">Story Highlights (Red Cards)</h3>
      <p class="text-sm text-gray-400">
        Each highlight card on the right column uses <strong>Title :: Body</strong> pairs separated by blank lines.
        Example: <code>From Passion to Purpose :: Born and raised...</code>.
      </p>
    </header>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <div>
        <label class="block text-sm text-gray-300 mb-1">Highlights (EN)</label>
        <textarea
          name="values[en]"
          rows="6"
          placeholder="From Passion to Purpose :: Born and raised...\n\nVision for the Future :: ..."
          class="w-full bg-neutral-800 text-gray-200 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-600 font-mono text-sm"
        >{{ old('values.en', data_get($team, 'values.en')) }}</textarea>
        <p class="text-xs text-gray-500 mt-2">
          Each block = one card. Optional separators: <code>::</code>, <code>||</code>, or <code>|</code>. Blank line between cards.
        </p>
      </div>
      <div>
        <label class="block text-sm text-gray-300 mb-1">Highlights (AR)</label>
        <textarea
          name="values[ar]"
          dir="rtl"
          rows="6"
          class="w-full bg-neutral-800 text-gray-200 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-600 font-mono text-sm"
        >{{ old('values.ar', data_get($team, 'values.ar')) }}</textarea>
        <p class="text-xs text-gray-500 mt-2" dir="rtl">
          افصل بين كل بطاقة بسطر فارغ. استخدم :: أو | لكتابة عنوان يتبعه وصف.
        </p>
      </div>
    </div>
  </section>

  <!-- Meta controls -->
  <section class="bg-neutral-900/60 border border-neutral-800 rounded-xl p-6 space-y-4">
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

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
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
        <div class="md:col-span-2">
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
  </section>
</div>
