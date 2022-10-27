@if($errors)
@foreach ($errors->all() as $error)
    <div class="alert alert-danger alert-dismissible fade show" role="alert">{{ $error }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

@endforeach
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
                <div class="col-lg-8 col-xl-5">
                    <div class="form-group">
                        <label for="val-username">الإسم <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="val-username" name="val-username" placeholder="الإسم">
                    </div>
                    <div class="form-group">
                        <label for="val-email">البريد الإلكتروني <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="val-email" name="val-email" placeholder="البريد الآلكتروني ">
                    </div>
                    <div class="form-group">
                        <label for="val-password">الرقم السري <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" id="val-password" name="val-password" placeholder="الرقم السري">
                        <label class="control-label col-lg-3">  الموبيل <span class="text-danger">*</span></label>
                        <div class="col-lg-9">
                            <input type="text" name="MOBILE" class="form-control" required="required" value="{{ SETTING_VALUE('MOBILE') }} "> 
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
