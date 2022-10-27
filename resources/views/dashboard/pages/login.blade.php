<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

        <title>تسجيل الدخول</title>

        @include('dashboard.includes.css')
    </head>
    <body>
 
        <div id="page-container" class="rtl-support">

            <!-- Main Container -->
            <main id="main-container">
                <!-- Page Content -->
            <div class="bg-image" style="background-image: url('{{asset("/")}}media/photos/photo6@2x.jpg');">
                    <div class="hero-static bg-white-95">
                        <div class="content">
                            <div class="row justify-content-center">
                                <div class="col-md-8 col-lg-6 col-xl-4">
                                    <!-- Sign In Block -->
                                    @if(session('message'))
                                    @if(session('message')['type'] == 'success')
                                        <div class="col-xl-12 alert alert-dismissible alert-success fade show" role="alert">
                                            {{ session('message')['content']  }}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @elseif(session('message')['type'] == 'error')
                                        <div class="col-xl-12 alert alert-dismissible alert-danger fade show" role="alert">
                                            {{ session('message')['content']  }}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @endif
                                @endif
                
                                @if($errors)
                                    @foreach ($errors->all() as $error)
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">{{ $error }}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @endforeach
                                @endif
                                    <div class="block block-themed block-fx-shadow mb-0">
                                        <div class="block-header">
                                            <h3 class="block-title">تسجيل الدخول</h3>
                                            <div class="block-options">
                                                
                                            </div>
                                        </div>
                                        <div class="block-content">
                                            <div class="p-sm-3 px-lg-4 py-lg-5">
                                                <h1 class="mb-2">لوحة التحكم</h1>
                                                <p> مرحبا ، قم بتسجيل الدخول</p>

                                                <!-- Sign In Form -->
                                                <!-- jQuery Validation (.js-validation-signin class is initialized in js/pages/op_auth_signin.min.js which was auto compiled from _es6/pages/op_auth_signin.js) -->
                                                <!-- For more info and examples you can check out https://github.com/jzaefferer/jquery-validation -->
                                            <form class="" action="{{ route('admin.auth') }}" method="POST">
                                                @csrf
                                                    <div class="py-3">
                                                        <div class="form-group">
                                                            <input type="email" class="form-control form-control-alt form-control-lg" id="login-email" name="email" placeholder="البريد الالكتروني">
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="password" class="form-control form-control-alt form-control-lg" id="login-password" name="password" placeholder="الرقم السري">
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input" id="login-remember" name="remember">
                                                                <label class="custom-control-label font-w400" for="login-remember">تذكرني </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-md-6 col-xl-5">
                                                            <button type="submit" class="btn btn-block btn-primary">
                                                                <i class="fa fa-fw fa-sign-in-alt mr-1"></i> تسجيل الدخول
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                                <!-- END Sign In Form -->
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END Sign In Block -->
                                </div>
                            </div>
                        </div>
                        <div class="content content-full font-size-sm text-muted text-center">
                            <strong></strong> &copy; <span data-toggle="year-copy"></span>
                        </div>
                    </div>
                </div>
                <!-- END Page Content -->
            </main>
            <!-- END Main Container -->
        </div>
        <!-- END Page Container -->

        @include('dashboard.includes.js')

        <!-- Page JS Code -->
    </body>
</html>
