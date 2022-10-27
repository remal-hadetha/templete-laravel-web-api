@extends('dashboard.layout.layout')
@section('content')
<!-- Hero -->
<div class="bg-image" style="background-image: url('{{asset("media/photos/photo8@2x.jpg")}}');">
    <div class="bg-black-50">
        <div class="content content-full text-center">
            <div class="my-3">
                <img class="img-avatar img-avatar-thumb" src="{{$data->ImageURL}}" alt="">
            </div>
            <h1 class="h2 text-white mb-0">{{$data->name_ar}}</h1>
            <span class="text-white-75"> عدد الصالونات : {{$data->salons->count()}}</span>

        </div>
    </div>
</div>
<!-- END Hero -->

<!-- Stats -->
<div class="bg-white border-bottom">
    <div class="content content-boxed">

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
