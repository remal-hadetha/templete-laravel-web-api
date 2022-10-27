@extends('dashboard.layout.layout')
@section('css')
    <style>
        .timeline-event-icon{
            margin-right: -28px;
        }
    </style>
@endsection
@section('content')
<!-- Hero -->
<div class="bg-image" style="background-image: url('{{asset("media/photos/photo8@2x.jpg")}}');">
    <div class="bg-black-50">
        <div class="content content-full text-center">
            <div class="my-3">
                @if ($data->type == 'user')

                <img class="img-avatar img-avatar-thumb" src="{{$data->user->ImageURL}}" alt="">
                @else
                <img class="img-avatar img-avatar-thumb" src="{{$data->salon->ImageURL}}" alt="">

                @endif
            </div>

            @if ($data->type == 'user')

            <h1 class="h2 text-white mb-0">{{$data->user->name}}</h1>
            @else
            <h1 class="h2 text-white mb-0">{{$data->salon->name}}</h1>

            @endif
            <span class="text-white-75">    صاحب الشكوي    </span>


        </div>
    </div>
</div>
<!-- END Hero -->

<!-- Stats -->
<div class="bg-white border-bottom">
    <div class="content content-boxed">
        <div class="col-md-7 col-xl-8">
            <!-- Updates -->
            <ul class="timeline timeline-alt py-0">

                <li class="timeline-event">
                    <div class="timeline-event-icon bg-modern">
                        <i class="fa fa-briefcase"></i>
                    </div>
                    <div class="timeline-event-block block invisible" data-toggle="appear">
                        <div class="block-header">
                            <h3 class="block-title">تاريخ إنشاء الشكوي</h3>
                            <div class="block-options">
                                <div class="timeline-event-time block-options-item font-size-sm">
                                        {{$data->created_at->diffForHumans()}}
                                </div>
                            </div>
                        </div>
                        <div class="block-content block-content-full">
                            <p class="font-w600 mb-2">

                                {{date('Y-m-d',strtotime($data->created_at)) }}

                            </p>
                            <hr>
                            <div class="row">
                                <h1> عنوان الرسالة : {{$data->name}}</h1>
                                <hr>
                            </div>
                            <div class="row" style="diplay:block">
                                <div  class="row" style="diplay:block">

                                </div>
                               <div  class="row" style="diplay:block">
                                <p> {{$data->message}} </p>

                               </div>
                            </div>
                        </div>
                    </div>
                </li>



            </ul>
            <!-- END Updates -->
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
