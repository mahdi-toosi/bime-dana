<?php
use Morilog\Jalali\Jalalian;
use Carbon\Carbon;
?>
@extends('admin.layout.app')

@section('title','  جزئیات مشتری')

@section('style')

@endsection

@section('content')
    <div class="container-fluid">

        <!------------giftlist-------------->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="boxtitle">
                        <i class="la la-file-alt"></i> مشاهده درخواست
                    </div>
                    <div class="container">
                        <div class="row mt-4">
                            @if($order->state<3)
                            <div class="col-12">
                                <div class="p-3">
                                    <div class="alert alert-secondary">
                                        <input type="button" class="btn btn-danger" id="trush" value="حذف درخواست">
                                        <input type="button"  class="btn btn-success" id="ok" value="تایید درخواست">
                                    </div>
                                </div>
                            </div>
                            @endif
                            <div class="col-md-4">
                                <div class="detailstitle text-muted">
                                    مشخصات کاربر
                                </div>
                                <ul class="mt-5 mb-5 personaldetails">
                                    <li class="row mb-2">
                                            <span class="col-6">
                                                تاریخ ثبت
                                            </span>
                                        <span class="col-6">
                                                @if($order->order_num==0)
                                                    <span class="text-dark">ثبت نشده</span>
                                                    @else
                                            <span class="text-success">{{$order->order_num}}</span>
                                                    @endif
                                            </span>
                                    </li>
                                    <li class="row mb-2">
                                            <span class="col-6">
                                                نوع پرداخت
                                            </span>
                                        <span class="col-6">
                                                 @if($order->payment_type==0)
                                                    <span class="text-success">نقد</span>
                                                    @else
                                            <span class="text-danger">اقساط</span>
                                                    @endif
                                            </span>
                                    </li>
                                    <li class="row mb-2">
                                            <span class="col-6">
                                                تاریخ ثبت
                                            </span>
                                        <span class="col-6">
                                                {{Jalalian::fromCarbon(Carbon::parse($order->created_at))->format('Y-m-d')}}
                                            </span>
                                    </li>
                                    <li class="row mb-2">
                                            <span class="col-6">
                                                وضعیت
                                            </span>
                                        <span class="col-6">
                                                {!! $order->statusspan() !!}
                                            </span>
                                    </li>
                                    <li class="row mb-2">
                                            <span class="col-6">
                                                کدملی
                                            </span>
                                        <span class="col-6">
                                                {{$order->codemeli}}
                                            </span>
                                    </li>
                                    <li class="row mb-2">
                             <span class="col-6">
                                     تاریخ تولد
                                            </span>
                                        <span class="col-6">
                                            {{$order->birthday}}
                                            </span>
                                    </li>

                                    <li class="row mb-2">
                                             <span class="col-6">
                                     شماره تماس
                                            </span>
                                        <span class="col-6">
                                           {{$order->phone}}
                                            </span>
                                    </li>
                                    <li class="row mb-2">
                                                <span class="col-12">
                                     آدرس
                                            </span>
                                        <span class="col-12">
                                                {{$order->address}}
                                            </span>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-8">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#home">تصاویر مدارک</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#menu1">بیمه نامه جدید</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#menu2">مشخصات اتومبیل</a>
                                    </li>
                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div class="tab-pane container active" id="home">
                                        <div class="row">
                                            <div class="col-md-3">

                                                <div class="picbox" data-toggle="modal" data-target="#myModal">
                                                    <img src="{{$order->image_front_card}}"/>
                                                </div>
                                                <p class="f-12 text-muted">
                                                    عکس روی کارت ماشین یا برگ سبز
                                                </p>
                                            </div>
                                            @if($order->image_back_card!="")
                                            <div class="col-md-3">

                                                <div class="picbox" data-toggle="modal" data-target="#myModal">
                                                    <img src="{{$order->image_back_card}}"/>
                                                </div>
                                                <p class="f-12 text-muted">
                                                    عکس پشت کارت ماشین یا برگ سبز
                                                </p>
                                            </div>
                                            @endif
                                            <div class="col-md-3">

                                                <div class="picbox" data-toggle="modal" data-target="#myModal">
                                                    <img src="{{$order->image_personal_card}}"/>
                                                </div>
                                                <p class="f-12 text-muted">
                                                    کارت ملی بیمه گذار
                                                </p>
                                            </div>
                                            @if($order->image_insurance_card!="")
                                            <div class="col-md-3">

                                                <div class="picbox" data-toggle="modal" data-target="#myModal">
                                                    <img src="{{$order->image_insurance_card}}"/>
                                                </div>
                                                <p class="f-12 text-muted">
                                                    عکس بیمه نامه
                                                </p>
                                            </div>
                                                @endif
                                        </div>
                                    </div>
                                    <div class="tab-pane container fade" id="menu1">
                                        <ul class="mt-5 mb-5 personaldetails">
                                            <li class="row mb-2 bg-light align-items-center rounded">
                                            <span class="col-6 mb-0 mt-2 mb-2">
                                                شرکت بیمه
                                            </span>
                                                <span class="col-6 mb-0 mt-2 mb-2">
                                               {{$order->insurance->name}}
                                            </span>
                                            </li>
                                            <li class="row mb-2 bg-light align-items-center rounded">
                                            <span class="col-6 mb-0 mt-2 mb-2">
                                                حق بیمه
                                            </span>
                                                <span class="col-6 mb-0 mt-2 mb-2">
                                               {{number_format($order->price,0)}} تومان
                                            </span>
                                            </li>
                                            <li class="row mb-2 bg-light align-items-center rounded">
                                            <span class="col-6 mb-0 mt-2 mb-2">
                                                سطح پوشش
                                            </span>
                                                <span class="col-6 mb-0 mt-2 mb-2">
                                               {{$order->cover}},000,000 تومان
                                            </span>
                                            </li>
                                            <li class="row mb-2 bg-light align-items-center rounded">
                                            <span class="col-6 mb-0 mt-2 mb-2">
                                                مدت بیمه
                                            </span>
                                                <span class="col-6 mb-0 mt-2 mb-2">
                                               {{$order->date()}}
                                            </span>
                                            </li>

                                        </ul>
                                    </div>
                                    <div class="tab-pane container fade" id="menu2">
                                        <ul class="mt-5 mb-5 personaldetails">
                                            <li class="row mb-2 bg-light align-items-center rounded">
                                            <span class="col-6 mb-0 mt-2 mb-2">
                                               نوع وسیله نقلیه
                                            </span>
                                                <span class="col-6 mb-0 mt-2 mb-2">
                                               {{$order->car->name}}
                                            </span>
                                            </li>
                                            <li class="row mb-2 bg-light align-items-center rounded">
                                            <span class="col-6 mb-0 mt-2 mb-2">
                                                مدل خودرو
                                            </span>
                                                <span class="col-6 mb-0 mt-2 mb-2">
                                                {{$order->plan->name}}
                                            </span>
                                            </li>
                                            <li class="row mb-2 bg-light align-items-center rounded">
                                            <span class="col-6 mb-0 mt-2 mb-2">
                                                کاربری
                                            </span>
                                                <span class="col-6 mb-0 mt-2 mb-2">
                                                {{$order->usage->name}}
                                            </span>
                                            </li>
                                            <li class="row mb-2 bg-light align-items-center rounded">
                                            <span class="col-6 mb-0 mt-2 mb-2">
                                                سال ساخت
                                            </span>
                                                <span class="col-6 mb-0 mt-2 mb-2">
                                                         {{$order->year}}
                                            </span>
                                            </li>

                                            <li class="row mb-2 bg-light align-items-center rounded">
                                            <span class="col-6 mb-0 mt-2 mb-2">
                                                تاریخ اتمام بیمه نامه
                                            </span>
                                                <span class="col-6 mb-0 mt-2 mb-2">
                                               {{$order->insurance_old_date}}
                                            </span>
                                            </li>
                                            <li class="row mb-2 bg-light align-items-center rounded">
                                            <span class="col-6 mb-0 mt-2 mb-2">
                                                درصد تخفیف بیمه نامه قبل
                                            </span>
                                                <span class="col-6 mb-0 mt-2 mb-2">
                                               {{$order->insurance_old_off_percentage_third}}%
                                            </span>
                                            </li>
                                            <li class="row mb-2 bg-light align-items-center rounded">
                                            <span class="col-6 mb-0 mt-2 mb-2">
                                              درصد تخفیف حوادث راننده
                                            </span>
                                                <span class="col-6 mb-0 mt-2 mb-2">
                                                {{$order->insurance_old_off_percentage_driver}}%
                                            </span>
                                            </li>
                                            <li class="row mb-2 bg-light align-items-center rounded">
                                            <span class="col-6 mb-0 mt-2 mb-2">
                                             خسارات جانی
                                            </span>
                                                <span class="col-6 mb-0 mt-2 mb-2">
                                              {{$order->insurance_old_life_damage}}%
                                            </span>
                                            </li>
                                            <li class="row mb-2 bg-light align-items-center rounded">
                                            <span class="col-6 mb-0 mt-2 mb-2">
                                            خسارات مالی
                                            </span>
                                                <span class="col-6 mb-0 mt-2 mb-2">
                                              {{$order->insurance_old_property_damage}}%
                                            </span>
                                            </li>

                                            <li class="row mb-2 bg-light align-items-center rounded">
                                            <span class="col-6 mb-0 mt-2 mb-2">
                                            شرکت بیمه نامه قبل
                                            </span>
                                                <span class="col-6 mb-0 mt-2 mb-2">
                                              @if($order->insurance_old_id==-1)
                                                  بدون سابقه
                                                  @elseif($order->insurance_old_id==0)
                                                    صفر کیلومتر
                                                  @else
                                                  {{$order->insuranceold->name}}
                                                    @endif
                                            </span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content modal-pic">

                <!-- Modal Header -->
                <div class="modal-header">


                    <h4 class="modal-title float-right">تصویر
                        <span class="picname"></span>
                    </h4>
                    <button type="button" class="close mr-auto ml-1" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <img src="" height="100%" width="100%"/>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer justify-content-start">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">بستن</button>
                </div>

            </div>
        </div>
    </div>
    <div class="modal fade" id="myModal2">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title float-right">ثبت شماره بیمه</h4>
                    <button type="button" class="close mr-auto ml-1" data-dismiss="modal">&times;</button>

                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="form-group">
                        <label for="bime" class="text-primary">شماره بیمه ثبت شده</label>
                        <input class="form-control" name="bime" id="bime">
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer justify-content-start">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">بستن</button>
                    <button type="button" id="confirm" class="btn btn-success">ثبت</button>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $('.picbox').click(function () {
            var src = $(this).find('img').attr('src');
            var title = $(this).parent().find('p').html();
            $('.modal-pic .modal-header .picname').html("");
            $('.modal-pic .modal-header .picname').html(title);
            $('.modal-pic .modal-body img ').attr("src", " ");
            $('.modal-pic .modal-body img ').attr("src", src);
        });
        $('#trush').click(function () {
            Swal.fire({
                title: 'آیا این درخواست به زباله دان برود?',
                text: "از این کار مطمئن هستید!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'بله حذف شود!',
                cancelButtonText: 'خیر'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.post('/admin/order/delete',{id:{{$order->id}}}).then(function () {
                        Swal.fire(
                            'حذف شد!',
                            'درخواست با موفقیت حذف شد.',
                            'success'
                        );
                        window.location.href='/admin/order/request/{{$order->id}}';
                    })


                }
            })
        })
        $('#ok').click(function () {
            $('#myModal2').modal('show');
        }
        );
        $('#confirm').click(function () {
            Swal.fire({
                title: 'آیا این درخواست تایید شود?',
                text: "از این کار مطمئن هستید!",
                icon: 'success',
                showCancelButton: true,
                confirmButtonColor: '#3fd64b',
                cancelButtonColor: '#d33',
                confirmButtonText: 'بله تایید شود!',
                cancelButtonText: 'خیر'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.post('/admin/order/confirm',{bime:$('#bime').val(),id:{{$order->id}}}).then(function () {
                        Swal.fire(
                            'تایید شد!',
                            'درخواست با موفقیت تایید شد.',
                            'success'
                        );
                        window.location.href='/admin/order/request/{{$order->id}}';
                    })


                }
            })
        })
    </script>


@endsection



