@yield('upperJs')


<script src="{{ asset('assets/modules/jquery.min.js') }}"></script>
<script src="{{ asset('assets/modules/popper.js') }}"></script>
<script src="{{ asset('assets/modules/tooltip.js') }}"></script>
<script src="{{ asset('assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
<script src="{{ asset('assets/modules/moment.min.js') }}"></script>
<script src="{{ asset('assets/js/stisla.js') }}"></script>

<script src="{{ asset('assets/modules/izitoast/js/iziToast.min.js') }}"></script>

@yield('middleJs')

<script>
  @if(Session::has('message'))
  var type = "{{ Session::get('alert-type', 'info') }}";
  switch (type) {
    case 'info':
      iziToast.info({
        title: "",
        message: "{{ Session::get('message') }}.",
        position: 'topRight'
      });
      break;

    case 'warning':
      iziToast.warning({
        title: "",
        message: "{{ Session::get('message') }}.",
        position: 'topRight'
      });
      break;

    case 'success':
      iziToast.success({
        title: "",
        message: "{{ Session::get('message') }}.",
        position: 'topRight'
      });
      break;

    case 'error':
      iziToast.error({
        title: "",
        message: "{{ Session::get('message') }}.",
        position: 'topRight'
      });
      break;
  }
  @endif
</script>

<script src="{{ asset('assets/js/scripts.js') }}"></script>
<script src="{{ asset('assets/js/custom.js') }}"></script>


@yield('lowerJs')