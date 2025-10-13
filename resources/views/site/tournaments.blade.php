@extends('layouts.app')

@section('title', 'Tournaments')

@push('styles')
<link rel="stylesheet" href="{{ asset('./css/style.css') }}" />
<link rel="stylesheet" href="{{ asset('./css/tournaments.css') }}" />
@endpush

@section('content')

    <section class="our-tournaments" aria-labelledby="esports-title">
      <!-- top labels -->
      <div class="right-panel">
        <div class="form-header">
          <button
            class="tab-btn active"
            style="font-size: 20px; border-radius: 10px"
          >
            E-Sports
          </button>
        </div>
      </div>
      <span class="ot-pill ot-pill--gray">Our Tournament</span>

      <!-- grid -->
      <ul class="ot-grid">
        <li class="ot-card">
          <article class="ot-card__wrap">
            <figure class="ot-media">
              <img src="{{ asset('./img/tournaments-inner.png') }}" alt="Imagem do torneio" />
            </figure>

            <div class="ot-body">
              <h3 class="ot-title">DESAFIO EM HOWLING ABYSS: ÀS CEGAS</h3>

              <ul class="ot-meta">
                <li class="meta">
                  <svg class="ico" viewBox="0 0 24 24" aria-hidden="true">
                    <path
                      d="M7 2v3M17 2v3M3 9h18M5 6h14a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2z"
                    />
                  </svg>
                  <span>01/11/23</span>
                </li>
                <li class="meta">
                  <svg class="ico" viewBox="0 0 24 24" aria-hidden="true">
                    <path
                      d="M12 8v5l3 2M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0z"
                    />
                  </svg>
                  <span>20:00</span>
                </li>
              </ul>

              <div class="ot-prize">
                <svg class="ico" viewBox="0 0 24 24" aria-hidden="true">
                  <path
                    d="M8 21h8M12 17v4M5 3h14v2a4 4 0 0 1-4 4h-1a4 4 0 0 1-3 4v0H9v0a4 4 0 0 1-3-4H7A4 4 0 0 1 3 5V3h2z"
                  />
                </svg>
                <span class="amount">$ 2.000,00</span>
              </div>

                <button class="ot-btn" type="button" data-url="./tours-reg.html"  data-target="_self">INSCREVER-SE</button>
            </div>
          </article>
        </li>

        <!-- 7 more copies -->
        <li class="ot-card">
          <article class="ot-card__wrap">
            <figure class="ot-media">
              <img src="{{ asset('./img/tournaments-inner.png') }}" alt="" />
            </figure>
            <div class="ot-body">
              <h3 class="ot-title">DESAFIO EM HOWLING ABYSS: ÀS CEGAS</h3>
              <ul class="ot-meta">
                <li class="meta">
                  <svg class="ico" viewBox="0 0 24 24">
                    <path
                      d="M7 2v3M17 2v3M3 9h18M5 6h14a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2z"
                    /></svg
                  ><span>01/11/23</span>
                </li>
                <li class="meta">
                  <svg class="ico" viewBox="0 0 24 24">
                    <path
                      d="M12 8v5l3 2M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0z"
                    /></svg
                  ><span>20:00</span>
                </li>
              </ul>
              <div class="ot-prize">
                <svg class="ico" viewBox="0 0 24 24">
                  <path
                    d="M8 21h8M12 17v4M5 3h14v2a4 4 0 0 1-4 4h-1a4 4 0 0 1-3 4v0H9v0a4 4 0 0 1-3-4H7A4 4 0 0 1 3 5V3h2z"
                  /></svg
                ><span class="amount">$ 2.000,00</span>
              </div>
                <button class="ot-btn" type="button" data-url="./tours-reg.html"  data-target="_self">INSCREVER-SE</button>
            </div>
          </article>
        </li>

        <li class="ot-card">
          <article class="ot-card__wrap">
            <figure class="ot-media">
              <img src="{{ asset('./img/tournaments-inner.png') }}" alt="" />
            </figure>
            <div class="ot-body">
              <h3 class="ot-title">DESAFIO EM HOWLING ABYSS: ÀS CEGAS</h3>
              <ul class="ot-meta">
                <li class="meta">
                  <svg class="ico" viewBox="0 0 24 24">
                    <path
                      d="M7 2v3M17 2v3M3 9h18M5 6h14a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2z"
                    /></svg
                  ><span>01/11/23</span>
                </li>
                <li class="meta">
                  <svg class="ico" viewBox="0 0 24 24">
                    <path
                      d="M12 8v5l3 2M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0z"
                    /></svg
                  ><span>20:00</span>
                </li>
              </ul>
              <div class="ot-prize">
                <svg class="ico" viewBox="0 0 24 24">
                  <path
                    d="M8 21h8M12 17v4M5 3h14v2a4 4 0 0 1-4 4h-1a4 4 0 0 1-3 4v0H9v0a4 4 0 0 1-3-4H7A4 4 0 0 1 3 5V3h2z"
                  /></svg
                ><span class="amount">$ 2.000,00</span>
              </div>
                <button class="ot-btn" type="button" data-url="./tours-reg.html"  data-target="_self">INSCREVER-SE</button>
            </div>
          </article>
        </li>

        <li class="ot-card">
          <article class="ot-card__wrap">
            <figure class="ot-media">
              <img src="{{ asset('./img/tournaments-inner.png') }}" alt="" />
            </figure>
            <div class="ot-body">
              <h3 class="ot-title">DESAFIO EM HOWLING ABYSS: ÀS CEGAS</h3>
              <ul class="ot-meta">
                <li class="meta">
                  <svg class="ico" viewBox="0 0 24 24">
                    <path
                      d="M7 2v3M17 2v3M3 9h18M5 6h14a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2z"
                    /></svg
                  ><span>01/11/23</span>
                </li>
                <li class="meta">
                  <svg class="ico" viewBox="0 0 24 24">
                    <path
                      d="M12 8v5l3 2M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0z"
                    /></svg
                  ><span>20:00</span>
                </li>
              </ul>
              <div class="ot-prize">
                <svg class="ico" viewBox="0 0 24 24">
                  <path
                    d="M8 21h8M12 17v4M5 3h14v2a4 4 0 0 1-4 4h-1a4 4 0 0 1-3 4v0H9v0a4 4 0 0 1-3-4H7A4 4 0 0 1 3 5V3h2z"
                  /></svg
                ><span class="amount">$ 2.000,00</span>
              </div>
                <button class="ot-btn" type="button" data-url="./tours-reg.html"  data-target="_self">INSCREVER-SE</button>
              </div>
          </article>
        </li>

        <!-- second row -->
        <li class="ot-card">
          <article class="ot-card__wrap">
            <figure class="ot-media">
              <img src="{{ asset('./img/tournaments-inner.png') }}" alt="" />
            </figure>
            <div class="ot-body">
              <h3 class="ot-title">DESAFIO EM HOWLING ABYSS: ÀS CEGAS</h3>
              <ul class="ot-meta">
                <li class="meta">
                  <svg class="ico" viewBox="0 0 24 24">
                    <path
                      d="M7 2v3M17 2v3M3 9h18M5 6h14a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2z"
                    /></svg
                  ><span>01/11/23</span>
                </li>
                <li class="meta">
                  <svg class="ico" viewBox="0 0 24 24">
                    <path
                      d="M12 8v5l3 2M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0z"
                    /></svg
                  ><span>20:00</span>
                </li>
              </ul>
              <div class="ot-prize">
                <svg class="ico" viewBox="0 0 24 24">
                  <path
                    d="M8 21h8M12 17v4M5 3h14v2a4 4 0 0 1-4 4h-1a4 4 0 0 1-3 4v0H9v0a4 4 0 0 1-3-4H7A4 4 0 0 1 3 5V3h2z"
                  /></svg
                ><span class="amount">$ 2.000,00</span>
              </div>
                <button class="ot-btn" type="button" data-url="./tours-reg.html"  data-target="_self">INSCREVER-SE</button>
            </div>
          </article>
        </li>

        <li class="ot-card">
          <article class="ot-card__wrap">
            <figure class="ot-media">
              <img src="{{ asset('./img/tournaments-inner.png') }}" alt="" />
            </figure>
            <div class="ot-body">
              <h3 class="ot-title">DESAFIO EM HOWLING ABYSS: ÀS CEGAS</h3>
              <ul class="ot-meta">
                <li class="meta">
                  <svg class="ico" viewBox="0 0 24 24">
                    <path
                      d="M7 2v3M17 2v3M3 9h18M5 6h14a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2z"
                    /></svg
                  ><span>01/11/23</span>
                </li>
                <li class="meta">
                  <svg class="ico" viewBox="0 0 24 24">
                    <path
                      d="M12 8v5l3 2M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0z"
                    /></svg
                  ><span>20:00</span>
                </li>
              </ul>
              <div class="ot-prize">
                <svg class="ico" viewBox="0 0 24 24">
                  <path
                    d="M8 21h8M12 17v4M5 3h14v2a4 4 0 0 1-4 4h-1a4 4 0 0 1-3 4v0H9v0a4 4 0 0 1-3-4H7A4 4 0 0 1 3 5V3h2z"
                  /></svg
                ><span class="amount">$ 2.000,00</span>
              </div>
                <button class="ot-btn" type="button" data-url="./tours-reg.html"  data-target="_self">INSCREVER-SE</button>
            </div>
          </article>
        </li>

        <li class="ot-card">
          <article class="ot-card__wrap">
            <figure class="ot-media">
              <img src="{{ asset('./img/tournaments-inner.png') }}" alt="" />
            </figure>
            <div class="ot-body">
              <h3 class="ot-title">DESAFIO EM HOWLING ABYSS: ÀS CEGAS</h3>
              <ul class="ot-meta">
                <li class="meta">
                  <svg class="ico" viewBox="0 0 24 24">
                    <path
                      d="M7 2v3M17 2v3M3 9h18M5 6h14a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2z"
                    /></svg
                  ><span>01/11/23</span>
                </li>
                <li class="meta">
                  <svg class="ico" viewBox="0 0 24 24">
                    <path
                      d="M12 8v5l3 2M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0z"
                    /></svg
                  ><span>20:00</span>
                </li>
              </ul>
              <div class="ot-prize">
                <svg class="ico" viewBox="0 0 24 24">
                  <path
                    d="M8 21h8M12 17v4M5 3h14v2a4 4 0 0 1-4 4h-1a4 4 0 0 1-3 4v0H9v0a4 4 0 0 1-3-4H7A4 4 0 0 1 3 5V3h2z"
                  /></svg
                ><span class="amount">$ 2.000,00</span>
              </div>
                <button class="ot-btn" type="button" data-url="./tours-reg.html"  data-target="_self">INSCREVER-SE</button>
            </div>
          </article>
        </li>

        <li class="ot-card">
          <article class="ot-card__wrap">
            <figure class="ot-media">
              <img src="{{ asset('./img/tournaments-inner.png') }}" alt="" />
            </figure>
            <div class="ot-body">
              <h3 class="ot-title">DESAFIO EM HOWLING ABYSS: ÀS CEGAS</h3>
              <ul class="ot-meta">
                <li class="meta">
                  <svg class="ico" viewBox="0 0 24 24">
                    <path
                      d="M7 2v3M17 2v3M3 9h18M5 6h14a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2z"
                    /></svg
                  ><span>01/11/23</span>
                </li>
                <li class="meta">
                  <svg class="ico" viewBox="0 0 24 24">
                    <path
                      d="M12 8v5l3 2M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0z"
                    /></svg
                  ><span>20:00</span>
                </li>
              </ul>
              <div class="ot-prize">
                <svg class="ico" viewBox="0 0 24 24">
                  <path
                    d="M8 21h8M12 17v4M5 3h14v2a4 4 0 0 1-4 4h-1a4 4 0 0 1-3 4v0H9v0a4 4 0 0 1-3-4H7A4 4 0 0 1 3 5V3h2z"
                  /></svg
                ><span class="amount">$ 2.000,00</span>
              </div>
              <button class="ot-btn" type="button" data-url="./tours-reg.html"  data-target="_self">INSCREVER-SE</button>
            </div>
          </article>
        </li>
      </ul>
    </section>


@endsection
@push('scripts')
@vite('../../../public/js/script.js')
@endpush