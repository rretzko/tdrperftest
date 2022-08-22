<!DOCTYPE html>
<div lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Vanilla Styles -->
        <style>
            /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */
            html{line-height:1.15;-webkit-text-size-adjust:100%}
            body{margin:0}
            a{background-color:transparent}
            [hidden]{display:none}
            html{font-family:system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji;line-height:1.5}
            *,:after,:before{box-sizing:border-box;border:0 solid #e2e8f0}
            a{color:inherit;text-decoration:inherit}
            svg,video{display:block;vertical-align:middle}
            video{max-width:100%;height:auto}
            .bg-white{--bg-opacity:1;background-color:#fff;background-color:rgba(255,255,255,var(--bg-opacity))}
            .bg-gray-100{--bg-opacity:1;background-color:#f7fafc;background-color:rgba(247,250,252,var(--bg-opacity))}
            .border-gray-200{--border-opacity:1;border-color:#edf2f7;border-color:rgba(237,242,247,var(--border-opacity))}
            .border-t{border-top-width:1px}.flex{display:flex}
            .grid{display:grid}
            .hidden{display:none}
            .items-center{align-items:center}
            .justify-center{justify-content:center}
            .font-semibold{font-weight:600}
            .h-5{height:1.25rem}
            .h-8{height:2rem}
            .h-16{height:4rem}
            .text-sm{font-size:.875rem}
            .text-lg{font-size:1.125rem}
            .leading-7{line-height:1.75rem}
            .mx-auto{margin-left:auto;margin-right:auto}
            .ml-1{margin-left:.25rem}
            .mt-2{margin-top:.5rem}
            .mr-2{margin-right:.5rem}
            .ml-2{margin-left:.5rem}
            .mt-4{margin-top:1rem}
            .ml-4{margin-left:1rem}
            .mt-8{margin-top:2rem}
            .ml-12{margin-left:3rem}
            .-mt-px{margin-top:-1px}
            .max-w-6xl{max-width:72rem}
            .min-h-screen{min-height:100vh}
            .overflow-hidden{overflow:hidden}
            .p-6{padding:1.5rem}
            .py-4{padding-top:1rem;padding-bottom:1rem}
            .px-6{padding-left:1.5rem;padding-right:1.5rem}
            .pt-8{padding-top:2rem}
            .fixed{position:fixed}
            .relative{position:relative}
            .top-0{top:0}
            .right-0{right:0}
            .shadow{box-shadow:0 1px 3px 0 rgba(0,0,0,.1),0 1px 2px 0 rgba(0,0,0,.06)}
            .text-center{text-align:center}
            .text-gray-200{--text-opacity:1;color:#edf2f7;color:rgba(237,242,247,var(--text-opacity))}
            .text-gray-300{--text-opacity:1;color:#e2e8f0;color:rgba(226,232,240,var(--text-opacity))}
            .text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}
            .text-gray-500{--text-opacity:1;color:#a0aec0;color:rgba(160,174,192,var(--text-opacity))}
            .text-gray-600{--text-opacity:1;color:#718096;color:rgba(113,128,150,var(--text-opacity))}
            .text-gray-700{--text-opacity:1;color:#4a5568;color:rgba(74,85,104,var(--text-opacity))}
            .text-gray-900{--text-opacity:1;color:#1a202c;color:rgba(26,32,44,var(--text-opacity))}
            .underline{text-decoration:underline}
            .antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}
            .w-5{width:1.25rem}
            .w-8{width:2rem}
            .w-auto{width:auto}
            .grid-cols-1{grid-template-columns:repeat(1,minmax(0,1fr))}

            @media (min-width:640px){
                .sm\:rounded-lg{border-radius:.5rem}
                .sm\:block{display:block}.sm\:items-center{align-items:center}
                .sm\:justify-start{justify-content:flex-start}
                .sm\:justify-between{justify-content:space-between}
                .sm\:h-20{height:5rem}
                .sm\:ml-0{margin-left:0}
                .sm\:px-6{padding-left:1.5rem;padding-right:1.5rem}
                .sm\:pt-0{padding-top:0}
                .sm\:text-left{text-align:left}
                .sm\:text-right{text-align:right}
            }
            @media (min-width:768px){
                .md\:border-t-0{border-top-width:0}
                .md\:border-l{border-left-width:1px}
                .md\:grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr))}
            }
            @media (min-width:1024px){
                .lg\:px-8{padding-left:2rem;padding-right:2rem}
            }
            @media (prefers-color-scheme:dark){
                .dark\:bg-gray-800{--bg-opacity:1;background-color:#2d3748;background-color:rgba(45,55,72,var(--bg-opacity))}
                .dark\:bg-gray-900{--bg-opacity:1;background-color:#1a202c;background-color:rgba(26,32,44,var(--bg-opacity))}
                .dark\:border-gray-700{--border-opacity:1;border-color:#4a5568;border-color:rgba(74,85,104,var(--border-opacity))}
                .dark\:text-white{--text-opacity:1;color:#fff;color:rgba(255,255,255,var(--text-opacity))}
                .dark\:text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}
            }
        </style>

        <!-- FJR 2020-02-21 -->
        <style>
            a {
                color: whitesmoke;
            }

            body {
                font-family: 'Nunito';
                background: rgba(0, 0, 0, .88) url('/assets/images/floatingHandChalkTransparent.png') no-repeat;
                background-size: 100vw ;
                background-position-y: 100px;
            }

            h1 {
                position: absolute;
                top: 1rem;
                left: 1rem;
                width: 100%;
                text-align: center;
                color: yellow;
                font-size: 1rem;
            }

            #guest-nav{
                display: flex;
                flex-direction: row;
                font-size: .66rem;
                justify-content: space-between;
                left: 0px;
                padding: 0 1rem;
                position: absolute;
                top: 40px;
                width: 100vw;
            }

            #guest-modules{

            }

            #login-register{
                margin-left: 2rem;
            }

            #logo {
                position: absolute;
                top: 1rem;
                left: 1rem;
            }

            #logo img{
                height: 25px;
                width: 25px;
            }

            #welcome-footer{
                color: white;
                display: flex;
                font-size: .66rem;
                justify-content: space-between;
                padding: 0 .5rem;
                width: 100%;
            }

            @media (min-width:640px) {
                h1 {
                    font-size: 2rem;
                    top: 1rem;
                }

                #logo img {
                    height: 80px;
                    width: 80px;
                }

                #guest-nav{
                    font-size: 1rem;
                    padding: 0 2rem;
                    top: 60px;
                }

                #welcome-footer
                {
                    position: absolute;
                    top: 90vh;
                    left: 10vw;
                    width: 80%;
                }
            }
            @media (min-width:1024px)
            {
                body{background-position-y: 0%;}

                #guest-nav{padding-right: 4rem;}
            }
        </style>
    </head>

