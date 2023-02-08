<footer class="main-footer">
    <div class="footer-left">
      @php
          $setting = App\Models\Setting::first();
      @endphp
      {{ $setting->copyrights }}
    </div>
    <div class="footer-right">
      
    </div>
  </footer>