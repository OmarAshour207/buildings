@extends('admin.layouts.app')

@section('title')
    التحكم في الأعضاء
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                 التحكم في المستخدمين
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ url('adminpanel') }}"><i class="fa fa-dashboard"></i> الرئيسيه </a></li>
                <li class="active">المستخدمين</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">المستخدمين</h3>
                        </div>
                        <a href="{{ route('users.create') }}" class="btn btn-primary" style="margin-right: 20px;"> أضافه عضو </a>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="data" class="table table-bordered table-hover dataTable">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>الأسم</th>
                                    <th> البريد الألكتروني </th>
                                    <th> الصوره </th>
                                    <th> عقاراتي </th>
                                    <th>أكشن</th>
                                </tr>
                                </thead>
                                <tbody>

                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>الأسم</th>
                                    <th> البريد الألكتروني </th>
                                    <th> الصوره </th>
                                    <th> عقاراتي </th>
                                    <th>أكشن</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.box-body -->
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

@push('styles')
    {!! Html::style('dashboard_files/css/dataTables.bootstrap.min.css') !!}
@endpush

@push('scripts')
    {!! Html::script('dashboard_files/js/jquery.dataTables.min.js') !!}
    {!! Html::script('dashboard_files/js/dataTables.bootstrap.min.js') !!}
    <!-- DataTables -->

    <script>

        var lastIdx = null;

        $('#data thead th').each(function () {
            if($(this).index() < 5 && $(this).index() != 3 && $(this).index() != 4) {
                var classname = $(this).index();
                var title = $(this).html();
                $(this).html('<input type="text" class="' + classname +'" data-value="' + $(this).index() + '" placeholder="البحث ' +title+'" />');
            }
        });

        var table = $('#data').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('users.data') !!}',
            columns: [
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'email', name: 'email' },
                { data: 'image', name: 'image' },
                { data: 'myBuildings', name: 'myBuildings' },
                { data: 'action', name: '' }
            ],
            language: {
                "url": "{{ asset('dashboard_files/plugins/custom/Arabic.json') }}"
            },
            "stateSave" : false,
            "responsive" :true,
            "order" : [[0, 'desc']],
            "pagingType": "full_numbers",
            aLengthMenu:[
                [25, 50, 75, 100, -1],
                [25, 50, 75, 100, "All"]
            ],
            iDisplayLength: 25,
            fixedHeader: true,

            oTableTools: {
                "aButtons": [
                    {
                        "sExtends": "csv",
                        "sButtonText":"ملف اكسل",
                        "sCharset": "utf16le"
                    },
                    {
                        "sExtends": "copy",
                        "sButtonText":"نسخ المعلومات"
                    },
                    {
                        "sExtends": "csv",
                        "sButtonText":"ملف اكسل",
                        "mColumns": "visible"
                    }
                ],
                "sSwfPath": "{{ asset('dashboard_files/plugins/datatables/swf/copy_csv_xls_pdf.swf') }}"
            },
            "dom": '<"pull-left text-left" T><"pull-right" i><"clearfix"> <"pull-right text-right col-lg-6" f > <"pull-left text-left" l><"clearfix">rt<"pull-right text-right col-lg-6" pi><"pull-left text-left" l><"clearfix"> ',
            initComplete: function ()
            {
                var r = $('#data tfoot tr');
                r.find('th').each(function () {
                    $(this).css('padding', 8);
                });
                $('#data thead').append(r);
                $('#search_0').css('text-align', 'center');
            }
        });

        table.columns().eq(0).each(function (colIdx) {
            $('input', table.column(colIdx).header()).on('keyup change', function () {
                table.column(colIdx).search(this.value).draw();
            });
        });

        table.columns().eq(0).each(function (colIdx) {
            $('select', table.column(colIdx).header()).on('change', function () {
                table.column(colIdx).search(this.value).draw();
            });
            $('select', table.column(colIdx).header()).one('click', function (e) {
                e.stopPropagation();
            });
        });

        $('#data thbody').on('mouseover', 'td', function () {
            var colIdx = table.cell(this).index().column;

            if (colIdx !== lastIdx) {
                $(table.cells().nodes()).removeClass('highlight');
                $(table.column(colIdx).nodes()).addClass('highlight');
            }
        }).on('mouseleave', function () {
            $(table.cells().nodes()).removeClass('highlight');
        });

        // $('#example1').DataTable({
        // 'paging'      : true,
        // 'lengthChange': true,
        // 'searching'   : true,
        // 'ordering'    : true,
        // 'info'        : true,
        // 'autoWidth'   : false
        // });
    </script>
@endpush
