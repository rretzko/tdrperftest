<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <!-- {{-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> --}} -->
        <!-- {{-- link rel="stylesheet" href="{{ asset('css/tdr.css') }}"> --}} -->
        <link rel="stylesheet" href="/css/app.css">
        <link rel="stylesheet" href="/css/tdr.css">


        <!-- Scripts -->
        <!-- {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}} -->
        <script src="/js/app.js" defer ></script>
    </head>
    <body>
        <x-site-header />
        <x-guest-nav />
        <div class="content font-sans antialiased">
            {{ $slot }}
        </div>
        <div class="footer">
            <x-site-footer />
        </div>

        <!--Start of Tawk.to Script-->
        <script type="text/javascript">
            var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
            (function(){
                var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
                s1.async=true;
                s1.src='https://embed.tawk.to/5f3ec60e1e7ade5df44299c0/default';
                s1.charset='UTF-8';
                s1.setAttribute('crossorigin','*');
                s0.parentNode.insertBefore(s1,s0);
            })();
        </script>
        <!--End of Tawk.to Script-->
    </body>
</html>
