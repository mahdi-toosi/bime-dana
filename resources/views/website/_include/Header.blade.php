<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="headerlogo">
                <img src="{{asset('website/img/bimelogo.png')}}" title="بیمه باش" alt="بیمه باش"/>

            </div>
        </div>
        <div class="col-md-6">
            <nav class="navbar navbar-expand-lg">
                <ul class="navbar-nav">
                    @if(Auth::check())
                    <li class="nav-item">
                        <a class="nav-link nav-link-two" href="/myinsurance">
                            <img src="{{asset('website/img/protection.png')}}">
                            بیمه های من
                        </a>
                    </li>

                    <!-- Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                            @if(\Illuminate\Support\Facades\Auth::user()->name=="")
                                {{\Illuminate\Support\Facades\Auth::user()->phone}}
                            @else
                            {{\Illuminate\Support\Facades\Auth::user()->name}}
                                @endif
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="/profile">
                                <i class="la la-user"></i>
                                پروفایل
                            </a>

                            <a class="dropdown-item" href="logout">
                                <i class="la la-sign-out"></i>
                                خروج</a>
                        </div>
                    </li>
                        @else
                        <li class="nav-item">
                            <a class="nav-link nav-link-two" href="/login">
                                <i class="la la-user"></i>
                                ورود به سیستم
                            </a>
                        </li>
                        @endif
                </ul>
            </nav>
        </div>
    </div>
</div>
