@extends('layouts.app')

@section('title', 'Reset Password')

@push('styles')
<link rel="stylesheet" href="{{ asset('./css/style.css') }}" />
<link rel="stylesheet" href="{{ asset('./css/gallery.css') }}" />
@endpush

@section('content')

 <div class="container">
        <div class="form-header">
          <button class="tab-btn active" style="font-size: 25px;">Reset password</button>
        </div>
        <img src="{{ asset('./img/forgot-password.png') }}" style="border-radius: 50%;" alt="forgot" />
        <form class="signup-form" style="width: 70%;">
          <div class="form-row">
            <input type="password"  placeholder="Enter your New Password" />
          </div>
          <div class="form-row">
            <input type="password" placeholder="Confirm your New Password" />
          </div>
          <button type="submit" class="btn-submit">Reset</button>
        </form>
        </div>

@endsection
@push('scripts')
@vite('../../../public/js/script.js')
@endpush