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
                @if ($data->services->first())
                <img class="img-avatar img-avatar-thumb" src="{{$data->services->first()->ImageURL}}" alt="">

                @endif
            </div>
            <h1 class="h2 text-white mb-0"> الإجمالي {{$data->sub_total}}</h1>
            <span class="text-white-75"></span>
        </div>
    </div>
</div>
<!-- END Hero -->

<!-- Stats -->
<div class="bg-white border-bottom">
    <div class="content content-boxed">
        <div class="row items-push text-center">
            <div class="col-6 col-md-3">
                <div class="font-size-sm font-w600 text-muted text-uppercase">اسم صاحب الطلب</div>
                <a class="link-fx font-size-h3" href="javascript:void(0)">{{$data->user->name}}</a>
            </div>
            <div class="col-6 col-md-3">
                <div class="font-size-sm font-w600 text-muted text-uppercase"> إسم صاحب الصالون </div>

                <a class="link-fx font-size-h3" href="javascript:void(0)"> {{$data->salon->name}}</a>
            </div>
            <div class="col-6 col-md-3">
                <div class="font-size-sm font-w600 text-muted text-uppercase">حالة الطلب</div>
                <a class="link-fx font-size-h3" href="javascript:void(0)">
                @if ($data->status == 'pending')
                    في إنتظار الموافقة
                @elseif($data->status == 'inprogress')
                    جاري التنفيذ
                @elseif($data->status == 'done' || $data->status == 'delevired' )
                     تم التنفيذ
                @elseif($data->status == 'cancelled')
                    تم الإلغاء
                @endif
            </a>
            </div>
            <div class="col-6 col-md-3">
                <div class="font-size-sm font-w600 text-muted text-uppercase">القسم</div>
                <a class="link-fx font-size-h3" href="javascript:void(0)">{{$data->salon->category->name_ar}}</a>
            </div>

        </div>
    </div>
</div>
<!-- END Stats -->

<!-- Page Content -->
<div class="content content-boxed">
    <div class="row">
        <div class="col-md-7 col-xl-8">
            <!-- Updates -->
            <ul class="timeline timeline-alt py-0">

                <li class="timeline-event">
                    <div class="timeline-event-icon bg-modern">
                        <i class="fa fa-briefcase"></i>
                    </div>
                    <div class="timeline-event-block block invisible" data-toggle="appear">
                        <div class="block-header">
                            <h3 class="block-title">تاريخ إنشاء الطلب</h3>
                            <div class="block-options">
                                <div class="timeline-event-time block-options-item font-size-sm">
                                        {{$data->created_at->diffForHumans()}}
                                </div>
                            </div>
                        </div>
                        <div class="block-content block-content-full">
                            <p class="font-w600 mb-2">
                                تاريخ تنفيذ الطلب
                                {{date('Y-m-d',strtotime($data->date)) }}

                            </p>
                            <div class="d-flex">
                                @if(count($data->services) > 0)
                                @forelse ($data->services as $item)
                                <a class="item item-rounded bg-info mr-2" href="{{route('services.show',$item->id)}}">
                                    <img src="{{$item->ImageURL}}" style="width: 65px;
                                    height: 65px;" alt="">
                                </a>
                                @empty

                                @endforelse

                                @endif
                            </div>
                        </div>
                    </div>
                </li>

                <li class="timeline-event">
                    <div class="timeline-event-icon bg-smooth">
                        <i class="fa fa-database"></i>
                    </div>
                    <div class="timeline-event-block block invisible" data-toggle="appear">
                        <div class="block-header">
                            <h3 class="block-title"> اعمال الصالون </h3>
                            <div class="block-options">
                                <div class="timeline-event-time block-options-item font-size-sm">

                                </div>
                            </div>
                        </div>
                        <div class="block-content">
                            <p class="font-w600 mb-2">
                           </p>
                           <div class="d-flex">
                            @if(count($data->salon->works) > 0)
                            @forelse ($data->salon->works as $item)
                            <a class="item item-rounded bg-info mr-2" href="{{route('services.show',$item->id)}}">
                                <img src="{{$item->ImageURL}}" style="width: 65px;
                                height: 65px;" alt="">
                            </a>
                            @empty

                            @endforelse

                            @endif
                        </div>

                        </div>
                    </div>
                </li>


            </ul>
            <!-- END Updates -->
        </div>
        <div class="col-md-5 col-xl-4">
            <!-- Products -->
            <div class="block">
                <div class="block-header block-header-default">
                    <h3 class="block-title">
                        <i class="fa fa-briefcase text-muted mr-1"></i> طريقة دفع الطلب
                    </h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                            <i class="si si-refresh"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                        <div class="media d-flex align-items-center push">
                            <div class="ml-3">
                                <a class="item item-rounded bg-info" href="javascript:void(0)">
                                    <i class="si si-rocket fa-2x text-white-75"></i>
                                </a>
                            </div>
                            <div class="media-body">
                                <div class="font-w800">  {{$data->payment_type}} </div>
                            </div>
                        </div>


                </div>
            </div>
            <!-- END Products -->

        </div>
    </div>
</div>
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
