@extends('website.layout.app')

@section('title','تاییدیه موبایل');

@section('style')

@endsection

@section('content')
    <div class="container">
        <div class="detailsbox">
            <div class="detailsboxheader">
                <a href="/" class="backpage">
                    <i class="la la-angle-right"></i>
                    صفحه نخست
                </a>
                <span class="detailsboxname d-block text-center">
                  دریافت کد تاییدیه تلفن همراه
                </span>
            </div>
            <div class="p-5">
                <h3 class="text-center m-0">
                    <a href="index.html" class="logo logo-admin">
                        <img src="http://www.bimebashe.ir/website/img/bimelogo.png" width="180" alt="logo"
                             style="margin-bottom: 10px">
                    </a>
                </h3>

                <div class="pr-3 pl-3 pb-3 pt-0">

                    <form class="form-horizontal m-t-30 text-right" method="post"
                          >
                        @csrf
                        <div class="form-group">
                            <label for="tell">کد </label>
                            <input type="tel" class="form-control text-center" name="code" id="tell"
                                   placeholder="* * * *">
                            @if($error==1)
                            <span class="mt-1 small text-danger"> کد وارد شده صحیح نمی باشد.</span>
                            @endif

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

                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')

    <script>

    </script>
@endsection



