@extends('admin.layouts.app')

@section('title')
    أضافه عضو
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                أضافه عضو
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ url('adminpanel') }}"><i class="fa fa-dashboard"></i> الرئيسيه </a></li>
                <li><a href="{{ route('users.index') }}"><i class="fa fa-user"></i> التحكم في الأعضاء </a></li>
                <li class="active"><i class="fa fa-plus"></i>  أضافه عضو </li>
            </ol>
        </section>

        <div class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title"> أضف عضو جديد </h3>
                        </div>
                        <div class="box-body">

                            @include('admin.partials._errors')

                            <form action="{{ route('users.store') }}" method="post" enctype="multipart/form-data">

                                {{ csrf_field() }}
                                {{ method_field('post') }}

                                <div class="form-group">
                                    <label> أسم المستخدم </label>
                                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" >
                                </div>

                                <div class="form-group">
                                    <label>البريد الألكتروني </label>
                                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" >
                                </div>

                                <div class="form-group">
                                    <label>صوره المستخدم </label>
                                    <input type="file" name="image" class="form-control image">
                                </div>

                                <div class="form-group">
                                    <img src="{{ asset('uploads/user_images/default.png') }}" style="width: 100px" class="img-thumbnail image-preview" alt="User Image">
                                </div>

                                <div class="form-group">
                                    <label> كلمة المرور </label>
                                    <input type="password" name="password" class="form-control" >
                                </div>

                                <div class="form-group">
                                    <label> تاكيد كلمة المرور </label>
                                    <input type="password" name="password_confirmation" class="form-control" >
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary"> <i class="fa fa-plus"></i> أضافه </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
