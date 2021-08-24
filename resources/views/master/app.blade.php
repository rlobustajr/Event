<!DOCTYPE html>
<html>
<title>Calendar Event</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}" />

  <link href="{{ asset('bootstrap/css/w3.css') }}" rel="stylesheet"> 
  <link href="{{ asset('bootstrap/css/all.min.css') }}" rel="stylesheet"> 
  <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

<body style="background:#1abdb9">

  <!-- !PAGE CONTENT! -->
  <div class="container-fluid">
    <div id="app">
        @yield('content')
    </div>
  </div>

  <script src="{{ asset('bootstrap/js/jquery.min.js') }}"></script>
  <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('js/app.js') }}"></script>

  <script>
  
  </script>

  @yield('script')

</body>
</html>
