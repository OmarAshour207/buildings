@extends('admin.layouts.app')

@section('title')
    الصفحة الرئيسيه
@endsection

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>الصفحة الرئيسيه</h1>

            <ol class="breadcrumb">
                <li class="active"><i class="fa fa-dashboard"></i> لصفحة الرئيسيه </li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Info boxes -->
            <div class="row">
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-aqua"><i class="fa fa-user"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text"> عدد الأعضاء </span>
                            <span class="info-box-number"> {{ $usersCount }} </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-green"><i class="fa fa-building-o"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text"> العقارات المفعله </span>
                            <span class="info-box-number"> {{ provedBuildings() }} </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->

                <!-- fix for small devices only -->
                <div class="clearfix visible-sm-block"></div>

                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-red"><i class="fa fa-building"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text"> العقارات الغير مفعله </span>
                            <span class="info-box-number"> {{ waitingBuildings() }} </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-yellow"><i class="fa fa-envelope-o"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text"> عدد الرسائل </span>
                            <span class="info-box-number"> {{ $contactCount }} </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <div class="row">
                <div class="col-md-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title"> تقرير بعدد العقارات </h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown">
                                        <i class="fa fa-wrench"></i></button>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="#">Action</a></li>
                                        <li><a href="#">Another action</a></li>
                                        <li><a href="#">Something else here</a></li>
                                        <li class="divider"></li>
                                        <li><a href="#">Separated link</a></li>
                                    </ul>
                                </div>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="text-center">
                                        <strong> عدد العقارات في خلال الفتره : يناير 2019 و الفتره ديسمبر 2019 </strong>
                                    </p>

                                    <div class="chart">
                                        <!-- Sales Chart Canvas -->
                                        <canvas id="salesChart" style="height: 180px;"></canvas>
                                    </div>
                                    <!-- /.chart-responsive -->
                                </div>

                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </div>

                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- Main row -->
            <div class="row">
                <!-- Left col -->
                <div class="col-md-8">
                    <!-- MAP & BOX PANE -->
                    <div class="box box-success">
                        <div class="box-header with-border">
                            <h3 class="box-title"> أماكن العقارات </h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body no-padding">
                            <div class="row">
                                <div class="col-md-9 col-sm-8">
                                    <div class="pad">
                                        <!-- Map will be created here -->
                                        <div id="world-map-markers" style="height: 325px;"></div>
                                    </div>
                                </div>
                                <!-- /.col -->
                                <div class="col-md-3 col-sm-4">
                                    <div class="pad box-pane-right bg-green" style="min-height: 280px">
                                        <div class="description-block margin-bottom">
                                            <h5 class="description-header"> {{ provedBuildings() }} </h5>
                                            <span class="description-text"> المفعل </span>
                                        </div>
                                        <!-- /.description-block -->
                                        <div class="description-block margin-bottom">
                                            <h5 class="description-header"> {{ unProvedBuildings() }} </h5>
                                            <span class="description-text"> الغير مفعل </span>
                                        </div>
                                        <!-- /.description-block -->
                                        <div class="description-block">
                                            <h5 class="description-header"> {{ provedBuildings() + unProvedBuildings() }} </h5>
                                            <span class="description-text"> كل العقارات </span>
                                        </div>
                                        <!-- /.description-block -->
                                    </div>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                    <div class="row">

                        <div class="col-md-12">
                            <!-- USERS LIST -->
                            <div class="box box-danger">
                                <div class="box-header with-border">
                                    <h3 class="box-title"> أخر الأعضاء </h3>

                                    <div class="box-tools pull-right">
                                        <span class="label label-danger"> {{ $latestUsers->count() }} أعضاء جدد</span>
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body no-padding">
                                    <ul class="users-list clearfix">
                                        @foreach($latestUsers as $user)
                                            <li>
                                                <img src="{{ $user->imagePath }}" alt="{{ $user->name }}">
                                                <a class="users-list-name" href="{{ route('users.edit', $user->id) }}"> {{ $user->name }} </a>
                                                <span class="users-list-date"> {{ date('D', strtotime($user->created_at)) }} </span>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <!-- /.users-list -->
                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer text-center">
                                    <a href="{{ route('users.index') }}" class="uppercase"> أظهر كل الأعضاء </a>
                                </div>
                                <!-- /.box-footer -->
                            </div>
                            <!--/.box -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <!-- TABLE: LATEST ORDERS -->
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title"> أخر رسائل الموقع </h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table no-margin">
                                    <thead>
                                    <tr>
                                        <th> ألاسم </th>
                                        <th> الايميل </th>
                                        <th> الموضوع </th>
                                        <th> الحاله </th>
                                        <th> أرسل في </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if($contacts->count() > 0)
                                        @foreach($contacts as $contact)
                                            <tr>
                                                <td><a href="{{ route('contacts.edit', $contact->id) }}"> {{ $contact->name }} </a></td>
                                                <td> {{ $contact->email }} </td>
                                                <td> {{ contact_type()[$contact->subject] }} </td>
                                                <td>
                                                    <a href="{{ route('contacts.edit', $contact->id) }}">
                                                        {!! $contact->view == 0 ? '<i class="fa fa-eye btn btn-danger"></i>' : '<i class="fa fa-eye btn btn-success"></i>' !!}
                                                    </a>
                                                </td>
                                                <td> {{ $contact->created_at }} </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <div class="alert alert-danger text-center">
                                            لا يوجد اي رسائل
                                        </div>
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer clearfix">
                            <a href=" {{ route('contacts.index') }} " class="btn btn-sm btn-default btn-flat pull-right"> أظهر كل ارسائل </a>
                        </div>
                        <!-- /.box-footer -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->

                <div class="col-md-4">
                    <!-- PRODUCT LIST -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title"> أخر العقارات المضافه </h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <ul class="products-list product-list-in-box">
                                @foreach($latestBuildings as $building)
                                    <li class="item">
                                        <div class="product-img">
                                            <img src=" {{ $building->imagePath }} " alt="{{ $building->name }}">
                                        </div>
                                        <div class="product-info">
                                            <a href="{{ route('buildings.edit', $building->id) }}" class="product-title"> {{ $building->name }}
                                                <span class="label label-warning pull-right"> {{ $building->price }} جنيه</span></a>
                                            <span class="product-description">
                                                {{ $building->description }}
                                            </span>
                                        </div>
                                    </li>
                                    <!-- /.item -->
                                @endforeach
                            </ul>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer text-center">
                            <a href="{{ url('adminpanel/buildings') }}" class="uppercase"> عرض كل المباني </a>
                        </div>
                        <!-- /.box-footer -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->

    </div>

