<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/croppie.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bulma.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>
<nav class="nav has-shadow">
  <div class="container">
    <div class="nav-left">
      <a class="nav-item is-brand" href="/">
          <strong>Polo's Contact</strong>
      </a>
      <a class="nav-item is-tab is-hidden-mobile {{ (Request::is('/') ? 'is-active' : '') }}" href="/">
        <span class="icon is-small"><i class="fa fa-home"></i></span> &nbsp;<span>Home</span>
      </a>
      <a class="nav-item is-tab is-hidden-mobile  {{ (Request::is('create') ? 'is-active' : '') }}" href="/create">
        <span class="icon is-small"><i class="fa fa-pencil"></i></span> &nbsp;<span>Add</span>
      </a>
    </div>
    <span id="nav-toggle" class="nav-toggle"  onclick="document.getElementById('nav-menu').classList.toggle('is-active');">
      <span></span>
      <span></span>
      <span></span>
    </span>
    <div class="nav-right nav-menu" id="nav-menu">
      <a class="nav-item is-tab is-hidden-tablet {{ (Request::is('/') ? 'is-active' : '') }}" href="/">
        <span class="icon is-small"><i class="fa fa-home"></i></span> &nbsp;<span>Home</span>
      </a>
      <a class="nav-item is-tab is-hidden-tablet  {{ (Request::is('create') ? 'is-active' : '') }}" href="create">
        <span class="icon is-small"><i class="fa fa-pencil"></i></span> &nbsp;<span>Add</span>
      </a>
        <a class="nav-item is-tab" href="{{ route('logout') }}"
            onclick="event.preventDefault();
                     document.getElementById('logout-form').submit();">
           {{ auth()->user()->name }} | Logout
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
    </div>
  </div>
</nav>
    <div id="app">
        @yield('content')
    </div>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('bottom_script')
</body>
</html>
