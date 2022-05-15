@extends('auth.layout.app')

@section('title','ورود')

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
                                <a href="{{route("login")}}" class="logo logo-admin">
                                    <img src="http://www.bimebashe.ir/website/img/bimelogo.png" width="180" alt="logo"
                                         style="margin-bottom: 10px">
                                </a>
                            </h3>
                            <div class="pr-3 pl-3 pb-3 pt-0">
                                <h4 class="text-muted font-18 m-b-5 text-center">QuizPro</h4>
                                <p class="text-muted text-center"> ایجاد رمز عبور !</p>
                                <div class="alert alert-info small text-right" role="alert">
                                    @if(session("registerRecently"))
                                        برای حساب خود رمز عبور انتخاب کنید !
                                    @else
                                        رمز عبور جدید را وارد کنید!
                                    @endif
                                </div>
                                <form class="form-horizontal m-t-30 text-right" method="post"
                                      action="{{route("set.password")}}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="password">
                                            <small>
                                                @if(session("registerRecently"))
                                                    رمز عبور
                                                @else
                                                    رمز عبور جدید
                                                @endif
                                            </small>
                                        </label>
                                        <input type="password"
                                               class="form-control @error('password') is-invalid @enderror"
                                               id="password" name="password">
                                        @error("password")
                                        <span class="mt-1 small text-danger"> &centerdot; {{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="password_confirmation">
                                            <small>
                                                @if(session("registerRecently"))
                                                    تکرار رمز عبور
                                                @else
                                                    تکرار رمز عبور جدید
                                                @endif
                                            </small>
                                        </label>
                                        <input type="password"
                                               class="form-control @error('confirm_password') is-invalid @enderror"
                                               name="password_confirmation" id="password_confirmation">
                                        @error("password_confirmation")
                                        <span class="mt-1 small text-danger"> &centerdot; {{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group row m-t-20">
                                        <div class="col-12 text-center">
                                            <button
                                                class="btn btn-primary w-md waves-effect waves-light float-sm-left mt-sm-0 mt-3"
                                                type="submit">ثبت
                                            </button>
                                        </div>
                                    </div>
                                </form>
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



