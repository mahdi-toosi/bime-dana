<?php
use Morilog\Jalali\Jalalian;
?>
<section class="header">
    <div class="header-top">
        <div class="container-fluid">
            <div class="header-top-in">
                <div class="header-top-right">
                    <div class="user-name">
                        <b class="text-site">{{auth()->user()->name}}</b>
                        <span class="hide-sm">
                                        خوش آمدید
                            </span>

                    </div>
                    <div class="header-date">
                        <span>{{Jalalian::now()->format('%A')}}</span>
                        <span>{{Jalalian::now()->format('d-m-Y')}}</span>
                    </div>
                </div>

                <div class="header-top-left">
                    <a href="#"> <i class="la la-user"></i></a>
                    <a href="/logout" class="ml-1"> خروج</a>
                </div>
            </div>
        </div>
    </div>
    <div class="header-bottom">
        <div class="container-fluid">
            <div class="header-bottom-in">
                <div class="header-bottom-left">
                    <img class="header-icon" src="{{asset('adminpanel/img/wrench.png')}}">
                </div>
            </div>
        </div>
    </div>

</section>
