@extends('website.layout.app')

@section('title','پروفایل')

@section('style')
<style>
    .profile-picture {
        width: 120px;
        height: 120px;
        overflow: hidden;
        border-radius: 100%;
        margin: 10px auto;
        position: relative;
        text-align: center;
    }

    .profile-picture img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .profile-picture .profile-picture-icon {
        position: absolute;
        top: 0;
        right: 0;
        width: 100%;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: rgba(0, 0, 50, 0.3);
        font-size: 50px;
        color: #fff;
        opacity: 0.3;
        transition: all 0.3s;
    }

    .profile-picture:hover .profile-picture-icon {
        opacity: 1;
        cursor: pointer;
    }
    .form-group {
        position: relative;
    }

    .form-group .passsee {
        position: absolute;
        left: 5px;
        font-size: 20px;
        width: 25px;
        height: 25px;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 100%;
        top: calc(50% - 12px);
        color: #fff;
        background: #0E0A30;
        transition: all 0.3s;
        cursor: pointer;
    }

    .form-group .passsee:hover {
        cursor: pointer;
        color: #0E0A30;
        background: #fff;
    }
    .form-control:focus
    {
        box-shadow: none;
        border-color: #0050b6;
    }

</style>
@endsection

@section('content')
    <div class="container">
        <section class="mainitems">
            <div class="detailsbox">
                <div class="detailsboxheader">
                    <a href="/" class="backpage">
                        <i class="la la-angle-right"></i>
                        صفحه نخست
                    </a>
                    <span class="detailsboxname d-block text-center">
                    پروفایل
                </span>
                </div>
                <div class="detailsboxcontent">
                    <div class="row">
                        <div
                            class="profile-page w-100 d-flex align-items-center justify-content-center flex-wrap p-4">
                            @if($save==1)
                                <div class="alert alert-success fade in alert-dismissible show">
                                    ویرایش اطلاعات با موفقیت انجام شد
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            <form action="/edit" method="post" class="w-100">
                                @csrf
                                <div class="row">
                                    <div class="col-md-4 col-sm-6">
                                        <div class="p-5">
                                            <img src="/image/profile.png" class="img-fluid"/>
                                        </div>

                                    </div>
                                    <div class="col-md-8 col-sm-6">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="name" class="text-danger"></label>
                                                <input class="form-control" name="name" id="name" type="text"
                                                       placeholder="نام و نام خانوادگی" value="{{auth()->user()->name}}">
                                            </div>

                                            <div class="col-md-6">
                                                <label for="mobile" class="text-danger"></label>
                                                <input class="form-control" name="phone" id="mobile"
                                                       type="text" disabled placeholder="شماره همراه" value="{{auth()->user()->phone}}">
                                            </div>

                                            <div class="col-12">
                                                <label for="addres" class="text-danger"></label>
                                                <textarea class="form-control" name="address" id="addres"
                                                          placeholder="آدرس">{{auth()->user()->address}}</textarea>
                                            </div>
                                            <div class="col-12 text-left mt-3">
                                                <button class="btn btn-outline-primary">ثبت اطلاعات</button>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </form>
                            <form action="/changepass" method="post" class="w-100">
                                @csrf
                                <div class="row">
                                    <div class="col-md-4 col-sm-6">

                                    </div>
                                    <div class="col-md-8 col-sm-6">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="boxtitle">
                                                    رمز عبور
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="pass" class="text-danger"></label>
                                                <div class="form-group">
                                                    <input class="form-control" type="password" name="pass"
                                                           id="pass" placeholder="کلمه عبور جدید"
                                                           autocomplete="new-password">
                                                    <div class="passsee">
                                                        <i class="la la-eye-slash"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="reppass" class="text-danger"></label>
                                                <input class="form-control" name="reppass" id="reppass"
                                                       type="text" placeholder="تکرار رمز عبور">

                                            </div>
                                            <div class="col-12 text-left mt-3">
                                                <button class="btn btn-outline-primary">تغییر رمز عبور</button>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection

@section('script')

    <script>
        $('.form-group .passsee').click(function () {
            if ($(this).find('i').hasClass('la-eye-slash')) {
                $(this).parent().find('input[type=password]').attr('type', 'text');
                $(this).find('i').removeClass('la-eye-slash').addClass('la-eye');
            } else {
                $(this).parent().find('input[type=text]').attr('type', 'password');
                $(this).find('i').removeClass('la-eye').addClass('la-eye-slash');
            }
        });
        $('.profile-picture .profile-picture-icon').click(function () {
            var inptfile = $(this).parent().find('input[type=file]');
            inptfile.click();
        });
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('.profile-picture img').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
        }
        $('.profile-picture input[type=file]').change(function () {
            readURL(this);
            //TODO axios
        });
    </script>
@endsection



