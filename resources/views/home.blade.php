@extends('layouts.master')
@section('css')
    <!--  Owl-carousel css-->
    {{-- <link href="{{ URL::asset('assets/plugins/owl-carousel/owl.carousel.css') }}" rel="stylesheet" /> --}}
    <!-- Maps css -->
    <link href="{{ URL::asset('assets/plugins/jqvmap/jqvmap.min.css') }}" rel="stylesheet">
@endsection
@section('page-header')
@endsection
@section('content')
    <!-- row -->
    <div class="row row-sm" style="margin-top: 30px">
        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-primary-gradient">
                <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                    <div class="">
                        <h6 class="mb-3 tx-12 text-white">عدد الموظفين</h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                <h4 class="tx-20 font-weight-bold mb-1 text-white">{{ \App\Models\User::count() }}</h4>
                            </div>
                            <span class="float-right my-auto mr-auto">
                                <i class="fas fa-arrow-circle-up text-white"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <span id="compositeline" class="pt-1">5,9,5,6,4,12,18,14,10,15,12,5,8,5,12,5,12,10,16,12</span>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-danger-gradient">
                <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                    <div class="">
                        <h6 class="mb-3 tx-12 text-white">العدد الإجمالي للمساعدات</h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                <h4 class="tx-20 font-weight-bold mb-1 text-white">{{ \App\Models\Assistance::count() }}
                                </h4>
                            </div>
                            <span class="float-right my-auto mr-auto">
                                <i class="fas fa-arrow-circle-down text-white"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <span id="compositeline2" class="pt-1">3,2,4,6,12,14,8,7,14,16,12,7,8,4,3,2,2,5,6,7</span>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-success-gradient">
                <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                    <div class="">
                        <h6 class="mb-3 tx-12 text-white">عدد الجهات المانحة</h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                <h4 class="tx-20 font-weight-bold mb-1 text-white">{{ \App\Models\Donor::count() }}</h4>
                                {{-- <p class="mb-0 tx-12 text-white op-7">Compared to last week</p> --}}
                            </div>
                            <span class="float-right my-auto mr-auto">
                                <i class="fas fa-arrow-circle-up text-white"></i>
                                {{-- <span class="text-white op-7"> 52.09%</span> --}}
                            </span>
                        </div>
                    </div>
                </div>
                <span id="compositeline3" class="pt-1">5,10,5,20,22,12,15,18,20,15,8,12,22,5,10,12,22,15,16,10</span>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-warning-gradient">
                <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                    <div class="">
                        <h6 class="mb-3 tx-12 text-white">عدد المساعدات خلال شهر {{ \Carbon\Carbon::now()->translatedFormat('F') }}
                        </h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                <h4 class="tx-20 font-weight-bold mb-1 text-white">{{ $count }}</h4>
                                {{-- <p class="mb-0 tx-12 text-white op-7">Compared to last week</p> --}}
                            </div>
                            <span class="float-right my-auto mr-auto">
                                <i class="fas fa-arrow-circle-down text-white"></i>
                                {{-- <span class="text-white op-7"> -152.3</span> --}}
                            </span>
                        </div>
                    </div>
                </div>
                <span id="compositeline4" class="pt-1">5,9,5,6,4,12,18,14,10,15,12,5,8,5,12,5,12,10,16,12</span>
            </div>
        </div>
    </div>
    <!-- row closed -->

    <!-- row opened -->
    <div class="row row-sm">
        @if (\App\Models\Assistance::count() > 0)
            <div class="col-md-12 col-lg-12 col-xl-7">
                <div class="card p-3">

                    <h5>المساعدات المستلمة مقارنة بالمساعدات الإجمالية آخر 3 شهور</h5>
                    <div class="card-header bg-transparent pd-b-0 pd-t-20 bd-b-0">

                        <canvas id="myChart"></canvas>

                    </div>

                </div>
            </div>
        @endif
        @if (count($chartDataJson['labels']) > 0)
            <div class="col-md-12 col-lg-12 col-xl-5">
                <div class="card p-3">
                    <h5>مساهمات الجهات المانحة</h5>
                    <div class="card-header bg-transparent pd-b-0 pd-t-20 bd-b-0 flex justify-content-center align-items-center"
                        style="height: 342px">

                        <canvas id="donorContributionsChart"></canvas>

                    </div>

                </div>
            </div>
        @endif

    </div>
    <!-- row closed -->

    <!-- row opened -->
    <div class="row row-sm mb-4">
        @if (\App\Models\Donor::count() > 0)
            <div class="col-xl-6 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header pb-1">
                        {{-- <h3 class="card-title mb-2">Recent Customers</h3> --}}
                        <h3 class="tx-12 mb-0 text-muted">أبرز الجهات المانحة</h3>
                    </div>
                    <div class="card-body p-0 customers mt-1">
                        <div class="list-group list-lg-group list-group-flush">
                            @foreach ($fiveDonors as $donor)
                                <div class="list-group-item list-group-item-action" href="#">
                                    <div class="media mt-0">
                                        <i class="fa-solid fa-gift"></i>
                                        <div class="media-body">
                                            <div class="d-flex align-items-center">
                                                <div class="mt-0">
                                                    <h5 class="mb-1 tx-15">{{ $donor->name }}</h5>
                                                    <p class="mb-0 tx-13 text-muted"><span class="text-success ml-2">عدد
                                                            المساعدات:
                                                            {{ \App\Models\Assistance::where('donor_id', $donor->id)->count() }}</span>
                                                    </p>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        @endif

        <div class="col-xl-6 col-md-12 col-lg-6">
            <div class="card">
                <div class="card-header pb-1">
                    <h3 class="tx-12 mb-0 text-muted">إحصائيات عامة</h3>
                </div>
                <div class="product-timeline card-body pt-2 mt-1">
                    <ul class="timeline-1 mb-0">
                        <li class="mt-0">
                            <i class="ti-user bg-primary-gradient text-white product-icon"></i>
                            <span class="font-weight-semibold mb-4 tx-14 ">عدد المستخدمين</span> <a href="#"
                                class="float-left tx-11 text-muted">{{ \App\Models\User::latest()->first()->created_at->diffForHumans() }}</a>
                            <p class="mb-0 text-muted tx-12">{{ \App\Models\User::count() }}</p>
                        </li>
                        <li class="mt-0">
                            <i class="fas fa-handshake bg-success-gradient text-white product-icon"></i>
                            <span class="font-weight-semibold mb-4 tx-14 ">عدد المساعدات</span> <a href="#"
                                class="float-left tx-11 text-muted">
                                @if (\App\Models\Assistance::count() > 0)
                                    {{ \App\Models\Assistance::latest()->first()->created_at->diffForHumans() }}
                                @endif
                            </a>
                            <p class="mb-0 text-muted tx-12">{{ \App\Models\Assistance::count() }}</p>
                        </li>
                        <li class="mt-0">
                            <i class="ti-bar-chart-alt bg-donors-gradient text-white product-icon"></i>
                            <span class="font-weight-semibold mb-4 tx-14 ">عدد الجهات المانحة</span> <a href="#"
                                class="float-left tx-11 text-muted">
                                @if (\App\Models\Donor::count() > 0)
                                    {{ \App\Models\Donor::latest()->first()->created_at->diffForHumans() }}
                                @endif
                            </a>
                            <p class="mb-0 text-muted tx-12">{{ \App\Models\Donor::count() }}</p>
                        </li>

                    </ul>
                </div>
            </div>
        </div>

    </div>
    <!-- row close -->


    </div>
    </div>
    <!-- Container closed -->
