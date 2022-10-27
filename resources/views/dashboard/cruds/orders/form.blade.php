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
            <h3 class="block-title">الطلبات</h3>
        </div>
        <div class="block-content block-content-full">
            <!-- Regular -->
            <h2 class="content-heading border-bottom mb-4 pb-2"></h2>
            <div class="row items-push">
                <div class="col-lg-4">
                    <p class="font-size-sm text-muted">
                        
                    </p>
                </div>
                <div class="col-lg-8 col-xl-5">
                    <div class="form-group">
                        <label for="val-skill">العميل <span class="text-danger">*</span></label>
                        <select class="js-select2 form-control" id="example-select2" name="user_id" style="width: 100%;" data-placeholder="من فضلك إختر العميل">
                            <option > </option>
                            @forelse ($users as $item)
                        <option value="{{$item->id}}" 
                            @isset($data)
                                 @if ($data->user_id == $item->id)
                                     selected
                                 @endif   
                            @endisset
                            >{{$item->name}}</option>
                            @empty
                                
                            @endforelse
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="val-price"> سعر التوصيل <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="val-price" name="delivery_price" placeholder="سعر التوصيل" value="{{$data->delivery_price}}">
                    </div>
                    <div class="form-group">
                        <label for="val-password"> تاريخ التوصيل <span class="text-danger">*</span></label>
                    <input type="text" class="js-flatpickr form-control bg-white" id="example-flatpickr-default" name="date" placeholder="Y-m-d" value="{{$data->date}}">
                    </div>
                    <div class="form-group">
                        <label for="val-password"> وقت التوصيل <span class="text-danger">*</span></label>
                    <input type="text" class="js-flatpickr form-control bg-white" id="example-flatpickr-time-standalone" name="time" data-enable-time="true" data-no-calendar="true" data-date-format="H:i" value="{{$data->time}}">
                    </div>
                    <div class="form-group">
                        <label class="d-block">الضريبة</label>

                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input" id="example-radio-custom-inline2" name="enable_tax" value="0" @isset($data)
                                @if ($data->enable_tax == '0')
                                checked   
                                @endif
                            @endisset >
                            <label class="custom-control-label" for="example-radio-custom-inline2">لايوجد ضريبة</label>
                        </div>

                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input" id="example-radio-custom-inline1" name="enable_tax" value="1" @isset($data)
                                @if ($data->enable_tax == '1')
                                     checked   
                                @endif
                            @endisset>
                            <label class="custom-control-label" for="example-radio-custom-inline1">إضافة ضريبة</label>
                        </div>

                    </div>
                    
                    <div class="form-group" id="tax-value">
                        <label for="val-price">  قيمة  الضريبة<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="val-price" name="tax" placeholder=" % الضريبة " @isset($data)
                    value="{{$data->tax}}"
                        @endisset> 
                    </div>

                    <div class="form-group">
                        <label class="d-block">الخصم</label>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input" id="example-radio-discount-inline1" name="discount" value="none" @isset($data)
                                @if($data->discount=='none') checked @endif
                            @endisset>
                            <label class="custom-control-label" for="example-radio-discount-inline1">لايوجد خصم</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input" id="example-radio-discount-inline2" name="discount" value="persentage" @isset($data)
                            @if($data->discount=='persentage') checked @endif
                        @endisset>
                            <label class="custom-control-label" for="example-radio-discount-inline2">خصم نسبة مئوية</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input" id="example-radio-discount-inline3" name="discount" value="money" @isset($data)
                            @if($data->discount=='money') checked @endif
                        @endisset>
                            <label class="custom-control-label" for="example-radio-discount-inline3">خصم مبلغ</label>
                        </div>
                    </div>

                    <div class="form-group" id="discount-persentage">
                        <label for="val-price">  قيمة الخصم  بالنسبة المئوية<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="val-price" name="price_persentage_discount" placeholder="النسبة المئوية" value="{{$data->price_persentage_discount}}">
                    </div>

                    <div class="form-group" id="discount-money">
                        <label for="val-price">  قيمة مبلغ الخصم<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="val-price" name="price_money_discount" placeholder=" الخصم " value="{{$data->price_money_discount}}">
                    </div>

                    <div class="new-product-block">
                        <div class="new-product">
                            <div class="add-new-product my-4">
                                <img src="{{asset("/")}}images/icons/plus.png" class="img-fluid pr-2"> إضافة منتج 
                            </div>
                        </div>
                        <div class="block row mb-md-0 mb-4 form-group">
                        <div class="col-md-6 form-group">
                            <select class="form-control" name=items[]>
                             <option value=""> إختر المنتج</option>
                             
                             @if ( count($data->products) > 0)
                                @forelse ($data->products as $product)
                                @foreach($products as $item)
                                <option value={{$item->id}}
                                    @if ($item->id == $product->id )
                                        selected
                                    @endif
                                    >{{$item->name_ar}}</option>
                                @endforeach
                                </select>
                                </div>
                                <div class="col-md-4 form-group">
                                <input class="form-control" type="number" name="quantity[]" placeholder="الكمية" value="{{$product->pivot->quantity}}">
                                </div>
                                <i class="far fa-trash-alt remove"></i>
                                </div>
                                @empty
                                    
                                @endforelse
                             @endif   

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

    @section('css')
    <link rel="stylesheet" href="{{asset('/')}}js/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css">
    <link rel="stylesheet" href="{{asset('/')}}js/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
    <link rel="stylesheet" href="{{asset('/')}}js/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{asset('/')}}js/plugins/ion-rangeslider/css/ion.rangeSlider.css">
    <link rel="stylesheet" href="{{asset('/')}}js/plugins/dropzone/dist/min/dropzone.min.css">
    <link rel="stylesheet" href="{{asset('/')}}js/plugins/flatpickr/flatpickr.min.css">

    @endsection

    @section('js')
    <script src="{{asset('/')}}js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <script src="{{asset('/')}}js/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
    <script src="{{asset('/')}}js/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
    <script src="{{asset('/')}}js/plugins/select2/js/select2.full.min.js"></script>
    <script src="{{asset('/')}}js/plugins/jquery.maskedinput/jquery.maskedinput.min.js"></script>
    <script src="{{asset('/')}}js/plugins/ion-rangeslider/js/ion.rangeSlider.min.js"></script>
    <script src="{{asset('/')}}js/plugins/dropzone/dropzone.min.js"></script>
    <script src="{{asset('/')}}js/plugins/flatpickr/flatpickr.min.js"></script>

    <!-- Page JS Helpers (Flatpickr + BS Datepicker + BS Colorpicker + BS Maxlength + Select2 + Masked Inputs + Ion Range Slider plugins) -->
    <script>jQuery(function(){ One.helpers(['flatpickr', 'datepicker', 'colorpicker', 'maxlength', 'select2', 'masked-inputs', 'rangeslider']); });</script>
    <script>
        $(document).ready(function(){
            $('#tax-value').hide();
            $('#discount-persentage').hide();
            $('#discount-money').hide();
            $('input[name="discount"]').change(function(){
                if($(this).val() == 'persentage'){
                    $('#discount-persentage').show();
                  $('#discount-money').hide();
                }else if($(this).val() == 'money'){
                    $('#discount-persentage').hide();
                  $('#discount-money').show();
                }else{
                  $('#discount-persentage').hide();
                  $('#discount-money').hide();
                }
            });
            $('input[name="enable_tax"]').change(function(){
                if($(this).val() == '0'){
                    $('#tax-value').hide();
                }else if($(this).val() == '1'){
                  $('#tax-value').show();
                }else{
                  $('#tax-value').hide();
                }
            });
            $('.add-new-product').click(function() {
                $('.new-product:last').after('<div class="block row mb-md-0 mb-4 form-group">' +
                    '<div class="col-md-6 form-group">' +
                    '<select class="form-control" name=items[]>' +
                    '<option value=""> إختر المنتج</option>' +

                    @foreach($products as $item)
                    '<option value={{$item->id}}>{{$item->name_ar}}</option>' +
                    @endforeach
                    '</select>' +
                    '</div>' +
                    '<div class="col-md-4 form-group">' +
                    '<input class="form-control" type="number" name="quantity[]" placeholder="الكمية">' +
                    '</div>' +
                    '<i class="far fa-trash-alt remove"></i>' +
                    '</div>');
            });
            $('.new-product-block').on('click', '.remove', function() {
                $(this).parent().remove();
            });
        });
    </script>
    @endsection
