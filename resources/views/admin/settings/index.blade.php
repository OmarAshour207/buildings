@extends('admin.layouts.app')

@section('title')
    تعديل اعدادات الموقغ
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                اعدادات الموقع
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ url('adminpanel') }}"><i class="fa fa-dashboard"></i> الرئيسيه </a></li>
                <li class="active"><i class="fa fa-cogs"></i> اعدادات الموقع </li>
            </ol>
        </section>

        <div class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title"> تعديل اعدادات الموقع </h3>
                        </div>
                        <div class="box-body">

                            @include('admin.partials._errors')
                            <form action="{{ route('settings.update', $setting->id) }}" method="post">

                                {{ csrf_field() }}
                                {{ method_field('put') }}

                                <div class="form-group">
                                    <label> أسم الموقع </label>
                                    <input type="text" name="namesetting" class="form-control" value="{{ $setting->namesetting }}" >
                                </div>

                                <div class="form-group">
                                    <label> أسم مميز </label>
                                    <input type="text" name="slug" class="form-control" value="{{ $setting->slug }}" >
                                </div>

                                <div class="form-group">
                                    <label>وصف الموقع </label>
                                    <textarea name="description" class="form-control"> {{ $setting->description }} </textarea>
                                </div>

                                <div class="form-group">
                                    <label> رقم التليفون </label>
                                    <input type="text" name="mobile" class="form-control" value="{{ $setting->mobile }}"> </input>
                                </div>

                                <div class="form-group">
                                    <label> فيسبوك </label>
                                    <input type="text" name="facebook" class="form-control" value="{{ $setting->facebook }}"> </input>
                                </div>

                                <div class="form-group">
                                    <label> انستغرام </label>
                                    <input type="text" name="instagram" class="form-control" value="{{ $setting->instagram }}"> </input>
                                </div>

                                <div class="form-group">
                                    <select>
                                        <option value=""> أختار الحاله </option>
                                        <option value="1" {{ $setting->type == 1 ? 'selected' : ''  }}> يعمل </option>
                                        <option value="2" {{ $setting->type == 2 ? 'selected' : ''  }}> في الصيانه </option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-app"> <i class="fa fa-save"></i> تعديل  </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
