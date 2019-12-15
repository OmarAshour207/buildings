@extends('admin.layouts.app')

@section('title')
    توليد خريطه الموقع
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                توليد خريطه الموقع
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ url('adminpanel') }}"><i class="fa fa-dashboard"></i> الرئيسيه </a></li>
                <li><a href="{{ url('adminpanel/generate_rss') }}"><i class="fa fa-user"></i> توليد خريطه الموقع </a></li>
            </ol>
        </section>

        <div class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title"> توليد خريطه الموقع </h3>
                        </div>
                        <div class="box-body">
                            <div class="alert alert-warning">
                                تم توليد الخريطه الخاصه بالموقع علي المسار التالي
                                {{ url('/') }}/rss.xml
                                <br>
                                عليك باضافتها لمحركات البحث
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

