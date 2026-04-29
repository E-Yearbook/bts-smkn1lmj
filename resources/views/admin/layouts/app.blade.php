<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/smkn1logo.png') }}">

    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>@yield('title', 'Dashboard') | Admin Panel</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
  </head>
  <body
    x-data="{
      page: '{{ $page ?? 'dashboard' }}',
      loaded: true,
      stickyMenu: false,
      sidebarToggle: false,
      scrollTop: false
    }"
  >
    @include('admin.partials.preloader')

    <div class="flex h-screen overflow-hidden">
      @include('admin.partials.sidebar')

      <div class="relative flex flex-col flex-1 overflow-x-hidden overflow-y-auto">
        @include('admin.partials.overlay')
        @include('admin.partials.header')

        <main class="flex-1">
          <div class="p-4 mx-auto max-w-screen-2xl md:p-6">
            @yield('content')
          </div>
        </main>
        @include('admin.partials.footer')
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @stack('scripts')
  </body>
</html>
