@extends('admin.layout')

@section('title', 'News Articles')

@section('content')
<div class="space-y-5">
  <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3">
    <div>
      <h2 class="text-xl font-semibold text-white">News Articles</h2>
      <p class="text-sm text-gray-400">Manage the articles displayed on the public news page.</p>
    </div>
    <a
      href="{{ route('admin.news-articles.create') }}"
      class="inline-flex items-center gap-2 px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded transition"
    >
      <span class="text-lg leading-none">＋</span>
      <span>Add Article</span>
    </a>
  </div>

  @if(session('ok'))
    <div class="px-4 py-3 bg-green-900/30 border border-green-700 text-green-200 rounded">
      {{ session('ok') }}
    </div>
  @endif

  <div class="overflow-hidden rounded border border-neutral-800">
    <table class="min-w-full divide-y divide-neutral-800 text-sm">
      <thead class="bg-neutral-900 text-gray-300 uppercase tracking-wide text-xs">
        <tr>
          <th class="px-3 py-3 text-left">Order</th>
          <th class="px-3 py-3 text-left">Title (EN)</th>
          <th class="px-3 py-3 text-left">Date</th>
          <th class="px-3 py-3 text-left">Published</th>
          <th class="px-3 py-3 text-right">Actions</th>
        </tr>
      </thead>
      <tbody id="news-sortable" class="divide-y divide-neutral-800">
        @forelse($articles as $article)
          <tr data-id="{{ $article->id }}" class="bg-neutral-900/40">
            <td class="px-3 py-3">
              <input
                type="number"
                class="w-24 bg-neutral-800 text-gray-200 rounded px-2 py-1 sort-input"
                value="{{ $article->sort_order }}"
              >
            </td>
            <td class="px-3 py-3 text-gray-200">{{ $article->title['en'] ?? '' }}</td>
            <td class="px-3 py-3 text-gray-400">{{ optional($article->date)->format('d/m/Y') }}</td>
            <td class="px-3 py-3">
              <span class="inline-flex items-center px-2 py-1 rounded text-xs {{ $article->is_published ? 'bg-green-700/70 text-white' : 'bg-neutral-700 text-gray-300' }}">
                {{ $article->is_published ? 'Yes' : 'No' }}
              </span>
            </td>
            <td class="px-3 py-3 text-right space-x-2">
              <a
                href="{{ route('admin.news-articles.edit', $article) }}"
                class="inline-flex items-center px-3 py-1.5 bg-blue-600 hover:bg-blue-700 text-white rounded transition"
              >
                Edit
              </a>
              <form
                action="{{ route('admin.news-articles.destroy', $article) }}"
                method="POST"
                class="inline"
                onsubmit="return confirm('Delete this article?');"
              >
                @csrf
                @method('DELETE')
                <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-red-600 hover:bg-red-700 text-white rounded transition">
                  Delete
                </button>
              </form>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="5" class="px-3 py-12 text-center text-gray-400">
              No articles yet.
              <a href="{{ route('admin.news-articles.create') }}" class="text-blue-400 hover:underline">Create the first article</a>.
            </td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  @if($articles->count())
    <div class="flex justify-end">
      <button
        id="save-order"
        type="button"
        class="px-4 py-2 bg-neutral-700 hover:bg-neutral-600 text-gray-200 rounded transition"
      >
        Save Order
      </button>
    </div>
  @endif
</div>
@endsection

@push('scripts')
<script>
document.getElementById('save-order')?.addEventListener('click', async () => {
  const rows = Array.from(document.querySelectorAll('#news-sortable tr[data-id]'));
  const orders = rows.map((row, index) => {
    const input = row.querySelector('.sort-input');
    const fallback = index + 1;
    const sortOrder = parseInt((input && input.value) ? input.value : fallback, 10);
    return {
      id: Number(row.dataset.id),
      sort_order: Number.isNaN(sortOrder) ? fallback : sortOrder,
    };
  });

  try {
    const response = await fetch(@json(route('admin.news-articles.reorder')), {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': @json(csrf_token()),
      },
      body: JSON.stringify({ orders }),
    });

    if (!response.ok) {
      throw new Error('Failed to save order.');
    }

    window.location.reload();
  } catch (error) {
    alert('Unable to save order. Please try again.');
    console.error(error);
  }
});
</script>
@endpush
