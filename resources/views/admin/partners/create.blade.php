@extends('admin.layout')

@section('title', 'Add Partner')

@section('content')
<div class="px-6 py-4 space-y-4">
  <div>
    <h1 class="text-xl font-semibold text-white">Add Partner</h1>
    <p class="text-sm text-gray-400">Create a new partner card for the site.</p>
  </div>

  <form action="{{ route('admin.partners.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
    @csrf
    @include('admin.partners._form', ['partner' => null, 'forceImage' => true])

    <div class="flex items-center gap-3">
      <button type="submit" class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded transition">Create</button>
      <a href="{{ route('admin.partners.index') }}" class="px-4 py-2 bg-neutral-700 hover:bg-neutral-600 text-gray-200 rounded transition">Cancel</a>
    </div>
  </form>
</div>
@endsection
