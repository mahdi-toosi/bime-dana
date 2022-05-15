<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta content="bimebash" name="description"/>
  <meta name="enamad" content="880686"/>
    <meta content="bimebash" name="author"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="csrf-tocken" content="{{csrf_token()}}"/>
    <title>@yield('title') | بیمه باش</title>


    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">


    <!-- Styles -->
    <link rel="stylesheet" href="{{asset('website/css/bootstrap.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('website/css/line-awesome-font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('website/css/line-awesome.min.css')}}" type="text/css">

    @yield('style')
    <link rel="stylesheet" href="{{asset('website/css/main.css')}}" type="text/css">
<style>
    .download {
        position: absolute;
        bottom: 4px;
        left: 110px;
        z-index: 100;
    }
    .download a
    {
        color:#fff;
    }
</style>
        </head>

<body>
<header>
    @include('website._include.Header')
</header>

<main>
    @yield('content')
    <div class="mainbg">

    </div>
    <div class="download">
        <a href="#" class="btn btn-default">دانلود مستقیم اپلیکشن</a>
        <a href="#" class="btn btn-default">دانلود از بازار</a>
        <a href="#" class="btn btn-default">دانلود از کندو</a>
    </div>
</main>

<footer>
    @include('website._include.Footer')
</footer>


<!-- Scripts -->
<script src="{{asset('website/js/jquery-3.2.1.min.js')}}"></script>
<script src="{{asset('website/js/bootstrap.min.js')}}"></script>


@yield('script')
<script src="{{asset('website/js/main.js')}}"></script>


</body>

</html>
