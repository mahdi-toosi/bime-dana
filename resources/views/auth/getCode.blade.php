@extends('auth.layout.app')

@section('title','فراموشی رمز عبور')

@section('style')

@endsection

@section('content')
    <div class="row justify-content-center align-items-center">
        <div class="col-lg-4 col-md-6 col-sm-8 col-11 mt-5">
            <div class="card login-box">
                <div class="row justify-content-start">
                    <div class="col-12">
                        <div class="card-body">

                            <h3 class="text-center m-0">
                                <a href="index.html" class="logo logo-admin">
                                    <img src="http://www.bimebashe.ir/website/img/bimelogo.png" width="180" alt="logo"
                                         style="margin-bottom: 10px">
                                </a>
                            </h3>

                            <div class="pr-3 pl-3 pb-3 pt-0">
                                <h4 class="text-muted font-18 m-b-5 text-center"> QuizPro</h4>
                                <p class="text-muted text-center">تایید شماره تلفن !</p>
                                <div class="alert alert-info small text-right" role="alert">
                                    کد برای شما ارسال شده است!
                                </div>
                                <form class="form-horizontal m-t-30 text-right" method="post"
                                      action="{{route("get.code")}}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="tell">کد </label>
                                        <input type="tel" class="form-control text-center" name="code" id="tell"
                                               placeholder="* * * *">
                                        @error("code")
                                        <span class="mt-1 small text-danger"> &centerdot; {{$message}}</span>
                                        @enderror
                                        @if (session('failure'))
                                            <span
                                                class="mt-1 small text-danger"> &centerdot; {{ session('failure') }}</span>
                                        @endif
                                    </div>
                                    <div class="timenotsend text-center text-primary">
                                        <time id="countdown">2:00</time>
                                    </div>
                                    <div class="form-group row m-t-20">
                                        <div class="col-12 text-center">
                                            <button
                                                class="btn btn-success float-sm-left mt-sm-0 mt-3"
                                                type="submit">ثبت
                                            </button>
                                        </div>
                                    </div>
                                </form>
                                <div class="form-group m-t-10 mb-0 row">
                                    <div class="col-12 m-t-20  text-center">
                                        <p class="mt-3">
                                            {{session("phone")}}
                                            <br/>
                                            شماره تلفن را اشتباه وارد کرده اید ؟
                                            <a href="@if(session("registerRecently")) {{route("register")}} @else {{route("reset.password")}} @endif"
                                               class="font-500 font-14 text-primary font-secondary">ویرایش شماره</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function () {
            var seconds = 120;

            function secondPassed() {
                var minutes = Math.round((seconds - 30) / 60),
                    remainingSeconds = seconds % 60;

                if (remainingSeconds < 10) {
                    remainingSeconds = "0" + remainingSeconds;
                }

                $('.timenotsend #countdown').html(minutes + ":" + remainingSeconds);

                if (seconds <= 0) {
                    axios.post("/register/clear/code").then(function (response) {
                        location.replace(response.data.whereToGo);
                    });
                } else {
                    seconds--;
                }
            }

            setInterval(secondPassed, 1000);
        });
    </script>
@endsection



