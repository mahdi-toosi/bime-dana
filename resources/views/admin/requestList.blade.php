<?php
use Morilog\Jalali\Jalalian;
use Carbon\Carbon;
?>
@extends('admin.layout.app')

@section('title','  جزئیات درخواست ها')

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
                    <div class="container-fluid requestlist">
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#menu1">پرداخت شده<i class="badge badge-success">{{count($list)}}</i></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#menu2">ناموفق<i class="badge badge-danger">{{count($nolist)}}</i></a>
                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane container active p-0" id="menu1">

                                <ul class="list-group mb-3">
                                    <li class="list-group-item list-group-item-site">
                                        <span class="w-25 text-center">ردیف</span>
                                        <span class=" w-50 text-center">شماره همراه</span>
                                        <span class=" w-50 text-center">آدرس</span>
                                        <span class="w-50 text-center"> تاریخ ثبت</span>
                                        <span class="w-50 text-center"> شرکت بیمه</span>
                                        <span class="w-25 text-center"> جزئیات</span>

                                    </li>
                                   @foreach($list as $o)
                                                <li class="list-group-item list-group-item-action border-left-0 border-right-0">
                                        <span class="w-25 text-center">{{$loop->iteration}}</span>
                                        <span
                                            class="text-dark font-weight-bold  w-50 text-center">{{$o->phone}}</span>
                                        <span class="text-danger font-weight-bold  w-50 text-center">{{$o->address}}</span>
                                        <span class="text-danger font-weight-bold  w-50 text-center">{{
                                         Jalalian::fromCarbon(Carbon::parse($o->created_at))->format('Y-m-d')
                                        }}</span>
                                        <span class="text-danger font-weight-bold  w-50 text-center"></span>
                                        <span class="text-danger font-weight-bold w-25 text-center">
                                        <a href="/admin/order/request/{{$o->id}}" target="_blank" class="btn btn-success ml-0">مشاهده</a>
                                    </span>

                                    </li>
                                       @endforeach
                                </ul>
                            </div>
                            <div class="tab-pane container fade p-0" id="menu2">


                                <ul class="list-group mb-3">
                                    <li class="list-group-item list-group-item-site">
                                        <span class="w-25 text-center">ردیف</span>
                                        <span class=" w-50 text-center">شماره همراه</span>
                                        <span class=" w-50 text-center">آدرس</span>
                                        <span class="w-50 text-center"> تاریخ ثبت</span>
                                        <span class="w-50 text-center"> شرکت بیمه</span>
                                        <span class="w-25 text-center"> جزئیات</span>

                                    </li>
                                    @foreach($nolist as $o)
                                        <li class="list-group-item list-group-item-action border-left-0 border-right-0">
                                            <span class="w-25 text-center">{{$loop->iteration}}</span>
                                            <span
                                                    class="@if($o->state==0) text-dark @else text-success @endif font-weight-bold  w-50 text-center">{{$o->phone}}</span>
                                            <span class="text-danger font-weight-bold  w-50 text-center">{{$o->address}}</span>
                                            <span class="text-danger font-weight-bold  w-50 text-center">{{
                                        Jalalian::fromCarbon(Carbon::parse($o->created_at))->format('Y-m-d')
                                        }}</span>
                                            <span class="text-danger font-weight-bold  w-50 text-center"></span>
                                            <span class="text-danger font-weight-bold w-25 text-center">
                                        <a href="/admin/order/request/{{$o->id}}" target="_blank" class="btn btn-success ml-0">مشاهده</a>
                                    </span>

                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

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
            format: 'YYYY/MM/DD',
            viewMode: 'years',
            yearPicker: false,
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
        $("#enddate").persianDatepicker({
            observer: true,
            format: 'YYYY/MM/DD',
            viewMode: 'years',
            yearPicker: false,
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

        $("#startdate2").persianDatepicker({
            observer: true,
            format: 'YYYY/MM/DD',
            viewMode: 'years',
            yearPicker: false,
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
        $("#enddate2").persianDatepicker({
            observer: true,
            format: 'YYYY/MM/DD',
            viewMode: 'years',
            yearPicker: false,
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
    </script>


@endsection



