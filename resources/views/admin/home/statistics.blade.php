@extends('admin.layouts.app')

@section('title')
    أحصائيات أضافه العقارات في سنه {{ $year }}
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                أحصائيات أضافه العقارات في سنه {{ $year }}
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ url('adminpanel') }}"><i class="fa fa-dashboard"></i> الرئيسيه </a></li>
                <li class="active"><i class="fa fa-user"></i>                 أحصائيات أضافه العقارات في سنه {{ $year }} </li>
            </ol>
        </section>

        <div class="content">
            <div class="row">
                <div class="col-md-12">
                    {!! Form::open(['url' => 'adminpanel/building/year/statistics', 'method' => 'post']) !!}
                        <select class="select-year" name="year">
                            <option value=""> أختر السنه </option>
                            @for($i = 2016; $i <= date('Y'); $i++)
                                <option value="{{ $i }}"> {{ $i }} </option>
                            @endfor
                        </select>
                        <input name="submit" type="submit" value="أظهر الاحصائيات" class="btn btn-warning">
                    {!! Form::close() !!}
                    <p class="text-center">
                        <strong> عدد العقارات في خلال الفتره : يناير {{ $year }} و الفتره ديسمبر {{ $year }} </strong>
                    </p>

                    <div class="chart">
                        <!-- Sales Chart Canvas -->
                        <canvas id="salesChart" style="height: 180px;"></canvas>
                    </div>
                    <!-- /.chart-responsive -->
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>

        $(document).ready(function() {
            $('.select-year').select2({
                dir: "rtl"
            });
        });

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
                        @foreach($new as $char)
                            @if(is_array($char))
                                {{ $char['counting'] }} ,
                            @else
                                {{ $char }},
                            @endif
                        @endforeach
                    ]
                }
            ]
        };

    </script>
@endpush

