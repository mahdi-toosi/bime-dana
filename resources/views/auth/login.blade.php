@extends('auth.layout.app')

@section('title','ورود')

@section('style')
    <style>
        .videosplash {
            display: none;
        }

        @media only screen and (max-width: 800px) {
            html {

                display: flex;
                flex-direction: column;
                justify-content: center;

            }

            .videosplash {
                display: flex;
            }

        }

        #preloader {
            display: none !important;
            opacity: 0 !important;
        }

        .videosplash {


            margin-top: -20px;
            width: 100%;
            height: 100%;
            z-index: 10000;


            justify-content: center;

        }

        .videosplash video {

            max-width: 250px;
            margin: 0 auto;
            display: block;
            height: auto;

        }
    </style>
@endsection

@section('content')
    <div class="row justify-content-center align-items-center">
        <div class="col-lg-4 col-md-6 col-sm-8 col-11 mt-5">
            <div class="card login-box">
                <div class="row justify-content-start">
                    <div class="col-12">
                        <div class="card-body">
                            <h3 class="text-center m-0">
                                <a href="{{route("login")}}" class="logo logo-admin">
                                    <img src="http://www.bimebashe.ir/website/img/bimelogo.png" width="180" alt="logo"
                                         style="margin-bottom: 10px">
                                </a>
                            </h3>
                            <div class="pr-3 pl-3 pb-3 pt-0">

                                @if(session("forgetPassword"))
                                    <div class="alert alert-success text-right">
                                        {{ session('forgetPassword') }}
                                    </div>
                                @endif
                                <form class="form-horizontal m-t-30 text-right" method="post"
                                      action="{{route("login")}}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="phone">شماره موبایل</label>
                                        <input type="tel" class="form-control @error('phone') is-invalid @enderror"
                                               id="phone"
                                               name="phone" value="{{ old('phone') }}" required autocomplete="phone">
                                        @error("phone")
                                        <span class="mt-1 small text-danger"> &centerdot; {{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="password">رمز عبور</label>
                                        <input type="password"
                                               class="form-control @error('password') is-invalid @enderror"
                                               id="password" name="password" required autocomplete="current-password">
                                        @error("password")
                                        <span class="mt-1 small text-danger"> &centerdot; {{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group row m-t-20">
                                        <div class="col-sm-6 text-sm-right text-center">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input"
                                                       id="customControlInline"
                                                       name="remember" {{ old('remember') ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="customControlInline">مرا به
                                                    خاطر
                                                    بسپار</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 text-center">
                                            <button
                                                class="btn btn-success w-md  float-sm-left mt-sm-0 mt-3"
                                                type="submit">ورود
                                            </button>
                                        </div>
                                    </div>
                                </form>
                                <div class="form-group m-t-10 mb-0 row">
                                    <div class="col-12 m-t-20  text-center">
                                        @if (Route::has('reset.password'))
                                            <a href="{{route("reset.password")}}" class="text-muted small">
                                                <i class="mdi mdi-lock"></i>
                                                رمز خود را فراموش کرده‌اید؟!
                                            </a>
                                        @endif
                                        <p class="mt-3">حساب کاربری ندارید ؟
                                            <a href="{{route("register")}}"
                                               class="font-500 font-14 text-primary font-secondary">ثبت
                                                نام</a>
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

@endsection



