<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>ورود بیمه باش </title>
    <meta content="guizpro" name="author"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>


    <!-- Styles -->
    <link rel="stylesheet" href="{{asset('adminpanel/css/bootstrap.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('adminpanel/css/line-awesome-font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('adminpanel/css/line-awesome.min.css')}}" type="text/css">

    @yield('style')

    <link rel="stylesheet" href="{{asset('auth.css')}}" type="text/css">
</head>
<body class="pb-0">
<div id="preloader">
    <div id="status">
        <div class="spinner"></div>
    </div>
</div>
<div class="wrapper-page">
    @yield('content')
</div>


<!-- Scripts -->
<script src="{{asset('adminpanel/js/jquery-3.2.0.min.js')}}"></script>

@yield('script')

<script>

</script>
</body>
</html>
