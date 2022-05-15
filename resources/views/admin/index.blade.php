@extends('admin.layout.app')

@section('title',' داشبورد')

@section('style')

@endsection

@section('content')
    <div class="container-fluid">

        <!------------shortcut-------------->
        <div class="row">
            <div class="col-lg-3 col-sm-6">
                <div class="shortcut shortcutblue">
                    <div class="d-flex align-items-center w-100">
                        <div class="shortcut-icons">
                            <img src="{{asset('adminpanel/img/life-insurance.png')}}">
                        </div>
                        <div class="d-flex flex-column justify-content-center">
                               <span>
                                      کل بیمه ها
                               </span>
                            <span class="f-22">
                                {{$order_count}}
                               </span>
                        </div>
                    </div>
                    <div>

                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="shortcut shortcutred">
                    <div class="d-flex align-items-center w-100">
                        <div class="shortcut-icons">
                            <img src="{{asset('adminpanel/img/life-insurance(1).png')}}">
                        </div>
                        <div class="d-flex flex-column justify-content-center">
                               <span>
                                      بیمه های امروز
                               </span>
                            <span class="f-22">
                                {{$order_todey}}
                               </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="shortcut shortcutgreen">
                    <div class="d-flex align-items-center w-100">
                        <div class="shortcut-icons">
                            <img src="{{asset('adminpanel/img/sales.png')}}">
                        </div>
                        <div class="d-flex flex-column justify-content-center">
                               <span>
                                    درآمد کل
                               </span>
                            <span class="f-22">
                                {{number_format($income,0)}}
                               </span>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="shortcut shortcutyellow">
                    <div class="d-flex align-items-center w-100">
                        <div class="shortcut-icons">
                            <img src="{{asset('adminpanel/img/group(1).png')}}">
                        </div>
                        <div class="d-flex flex-column justify-content-center">
                               <span>
                                   تعداد کاربران
                               </span>
                            <span class="f-22">
                                {{$user_count}}
                               </span>
                        </div>
                    </div>
                    <div>

                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="card p-2">
                    <div class="boxtitle">
                        <i class="la la-line-chart"></i>نمودار درآمد
                    </div>
                    <div style="width:100%;">
                        <canvas id="canvas"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card p-2">
                    <div class="boxtitle">
                        <i class="la la-line-chart"></i>نمودار درآمد
                    </div>
                    <div style="width:100%;">
                        <canvas id="canvas2"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{asset('adminpanel/js/Chart.min.js')}}"></script>
    <script src="{{asset('adminpanel/js/utils.js')}}"></script>
    <script>
        var config = {
            type: 'line',
            data: {
                labels: ['فروردین', 'اردیبهشت', 'خرداد', 'تیر', 'مرداد', 'شهریور'],
                datasets: [{
                    label: 'نمودار درآمد',
                    backgroundColor: window.chartColors.blue,
                    borderColor: window.chartColors.blue,
                    data: [
                        1000000,
                        700000,
                        500000,
                        700000,
                        1000000,
                        1200000
                    ],
                    fill: false,
                }]
            },
            options: {
                responsive: true,
                title: {
                    display: true,
                    text: 'درآمد 6 ماه اول'
                },
                tooltips: {
                    mode: 'index',
                    intersect: false,
                },
                hover: {
                    mode: 'nearest',
                    intersect: true
                }
            }
        };
        var config2 = {
            type: 'line',
            data: {
                labels: ['مهر', 'آبان', 'آذر', 'دی', 'بهمن', 'اسفند'],
                datasets: [{
                    label: 'نمودار درآمد',
                    backgroundColor: window.chartColors.orange,
                    borderColor: window.chartColors.orange,
                    data: [
                        1000000,
                        700000,
                        0,
                        1200000,
                        1000000,
                        1050000
                    ],
                    fill: false,
                }]
            },
            options: {
                responsive: true,
                title: {
                    display: true,
                    text: 'درآمد 6 ماه دوم'
                },
                tooltips: {
                    mode: 'index',
                    intersect: false,
                },
                hover: {
                    mode: 'nearest',
                    intersect: true
                }
            }
        };
        window.onload = function () {
            var ctx = document.getElementById('canvas').getContext('2d');
            window.myLine = new Chart(ctx, config);
            var ctxx = document.getElementById('canvas2').getContext('2d');
            window.myLine = new Chart(ctxx, config2);
        };
    </script>
@endsection



