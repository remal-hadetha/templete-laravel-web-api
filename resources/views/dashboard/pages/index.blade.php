@extends('dashboard.layout.layout')
@section('content')
                    <!-- Quick Overview -->
                    <div class="row">
                        <div class="col-6 col-lg-3">
                            <a class="block block-link-shadow text-center" href="javascript:void(0)">
                                <div class="block-content block-content-full">
                                    <div class="font-size-h2 text-primary">{{ \App\Models\Order::where('status','pending')->count() }}</div>
                                </div>
                                <div class="block-content py-2 bg-body-light">
                                    <p class="font-w600 font-size-sm text-muted mb-0">
                                        طلبات قيد الانتظار
                                    </p>
                                </div>
                            </a>
                        </div>
                        <div class="col-6 col-lg-3">
                            <a class="block block-link-shadow text-center" href="javascript:void(0)">
                                <div class="block-content block-content-full">
                                    <div class="font-size-h2 text-dark">{{ \App\Models\Order::where('status','inprogress')->orWhere('status','inway')->count()  }}</div>
                                </div>
                                <div class="block-content py-2 bg-body-light">
                                    <p class="font-w600 font-size-sm text-muted mb-0">
                                        طلبات قيد التنفيذ
                                    </p>
                                </div>
                            </a>
                        </div>

                        <div class="col-6 col-lg-3">
                            <a class="block block-link-shadow text-center" href="javascript:void(0)">
                                <div class="block-content block-content-full">
                                    <div class="font-size-h2 text-success">{{ \App\Models\Order::where('status','delevired')->count() }}</div>
                                </div>
                                <div class="block-content py-2 bg-body-light">
                                    <p class="font-w600 font-size-sm text-muted mb-0">
                                        طلبات منتهيه
                                    </p>
                                </div>
                            </a>
                        </div>

                        <div class="col-6 col-lg-3">
                            <a class="block block-link-shadow text-center" href="javascript:void(0)">
                                <div class="block-content block-content-full">
                                    <div class="font-size-h2 text-dark">{{ \App\Models\Order::where('status','delevired')->get()->sum('total') }} س.ر</div>
                                </div>
                                <div class="block-content py-2 bg-body-light">
                                    <p class="font-w600 font-size-sm text-muted mb-0">
                                        إجمالي التحصيل من الطلبات
                                    </p>
                                </div>
                            </a>
                        </div>
                    </div>
                    <!-- END Quick Overview -->

                    <!-- Orders Overview -->
                    <div class="block">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">تقرير الطلبات</h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                                    <i class="si si-refresh"></i>
                                </button>
                            </div>
                        </div>
                        <div class="block-content block-content-full" style="min-height: 630px">
                            <!-- Chart.js is initialized in js/pages/be_pages_ecom_dashboard.min.js which was auto compiled from _es6/pages/be_pages_ecom_dashboard.js) -->
                            <!-- For more info and examples you can check out http://www.chartjs.org/docs/ -->
                            <div style="height: 400px;"><canvas class="week-orders-chart"></canvas></div>
                        </div>
                    </div>
                    <!-- END Orders Overview -->

                    <!-- Top Products and Latest Orders -->
                    <div class="row">
                        <div class="col-xl-6">
                            <!-- Top Products -->
                            <div class="block">
                                <div class="block-header block-header-default">
                                    <h3 class="block-title">آخر الطلبات  </h3>
                                    <div class="block-options">
                                        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                                            <i class="si si-refresh"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="block-content">
                                    <table class="table table-borderless table-striped table-vcenter font-size-sm">
                                        <tbody>
                                            @php
                                             $Deliveredorders =  \App\Models\Order::where('status','pending')->get()
                                            @endphp
                                            @forelse ($Deliveredorders as $order)
                                            <tr>
                                                <td class="font-w600 text-center" style="width: 100px;">
                                                    <a href="{{route('orders.show',$order->id)}}">{{$order->id}}</a>
                                                </td>
                                                <td class="d-none d-sm-table-cell">
                                                <a href="{{route('users.show',$order->user_id)}}">{{$order->user->name}}</a>
                                                </td>
                                                <td>
                                                    <span class="badge badge-success">{{$order->total}}</span>
                                                </td>
                                                @php
                                                    $date = $order->created_at->diffForHumans();
                                                @endphp
                                                <td class="font-w600 text-right">{{$date }}</td>
                                            </tr>

                                            @empty
                                                <td colspan="4" class="alert alert-info"> لايوجد طلبات قيد الانتظار  الان </td>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- END Top Products -->
                        </div>
                        <div class="col-xl-6">
                            <!-- Latest Orders -->
                            <div class="block">
                                <div class="block-header block-header-default">
                                    <h3 class="block-title"> آخر الطلبات المنتهية </h3>
                                    <div class="block-options">
                                        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                                            <i class="si si-refresh"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="block-content">
                                    <table class="table table-borderless table-striped table-vcenter font-size-sm">
                                        <tbody>
                                            @php
                                             $Deliveredorders =  \App\Models\Order::where('status','delevired')->get()
                                            @endphp
                                            @forelse ($Deliveredorders as $order)
                                            <tr>
                                                <td class="font-w600 text-center" style="width: 100px;">
                                                    <a href="{{route('orders.show',$order->id)}}">{{$order->id}}</a>
                                                </td>
                                                <td class="d-none d-sm-table-cell">
                                                <a href="{{route('users.show',$order->user_id)}}">{{$order->user->name}}</a>
                                                </td>
                                                <td>
                                                    <span class="badge badge-success">{{$order->total}}</span>
                                                </td>
                                                @php
                                                    $date = $order->created_at->diffForHumans();
                                                @endphp
                                                <td class="font-w600 text-right">{{$date }}</td>
                                            </tr>

                                            @empty
                                                <td colspan="4" class="alert alert-info"> لايوجد طلبات منتهيه حتي الان </td>
                                            @endforelse

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- END Latest Orders -->
                        </div>
                    </div>
                    <!-- END Top Products and Latest Orders -->