@endsection

@push('scripts')
    <script>
        /* jVector Maps
 * ------------
 * Create a world map with markers
 */
        $('#world-map-markers').vectorMap({
            map              : 'world_mill_en',
            normalizeFunction: 'polynomial',
            hoverOpacity     : 0.7,
            hoverColor       : false,
            backgroundColor  : 'transparent',
            regionStyle      : {
                initial      : {
                    fill            : 'rgba(210, 214, 222, 1)',
                    'fill-opacity'  : 1,
                    stroke          : 'none',
                    'stroke-width'  : 0,
                    'stroke-opacity': 1
                },
                hover        : {
                    'fill-opacity': 0.7,
                    cursor        : 'pointer'
                },
                selected     : {
                    fill: 'yellow'
                },
                selectedHover: {}
            },
            markerStyle      : {
                initial: {
                    fill  : '#00a65a',
                    stroke: '#111'
                }
            },
            markers          : [
                @foreach($mapping as $map)
                    { latLng: [ {{ $map->latitude }}, {{ $map->longitude }} ], name: '{{ $map->name }}' },
                @endforeach
            ]
        });

        /* ChartJS
 * -------
 * Here we will create a few charts using ChartJS
 */

        // -----------------------
        // - MONTHLY SALES CHART -
        // -----------------------

        // Get context with jQuery - using jQuery's .get() method.
        var salesChartCanvas = $('#salesChart').get(0).getContext('2d');
        // This will get the first returned node in the jQuery collection.
        var salesChart       = new Chart(salesChartCanvas);

        var salesChartData = {
            labels  : ['يناير', 'فبراير', 'مارس', 'ابريل', 'مايو', 'يونيو', 'يونيه' , 'أغسطس', 'سبتمبر', 'اكتوبر', 'نوفمبر', 'ديسمبر'],
            datasets: [
                {
                    label               : 'العقارات',
                    fillColor           : 'rgba(60,141,188,0.9)',
                    strokeColor         : 'rgba(60,141,188,0.8)',
                    pointColor          : '#3b8bba',
                    pointStrokeColor    : 'rgba(60,141,188,1)',
                    pointHighlightFill  : '#fff',
                    pointHighlightStroke: 'rgba(60,141,188,1)',
                    data                : [
                        @foreach($chart as $char)
                            {{ $char->counting }} ,
                        @endforeach
                    ]
                }
            ]
        };
    </script>
@endpush
