@extends('dashboard.layout.layout')
@section('content')
<form  action="{{route('setting_update')}}" method="POST">
    @csrf
    @if($errors)
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger alert-dismissible fade show" role="alert">{{ $error }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

    @endforeach
    @endif
    @if(session('message'))
    @if(session('message')['type'] == 'success')
        <div class="col-xl-12 alert alert-dismissible alert-success fade show" role="alert">
            {{ session('message')['content']  }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @endif
        <div class="block">
            <div class="block-header">
                <h3 class="block-title">الإعدادت</h3>
            </div>
            <div class="block-content block-content-full">
                <!-- Regular -->
                <h2 class="content-heading border-bottom mb-4 pb-2">إضافة</h2>
                <div class="row items-push">
                    <div class="col-lg-4">
                        <p class="font-size-sm text-muted">

                        </p>
                    </div>
                    <div class="col-lg-10 col-xl-7">

                        <div class="form-group">
                            <label class="control-label "> اسم التطبيق بالعربي <span class="text-danger">*</span></label>
                            <div class="">
                                <input type="text" value="{{ SETTING_VALUE('APP_NAME_AR') }}" name="APP_NAME_AR" class="form-control" required="required" placeholder="اسم التطبيق بالعربي">
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="control-label "> اسم التطبيق بالانجليزيه<span class="text-danger">*</span></label>
                            <div class="">
                                <input type="text" value="{{ SETTING_VALUE('APP_NAME_EN') }}" name="APP_NAME_EN" class="form-control" required="required" placeholder="اسم التطبيق بالانجليزيه">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label ">   الضريبة<span class="text-danger">*</span></label>
                            <div class="">
                                <input type="text" value="{{ SETTING_VALUE('tax') }}" name="tax" class="form-control" required="required" placeholder="الضريبة ">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label "> وصف التطبيق الاسم باللغة العربية <span class="text-danger">*</span></label>
                            <div class="">
                                <textarea rows="5" cols="5" name="APP_DESC_AR" class="form-control" required="required" placeholder="وصف التطبيق الاسم باللغة العربية"> {{ SETTING_VALUE('APP_DESC_AR') }} </textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label "> وصف التطبيق الاسم باللغه الانجليزيه <span class="text-danger">*</span></label>
                            <div class="">
                                <textarea rows="5" cols="5" name="APP_DESC_EN" class="form-control" required="required" placeholder="وصف التطبيق الاسم باللغه الانجليزيه"> {{ SETTING_VALUE('APP_DESC_EN') }} </textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label "> عن الطبيق بالعربيه <span class="text-danger">*</span></label>
                            <div class="">
                                <textarea rows="5" cols="5" name="ABOUT_AR" class="form-control" required="required"> {{ SETTING_VALUE('ABOUT_AR') }} </textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label "> عن الطبيق بالانجليزيه <span class="text-danger">*</span></label>
                            <div class="">
                                <textarea rows="5" cols="5" name="ABOUT_EN" class="form-control" required="required" placeholder="{{ trans('dash.app_desc_en') }}"> {{ SETTING_VALUE('ABOUT_EN') }} </textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label "> الشروط والاحكام بالعربيه <span class="text-danger">*</span></label>
                            <div class="">
                                <textarea rows="5" cols="5" name="PRIVACY_POLICY_AR" class="form-control" required="required"> {{ SETTING_VALUE('PRIVACY_POLICY_AR') }} </textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label "> الشروط والاحكام بالانجليزيه <span class="text-danger">*</span></label>
                            <div class="">
                                <textarea rows="5" cols="5" name="PRIVACY_POLICY_EN" class="form-control" required="required"> {{ SETTING_VALUE('PRIVACY_POLICY_EN') }} </textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label ">  الإيميل <span class="text-danger">*</span></label>
                            <div class="">
                                <input type="email" name="FORMAL_EMAIL" class="form-control" required="required" value="{{ SETTING_VALUE('FORMAL_EMAIL') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label ">  الموبيل <span class="text-danger">*</span></label>
                            <div class="">
                                <input type="text" name="MOBILE" class="form-control" required="required" value="{{ SETTING_VALUE('MOBILE') }} ">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label "> رقم WhatsApp  </label>
                            <div class="">
                                <input type="text" value="{{ SETTING_VALUE('WhatsApp') }}" name="WhatsApp" class="form-control" placeholder="رقم WhatsApp">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label "> رابط Facebook  </label>
                            <div class="">
                                <input type="text" value="{{ SETTING_VALUE('FACEBOOK_URL') }}" name="FACEBOOK_URL" class="form-control" placeholder="رابط facebook">
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="control-label"> رابط Twitter  </label>
                            <div class="">
                                <input type="text" value="{{ SETTING_VALUE('TWITTER_URL') }}" name="TWITTER_URL" class="form-control" placeholder="رابط Twitter ">
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="control-label "> رابط Instagram  </label>
                            <div class="">
                                <input type="text" value="{{ SETTING_VALUE('INSTAGRAM_URL') }}" name="INSTAGRAM_URL" class="form-control" placeholder="رابط Instagram">
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="control-label "> رابط Snapchat  </label>
                            <div class="">
                                <input type="text" value="{{ SETTING_VALUE('SNAPCHAT_URL') }}" name="SNAPCHAT_URL" class="form-control" placeholder="رابط Snapchat">
                            </div>
                        </div>






                <div class="form-group">
                    <label class="control-label "> استضافة SMTP  </label>
                    <div class="">
                        <input type="text" value="{{ SETTING_VALUE('SMTP_HOST') }}" name="SMTP_HOST" class="form-control" placeholder="استضافة SMTP">
                    </div>
                </div>


                <div class="form-group">
                    <label class="control-label "> منفذ SMTP  </label>
                    <div class="">
                        <input type="text" value="{{ SETTING_VALUE('SMTP_PORT') }}" name="SMTP_PORT" class="form-control" placeholder="منفذ SMTP">
                    </div>
                </div>


                <div class="form-group">
                    <label class="control-label "> بريد SMTP  </label>
                    <div class="">
                        <input type="text" value="{{ SETTING_VALUE('SMTP_EMAIL') }}" name="SMTP_EMAIL" class="form-control" placeholder="بريد SMTP">
                    </div>
                </div>


                <div class="form-group">
                    <label class="control-label "> كلمة مرور SMTP  </label>
                    <div class="">
                        <input type="password" value="{{ SETTING_VALUE('SMTP_PASSWORD') }}" name="SMTP_PASSWORD" class="form-control" placeholder="كلمة مرور SMTP">
                    </div>
                </div>


                <div class="form-group">
                    <label class="control-label "> الجوال  </label>
                    <div class="">
                        <input type="text" value="{{ SETTING_VALUE('SMS_PROVIDER_MOBILE') }}" name="SMS_PROVIDER_MOBILE" class="form-control" placeholder="الجوال">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label "> الراسل </label>
                    <div class="">
                        <input type="text" value="{{ SETTING_VALUE('SMS_PROVIDER_SENDER') }}" name="SMS_PROVIDER_SENDER" class="form-control" placeholder="الراسل">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label"> كلمه السر </label>
                    <div class="">
                        <input type="text" value="{{ SETTING_VALUE('SMS_PROVIDER_PASSWORD') }}" name="SMS_PROVIDER_PASSWORD" class="form-control" placeholder="كلمه السر">
                    </div>
                </div>

                    </div>
                </div>
                <!-- END Regular -->


                <!-- Submit -->
                <div class="row items-push">
                    <div class="col-lg-7 offset-lg-4">
                        <button type="submit" class="btn btn-primary">حفظ</button>
                    </div>
                </div>
                <!-- END Submit -->
            </div>
        </div>

</form>
@endsection

@section('css')
        <!-- Stylesheets -->
    <!-- Page JS Plugins CSS -->
<link rel="stylesheet" href="{{asset('/')}}js/plugins/select2/css/select2.min.css">

@endsection

@section('js')
<script src="{{asset('/')}}js/plugins/select2/js/select2.full.min.js"></script>
<script src="{{asset('/')}}js/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="{{asset('/')}}js/plugins/jquery-validation/additional-methods.js"></script>

<!-- Page JS Helpers (Select2 plugin) -->
<script>jQuery(function(){ One.helpers('select2'); });</script>

<!-- Page JS Code -->
<script src="{{asset('/')}}js/pages/be_forms_validation.min.js"></script>
@endsection
