@extends('dashboard.layout.layout')
@section('content')
                    <!-- Quick Overview -->
                    <h2 class="content-heading">Chart.js</h2>
                    <div class="row">
                        <div class="col-xl-6">
                            <!-- Lines Chart -->
                            <div class="block">
                                <div class="block-header">
                                    <h3 class="block-title">Lines</h3>
                                    <div class="block-options">
                                        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                                            <i class="si si-refresh"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="block-content block-content-full text-center">
                                    <div class="py-3">
                                        <!-- Lines Chart Container -->
                                        <canvas class="js-chartjs-lines"></canvas>
                                    </div>
                                </div>
                            </div>
                            <!-- END Lines Chart -->
                        </div>
                        <div class="col-xl-6">
                            <!-- Bars Chart -->
                            <div class="block">
                                <div class="block-header">
                                    <h3 class="block-title">Bars</h3>
                                    <div class="block-options">
                                        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                                            <i class="si si-refresh"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="block-content block-content-full text-center">
                                    <div class="py-3">
                                        <!-- Bars Chart Container -->
                                        <canvas class="js-chartjs-bars"></canvas>
                                    </div>
                                </div>
                            </div>
                            <!-- END Bars Chart -->
                        </div>
                        <div class="col-xl-6">
                            <!-- Radar Chart -->
                            <div class="block">
                                <div class="block-header">
                                    <h3 class="block-title">Radar</h3>
                                    <div class="block-options">
                                        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                                            <i class="si si-refresh"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="block-content block-content-full text-center">
                                    <div class="py-3">
                                        <!-- Radar Chart Container -->
                                        <canvas class="js-chartjs-radar"></canvas>
                                    </div>
                                </div>
                            </div>
                            <!-- END Radar Chart -->
                        </div>
                        <div class="col-xl-6">
                            <!-- Polar Area Chart -->
                            <div class="block">
                                <div class="block-header">
                                    <h3 class="block-title">Polar Area</h3>
                                    <div class="block-options">
                                        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                                            <i class="si si-refresh"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="block-content block-content-full text-center">
                                    <div class="py-3">
                                        <!-- Polar Area Chart Container -->
                                        <canvas class="js-chartjs-polar"></canvas>
                                    </div>
                                </div>
                            </div>
                            <!-- END Polar Area Chart -->
                        </div>
                        <div class="col-xl-6">
                            <!-- Pie Chart -->
                            <div class="block">
                                <div class="block-header">
                                    <h3 class="block-title">Pie</h3>
                                    <div class="block-options">
                                        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                                            <i class="si si-refresh"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="block-content block-content-full text-center">
                                    <div class="py-3">
                                        <!-- Pie Chart Container -->
                                        <canvas class="js-chartjs-pie"></canvas>
                                    </div>
                                </div>
                            </div>
                            <!-- END Pie Chart -->
                        </div>
                        <div class="col-xl-6">
                            <!-- Donut Chart -->
                            <div class="block">
                                <div class="block-header">
                                    <h3 class="block-title">Donut</h3>
                                    <div class="block-options">
                                        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                                            <i class="si si-refresh"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="block-content block-content-full text-center">
                                    <div class="py-3">
                                        <!-- Donut Chart Container -->
                                        <canvas class="js-chartjs-donut"></canvas>
                                    </div>
                                </div>
                            </div>
                            <!-- END Donut Chart -->
                        </div>
                    </div>
                    <!-- END Chart.js Charts -->
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