@endsection

@section('js')
    <script>
        $(document).ready(function(){
            let chartOverviewCon  = jQuery('.week-orders-chart');
            let chartOverview, chartOverviewOptions, chartOverviewData;
            chartOverviewData = {
            labels: ['{{$label1}}', '{{$label2}}', '{{$label3}}', '{{$label4}}', '{{$label5}}', '{{$label6}}', '{{$label7}}'],
            datasets: [
                {
                    label: 'هذا الإسبوع',
                    fill: true,
                    backgroundColor: 'rgba(132, 94, 247, .3)',
                    borderColor: 'transparent',
                    pointBackgroundColor: 'rgba(132, 94, 247, 1)',
                    pointBorderColor: '#fff',
                    pointHoverBackgroundColor: '#fff',
                    pointHoverBorderColor: 'rgba(132, 94, 247, 1)',
                    data: [ {{$incoming_day1}}  , {{$incoming_day2}}, {{$incoming_day3}}, {{$incoming_day4}}, {{$incoming_day5}}, {{$incoming_day6}}, {{$incoming_day7}}]
                },
                {
                    label: 'الإسبوع الماضي',
                    fill: true,
                    backgroundColor: 'rgba(233, 236, 239, 1)',
                    borderColor: 'transparent',
                    pointBackgroundColor: 'rgba(233, 236, 239, 1)',
                    pointBorderColor: '#fff',
                    pointHoverBackgroundColor: '#fff',
                    pointHoverBorderColor: 'rgba(233, 236, 239, 1)',
                    data: [{{$outcoming_day1}}, {{$outcoming_day2}}, {{$outcoming_day3}}, {{$outcoming_day4}}, {{$outcoming_day5}}, {{$outcoming_day6}}, {{$outcoming_day7}}]
                }
            ]
            };

            if (chartOverviewCon.length) {
                chartOverview = new Chart(chartOverviewCon, {
                    type: 'line',
                    data: chartOverviewData,
                    options: {
                            scales: {
                            yAxes: [{
                                ticks: {
                                beginAtZero: true,
                                reverse: false,
                                stepSize:5,
                                max: 50

                                },
                            }]
                            }
                        }

                });
             }
        });
    </script>
@endsection
