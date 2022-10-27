@extends('dashboard.layout.layout')
@section('content')
<!-- Hero -->
<div class="bg-image" style="background-image: url('{{asset("media/photos/photo8@2x.jpg")}}');">
    <div class="bg-black-50">
        <div class="content content-full text-center">
            <div class="my-3">
                <img class="img-avatar img-avatar-thumb" src="{{$data->ImageURL}}" alt="">
            </div>
            <h1 class="h2 text-white mb-0">{{$data->name}}</h1>
            <h1 class="h2 text-white mb-0"> إسم الصالون  : {{$data->salon->name}}</h1>
        </div>
    </div>
</div>
<!-- END Hero -->

<!-- Stats -->
<div class="bg-white border-bottom">
    <div class="content content-boxed">
        <div class="row items-push text-center">
            <div class="col-6 col-md-6">
                <div class="font-size-sm font-w600 text-muted text-uppercase">السعر</div>
                <a class="link-fx font-size-h3" href="javascript:void(0)">{{$data->price}}</a>
            </div>
            <div class="col-6 col-md-6">
                <div class="font-size-sm font-w600 text-muted text-uppercase"> الوقت </div>

                <a class="link-fx font-size-h3" href="javascript:void(0)"> {{$data->time}}</a>
            </div>


        </div>
    </div>
</div>
<!-- END Stats -->

<!-- Page Content -->

<!-- END Page Content -->
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
