@extends('website.layout.app')

@section('title','صفحه نخست')

@section('style')

@endsection

@section('content')
    <div class="container">
        <section class="mainitems">
            <div class="text-center pt-5 pb-2">
                <h2 class="mb-4 font-weight-bold sitecolor">
                    سامانه خرید آنلاین بیمه
                </h2>
                <p>
                    بیمه مورد نظر خودتون رو انتخاب کنید
                </p>
                <p class="small text-muted">
                    در صورت خرید تا ساعت 21 در روزهای عادی و تا ساعت 19 در روزهای پنج‌شنبه و تعطیل، بیمه‌نامه شما همان
                    روز صادر می‌شود.
                </p>
            </div>
            <div class="row justify-content-center">

                <div class="row justify-content-center">
                    <div class="col-lg-2 col-md-4 col-sm-6">
                        <a href="/order/car">
                        <div class="insurancetype" href="/order/car">
                            <img src="{{asset('website/img/car-crash.png')}}">
                            <span>
                            بیمه شخص ثالث
                        </span>
                        </div>
                        </a>
                    </div>

                    <div class="col-lg-2 col-md-4 col-sm-6">
                        <a href="/order/motorcycle">
                        <div class="insurancetype ">
                            <img src="{{asset('website/img/motorcycle(1).png')}}">
                            <span>
                           موتور سیکلت
                        </span>
                        </div>
                        </a>
                    </div>

                    <div class="col-lg-2 col-md-4 col-sm-6">
                        <div class="insurancetype deactive">
                            <img src="{{asset('website/img/insurance(1).png')}}">
                            <span>
                           بدنه خودرو
                        </span>
                        </div>
                    </div>

                    <div class="col-lg-2 col-md-4 col-sm-6">
                        <div class="insurancetype deactive">
                            <img src="{{asset('website/img/delivery-truck.png')}}">
                            <span>
                           باربری
                        </span>
                        </div>
                    </div>

                    <div class="col-lg-2 col-md-4 col-sm-6">
                        <div class="insurancetype deactive">
                            <img src="{{asset('website/img/accident(3).png')}}">
                            <span>
                            حوادث انفرادی
                        </span>
                        </div>
                    </div>

                    <div class="col-lg-2 col-md-4 col-sm-6">
                        <div class="insurancetype deactive">
                            <img src="{{asset('website/img/crane.png')}}">
                            <span>
                           مهندسی
                        </span>
                        </div>
                    </div>

                    <div class="col-lg-2 col-md-4 col-sm-6">
                        <div class="insurancetype deactive">
                            <img src="{{asset('website/img/suitcases.png')}}">
                            <span>
                            مسافرتی
                        </span>
                        </div>
                    </div>

                    <div class="col-lg-2 col-md-4 col-sm-6">
                        <div class="insurancetype deactive">
                            <img src="{{asset('website/img/responsibility.png')}}">
                            <span>
                            مسئولیت
                        </span>
                        </div>
                    </div>

                    <div class="col-lg-2 col-md-4 col-sm-6">
                        <div class="insurancetype deactive">
                            <img src="{{asset('website/img/fire.png')}}">
                            <span>
                           آتش سوزی
                        </span>
                        </div>
                    </div>
                </div>

            </div>

        </section>
    </div>

@endsection

@section('script')

    <script>

    </script>
@endsection



