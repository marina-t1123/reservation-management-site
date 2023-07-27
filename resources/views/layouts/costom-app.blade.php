<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        {{-- styles --}}
        <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}" />

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

        <!-- Bootstrap -->
        <link rel = "stylesheet" href = "https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

        <!-- fontawsome cdn -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <div id="app">

            <!-- header -->
            @include('components.parts.custom-header')

            <!-- 宿泊者の場合 -->
            @guest
                <main class="py-4">

                    <!-- content -->
                    @yield('content')

                </main>
            @else
            <!-- 管理者の場合 -->
                <!-- フラッシュメーセージ -->
                {{-- @include('components.parts.flash_message') --}}
                <!-- コンテンツ -->
                <main class="py-4">
                    <div id="content">
                        <div class="container-fluid">
                            <div class="row justify-content-center">
                                <!-- サイドメニュー -->
                                <div class="col-2" style="display: block;">
                                    {{-- @include('com') --}}
                                    @include('components.parts.admin-sidebar')
                                </div>
                                <!-- メインコンテンツ -->
                                <div class="col-10">
                                    {{-- <div class="card"> --}}
                                        @yield('content')
                                    {{-- </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            @endguest
        </div>

    </body>
</html>
