<nav id="sidebar" aria-label="Main Navigation">
    <!-- Side Header -->
    @include('dashboard.includes.sidebar-header')
    <!-- END Side Header -->

    <!-- Side Navigation -->
    <div class="content-side content-side-full">
        <ul class="nav-main">
            <li class="nav-main-item">
            <a class="nav-main-link" href="{{route('admin.index')}}">
                    <i class="nav-main-link-icon si si-speedometer"></i>
                    <span class="nav-main-link-name">لوحة التحكم</span>
                </a>
            </li>



            <li class="nav-main-heading"> المستخدمين </li>
            <li class="nav-main-item">
                <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                    <i class="nav-main-link-icon si si-energy"></i>
                    <span class="nav-main-link-name">المديرين</span>
                </a>
                <ul class="nav-main-submenu">
                    <li class="nav-main-item">
                    <a class="nav-main-link" href="{{route('admins.index')}}">
                            <span class="nav-main-link-name">الرئيسية</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link" href="{{route('admins.create')}}">
                            <span class="nav-main-link-name">إنشاء</span>
                        </a>
                    </li>

                </ul>
            </li>
            <li class="nav-main-item">
                <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                    <i class="nav-main-link-icon si si-energy"></i>
                    <span class="nav-main-link-name">الأعضاء</span>
                </a>
                <ul class="nav-main-submenu">
                    <li class="nav-main-item">
                        <a class="nav-main-link" href="{{route('users.index')}}">
                            <span class="nav-main-link-name">الرئيسية</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link" href="{{route('users.create')}}">
                            <span class="nav-main-link-name">إنشاء</span>
                        </a>
                    </li>

                </ul>
            </li>

            <li class="nav-main-item">
                <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                    <i class="nav-main-link-icon si si-energy"></i>
                    <span class="nav-main-link-name"> الصالونات</span>
                </a>
                <ul class="nav-main-submenu">
                    <li class="nav-main-item">
                        <a class="nav-main-link" href="{{route('providers.index')}}">
                            <span class="nav-main-link-name">الرئيسية</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link" href="{{route('providers.create')}}">
                            <span class="nav-main-link-name">إنشاء</span>
                        </a>
                    </li>

                </ul>
            </li>

            <li class="nav-main-heading"> التخصصات </li>
            <li class="nav-main-item">
                <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                    <i class="nav-main-link-icon si si-energy"></i>
                    <span class="nav-main-link-name"> التخصصات</span>
                </a>
                <ul class="nav-main-submenu">
                    <li class="nav-main-item">
                        <a class="nav-main-link" href="{{route('categories.index')}}">
                            <span class="nav-main-link-name">الرئيسية</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link" href="{{route('categories.create')}}">
                            <span class="nav-main-link-name">إنشاء</span>
                        </a>
                    </li>

                </ul>
            </li>

            <li class="nav-main-heading"> الخدمات </li>
            <li class="nav-main-item">
                <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                    <i class="nav-main-link-icon si si-energy"></i>
                    <span class="nav-main-link-name">الخدمات</span>
                </a>
                <ul class="nav-main-submenu">
                    <li class="nav-main-item">
                        <a class="nav-main-link" href="{{route('services.index')}}">
                            <span class="nav-main-link-name">الرئيسية</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link" href="{{route('services.create')}}">
                            <span class="nav-main-link-name">إنشاء</span>
                        </a>
                    </li>

                </ul>
            </li>


            <li class="nav-main-heading"> الآعمال </li>
            <li class="nav-main-item">
                <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                    <i class="nav-main-link-icon si si-energy"></i>
                    <span class="nav-main-link-name">الآعمال</span>
                </a>
                <ul class="nav-main-submenu">
                    <li class="nav-main-item">
                        <a class="nav-main-link" href="{{route('works.index')}}">
                            <span class="nav-main-link-name">الرئيسية</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link" href="{{route('works.create')}}">
                            <span class="nav-main-link-name">إنشاء</span>
                        </a>
                    </li>

                </ul>
            </li>


            <li class="nav-main-heading"> الطلبات </li>
            <li class="nav-main-item">
                <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                    <i class="nav-main-link-icon si si-energy"></i>
                    <span class="nav-main-link-name">الطلبات</span>
                </a>
                <ul class="nav-main-submenu">
                    <li class="nav-main-item">
                        <a class="nav-main-link" href="{{route('orders.index')}}">
                            <span class="nav-main-link-name">الرئيسية</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link" href="{{route('orders.status',['status'=>'pending'])}}">
                            <span class="nav-main-link-name">طلبات قيد الإنتظار</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link" href="{{route('orders.status',['status'=>'inprogress'])}}">
                            <span class="nav-main-link-name">طلبات قيد التنفيذ</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link" href="{{route('orders.status',['status'=>'delevired'])}}">
                            <span class="nav-main-link-name">طلبات تم تنفيذها</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-main-heading"> البنرات </li>
            <li class="nav-main-item">
                <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                    <i class="nav-main-link-icon si si-energy"></i>
                    <span class="nav-main-link-name">البنرات</span>
                </a>
                <ul class="nav-main-submenu">
                    <li class="nav-main-item">
                        <a class="nav-main-link" href="{{route('sliders.index')}}">
                            <span class="nav-main-link-name">الرئيسية</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link" href="{{route('sliders.create')}}">
                            <span class="nav-main-link-name">إنشاء</span>
                        </a>
                    </li>

                </ul>
            </li>

            <li class="nav-main-heading"> الكوبونات </li>
            <li class="nav-main-item">
                <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                    <i class="nav-main-link-icon si si-energy"></i>
                    <span class="nav-main-link-name">الكوبونات</span>
                </a>
                <ul class="nav-main-submenu">
                    <li class="nav-main-item">
                        <a class="nav-main-link" href="{{route('coupons.index')}}">
                            <span class="nav-main-link-name">الرئيسية</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link" href="{{route('coupons.create')}}">
                            <span class="nav-main-link-name">إنشاء</span>
                        </a>
                    </li>

                </ul>
            </li>

            <li class="nav-main-heading"> الشكاوي </li>
            <li class="nav-main-item">
                <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                    <i class="nav-main-link-icon si si-energy"></i>
                    <span class="nav-main-link-name">الشكاوي</span>
                </a>
                <ul class="nav-main-submenu">
                    <li class="nav-main-item">
                    <a class="nav-main-link" href="{{route('contacts.index')}}">
                            <span class="nav-main-link-name">الرئيسية</span>
                        </a>
                    </li>
                    {{--  <li class="nav-main-item">
                        <a class="nav-main-link" href="{{route('contacts.create')}}">
                            <span class="nav-main-link-name">إنشاء</span>
                        </a>
                    </li>  --}}

                </ul>
            </li>

            <li class="nav-main-heading"> عمليات الدفع </li>
            <li class="nav-main-item">
                <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                    <i class="nav-main-link-icon si si-energy"></i>
                    <span class="nav-main-link-name">عمليات الدفع </span>
                </a>
                <ul class="nav-main-submenu">
                    <li class="nav-main-item">
                    <a class="nav-main-link" href="{{route('payments.index')}}">
                            <span class="nav-main-link-name">الرئيسية</span>
                        </a>
                    </li>
                </ul>
            </li>

            {{--  <li class="nav-main-heading"> التقارير </li>
            <li class="nav-main-item">
                <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                    <i class="nav-main-link-icon si si-energy"></i>
                    <span class="nav-main-link-name">التقارير</span>
                </a>
                <ul class="nav-main-submenu">
                    <li class="nav-main-item">
                    <a class="nav-main-link" href="{{route('reports.index')}}">
                            <span class="nav-main-link-name">الرئيسية</span>
                        </a>
                    </li>
                </ul>
            </li>  --}}


            <li class="nav-main-heading"> الإعدادات </li>
            <li class="nav-main-item">
                <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                    <i class="nav-main-link-icon si si-energy"></i>
                    <span class="nav-main-link-name"></span>
                </a>
                <ul class="nav-main-submenu">
                    <li class="nav-main-item">
                        <a class="nav-main-link" href="{{route('settings.index')}}">
                            <span class="nav-main-link-name">الرئيسية</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
    <!-- END Side Navigation -->
</nav>
