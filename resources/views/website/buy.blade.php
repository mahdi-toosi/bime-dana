@extends('website.layout.app')

@section('title','خرید بیمه')

@section('style')

    <link rel="stylesheet" href="{{asset('website/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('website/css/persian-datepicker.min.css')}}">
    <style>
        .select2-container
        {
            width: 100% !important;
        }
        .btn.disabled, .btn:disabled
        {
            opacity: .2;
        }
        .has-error {border:1px solid rgb(185, 74, 72) !important;}
        .loading {
            background: url('/image/lod.gif');
            background-size: auto auto;
            width: 300px;
            height: 300px;
            background-size: 100% auto;
            margin: 0 auto;
        }
        .btntwo.selected {

            background: #19b950;
        }
        #bprice {
            color: red;
            font-weight: bold;
            font-size: 14px;
        }
.pcc {
    display: block;
    font-size: 13px;
    color: #777;
}
        #bprice .pcc {
            display: inline-block;
        }
        small.text-danger {
            display: none !important;
        }
        .has-error + small.text-danger {
            display: block !important;
        }
        .d-x
        {
            visibility: hidden;
        }
        .resendsms {
            color: #7987e3;
            cursor: pointer;
            padding-left: 10px;
        }
        .resendsmsok
        {
            color: #0bb44e;
            padding-left: 10px;
        }
        .btntwo {
 width: 100%;
    background: #fff;
    color: #000;
}
.omg select {
  width: 75px;
}

