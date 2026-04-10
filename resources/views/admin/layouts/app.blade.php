<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />
    <link rel="stylesheet" href="{{ asset('admin/css/style.css') }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>@yield('title', 'Dashboard') | Admin Panel</title>
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

        <main>
          <div class="p-4 mx-auto max-w-screen-2xl md:p-6">
            @yield('content')
          </div>
        </main>
      </div>
    </div>

    <script src="{{ asset('admin/js/bundle.js') }}"></script>
    <script src="{{ asset('admin/js/fix-debugger.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @stack('scripts')
  </body>
</html>