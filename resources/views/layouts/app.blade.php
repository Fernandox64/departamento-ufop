<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <title>@yield('title', $siteSettings['nome_site']) | {{ $siteSettings['nome_site'] }}</title>
    <meta name="description" content="@yield('description', $rodape['texto'])">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="48x48" href="{{ asset('favicon-48x48.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/all.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/rounded.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/back-menus.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/owl.carousel.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/magnific-popup.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/back-spacing.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/responsive.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/brand.css') }}">
    @stack('styles')
</head>
<body>

    <div id="back__preloader">
        <div id="back__circle_loader"></div>
    </div>

    @include('partials.header')

    <div class="back-wrapper">
        @yield('breadcrumb')

        @yield('content')
    </div>

    @include('partials.footer')

    <button type="button" id="backToTop" aria-label="Voltar ao topo">
        <svg class="back-to-top-ring" viewBox="0 0 52 52">
            <circle class="back-to-top-ring-bg" cx="26" cy="26" r="23"></circle>
            <circle class="back-to-top-ring-fill" cx="26" cy="26" r="23"></circle>
        </svg>
        <i class="fa-solid fa-arrow-up" aria-hidden="true"></i>
    </button>

    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('assets/js/wow.min.js') }}"></script>
    <script src="{{ asset('assets/js/back-menus.js') }}"></script>
    <script src="{{ asset('assets/js/plugins.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script>
        (function () {
            var btn = document.getElementById('backToTop');
            var ring = btn.querySelector('.back-to-top-ring-fill');
            var radius = ring.r.baseVal.value;
            var circumference = 2 * Math.PI * radius;
            ring.style.strokeDasharray = circumference + ' ' + circumference;
            ring.style.strokeDashoffset = circumference;

            function updateProgress() {
                var scrollTop = window.scrollY || document.documentElement.scrollTop;
                var docHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;
                var progress = docHeight > 0 ? scrollTop / docHeight : 0;
                ring.style.strokeDashoffset = circumference * (1 - progress);
                btn.classList.toggle('is-visible', scrollTop > 350);
            }

            window.addEventListener('scroll', updateProgress);
            window.addEventListener('resize', updateProgress);
            updateProgress();

            btn.addEventListener('click', function () {
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });
        })();
    </script>
    @stack('scripts')
</body>
</html>
