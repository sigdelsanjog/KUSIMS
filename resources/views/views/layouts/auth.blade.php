<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials.head')
</head>

<body class="app flex-row align-items-center">
<div class="container">

  @yield('content')

</div>
</body>
@include('partials.javascripts')

</html>