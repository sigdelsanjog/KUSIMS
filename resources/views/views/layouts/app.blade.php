<!DOCTYPE html>
<html lang="en">
<head>
    @include('partials.head')
</head>
<body class="app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show footer-fixed">
    <div id="app">
        @include('partials.header')
        <div class="app-body">
            @include('partials.sidebar')
            <main class="main">
                <div class="container-fluid">
                    <div class="animated fadeIn">
                        @include('partials.breadcrumb')          
                            @if (Session::has('message'))
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    {{ Session::get('message') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            @if ($errors->count() > 0)
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <ul class="list-unstyled">
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                           
                            @endif
                        @yield('content')
                    </div>
                </div>
            </main>
        </div>
    </div>
  @include('partials.footer')
  @include('partials.javascripts')
</body>
</html>