<!-- {{--
        <div id="guest-nav"><!-- relative flex items-top justify-center min-h-screen sm:items-center sm:pt-0 -->
            @if (Route::has('login'))
                <div id="guest-nav" class="text-xs"><!-- hidden fixed top-0 right-0 px-6 py-4 sm:block -->
                    <div id="guest-modules">
                        <a href="{{ url('/dashboard') }}" class="text-xs underline">Dashboard</a>
                    </div>
                    <div id="login-register">
                        <a href="{{ route('login') }}" class="underline">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-1 underline">Register</a>
                        @endif
                    </div>
                </div>
            @endif
        </div>
--}} -->
    <body class="antialiased" >

    <div id="welcome-header">
        <!-- LOGO -->
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div id="logo">
                <img
                    src="\images\tdr_logo_20200716.svg"
                    alt="TheDirectorsRoom.com svg image"
                />
            </div>

            <h1>TheDirectorsRoom.com</h1>

            @guest
                <div style="position: absolute; top:40px; right:80px;" id="login-register">
                    <a href="{{ route('login.tdr.show') }}" class="underline">Log in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="ml-1 underline">Register</a>
                    @endif
                </div>
            @endguest

            <div style="position:relative; top:240px; left:25%; background-color:lightgray; border-radius: 1rem; width: 50%; padding-top: .25rem;">
                <h2 style="text-align: center; ">Welcome!  Please log in!</h2>
                @if(config('app.url') === 'http://localhost')
                    {{-- USE THE local http:// ENVIRONMENT --}}
                    <form method="post" id="dev" action="{{ route('login.tdr.update') }}" style="padding:.25rem .5rem;">
                @else
                    {{-- USE THE PRODUCTION ENVIRONMENT --}}
                    <form method="post" id="{{ config('app.url') }}" action="https://thedirectorsroom.com/login/tdr/update" style="padding:.25rem .5rem;">
                @endif

                    @csrf

                    <div id="input-group">
                        <div class="input-row" style="display:flex; margin-bottom: .25rem;">
                            <label for="username" style="min-width: 25%; margin-right: 4px;">Username</label>
                            <input type="text" name="username" id="username" value="" style="font-size: 1.25rem;">
                        </div>

                        <div class="input-row" style="display:flex; margin-bottom: .5rem;">
                            <label for="username" style="min-width: 25%; margin-right: 4px;">Password</label>
                            <input type="password" name="password" id="password" value="" style="font-size: 1.25rem;">
                        </div>

                        <div class="input-row" style="display:flex; margin-bottom: .25rem;">
                            <label for="submit" style="min-width: 25%; margin-right: 4px;"></label>
                            <div>
                                <a href="{{ route('password.request') }}" style="color: black; font-size: small; text-decoration: underline;">
                                    Forgot your passord?
                                </a>
                                <input type="submit" name="submit" id="submit" value="Log In"
                                   style="margin-left: .5rem; padding: .25rem; font-size: 1rem; background-color: black; color: white; border-radius: 1rem;">
                            </div>
                        </div>
                    </div>

                </form>
            </div>

            <div id="welcome-footer" class="">
                <div id="copyright">
                    &copy; 2020-{{ date('Y') }}
                </div>

                <div id="contact">
                    <a href="mailto:rick@mfrholdings.com?subject=TheDirectorsRoom.com inquiry&body=Hi Rick - "
                       title="Email us with any questions you have regarding our AuditionSuite products!"
                    >
                        Contact Us
                    </a>
                </div>

                <div id="version">
                    v.2021.3
                </div>
            </div>
        </div>
    </div>

    </body>
    </html>
