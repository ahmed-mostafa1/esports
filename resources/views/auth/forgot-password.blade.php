@extends('layouts.app')

@section('title', 'Forgot Password')

@push('styles')
<link rel="stylesheet" href="{{ asset('./css/style.css') }}" />
@endpush

@section('content')

<div class="container">
        <div class="form-header">
          <button class="tab-btn active" style="font-size: 25px;">Login</button>
        </div>
        <img src="{{ asset('./img/forgot-password.png') }}" style="border-radius: 50%;" alt="forgot" />
    
        <div class="description" style="border: 1px red solid; padding: 10px; border-radius: 20px;">
          <h2>Forgot password ?</h2>
          <p>Enter the email address associated with your account.</p>
        </div>
        
        <form class="signup-form" style="width: 70%; text-align: start;">
          <p style="margin: 0;">Email</p>
          <div class="form-row">
            <input type="text" id="email" name="email" placeholder="Enter your Email" />
          </div>
          <button type="submit" class="btn-submit">Reset password</button>
        </form>
        </div>

@endsection
@push('scripts')
@vite('../../../public/js/script.js')
@endpush