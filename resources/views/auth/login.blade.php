@extends('layouts.app')

@section('title', 'Login')

@push('styles')
<link rel="stylesheet" href="{{ asset('./css/style.css') }}" />
@endpush

@section('content')
<div class="main-section">
 <div class="left-panel hero-area">
        <img src="{{ asset('./img/image 3.png') }}" alt="Gamers" class="hero-img" />
        <!-- Floating triangles around hero image -->
        <div class="hero-triangle t1"></div>
        <div class="hero-triangle t2"></div>
        <div class="hero-triangle t3"></div>
        <div class="hero-triangle t4"></div>
        <div class="hero-triangle t5"></div>
      </div>

      <div class="right-panel">
        <div class="form-header">
          <button class="tab-btn active" style="font-size: 25px;">Login</button>
        </div>
        <p class="description" style="border: 1px red solid; padding: 10px; border-radius: 20px;">
          Lorem Ipsum is simply dummy text of the printing and typesetting
          industry.
        </p>

        <form class="signup-form" style="width: 70%;">
          <div class="form-row">
            <input type="text" placeholder="Enter your user name" />
          </div>
          <div class="form-row">
            <input type="password" placeholder="Enter your Password" />
          </div>

          <div class="checkbox-group">
            <label><input type="checkbox" style="text-decoration: none;" /> Remember me</label>
          </div>
          <div style="text-align: end !important;">
            <a href="./forgot-password.html" class="forgot-password">Forgot Password?</a>
          </div>
          <button type="submit" class="btn-submit">Log in</button>
        </form>
      </div>
      </div>

@endsection
@push('scripts')
@vite('../../../public/js/script.js')
@endpush