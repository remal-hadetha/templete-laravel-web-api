<div class="content-header bg-white-5">
    <!-- Logo -->
<a class="font-w600 text-dual" href="{{route('admin.index')}}">
        <i class="fa fa-circle-notch text-primary"></i>
        <span class="smini-hide">
            <span class="font-w700 font-size-h5">A</span>
        </span>
    </a>
    <!-- END Logo -->

    <!-- Extra -->
    <div>
        <!-- Options -->
        <div class="dropdown d-inline-block ml-2">
            <a class="btn btn-sm btn-dual" id="sidebar-themes-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#">
                <i class="si si-drop"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-left font-size-sm smini-hide border-0" aria-labelledby="sidebar-themes-dropdown">
                <!-- Color Themes -->
                <!-- Layout API, functionality initialized in Template._uiHandleTheme() -->
                <a class="dropdown-item d-flex align-items-center justify-content-between" data-toggle="theme" data-theme="default" href="#">
                    <span>Default</span>
                    <i class="fa fa-circle text-default"></i>
                </a>
                <a class="dropdown-item d-flex align-items-center justify-content-between" data-toggle="theme" data-theme="{{asset('/')}}css/themes/amethyst.min.css" href="#">
                    <span>Amethyst</span>
                    <i class="fa fa-circle text-amethyst"></i>
                </a>
                <a class="dropdown-item d-flex align-items-center justify-content-between" data-toggle="theme" data-theme="{{asset('/')}}css/themes/city.min.css" href="#">
                    <span>City</span>
                    <i class="fa fa-circle text-city"></i>
                </a>
                <a class="dropdown-item d-flex align-items-center justify-content-between" data-toggle="theme" data-theme="{{asset('/')}}css/themes/flat.min.css" href="#">
                    <span>Flat</span>
                    <i class="fa fa-circle text-flat"></i>
                </a>
                <a class="dropdown-item d-flex align-items-center justify-content-between" data-toggle="theme" data-theme="{{asset('/')}}css/themes/modern.min.css" href="#">
                    <span>Modern</span>
                    <i class="fa fa-circle text-modern"></i>
                </a>
                <a class="dropdown-item d-flex align-items-center justify-content-between" data-toggle="theme" data-theme="{{asset('/')}}css/themes/smooth.min.css" href="#">
                    <span>Smooth</span>
                    <i class="fa fa-circle text-smooth"></i>
                </a>
                <!-- END Color Themes -->

                <div class="dropdown-divider"></div>

                <!-- Sidebar Styles -->
                <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                <a class="dropdown-item" data-toggle="layout" data-action="sidebar_style_light" href="#">
                    <span>Sidebar Light</span>
                </a>
                <a class="dropdown-item" data-toggle="layout" data-action="sidebar_style_dark" href="#">
                    <span>Sidebar Dark</span>
                </a>
                <!-- Sidebar Styles -->

                <div class="dropdown-divider"></div>

                <!-- Header Styles -->
                <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                <a class="dropdown-item" data-toggle="layout" data-action="header_style_light" href="#">
                    <span>Header Light</span>
                </a>
                <a class="dropdown-item" data-toggle="layout" data-action="header_style_dark" href="#">
                    <span>Header Dark</span>
                </a>
                <!-- Header Styles -->
            </div>
        </div>
        <!-- END Options -->

        <!-- Close Sidebar, Visible only on mobile screens -->
        <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
        <a class="d-lg-none btn btn-sm btn-dual ml-2" data-toggle="layout" data-action="sidebar_close" href="javascript:void(0)">
            <i class="fa fa-fw fa-times"></i>
        </a>
        <!-- END Close Sidebar -->
    </div>
    <!-- END Extra -->
</div>