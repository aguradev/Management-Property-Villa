<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    @include('backend.temp.style')

</head>

<body>

    <div class="layout-wrapper layout-content-navbar">

        <div class="layout-container">
            @include('backend.temp.sidebar')


            <div class="layout-page">
                @include('backend.temp.navbar')

                <div class="content-wrapper">
                    <div class="container-xxl flex-grow-1 container-p-y">
                    @yield('content')
                    </div>

                    <div class="content-backdrop fade"></div>
                </div>
            </div>

            @include('backend.temp.script')

        </div>

    </div>

</body>

</html>
