@extends('auth.layout.app')

@section('title','ثبت نام')

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
                                <p class="text-muted text-center"> خوش آمدید !</p>
                                <form class="form-horizontal m-t-30 text-right" method="post"
                                      action="{{route('register.send.code')}}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="name">نام و نام خانوادگی</label>
                                        <input type="text" name="name"
                                               class="form-control @error('name') is-invalid @enderror"
                                               id="name" value="{{old("name")}}">
                                        @error("name")
                                        <span class="mt-1 small text-danger"> &centerdot; {{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">شماره موبایل</label>
                                        <input type="tel" name="phone"
                                               class="form-control @error('phone') is-invalid @enderror"
                                               id="phone" value="{{old("phone")}}">
                                        @error("phone")
                                        <span class="mt-1 small text-danger"> &centerdot; {{$message}}</span>
                                        @enderror
                                    </div>
                                    @if (session('status'))
                                        <div class="alert alert-danger">
                                            {{ session('status') }}
                                        </div>
                                    @endif
                                    <div class="form-group row m-t-20">
                                        <div class="col-sm-12 text-center">
                                            <button
                                                class="btn btn-primary w-md waves-effect waves-light float-sm-left mt-sm-0 mt-3"
                                                type="submit">ارسال کد تایید
                                            </button>
                                        </div>
                                    </div>
                                </form>
                                <div class="form-grou mb-0 row">
                                    <div class="col-12 text-center">
                                        <p class="mt-3">حساب کاربری دارید ؟
                                            <a href="{{route("login")}}"
                                               class="font-500 font-14 text-primary font-secondary">
                                                ورود </a>
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



