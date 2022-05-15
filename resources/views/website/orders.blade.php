<?php
use Morilog\Jalali\Jalalian;
use Carbon\Carbon;
?>
@extends('website.layout.app')

@section('title','بیمه های من')

@section('style')

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
                   بیمه های من
                </span>
                </div>
                <div class="detailsboxcontent p-2">
                    <div class="table-responsive">
                        <table class="table text-center">
                            <thead class="thead-light">
                            <tr>
                                <th>ردیف</th>
                                <th>شرکت بیمه</th>
                                <th>تاریخ ثبت بیمه</th>
                                <th>مبلغ بیمه</th>
                                <th>وضعیت</th>
                                <th> جزئیات بیشتر</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $order)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$order->insurance->name}}</td>
                                <td>{{
                                 Jalalian::fromCarbon(Carbon::parse($order->created_at))->format('Y-m-d')
                                }}</td>
                                <td>{{number_format($order->price,0)}} تومان</td>
                                <td> {!! $order->statusspan() !!}</td>
                                <td>
                                    <button class="btn btn-outline-primary btn-more"
                                            data-id="@if($order->order_num==0) صادر نشده  @else {{$order->order_num}} @endif"
                                            data-name="{{$order->insurance->name}}"
                                            data-cover="{{$order->cover}} میلیون تومان"
                                            data-time="{{$order->date()}}"
                                            data-price="{{number_format($order->price,0)}} تومان"
                                            data-year="{{$order->year}}"
                                            data-car="{{$order->car->name}}"
                                            data-plan="{{$order->plan->name}}"
                                            data-offtirth="{{$order->insurance_old_off_percentage_third}} درصد"
                                            data-offdriver="{{$order->insurance_old_off_percentage_driver}} درصد"
                                            data-finishtime="{{$order->insurance_old_date}}"



                                    >بیشتر</button>
                                </td>
                            </tr>
                          @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="modal fade" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">سفارش </h4>
                    <button type="button" class="close mr-auto ml-1 text-white" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="text-center bg-light p-2">
                        مشخصات بیمه
                    </div>
                    <div class="d-flex justify-content-between align-items-center modaldetails">
                        <span>شماره بیمه</span>
                        <span class="bid">صادر نشده</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center modaldetails">
                        <span>شرکت بیمه</span>
                        <span class="bname">بیمه دانا</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center modaldetails">
                        <span>حق بیمه</span>
                        <span class="bprice"> 3,579,551 تومان</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center modaldetails">
                        <span>سطح پوشش</span>
                        <span class="bcover"> 220,000,000 تومان</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center modaldetails">
                        <span>مدت بیمه</span>
                        <span class="btime">یک ساله</span>
                    </div>
                    <div class="text-center bg-light p-2">
                        مشخصات اتومبیل
                    </div>
                    <div class="d-flex justify-content-between align-items-center modaldetails">
                        <span>نوع وسیله نقلیه</span>
                        <span class="bcar"> تاکسی درون شهری</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center modaldetails">
                        <span>مدل خودرو</span>
                        <span class="bplan">  پژو 206تیپ2</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center modaldetails">
                        <span>سال ساخت</span>
                        <span class="byear"> 1394</span>
                    </div>

                    <div class="d-flex justify-content-between align-items-center modaldetails">
                        <span>تاریخ اتمام بیمه‌نامه قبلی</span>
                        <span class="bfinishtime">  1399/06/05</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center modaldetails">
                        <span>درصد تخفیف بیمه‌نامه قبلی</span>
                        <span class="bofftirth">  15 درصد</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center modaldetails">
                        <span>درصد تخفیف حوادث راننده</span>
                        <span class="boffdriver"> 15 درصد</span>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">بستن</button>
                </div>

            </div>
        </div>
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
        $('.btn-more').click(function () {
            $('.bid').html($(this).data('id'));
            $('.bname').html($(this).data('name'));
            $('.bcover').html($(this).data('cover'));
            $('.bprice').html($(this).data('price'));
            $('.btime').html($(this).data('time'));
            $('.bcar').html($(this).data('car'));
            $('.plan').html($(this).data('plan'));
            $('.byear').html($(this).data('year'));
            $('.bfinishtime').html($(this).data('finishtime'));
            $('.bofftirth').html($(this).data('offtirth'));
            $('.boffdriver').html($(this).data('offdriver'));


            $('#myModal').modal('show');
        })
    </script>
@endsection



