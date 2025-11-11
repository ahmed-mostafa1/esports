@extends('admin.layout')

@section('title', 'Tournament Cards')

@section('content')
<div class="px-6 py-4 space-y-4">
  <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3">
    <div>
      <h1 class="text-xl font-semibold text-white">Tournament Cards</h1>
      <p class="text-sm text-gray-400">Manage tournament cards displayed on the public tournaments page.</p>
    </div>
    <a href="{{ route('admin.tournament-cards.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded transition">
      <span class="text-lg leading-none">＋</span>
      <span>Add Card</span>
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
          <th class="px-3 py-3 text-left">Dates</th>
          <th class="px-3 py-3 text-left">Time</th>
          <th class="px-3 py-3 text-left">Prize</th>
          <th class="px-3 py-3 text-left">Published</th>
          <th class="px-3 py-3 text-right">Actions</th>
        </tr>
      </thead>
      <tbody id="sortable-body" class="divide-y divide-neutral-800">
        @forelse($cards as $card)
          <tr data-id="{{ $card->id }}" class="bg-neutral-900/40">
            <td class="px-3 py-3">
              <input type="number" class="w-24 bg-neutral-800 text-gray-200 rounded px-2 py-1 sort-input" value="{{ $card->sort_order }}">
            </td>
            <td class="px-3 py-3 text-gray-200">{{ $card->title['en'] ?? '' }}</td>
            <td class="px-3 py-3 text-gray-400">
              <div>{{ $card->date?->format('d/m/Y') ?? '—' }}</div>
              <div class="text-xs text-gray-500">
                {{ __('End:') }} {{ $card->end_date?->format('d/m/Y') ?? '—' }}
              </div>
            </td>
            <td class="px-3 py-3 text-gray-400">{{ $card->time }}</td>
            <td class="px-3 py-3 text-gray-200">{{ $card->prize }}</td>
            <td class="px-3 py-3">
              <span class="inline-flex items-center px-2 py-1 rounded text-xs {{ $card->is_published ? 'bg-green-700/70 text-white' : 'bg-neutral-700 text-gray-300' }}">
                {{ $card->is_published ? 'Yes' : 'No' }}
              </span>
            </td>
            <td class="px-3 py-3 text-right space-x-2">
              <a href="{{ route('admin.tournament-cards.edit', $card) }}" class="inline-flex items-center px-3 py-1.5 bg-blue-600 hover:bg-blue-700 text-white rounded transition">Edit</a>
              <form action="{{ route('admin.tournament-cards.destroy', $card) }}" method="POST" class="inline" onsubmit="return confirm('Delete this card?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-red-600 hover:bg-red-700 text-white rounded transition">Delete</button>
              </form>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="7" class="px-3 py-12 text-center text-gray-400">
              No tournament cards yet. <a href="{{ route('admin.tournament-cards.create') }}" class="text-blue-400 hover:underline">Create the first card</a>.
            </td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  @if($cards->hasPages())
    <div>
      {{ $cards->links() }}
    </div>
  @endif

  @if($cards->count())
    <div class="flex justify-end">
      <button id="save-order" type="button" class="px-4 py-2 bg-neutral-700 hover:bg-neutral-600 text-gray-200 rounded transition">
        Save Order
      </button>
    </div>
  @endif
</div>
@endsection

@push('scripts')
<script>
document.getElementById('save-order')?.addEventListener('click', async () => {
  const rows = Array.from(document.querySelectorAll('#sortable-body tr[data-id]'));
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
    const response = await fetch(@json(route('admin.tournament-cards.reorder')), {
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
