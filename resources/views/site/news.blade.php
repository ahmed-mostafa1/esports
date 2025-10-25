@extends('layouts.app')

@section('title', 'News')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/style.css') }}" />
@endpush

@section('content')

  <h2 style="display: flex; justify-content: center;">
    <button class="tab-btn active" style="font-size: 25px; padding: 10px 40px; border-radius: 5px !important;">
      {{ content('news.header.main_title', 'E-Sports') }}
    </button>
  </h2>

  @php($locale = app()->getLocale())
  <section class="our-news-section">
    <h2 style="display: flex; justify-content: start;">
      <button class="secondary-btn" style="font-size: 25px; padding: 10px 40px; border-radius: 5px !important;">
        {{ content('news.header.section_title', 'Our News') }}
      </button>
    </h2>

    <div class="news-container">
      @foreach($articles as $a)
        <div class="news-card">
          <div class="news-content">
            <p class="news-date">{{ optional($a->date)->format('F j, Y') }}</p>
            <h3 class="news-title">{{ $a->t('title', $locale) }}</h3>
            <p class="news-desc">
              {{ \Illuminate\Support\Str::words($a->t('description', $locale), 40) }}
            </p>
            <a class="news-btn" href="{{ route('news.show', $a->slug) }}">{{ __('Read more') }}</a>
          </div>
          @if($a->image_path)
            <img src="{{ $a->imageUrl() }}" alt="{{ $a->t('title', $locale) }}" />
          @endif
        </div>
      @endforeach
    </div>

    @if(method_exists($articles, 'links'))
      <div class="pagination">
        {{ $articles->links() }}
      </div>
    @endif
  </section>

@endsection

@push('scripts')
@vite('../../../public/js/script.js')
@endpush
