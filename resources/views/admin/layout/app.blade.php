<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta content="bimebash" name="description"/>
    <meta content="bimebash" name="author"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="csrf-tocken" content="{{csrf_token()}}"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') | پنل مدیریت</title>
    <!-- Styles -->

    <link rel="stylesheet" href="{{asset('adminpanel/css/bootstrap.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('adminpanel/css/line-awesome-font-awesome.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('adminpanel/css/line-awesome.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('adminpanel/css/scroll.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('adminpanel/css/sweetalert2.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('adminpanel/css/persian-datepicker.min.css')}}" type="text/css">


    @yield('style')
    <link rel="stylesheet" href="{{asset('adminpanel/css/main.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('adminpanel/css/styles.css')}}" type="text/css">
</head>

<body>

@include('admin._include.Sidebar')


<div class="content-all rtl">
    @include('admin._include.Header')
    <section class="content">
        @include('admin.components.alert.alert')
        @yield('content')
    </section>
</div>


<!-- Scripts -->
<script src="{{asset('adminpanel/js/jquery-3.2.0.min.js')}}"></script>
<script src="{{asset('adminpanel/js/bootstrap.min.js')}}"></script>
<script src="{{asset('adminpanel/js/scroll.js')}}"></script>
<script src="{{asset('adminpanel/js/sweetalert2.min.js')}}"></script>
<script src="{{asset('adminpanel/js/persian-datepicker.min.js')}}"></script>
<script src="{{asset('adminpanel/js/persian-date.min.js')}}"></script>
<script src="{{asset('adminpanel/js/axios.js')}}"></script>
<script>
    $(document).ready(function () {
        const csrf = $("meta[name='csrf-tocken']").attr("content");
        //bind csrf to axios  and show loading
        axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
        axios.interceptors.request.use(function (config) {
            $("#toast_loading").fadeIn();
            return config;
        });
        axios.interceptors.response.use(function (response) {
            $("#toast_loading").fadeOut();
            return response;
        }, function (error) {
            $("#toast_loading").fadeOut();
            return Promise.reject(error);
        });

    });
</script>

@yield('script')
<script src="{{asset('adminpanel/js/main.js')}}"></script>


</body>

</html>
