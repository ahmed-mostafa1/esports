@extends('layouts.app')

@section('title', 'Signup')

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
        <button class="tab-btn" type="button" data-url="./login.html" data-target="_self">Login</button>
        <button class="tab-btn active">Sign up</button>
    </div>
    <p class="description">
        Lorem Ipsum is simply dummy text of the printing and typesetting
        industry.
    </p>

    <form class="signup-form">
        <div class="form-row">
            <input type="text" placeholder="Enter your Full name" />
            <input type="email" placeholder="Enter your E-mail" />
        </div>
        <div class="form-row">
            <input type="text" placeholder="Enter your Mobile number" />
            <select>
                <option>Select your State</option>
            </select>
        </div>
        <div class="form-row">
            <input type="text" placeholder="Enter your Address" />
            <select>
                <option>Select your Gender</option>
            </select>
        </div>
        <div class="form-row">
            <input type="text" placeholder="dd/mm/yyyy" />
            <input type="text" placeholder="Enter your ID Emirates" />
        </div>
        <div class="form-row">
            <input type="password" placeholder="Enter your Password" />
            <input type="password" placeholder="Enter your Confirm password" />
        </div>

        <div class="checkbox-group">
            <label><input type="checkbox" /> <a href="./privacy.html" class="href">Privacy Policy</a> </label>
        </div>
        <div class="checkbox-group">
            <label><input type="checkbox" /><a href="./terms.html" class="href">Terms and conditions</a> </label>
        </div>

        <button type="submit" class="btn-submit">Sign up</button>
    </form>
</div>
</div>
@endsection
@push('scripts')
@vite('../../../public/js/script.js')
<!-- button action -->
<script>
    document.addEventListener('click', function(e) {
        const btn = e.target.closest('.tab-btn[data-url]');
        if (!btn) return;
        location.href = btn.dataset.url;
    });
</script>
@endpush