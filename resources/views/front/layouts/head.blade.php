<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ LaravelLocalization::getCurrentLocaleDirection() }}">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', setting()->site_name)</title>
    <!-- Normalize -->
    <link rel="stylesheet" href="{{ asset('css/normalize.css') }}" />
    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
    <!-- <link rel="stylesheet" href="{{ asset('css/bootstrap.rtl.min.css') }}" /> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.css" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('css/all.min.css') }}" />
    <!-- Main File Css  -->
    <link rel="stylesheet" href="{{ asset('css/main.css') }}" />

    @if (app()->getLocale() == 'en')
    <!-- Main File Css LTR  -->
    <link rel="stylesheet" href="{{ asset('css/main-ltr.css') }}" />
    @endif
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" type="text/css">
    @livewireStyles
    @stack('css')
    <!-- Font Google -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Noto+Kufi+Arabic:wght@500;600;700;800&display=swap" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Amiri:ital,wght@0,400;0,700;1,400;1,700&family=Marhey:wght@300..700&family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">

</head>
