<section class="sidebar rtl">
    <div class="sidebar-box">
        <div class="sidebar-top border-bottom pb-4">
            <img src="{{asset('adminpanel/img/bimelogo.png')}}" width="40" height="40">
            <img class="logo" src="{{asset('adminpanel/img/logo.png')}}">
        </div>
        <div class="sidebar-bottom">
            <div class="slimScrollDiv">
                <ul class="sidebar-items">
                    <li class="sidebar-item">
                        <a href="/admin" class="sidebar-link selected"><i class="la la-dashboard"></i> داشبورد </a>
                    </li>

                    <li class="sidebar-item sidebar-item-have">
                        <a href="#" class="sidebar-link"><i class="la la-file-alt"></i>بیمه ها
                            <i class="la la-angle-down"></i>
                        </a>
                        <ul class="sidebar-items-in">
                            <li class="sidebar-item-in">
                                <a href="/admin/insurance/" class="sidebar-link"><i class="la la-list"></i> لیست بیمه ها
                                </a>
                            </li>
                            <li class="sidebar-item-in">
                                <a href="/admin/insurance/create" class="sidebar-link"><i class="la la-plus"></i> افزودن
                                    بیمه </a>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-item sidebar-item-have">
                        <a href="#" class="sidebar-link"><i class="la la-cogs"></i> تنظیمات عمومی
                            <i class="la la-angle-down"></i>
                        </a>
                        <ul class="sidebar-items-in">
                            <li class="sidebar-item-in">
                                <a href="/admin/car/" class="sidebar-link"><i class="la la-list"></i> دسته ها </a>
                            </li>
                            <li class="sidebar-item-in">
                                <a href="/admin/plan/" class="sidebar-link"><i class="la la-list"></i> گروه تعرفه ای
                                </a>
                            </li>
                            <li class="sidebar-item-in">
                                <a href="/admin/usage/" class="sidebar-link"><i class="la la-list"></i> نوع کاربری </a>
                            </li>

                            <li class="sidebar-item-in">
                                <a href="{{ route('admin.car-types.create') }}" class="sidebar-link"><i class="la la-list"></i> نوع خودرو </a>
                            </li>

                            <li class="sidebar-item-in">
                                <a href="{{ route('admin.car-models.create') }}" class="sidebar-link"><i class="la la-list"></i> مدل خودرو </a>
                            </li>

                        </ul>
                    </li>
                    <li class="sidebar-item sidebar-item-have">
                        <a href="#" class="sidebar-link"><i class="la la-question"></i>درخواست ها
                            <i class="la la-angle-down"></i>
                        </a>
                        <ul class="sidebar-items-in">
                            <li class="sidebar-item-in">
                                <a href="/admin/order/new" class="sidebar-link"><i class="la la-hourglass-1"></i> بررسی
                                    نشده </a>
                            </li>
                            <li class="sidebar-item-in">
                                <a href="/admin/order/archive" class="sidebar-link"><i class="la la-check"></i> آرشیو
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-item">
                        <a href="/admin/profile/" class="sidebar-link"><i class="la la-user"></i> پروفایل </a>
                    </li>
                </ul>

                <div class="close-sidebar">
                    <i class="la la-close"></i>
                    <span>
                    بستن منو
                </span>
                </div>
            </div>

        </div>
    </div>
</section>
