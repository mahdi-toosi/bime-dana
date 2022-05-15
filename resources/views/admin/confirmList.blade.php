<?php
use Morilog\Jalali\Jalalian;
use Carbon\Carbon;
?>
@extends('admin.layout.app')

@section('title',' تایید شدگان')

@section('style')

@endsection

@section('content')
    <div class="container-fluid">

        <!------------giftlist-------------->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="boxtitle">
                        <i class="la la-file-alt"></i>لیست درخواست ها
                    </div>
                    <div class="container-fluid">

                        <div class="row w-100 mr-auto ml-auto">
                            <div class="col-12">
                                <div class="boxtitle">
                                    <i class="la la-search"></i>جست و جو
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="form-group">
                                    <label for="name">کدملی</label>
                                    <input class="form-control" id="code" name="code" value="@if($cid!="0") {{$cid}} @endif">
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="form-group">
                                    <label for="phone">شماره تماس</label>
                                    <input class="form-control" type="tel" id="phone" name="phone" value="@if($pid!="0") {{$pid}} @endif">
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="form-group">
                                    <label for="startdate">از تاریخ</label>
                                    <input class="form-control" id="startdate" name="startdate" value="@if($dt1!="0") {{$dt1}} @endif">
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="form-group">
                                    <label for="enddate">تا تاریخ</label>
                                    <input class="form-control" id="enddate" name="enddate" value="@if($dt2!="0") {{$dt2}} @endif">
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <button class="search btn btn-success d-flex align-items-center mr-auto">
                                    <i class="la la-search"></i>
                                    جست و جو
                                </button>
                            </div>
                        </div>
                        <ul class="list-group mb-3">
                            <li class="list-group-item list-group-item-site">
                                <span class="w-25 text-center">ردیف</span>
                                <span class=" w-50 text-center">شماره همراه</span>
                                <span class=" w-50 text-center">کد ملی</span>
                                <span class="w-50 text-center"> تاریخ ثبت</span>
                                <span class="w-50 text-center"> شرکت بیمه</span>
                                <span class="w-25 text-center"> شماره بیمه</span>
                                <span class="w-25 text-center"> جزئیات</span>

                            </li>
                            @foreach($list as $o)
                            <li class="list-group-item list-group-item-action border-left-0 border-right-0">
                                <span class="w-25 text-center">{{$loop->iteration}}</span>
                                <span class="text-danger font-weight-bold  w-50 text-center">{{$o->phone}}</span>
                                <span class="text-dark font-weight-bold  w-50 text-center">{{$o->codemeli}}</span>
                                <span class="text-danger font-weight-bold  w-50 text-center">{{
                                Jalalian::fromCarbon(Carbon::parse($o->created_at))->format('Y-m-d')
                                }}</span>
                                <span class="text-danger font-weight-bold  w-50 text-center">{{$o->insurance->name}}</span>
                                <span class="text-danger font-weight-bold w-25 text-center">
                                        {{$o->order_num}}
                                    </span>
                                <span class="text-danger font-weight-bold w-25 text-center">
                                        <a href="/admin/order/request/{{$o->id}}" target="_blank" class="btn btn-success ml-0">مشاهده</a>
                                    </span>

                            </li>
                                @endforeach

                        </ul>
                        {!! $list->links("paging") !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')

    <script>
        $("#startdate").persianDatepicker({
            observer: true,
            format: 'YYYY-MM-DD',
            viewMode: 'years',
            yearPicker: false,
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
        $("#enddate").persianDatepicker({
            observer: true,
            format: 'YYYY-MM-DD',
            viewMode: 'years',
            yearPicker: false,
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
        function toen(dt)
        {
            dt=dt.trim();
            dt=dt.replace(/۰/g,0);
            dt=dt.replace(/۱/g,1);
            dt=dt.replace(/۲/g,2);
            dt=dt.replace(/۳/g,3);
            dt=dt.replace(/۴/g,4);
            dt=dt.replace(/۵/g,5);
            dt=dt.replace(/۶/g,6);
            dt=dt.replace(/۷/g,7);
            dt=dt.replace(/۸/g,8);
            dt=dt.replace(/۹/g,9);
            return dt;
        }
        $('.search').click(function () {
            var c=0;
            var st=0;
            var et=0;
            var p=0;
            if($('#code').val()!="")
                c=$('#code').val();
            if($('#phone').val()!="")
                p=$('#phone').val();
           if($('#startdate').val()!="")
           {
               st=toen($('#startdate').val());
           }
            if($('#enddate').val()!="")
            {
                et=toen($('#enddate').val());
            }
            window.location.href="/admin/order/archive/"+c+"."+p+"."+(st)+"."+(et);
        })
    </script>
@endsection