.input-group {
    direction: ltr;
}
        table td {


            border: 1px solid;
            padding: 4px;
            font-size: 11px;

        }

       .detailsboxcontent .btn-type .btn {
            background: #ccc;
            color: #fff;
            border-bottom: 3px solid #aaa;
            text-align: center;
            padding: 10px 40px !important;

        }
        .detailsboxcontent .btn-type .btn-primary {
            background: #163b68;
            border-color: #001b3d;
            border-bottom-width: 2px;
            border-top: 1px solid #fff;
            border-left: 0px solid #fff;
            border-right: 0px solid #fff;
        }

        .more {
            border: 1px solid #bbb6;
            border-radius: 6px;
            padding: 8px;
            background: #eee9;
            margin-bottom: 11px;
            display: none;
        }
        .showmore {
            position: absolute;
            bottom: -10px;
            background: #fff;
            padding: 2px 8px;
            box-shadow: 0px 4px #eee;
            left: calc( 50% - 20px);
            border: 1px solid #eee;
            border-radius: 5px;
            color: #777;
        }
        .ghesti
        {
            display: none;
        }
        .btn-primary:not(:disabled):not(.disabled).active:focus, .btn-primary:not(:disabled):not(.disabled):active:focus, .show > .btn-primary.dropdown-toggle:focus
        {
            box-shadow: none;
        }
        .btn-primary.focus, .btn-primary:focus
        {
            box-shadow: none;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="detailsbox">
            <div class="detailsboxheader">
                <a href="/" class="backpage">
                    <i class="la la-angle-right"></i>
                    صفحه اصلی
                </a>
                <span class="detailsboxname d-block text-center">
                    بیمه شخص ثالث وسیله نقلیه
                </span>
            </div>
            <div class="detailsboxcontent">
                <div class="row justify-content-center pt-5 pb-4 content-box active">
                    <div class="col-8">
                        <p class="font-weight-bold">
                           نوع کاربری و سال ساخت خودرو را انتخاب کنید
                        </p>
                    </div>
                    <div class="col-md-6 pt-4">
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <select class="js-states form-control" id="select1">

                                </select>
                            </div>
                            <div class="col-md-6 mb-4">
                                <select class="js-states form-control" id="select2">
                                    <option></option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-4">
                                <select class="js-states form-control" id="select3">
                                    <option></option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-4">
                                <select class="js-states form-control" id="select4">
                                    <option></option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center pt-5 pb-4 content-box">
                    <div class="col-8">
                        <p class="font-weight-bold">
                            شرکت بیمه‌گر قبلی خود را در این بخش وارد کنید.
                        </p>
                    </div>
                    <div class="col-md-6 pt-4">
                        <div class="row">
                            <div class="col-12 mb-4 d-flex">
                                <select class="js-states form-control" id="select6">
                                    <option></option>
                                    <option value="-1" selected>بدون سابقه</option>
                                    <option value="0">صفر کیلومتر</option>
                                    @foreach($insurances as $insurance)
                                        <option value="{{$insurance->id}}">{{$insurance->name}}</option>
                                        @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center pt-5 pb-4 content-box">
                    <div class="col-8">
                        <p class="font-weight-bold">
                          تاریخ اتمام و مدت بیمه نامه قبل خود را در این بخش وارد نمایید.
                        </p>
                    </div>
                    <div class="col-md-6 pt-4">
                        <div class="row">
                            <div class="col-12 mb-4 d-flex">
                                <select class="js-states form-control" id="time_last_inc" >
                                    <option></option>
                                    <option value="0" selected>یک ساله</option>
                                    <option value="1">کمتر از یک سال</option>

                                </select>
                            </div>
                            <div class="col-12 mb-4">
                                <label class="d-block">تاریخ اتمام بیمه نامه قبلی</label>
                                <input class="form-control" id="endtdate" name="endtdate"
                                       placeholder="تاریخ اتمام بیمه نامه قبلی">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center pt-5 pb-4 content-box">
                    <div class="col-8">
                        <p class="font-weight-bold">
                            درصد تخفیف خود را دقیقا مطابق بیمه‌نامه و بدون افزودن عددی به آن وارد کنید
                            <span class="text-muted small d-block mt-3">
                                درصد تخفیف بیمه‌نامه جدید شما به صورت خودکار محاسبه می‌شود
                            </span>
                        </p>
                    </div>
                    <div class="col-md-6 pt-4">
                        <div class="row">
                            <div class="col-12 mb-4 d-flex">
                                <div class="form-group w-100">
                                    <label for="select7" class="d-block">درصد تخفیف ثالث</label>
                                    <select class="js-states form-control" id="select7">

                                    </select>
                                </div>

                            </div>
                            <div class="col-12 mb-4 d-flex">
                                <div class="form-group w-100">
                                    <label for="select8" class="d-block">درصد  تخفیف حوادث راننده</label>
                                    <select class="js-states form-control" id="select8">

                                    </select>
                                </div>

                            </div>
                            <div class="col-6 mb-4 d-flex">
                                <div class="form-group w-100">
                                    <label for="select10" class="d-block">سابقه خسارت مالی</label>
                                <select class="js-states form-control" id="select10">
                                </select>
                                </div>
                            </div>
                            <div class="col-6 mb-4 d-flex">
                                <div class="form-group w-100">
                                    <label for="select11" class="d-block">سابقه خسارت بدنی</label>
                                <select class="js-states form-control" id="select11">
                                </select>
                                </div>
                            </div>
                           

                        </div>
                    </div>
                </div>

                

                <div class="row justify-content-center pt-5 pb-4 content-box">
                    <div class="col-8">
                        <div class="alert alert-primary mt-4">
                            <i class="las la-exclamation-circle"></i>
                            با تغییر شرکت بیمه‌گر فعلی خود، تخفیف‌های عدم خسارت بیمه‌نامه شما به شرکت جدید منتقل می‌شود.
                        </div>
                    </div>
                    <div class="col-md-6 pt-4">
                        <div class="row">
                            <div class="col-md-6 mb-4 d-flex">
                                <div class="form-group">
                                    <label>میزان پوشش مالی</label>
                                    <select class="js-states form-control" id="select13">
                                        <option value="11">11 میلیون تومان</option>
                                        @for($i=20;$i<=150;$i=$i+10)
                                            <option value="{{$i}}" @if($i==11) selected @endif>{{$i}} میلیون تومان</option>
                                        @endfor
                                    </select>
                                </div>

                            </div>
                            <div class="col-md-6 mb-4 d-flex">
                                <div class="form-group">
                                    <label>مدت اعتبار بیمه نامه</label>
                                <select class="js-states form-control" id="select12">
                                    <option value="1" selected>یکساله</option>
                                    <option value="2">شش ماهه</option>
                                    <option value="3">سه ماه</option>
                                    <option value="4">یک ماهه</option>
                                </select>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="btn-type d-flex justify-content-center">
                        <div class="btn-group" style="direction: ltr">
                            <button data-type="1" class="btn pl-5 pr-2">اقساط</button>
                            <button data-type="0" class="btn pl-5 pr-2 btn-primary ">نقد</button>
                        </div>
                        </div>
                        <div class="row list_ins">


                        </div>



                    </div>
                </div>

                <div class="row justify-content-center pt-5 pb-4 content-box ">
                    <div class="col-8">
                        <div class="alert alert-primary mt-4">
                            <i class="las la-exclamation-circle"></i>
                            تکمیل مدارک و ارسال تصاویر
                        </div>
                    </div>
                    <div class="col-md-6 pt-4">
                        <div class="row">
                            <div class="col-12 mb-4">
                                <label class="f-12 sitecolor"> عکس روی کارت ماشین یا برگ سبز <span class="text-danger">*</span></label>
                                <div class="custom-file text-left">

                                    <input type="file" class="custom-file-input" id="customFile">
                                    <label class="custom-file-label" for="customFile">انتخاب</label>
                                </div>
                            </div>
                            <div class="col-12 mb-4">
                                <label class="f-12 sitecolor"> عکس پشت کارت ماشین یا برگ سبز </label>
                                <div class="custom-file text-left">

                                    <input type="file" class="custom-file-input" id="customFile2">
                                    <label class="custom-file-label" for="customFile2">انتخاب</label>
                                </div>
                            </div>
                            <div class="col-12 mb-4">
                                <label class="f-12 sitecolor">کارت ملی بیمه گذار<span class="text-danger">*</span></label>
                                <div class="custom-file text-left">

                                    <input type="file" class="custom-file-input" id="customFile3">
                                    <label class="custom-file-label" for="customFile3">انتخاب</label>
                                </div>
                            </div>
                            <div class="col-12 mb-4">
                                <label class="f-12 sitecolor"> عکس بیمه نامه </label>
                                <div class="custom-file text-left">
                                    <input type="file" class="custom-file-input" id="customFile4">
                                    <label class="custom-file-label" for="customFile4">انتخاب</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="row justify-content-center">
                            <div class="col-12">
                                <p class="font-weight-bold sitecolor">
                                    مشخصات بیمه گذار
                                    <span class="text-muted small d-block mt-3">

                    بیمه نامه به نام صاحب شماره ملی ثبت خواهد شد در ثبت اطلاعات دقت نمایید.
                            </span>
                                </p>
                            </div>
                          
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="codmeli">کدملی <span class="text-danger">*</span> </label>
                                    <input type="text" id="codmeli" name="codmeli number" class="form-control">
                                    <small id="emailHelp" class="form-text text-danger">لطفا کد ده رقمی کد ملی را وارد نمایید</small>
                                </div>
                            </div>
                      <!--      <div class="col-md-8">
                                <div class="form-group">
                                    <label for="birthday">تاریخ تولد <span class="text-danger">*</span> </label>
                                    <input type="text" id="birthday" name="birthday" class="form-control">
                                    <small id="emailHelp" class="form-text text-danger">تاریخ تولد را وارد نمایید</small>
                                </div>
                            </div>-->
                           
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="birthday">شماره موبایل <span class="text-danger">*</span> </label>
          
                                    <input type="text" id="phonenumber" name="phonenumber" class="form-control" placeholder="-----------" value="">
     
                                    <small id="emailHelp" class="form-text text-danger">تلفن را به صورت یازده رقمی وارد نمایید.</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div class="row justify-content-center">

                           
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="address">آدرس دقیق<span class="text-danger">*</span> </label>
                                    <textarea type="text" id="address" name="address" class="form-control"
                                              rows="2"></textarea>
                                    <small id="emailHelp" class="form-text text-danger">آدرس خود را دقیق وارد نمایید</small>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-8 text-center">
                        <button class="btn btn-final" >تایید و مشاهده پیش فاکتور
                        </button>
                    </div>
                </div>
                <div class="row justify-content-center p-5 pb-4 content-box ">
                    <div class="col-6">
                        <table class="tabel" cellspacing="0px" cellpadding="0px">
                           <tr>
                               <td width="80%" colspan="2">کد یکتای بیمه نامه: در حال صدور
                               </td>
                               <td >تصویر بیمه</td>
                           </tr>
                            <tr>
                                <td colspan="2">شماره بیمه نامه: صادر نشده </td>
                                <td rowspan="4">
                                    <img id="blogo" src="" style="width:100px;max-width: 100%">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">کد رایانه بیمه نامه : صادر</td>
                            </tr>
                            <tr>
                                <td colspan="2">شماره تماس واحد صدور : 09197424812</td>
                            </tr>
                            <tr>
                                <td colspan="2">تاریخ صدور : {{$today}}</td>
                            </tr>
                            <tr><td colspan="3" >تاریخ اعتبار :
                                    <span id="btitr"></span></td></tr>
                            <tr><td colspan="3" >نام بیمه گذار: مطابق مدرک شناسنامه </td></tr>
                            <tr>
                                <td style="width: 50%">شماره تماس : <span id="btamas"></span></td>
                                <td width="50%" colspan="2" >شناسه ملی :<span id="bcode"></span></td>
                            </tr>
                            <tr><td colspan="3" id="baddr" >آدرس: خراسان رضوي  سبزوار سبزوار چهارراه کوشک جنب ايران </td></tr>
                            <tr>
                                <td >نوع وسیله نقلیه: <span id="bcar"></span> </td>
                                <td colspan="2" >شماره انتظامی : مطابق مدرک  ارسالی</td>
                            </tr>
                            <tr>
                                <td >سیستم و تیپ: <span id="bplan"></span></td>
                                <td colspan="2" >ظرفیت : مطابق مدارک ارسالی</td>
                            </tr>
                            <tr>
                                <td >شماره موتور : مطابق مدارک ارسالی </td>
                                <td colspan="2" >شماره شاسی : مطابق مدارک ارسالی</td>
                            </tr>
                            <tr>
                                <td >مورد استفاده: <span id="busage"></span> </td>
                                <td colspan="2" >شماره VIN     :مطابق مدارک ارسالی</td>
                            </tr>
                            <tr>
                                <td >سال ساخت : <span id="byear"></span>
                                </td>
                                <td colspan="2" >تعداد سیلندر : مطابق مدارک ارسالی                            </tr>
                            <tr>
                                <td >رنگ:  مطابق مدارک ارسالی</td>
                                <td colspan="2" >یدک اضافی : مطابق مدارک ارسالی</td>
                            </tr>
                            <tr><td colspan="3" >حداکثر تعهد بدنی شخص ثالث : 4,400,000,000 ریال</td></tr>
                            <tr><td colspan="3" >حداکثر تعهد مالی شخص ثالث : <span id="bcover"></span>  ریال</td></tr>
                            <tr><td colspan="3" >حداکثر تعهد بدنی حوادث راننده : 3,300,000,000 ریال</td></tr>
                            <tr><td colspan="3" >درصد و سنوات تخفیف بیمه شخص ثالث : <span id="bmyear"></span> سال,<span id="bofftrith"></span></td></tr>
                            <tr><td colspan="3" >درصد تخفیف بیمه حوادث راننده : <span id="boffdriver"></span></td></tr>
                            <tr><td colspan="3" >تعدد خسارت بدنی , مالی و حوادث راننده:<span id="bdamage"></span></td></tr>
                        </table>
                    </div>
                    <div class="col-6">
                        <table class="tabel" cellspacing="0px" cellpadding="0px" width="100%">
                            <tr>
                                <td colspan="2">شرکت بیمه گر قبلی: <span id="binsurance"></span></td>
                            </tr>
                            <tr>
                                <td colspan="2">تاریخ انقضای بیمه نامه قبلی: <span id="b_old_date"></span></td>
                            </tr>
                            <tr>
                                <td>حق بیمه شخص ثالث: <span id="btirth_bime"></span></td>
                                <td>اضافه نرخ: 0 </td>
                            </tr>

                            <tr>
                                <td style="width: 50%">حق بیمه حوادث راننده: <span id="bdriver_bime"></span></td>
                                <td>جریمه دیرکرد: <span id="bdp_bime">0</span> </td>
                            </tr>
                            <tr>
                                <td style="width: 50%">حق بیمه پوشش مازاد: <span id="bcover_bime"></span> </td>
                                <td>با مالیات بر ارزش افزوده: <span id="b_maliyat_bime"></span> </td>
                            </tr>
                            <tr>
                                <td style="width: 50%">تخفیفات: 0</td>
                                <td>جمع : <span id="bprice"></span></td>
                            </tr>
                            <tr>
                                <td colspan="2">جمع به حروف: <span id="bprice_horof"></span></td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <div>نحوه ی پرداخت : <span id="btype"></span></div>


                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" style="text-align: center" id="resend">
                                    <input style="background-color: #218838" type="button" class="btn btn-success btn-finish " value="دریافت کد تایید پرداخت" />
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" style="text-align: center;display: none" id="sending">
                                    <form class="form-horizontal m-t-30 text-right" method="post"
                                    >

                                        <div class="form-group">
                                            <label for="tell">کد </label>
                                            <input type="tel" class="form-control text-center" name="code" id="code"
                                                   placeholder="* * * *"  maxlength="4">

                                                <span style="display: none" class="mt-1 small text-danger"> کد وارد شده صحیح نمی باشد.</span>


                                        </div>

                                        <div class="form-group row m-t-20">
                                            <div class="col-12 text-center">
                                                <div class="d-flex justify-content-between">
                                                <button id="submited"
                                                        class="btn btn-success float-sm-left mt-sm-0 mt-3"
                                                        type="button" style="background-color: #218838">ثبت
                                                </button>
                                                    <div id="rem">زمان باقی مانده : <span>60</span> ثانیه</div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="row justify-content-center mb-5">
                    <div class="col-8 d-flex justify-content-between align-items-center">
                        <button class="btn backstep d-x align-items-center" >
                            <i class="la la-angle-right"></i>
                           مرحله قبل
                       </button>

                        <button class="btn nextstep d-flex align-items-center justify-content-between">
                            مرحله بعد
                            <i class="la la-angle-left"></i>
                        </button>
                    </div>
                    <div class="col-8">
{{--                        <div class="alert alert-danger mt-4">--}}
{{--                            <i class="las la-exclamation-circle"></i>--}}
{{--                           پوشش بیمه نامه از پایان روز رسمی فعال می شود. در صورت خرید بیمه نامه تا ساعت 21 بیمه خودرو از پایان شب فعال خواهد شد.--}}
{{--                        </div>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script src="{{asset('website/js/select2.min.js')}}"></script>
    <script src="{{asset('website/js/num2persian.js')}}"></script>
    <script src="{{asset('website/js/persian-date.min.js')}}"></script>
    <script src="{{asset('website/js/persian-datepicker.min.js')}}"></script>
    <script src="{{asset('adminpanel/js/axios.js')}}"></script>
        <script href="{{asset('website/js/jquery.inputmask.min.js')}}"></script>    
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
    <script>
        $("#startdate").persianDatepicker({
            observer: true,
            format: 'YYYY/MM/DD',
            viewMode: 'years',
            yearPicker: true,
            altField: '.linkedCalendarsto-alt',
            initialValue: true,
            autoClose: true,
            locale: "fa",
            onSelect: function (unix) {
                from.touched = true;
                if (to && to.options && to.options.minDate != unix) {
                    var cachedValue = to.getState().selected.unixDate;
                    to.options = {minDate: unix};
                    if (to.touched) {
                        to.setDate(cachedValue);
                    }
                }
            }
        });
         jQuery.fn.extend({
             getdate: function() {
                 var y=$(this).next().find('.year').val();
                 var m=$(this).next().find('.month').val();
                 var d=$(this).next().find('.day').val();
                 if(m.length==1)
                           m="0"+m;
                 if(d.length==1)
                           d="0"+d;
                 return y+"/"+m+"/"+d;
             },
  shamsidatepicker: function(vk) {
       $(this).after('<div class="d-flex omg input-group"><select class="custom-select form-control year"></select><select class="custom-select form-control month"></select><select class="custom-select form-control day"></select></div>');
      $(this).hide();
    $(this).each( function( index, element ){
             
            var  y={{$year}};
             var m={{$month}};
             
             
             for(var i=y-vk;i<=y;i++)
             {
                 if(i==y)
                 $(this).next().find('.year').append('<option selected>'+i+'</option>');
                 else
                 $(this).next().find('.year').append('<option>'+i+'</option>');
             }
             for(var i=1;i<=12;i++)
             {
                 if(i==m)
                 $(this).next().find('.month').append('<option selected>'+i+'</option>');
                 else
                 $(this).next().find('.month').append('<option>'+i+'</option>');
             }
             $(this).next().find('.month').change(function(){
                 var d={{$day}};
                 $(this).parent().find('.day').html('');
                 x=31;
                 if($(this).val()>6)
                 x=30
                 if($(this).val()==12)
                 x=29
                 for(var i=1;i<=x;i++)
             {
                 if(i==d)
                 $(this).parent().find('.day').append('<option selected>'+i+'</option>');
                 else
                 $(this).parent().find('.day').append('<option>'+i+'</option>');
             }
             });
             $(this).next().find('.month').change();
        });
  }
         });
         $("#endtdate").shamsidatepicker(3);
       //  $("#birthday").shamsidatepicker(80);
         
        $("#endtdatex").persianDatepicker({
            observer: true,
            format: 'YYYY/MM/DD',
            viewMode: 'years',
            yearPicker: true,
            altField: '.linkedCalendarsto-alt',
            initialValue: false,
            autoClose: true,
            locale: "fa",
            onSelect: function (unix) {
                from.touched = true;
                if (to && to.options && to.options.minDate != unix) {
                    var cachedValue = to.getState().selected.unixDate;
                    to.options = {minDate: unix};
                    if (to.touched) {
                        to.setDate(cachedValue);
                    }
                }
            }
        });
        function checkselected(select)
        {
            if(!$(select).val())
            {
                $(select).next().find('.select2-selection').addClass('has-error');
                return false;
            }
            else
            {
                $(select).next().find('.select2-selection').removeClass('has-error');
                return true;
            }
        }
        function isempty(select)
        {
            if($(select).val()=="")
            {
                $(select).addClass('has-error');
                return false;
            }
            else
            {
                $(select).removeClass('has-error');
                return  true;
            }
        }
        let indexpage=0;
        function validate(page){
            if(page==0)
            {
                var res=true;
                res =checkselected("#select2") && res;
                res =checkselected("#select3") && res;
                res =checkselected("#select4") && res;
                return res;
            }
            else if(page==1)
            {
                var res=true;
                res =checkselected("#select6") && res;
                return res;
            }
            else if(page==2)
            {
                var res=true;
                res =checkselected("#time_last_inc") && res;

                return res;
            }
            else if(page==3)
            {
                var res=true;
                res =checkselected("#select7") && res;
                res =checkselected("#select8") && res;

                return res;
            }
           /* else if(page==4)
            {
                var res=true;
                res =checkselected("#select10") && res;
                res =checkselected("#select11") && res;
                return res;
            }*/
            else if(page==4)
            {
                var res=true;
                res =checkselected("#select12") && res;
                res =checkselected("#select13") && res;
                if($('.btntwo.selected').length==0)
                {
                    alert('لطفا یک بیمه را انتخاب نمایید');
                    res=false;
                }
                return res;
            }
            else if(page==6)
            {
                var res=true;
               
               
                if($('#codmeli').val().trim().length!=10)
                {
                    res=false;
                    $('#codmeli').addClass('has-error');
                }
                else
                {
                    $('#codmeli').removeClass('has-error');
                }
                
                
                
                if($('#phonenumber').val().trim().length!=11)
                {
                    res=false;
                    $('#phonenumber').addClass('has-error');
                }
                else
                {
                    $('#phonenumber').removeClass('has-error');
                }

                if($('#address').val().trim()=='')
                {
                    res=false;
                    $('#address').addClass('has-error');
                }
                else
                {
                    $('#address').removeClass('has-error');
                }
                if($('#customFile').val()==""){
                    res=false;
                alert('لطفا عکس روی کارت ماشین یا برگ سبز را اپلود نمایید.')
                }
                
                if($('#customFile3').val()=="" && $('#select6').val()>0){
                    res=false;
                    alert('لطفا عکس بیمه نامه  را اپلود نمایید.')
                }



                return res;
            }
            return true;
        }
        $('.nextstep').click(function () {
            if(validate(indexpage)) {
                $('.backstep').removeClass('d-x').addClass('d-flex');
               

                $(".content-box").eq(indexpage).removeClass('active');
                if(indexpage==1 && $('#select6').val()<1)
                {
                    indexpage=3;
                }
               
                $(".content-box").eq(indexpage + 1).addClass('active');
                indexpage++;
                if(indexpage==5)
                {
                    $('.nextstep').addClass('d-none').removeClass('d-flex');
                }
                if(indexpage==4)
                {
                    $('#select12').change();
                }
            }
        });
        $('.backstep').click(function () {
            $(".content-box").eq(indexpage).removeClass('active');
           
            if(indexpage==4 && $('#select6').val()<1)
            {
                indexpage=2;
            }

            $(".content-box").eq(indexpage - 1).addClass('active');
            indexpage--;
            if(indexpage<5) {

                $('.nextstep').removeClass('d-none').addClass('d-flex');
            }
            if(indexpage==0)
            {
                 $('.backstep').removeClass('d-flex').addClass('d-x');
            }
        });
        let maindata=JSON.parse('{!!$data!!}');
        let data2 = "";
        let i=0;
        $.each(maindata, function (key, v) {
            if(v.name!=undefined) {
                data2 += "<option value='" + v.id + "'>" + v.name + "</option>";
                i++;
            }
        })
        $('#select1').append(data2);
        $("#select1").select2({
            placeholder: "نوع وسیله نقلیه",
        });
        $('#select1').on("change", function(e) {
            let data3 = "<option></option>";
            var data3_1 =maindata[this.value]['plan'];
            $.each(data3_1, function (key, v) {
                if(v.def==1)
                data3 += "<option value='" + v.id + "'selected>" + v.name + "</option>"
                else
                data3 += "<option value='" + v.id + "'>" + v.name + "</option>"
            });
            $('#select2').html(data3);
            let data4 = "<option></option>";
            var data4_1 = maindata[this.value]['usage'];
            $.each(data4_1, function (key, v) {
                if(v.def==1)
                data4 += "<option value='" + v.id + "' selected>" + v.name + "</option>"
                else
                data4 += "<option value='" + v.id + "'>" + v.name + "</option>"
            })
            $('#select3').html(data4);
        });

        $('#select1').change();



        $("#select2").select2({
            placeholder: "گروه تعرفه ای",
        });
        $("#time_last_inc").select2({
            placeholder: "مدت بیمه نامه قبل",
        });

        $("#select3").select2({
            placeholder: "مورد استفاده",
        });
        let data5 = "";
        for(var z=1370;z<={{$year}};z++){
 if(z==1390)
 data5 += "<option selected >" + z + "</option>"
 else
            data5 += "<option >" + z + "</option>"
        }
        $('#select4').append(data5);
        $("#select4").select2({
            placeholder: "سال ساخت",
        });



        $("#select6").select2({
            placeholder: "َشرکت بیمه گر قبلی",
        });


        let data7 = "";
        var data7_1 = [{
            id: 0,
            text: 'صفر',
        },
            {
                id: 5,
                text: '5%',
            },
            {
                id: 10,
                text: '10%',
            },
            {
                id: 15,
                text: '15%',
            },
            {
                id: 20,
                text: '20%',
            },
            {
                id: 25,
                text: '25%',
            },
            {
                id: 30,
                text: '30%',
            },
            {
                id: 35,
                text: '35%',
            },
            {
                id: 40,
                text: '40%',
            },
            {
                id: 45,
                text: '45%',
            },
            {
                id: 50,
                text: '50%',
            },
            {
                id: 55,
                text: '55%',
            },
            {
                id: 60,
                text: '60%',
            },
            {
                id: 65,
                text: '65%',
            },
            {
                id: 70,
                text: '70%',
            }];
        $.each(data7_1, function (key, v) {
            data7 += "<option value='" + v.id + "'>" + v.text + "</option>"
        })
        $('#select7').append(data7);
        $("#select7").select2({

        });

        let data8 = "";
        var data8_1 = [{
            id: 0,
            text: 'صفر',
        },
            {
                id: 5,
                text: '5%',
            },
            {
                id: 10,
                text: '10%',
            },
            {
                id: 15,
                text: '15%',
            },
            {
                id: 20,
                text: '20%',
            },
            {
                id: 25,
                text: '25%',
            },
            {
                id: 30,
                text: '30%',
            },
            {
                id: 35,
                text: '35%',
            },
            {
                id: 40,
                text: '40%',
            },
            {
                id: 45,
                text: '45%',
            },
            {
                id: 50,
                text: '50%',
            },
            {
                id: 55,
                text: '55%',
            },
            {
                id: 60,
                text: '60%',
            },
            {
                id: 65,
                text: '65%',
            },
            {
                id: 70,
                text: '70%',
            }];
        $.each(data8_1, function (key, v) {
            data8 += "<option value='" + v.id + "'>" + v.text + "</option>"
        })
        $('#select8').append(data8);
        $("#select8").select2({

        });
      

        let data10 = "";
        var data10_1 = [{
            id: 0,
            text: 'فاقد خسارت مالی',
        },
            {
                id: 20,
                text: 'یکبار خسارت مالی',
            },
            {
                id: 30,
                text: 'دوبار خسارت مالی',
            },
            {
                id: 40,
                text: 'سه بار خسارت مالی یا بیشتر',
            }];
        $.each(data10_1, function (key, v) {
            data10 += "<option value='" + v.id + "'>" + v.text + "</option>"
        })
        $('#select10').append(data10);
        $("#select10").select2({
            placeholder: "تعداد خسارت مالی",
        });

        let data11 = "";
        var data11_1 = [{
            id: 0,
            text: 'فاقد خسارت جانی',
        },
            {
                id: 30,
                text: 'یکبار خسارت جانی',
            },
            {
                id: 70,
                text: 'دوبار خسارت جانی',
            },
            {
                id: 100,
                text: 'سه بار خسارت جانی یا بیشتر',
            }];
        $.each(data11_1, function (key, v) {
            data11 += "<option value='" + v.id + "'>" + v.text + "</option>"
        })
        $('#select11').append(data11);
        $("#select11").select2({
            placeholder: "تعداد خسارت جانی",
        });

   
        $("#select12").select2({
            placeholder: "مدت اعتبار بیمه نامه جدید",
        });



        $("#select13").select2({
            placeholder: "میزان پوشش مالی",
        });

        $('#select12,#select13').on("change", function(e) {
            var data={};
            data['car']=$('#select1').val();
            data['plan']=$('#select2').val();
            data['usage']=$('#select3').val();
            data['year']=$('#select4').val();
            data['insurance_old']=$('#select6').val();
            if(data['insurance_old']>0)
            {
                data['insurance_old_type']=$('#time_last_inc').val();
                data['insurance_old_enddate']=$('#endtdate').getdate();
                data['insurance_old_third']=$('#select7').val();
                data['insurance_old_driver']=$('#select8').val();


                    data['insurance_old_damage_life']=$('#select11').val();
                    data['insurance_old_damage_driver']=$('#select10').val();
                
            }
            data["cover"]=$('#select13').val();
            data["time_insurence"]=$('#select12').val();
            $('.list_ins').html('<div class="loading"></div>');
           axios.post('/order/getinsurance',data).then(function (response) {

               var d=response.data;//JSON.parse();
               $('.list_ins').html('');
               for(var i=0;i<d.length;i++)
               {
                   var b=d[i];
                   f='<div class="col-md-6 d-flex item ">\n' +
                       '                                <div data-base="'+b['base']+'" data-driver="'+b['driver']+'" data-dp="'+b['dp']+'" data-af="'+b['af']+'" data-cover="'+b['cover']+'"  data-id='+b['id']+' class="card p-3 detailsboxcontent btntwo">\n' +
                       '                                    <div class="row align-items-center">\n' +
                       '                                        <div class="col-6">\n' +
                       '                                            <img src="'+b['img']+'"\n' +
                       '                                                 width="60px" height="60px">\n' +
                       '                                            <span class="name font-weight-bold">\n' +
                       b['name'] +
                       '                            </span>\n' +
                       '                                        </div>\n' +
                       '                                        <div class="col-6 text-left">\n' +
                       '                            <span class="price text-dark font-weight-bold">\n' +
                       b['price']+
                       '                            <i class="pcc">ریال</i></span>\n' +
                       '                                        </div>\n' +
                       '                                        <div class="col-12 text-center mt-2">\n' +
                       '                                        </div>\n' +
                       '                                    </div>\n' +
                           '<div class="ghesti">\n' +
                       '        <div class="more"><span>'+b['more']+'</span></div>\n' +
                       '        <div class="showmore"><i class="la la-angle-down"></i>جزئیات</div>\n' +
                       '    </div>'
                       '                                </div>\n' +
                       '                            </div>'
                   $('.list_ins').append(f);
               }
               $('.showmore').click(function () {
                   $(this).parent().find('.more').slideToggle();
               })
               $('.btntwo').click(function () {
                   $('.btntwo').removeClass('selected');
                   $(this).addClass('selected');
               })
           });
        });
        $('.btn-finish').click(function(){
            $('#resend').html('<div class="loading"></div>');

             var data={};
            var formData = new FormData();
            formData.append('phone',$('#phonenumber').val());
            formData.append('address',$('#address').val());
            formData.append('payment_type',$('.btn-type .btn-primary').attr('data-type'));
            formData.append('car_id',$('#select1').val());
            formData.append('plan_id',$('#select2').val());
            formData.append('usage_id',$('#select3').val());
            formData.append('codemeli',$('#codmeli').val());
            formData.append('birthday','1399-01-01');//$('#birthday').getdate());
            formData.append('insurance_id',$('.btntwo.selected').data('id'));
            formData.append('year',$('#select4').val());
            formData.append('insurance_old_id',$('#select6').val());
            formData.append('insurance_date_expire',$('#select12').val());

            if($('#select6').val()>0)
            {
            formData.append('insurance_old_date',$('#endtdate').getdate());
            formData.append('insurance_old_type',$('#time_last_inc').val());
            formData.append('insurance_old_off_percentage_third',$('#select7').val());
            formData.append('insurance_old_off_percentage_driver',$('#select8').val());
            formData.append('insurance_old_property_damage',$('#select10').val());
            formData.append('insurance_old_life_damage',$('#select11').val());
            }
            else
            {
                //def
                formData.append('insurance_old_date','');
                formData.append('insurance_old_type',0);
                formData.append('insurance_old_off_percentage_third',0);
                formData.append('insurance_old_off_percentage_driver',0);
                formData.append('insurance_old_property_damage',0);
                formData.append('insurance_old_life_damage',0);
                //
            }
            formData.append("cover",$('#select13').val());

            formData.append("image_front_card", $('#customFile')[0].files[0]);
            formData.append("image_back_card", $('#customFile2')[0].files[0]);
            formData.append("image_personal_card", $('#customFile3')[0].files[0]);
            formData.append("image_insurance_card", $('#customFile4')[0].files[0]);
             axios.post('/order/save',formData,{
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }).then(function (response) {
                if($('.btn-type .btn-primary').attr('data-type')==1)
                {
                    window.location.href='/order/recall';
                    return;
                }
                 $('#resend').remove();
                $('#sending').show();
                tim=setInterval(function () {
                    var t=$('#rem span').html();
                    t=parseInt(t);
                    if(t>0)
                    {
                        t=t-1;
                        $('#rem span').html(t)
                    }
                    else
                    {
                        clearInterval(tim);
                        $('#rem').html('<div class="resendsms">ارسال مجدد پیامک</div>');
                        $('.resendsms').click(function () {
                           axios.post('/order/resms',{}).then(function () {
                               $('#rem').html('<div class="resendsmsok">پیامک مجدد ارسال شد.</div>');
                           })
                        });
                    }
                },1000);
                 //window.location.href='/order/validate';
             });
        })

var tim;
        $(".custom-file-input").on("change", function () {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
        $("#birthday").persianDatepicker({
            observer: true,
            format: 'YYYY/MM/DD',
            viewMode: 'years',
            yearPicker: true,
            altField: '.linkedCalendarsto-alt',
            initialValue: true,
            autoClose: true,
            locale: "fa",
            onSelect: function (unix) {
                from.touched = true;
                if (to && to.options && to.options.minDate != unix) {
                    var cachedValue = to.getState().selected.unixDate;
                    to.options = {minDate: unix};
                    if (to.touched) {
                        to.setDate(cachedValue);
                    }
                }
            }
        });
        $('.btn-final').click(function(){
            if(validate(6))
            {
                $('#bcode').html($('#codmeli').val());
                var a=$('.btntwo.selected img').attr('src');
                $('#blogo').attr('src',a);
                $('#btamas').html($('#phonenumber').val());
                $('#baddr').html($('#address').val());

                $('#b_maliyat_bime').html($('.btntwo.selected').attr('data-af'));
                $('#bcover_bime').html($('.btntwo.selected').attr('data-cover'));
                $('#bdp_bime').html($('.btntwo.selected').attr('data-dp') + ' روز');
                $('#btirth_bime').html($('.btntwo.selected').attr('data-base') );
                $('#bdriver_bime').html($('.btntwo.selected').attr('data-driver'));

                $('#bname').html($('.btntwo.selected .name').html());
                $('#btype').html('نقدی');
                $('.btn-finish').val('اردریافت کد تایید پرداخت');
                if($('.btn-type .btn-primary').attr('data-type')==1){
                $('#btype').html('اقساط');
                $('.btn-finish').val('ارسال به کارشناس');
                }
                $('#bprice').html($('.btntwo.selected .price').html());
                $('#bprice_horof').html(Num2persian($('.btntwo.selected .price').text().replace(/,/,"")));
                $('#binsurance').html($('#select6').select2('data')[0]['text']);
                $('#boldtime').html($('#endtdate').getdate());
                $('#btime').html($('#select12').select2('data')[0]['text']);
                $('#bcover').html($('#select13').val()+"0,000,000");
                $('#byear').html($('#select4').val());
                var dy="365";
                if($('#select12').val()=="2")
                    dy=180;
                if($('#select12').val()=="3")
                    dy=90;
                if($('#select12').val()=="4")
                    dy=30;
                var d1="{{$today}}";
                var d2="";

                var titr="از ساعت 24 مورخ "+d1+" تا ساعت 24 مورخ "+d2+" به مدت "+dy+" روز";
                $('#btitr').html(titr);
$('#bcar').html($('#select1').select2('data')[0]['text']);
$('#bplan').html($('#select2').select2('data')[0]['text']);
$('#busage').html($('#select3').select2('data')[0]['text']);
if($('#select6').val()>0){
                $('#b_old_date').html($('#endtdate').getdate());
                $('#bofftrith').html($('#select7').select2('data')[0]['text']);
                $('#boffdriver').html($('#select8').select2('data')[0]['text']);
                
                
                    //$('#b-accident').html($('#select10').select2('data')[0]['text']);
                    if($('#select10').val()==0 && $('#select11').val()==0 && $('#select12').val()==1)
                    {
                         $('#bofftrith').html((parseInt($('#select7').val())+5)+"%");
                         $('#boffdriver').html((parseInt($('#select8').val())+5)+"%");
                    }
                    $('#bdamage').html($('#select10').select2('data')[0]['text']+" و "+$('#select11').select2('data')[0]['text']);
}
else
{
    $('#b_old_date').html('ندارد');
     $('#bofftrith').html('0%');
      $('#boffdriver').html('0%');
       $('#bdamage').html('فاقد خسارت مالی و جانی');

}


                $(".content-box").eq(indexpage).removeClass('active');
                $(".content-box").eq(indexpage + 1).addClass('active')
                indexpage++;
               // $('#myModal').modal('show');
            }
        })
        $('#phonenumber').keydown(function(e){
             x=$(this).val();
           x=x.replace(/-/g,'');
            
            var key = e.charCode || e.keyCode || 0;
            if(x.length>=11 && (key!=8 && key!=46))
             e.preventDefault();
            // allow backspace, tab, delete, enter, arrows, numbers and keypad numbers ONLY
            // home, end, period, and numpad decimal
            if (!(
                key == 8 || 
                key == 9 ||
                key == 13 ||
                key == 46 ||
                key == 110 ||
                key == 190 ||
                (key >= 35 && key <= 40) ||
                (key >= 48 && key <= 57) ||
                (key >= 96 && key <= 105)))
                 e.preventDefault();
        
        
        });
        $('#submited').click(function () {
           axios.post('/order/validate',{code:$('#code').val()}).then(function(response){
               var d=response.data;
               if(d=="error")
                   $('.mt-1.small.text-danger').show();
                   else
                    window.location.href=d;
           }) ;
        });
        $('.btn-type .btn').click(function () {
            $('.btn-type .btn').removeClass('btn-primary');
            $(this).addClass('btn-primary');
            if($(this).attr('data-type')==1)
            {
                $('.ghesti').show();
            }
            else
            {
                $('.ghesti').hide();
            }
        })
     /* $('#phonenumber').keyup(function(){
          
           x=$(this).val();
           x=x.replace(/-/g,'');
           if(x.length<9)
           {
               a=x.length;
               for(var i=0;i<9-a;i++)
               {
                   x=x+"-";
               }
               
              
               
           }
            $(this).val(x);
            $(this)[0].setSelectionRange(a, a);
      })*/
    </script>
@endsection



