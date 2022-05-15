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
                                <a href="{{route("login")}}" class="logo logo-admin">
                                    <img src="http://www.bimebashe.ir/website/img/bimelogo.png" width="180" alt="logo"
                                         style="margin-bottom: 10px">
                                </a>
                            </h3>
                            <div class="pr-3 pl-3 pb-3 pt-0">
                                <h4 class="text-muted font-18 m-b-5 text-center"> QuizPro</h4>
                                <p class="text-muted text-center"> فراموشی رمز عبور !</p>
                                <form class="form-horizontal m-t-30 text-right"
                                      action="{{route("reset.password.send.code")}}">
                                    <div class="form-group">
                                        <label for="tell">شماره تماس</label>
                                        <input type="tel" class="form-control" name="phone" id="tell"
                                               placeholder="شماره موبایل خود را وارد کنید">
                                    </div>
                                    @error("phone")
                                    <span class="mt-1 small text-danger"> &centerdot; {{$message}}</span>
                                    @enderror
                                    <div class="form-group row m-t-20">
                                        <div class="col-12 text-center">
                                            <button
                                                class="btn btn-success float-sm-left mt-sm-0 mt-3"
                                                type="submit">دریافت کد
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