@endsection
@section('js')
    <!--Internal  Chart.bundle js -->
    <script src="{{ URL::asset('assets/plugins/chart.js/Chart.bundle.min.js') }}"></script>
    <!-- Moment js -->
    <script src="{{ URL::asset('assets/plugins/raphael/raphael.min.js') }}"></script>
    <!--Internal  Flot js-->
    <script src="{{ URL::asset('assets/plugins/jquery.flot/jquery.flot.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/jquery.flot/jquery.flot.pie.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/jquery.flot/jquery.flot.resize.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/jquery.flot/jquery.flot.categories.js') }}"></script>
    <script src="{{ URL::asset('assets/js/dashboard.sampledata.js') }}"></script>
    <script src="{{ URL::asset('assets/js/chart.flot.sampledata.js') }}"></script>
    <!--Internal Apexchart js-->
    {{-- <script src="{{ URL::asset('assets/js/apexcharts.js') }}"></script> --}}
    <!-- Internal Map -->
    <script src="{{ URL::asset('assets/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
    <script src="{{ URL::asset('assets/js/modal-popup.js') }}"></script>
    <!--Internal  index js -->
    <script src="{{ URL::asset('assets/js/index.js') }}"></script>
    <script src="{{ URL::asset('assets/js/jquery.vmap.sampledata.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        Chart.defaults.font.size = 16;
        Chart.defaults.font.family = "Cairo";
        // Pass data from Laravel to JavaScript
        const labels = @json($labels);
        const totals = @json($totals);
        const received = @json($received);

        const data1 = {
            labels: labels,
            datasets: [{
                    label: 'المساعدات الإجمالية',
                    data: totals,
                    backgroundColor: 'rgba(54, 162, 235, 0.5)', // Blue
                },
                {
                    label: 'المساعدات المستلمة',
                    data: received,
                    backgroundColor: 'rgba(255, 99, 132, 0.5)', // Red
                }
            ]
        };

        const config1 = {
            type: 'bar',
            data: data1,
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1 // Set the step size for the y-axis ticks

                        }
                    }
                }
            }
        }


        const chart1 = new Chart(
            document.getElementById('myChart'),
            config1
        );

        const chartData = @json($chartDataJson);


        const data2 = {
            labels: chartData.labels, // Donor names
            datasets: [{
                label: 'المساعدات الإجمالية',
                data: chartData.data, // Total number of assistances per donor
                backgroundColor: [
                    'rgba(255, 99, 132, 0.5)', // Red
                    'rgba(75, 192, 192, 0.5)', // Green
                    'rgba(54, 162, 235, 0.5)', // Blue
                    'rgba(153, 102, 255, 0.5)' // Purple (for "Other")
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)', // Red
                    'rgba(75, 192, 192, 1)', // Green
                    'rgba(54, 162, 235, 1)', // Blue
                    'rgba(153, 102, 255, 1)' // Purple (for "Other")
                ],
                borderWidth: 1
            }]
        };

        const config2 = {
            type: 'doughnut',
            data: data2,
            options: {
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const total = context.dataset.data.reduce((a, b) => a + b,
                                    0); // Total of all values
                                const value = context.dataset.data[context
                                    .dataIndex]; // Correct way to access the value
                                const percentage = ((value / total) * 100).toFixed(2); // Calculate percentage
                                return `${context.label}: ${percentage}% (${value})`; // Return the percentage and value in the tooltip
                            }
                        }
                    }
                }
            }
        };

        const chart2 = new Chart(
            document.getElementById('donorContributionsChart'),
            config2
        );
    </script>
@endsection
