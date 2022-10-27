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
                <img class="img-avatar img-avatar-thumb" src="{{$data->ImageURL}}" alt="">
            </div>
            <h1 class="h2 text-white mb-0">{{$data->name}}</h1>
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
                <div class="font-size-sm font-w600 text-muted text-uppercase">الطلبات</div>
                <a class="link-fx font-size-h3" href="javascript:void(0)">{{$data->orders->count()}}</a>
            </div>
            <div class="col-6 col-md-3">
                <div class="font-size-sm font-w600 text-muted text-uppercase">عدد الخدمات في الطلبات</div>
                @php
                    $ids  = $data->orders()->with('servicesCount')->get();
                    $servicesCount = 0 ;
                    foreach ($ids as $item){
                      $servicesCount +=  $item->servicesCount;
                    }
                @endphp
                <a class="link-fx font-size-h3" href="javascript:void(0)"> {{$servicesCount}}</a>
            </div>
            <div class="col-6 col-md-3">
                <div class="font-size-sm font-w600 text-muted text-uppercase">الشكاوي</div>
                <a class="link-fx font-size-h3" href="javascript:void(0)">{{$data->contacts->count()}}</a>
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
                            <h3 class="block-title">آخر الطلبات</h3>
                            <div class="block-options">
                                <div class="timeline-event-time block-options-item font-size-sm">
                                    @if(count($data->orders) > 0 )
                                        {{$data->orders->last()->created_at->diffForHumans()}}

                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="block-content block-content-full">
                            <p class="font-w600 mb-2">
                                عدد الخدمات  في آخر طلب
                                {{optional($data->orders->last())->servicesCount}}

                            </p>
                            <div class="d-flex">
                                @if(count($data->orders) > 0)
                                @forelse ($data->orders->last()->services as $item)
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
                            <h3 class="block-title">آخر شكوي</h3>
                            <div class="block-options">
                                <div class="timeline-event-time block-options-item font-size-sm">
                                    @if ($data->contacts->last())
                                        {{$data->contacts->last()->created_at}}
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="block-content">
                            <p class="font-w600 mb-2">
                                @if ($data->contacts->last())
                                    {{$data->contacts->last()->message}}
                                @endif
                           </p>
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
                        <i class="fa fa-briefcase text-muted mr-1"></i> آخر الطلبات
                    </h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                            <i class="si si-refresh"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    @forelse ($data->orders->take(4) as $item)
                        <div class="media d-flex align-items-center push">
                            <div class="ml-3">
                                <a class="item item-rounded bg-info" href="javascript:void(0)">
                                    <i class="si si-rocket fa-2x text-white-75"></i>
                                </a>
                            </div>
                            <div class="media-body">
                                <div class="font-w600">{{$item->sub_total}} : الإجمالي </div>
                                <div class="font-size-sm"> التاريخ : {{ date('Y-m-d',strtotime($item->date)) }} </div>
                            </div>
                        </div>
                    @empty

                    @endforelse

                </div>
            </div>
            <!-- END Products -->

            <!-- Ratings -->
            <div class="block">
                <div class="block-header block-header-default">
                    <h3 class="block-title">
                        <i class="fa fa-pencil-alt text-muted mr-1"></i> آخر التقيمات
                    </h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                            <i class="si si-refresh"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    @forelse ($data->userReviews->take(3) as $item)
                        <div class="font-size-sm push">
                            <div class="d-flex justify-content-between mb-2">

                                <div class="text-warning">
                                    @switch($item->review)
                                        @case(1)
                                        <i class="fa fa-star"></i>

                                            @break
                                        @case(2)
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                            @break
                                        @case(3)
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                            @break
                                        @case(4)
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                            @break
                                        @case(5)
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>

                                            @break
                                        @default

                                    @endswitch


                                </div>
                                <div>
                                    <a class="font-w600" href="">{{$item->salon->name}}</a>
                                    <span class="text-muted">(5/{{$item->review}})</span>
                                </div>
                            </div>
                            <p class="mb-0">{{$item->comment}}</p>
                        </div>
                    @empty

                    @endforelse


                </div>
            </div>
            <!-- END Ratings -->

            <!-- Followers -->
            <div class="block">
                <div class="block-header block-header-default">
                    <h3 class="block-title">
                        <i class="fa fa-share-alt text-muted mr-1"></i> آخر الصالونات
                    </h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                            <i class="si si-refresh"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <ul class="nav-items font-size-sm">
                      @forelse ($data->orders->take(3) as $item)

                      <li>
                        <a class="media py-2" href="javascript:void(0)">
                            <div class="mr-3 ml-2 overlay-container overlay-bottom">
                                <img class="img-avatar img-avatar48" src="{{$item->salon->ImageURL}}" alt="">
                                <span class="overlay-item item item-tiny item-circle border border-2x border-white bg-success"></span>
                            </div>
                            <div class="media-body">
                                <div class="font-w600">{{$item->salon->name}}</div>
                                <div class="font-w400 text-muted">{{optional($item->salon->category)->name_ar}}</div>
                            </div>
                        </a>
                    </li>

                      @empty

                      @endforelse


                    </ul>

                </div>
            </div>
            <!-- END Followers -->
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
