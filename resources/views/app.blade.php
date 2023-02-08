<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  @php
      $setting = App\Models\Setting::first();
  @endphp
  <title>{{ $setting->system_title }} | @yield('pageTitle')</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <link rel="shortcut icon" href="{{ asset($setting->favicon) }}" type="image/x-icon">

  @include('layouts.css')

<body>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
      @include('layouts.navbar')
      @include('layouts.sidebar')

      <!-- Main Content -->
      <div class="main-content">
        @yield('content')
      </div>
      @include('layouts.footer')
    </div>
  </div>

  @include('layouts.js')
</body>
</html>