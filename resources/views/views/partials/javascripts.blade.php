
<script src="{{ url('js/app.js') }}"></script>
<!-- <script src="{{ url('adminlte/js') }}/select2.full.min.js"></script> -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>

<script>
    window._token = '{{ csrf_token() }}';
</script>



@yield('javascript')