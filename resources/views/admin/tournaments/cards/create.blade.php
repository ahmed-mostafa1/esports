@extends('admin.layout')

@section('title', 'Add Tournament Card')

@section('content')
<div class="px-6 py-4 space-y-4">
  <div>
    <h1 class="text-xl font-semibold text-white">Add Tournament Card</h1>
    <p class="text-sm text-gray-400">Create a new tournament card for the public tournaments page.</p>
  </div>

  <form action="{{ route('admin.tournament-cards.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
    @csrf
    @include('admin.tournaments.cards._form', ['card' => null])

    <div class="flex items-center gap-3">
      <button type="submit" class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded transition">Create</button>
      <a href="{{ route('admin.tournament-cards.index') }}" class="px-4 py-2 bg-neutral-700 hover:bg-neutral-600 text-gray-200 rounded transition">Cancel</a>
    </div>
  </form>
</div>
@endsection
