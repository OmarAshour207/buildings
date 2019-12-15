@extends('layouts.app')

@section('title')
    تعديل بيانات العضو {{ $user->name }}
@endsection


@section('content')
    <div class="container">
        <div class="row-profile">
            <h3 class="h3"> تعديل بيانات </h3>
            <div class="col-md-9">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb" style="background-color: #FFF;">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"> الرئيسيه </a></li>
                        <li class="breadcrumb-item active"> تعديل بيانات العضو {{ $user->name }} </li>
                    </ol>
                </nav>

                <div class="profile-content">
                    <div class="box-body">

                        @include('admin.partials._errors')

                        <form action="{{ route('user.profile') }}"  method="post" enctype="multipart/form-data">

                            {{ csrf_field() }}
                            {{ method_field('put') }}

                            <div class="form-group">
                                <label> أسم المستخدم </label>
                                <input type="text" name="name" class="form-control" value="{{ $user->name }}">
                            </div>

                            <div class="form-group">
                                <label>البريد الألكتروني </label>
                                <input type="email" name="email" class="form-control" value="{{ $user->email }}">
                            </div>

                            <div class="form-group">
                                <label>صوره المستخدم </label>
                                <input type="file" name="image" class="form-control image">
                            </div>

                            <div class="form-group">
                                <img src="{{ $user->imagePath }}" style="width: 100px" class="img-thumbnail image-preview" alt="{{ $user->name }}" title="{{ $user->name }}">
                            </div>

                            <div class="form-group">
                                <button type="submit" class="banner_btn" style="border: none"> <i class="fa fa-edit" style="color: #fff"></i> تعديل </button>
                            </div>
                        </form>

                        <hr>
                        <h2> تعديل كلمه المرور </h2>
                        <hr>

                        <form action="{{ route('user.password') }}" method="post">
                            {{ csrf_field() }}
                            {{ method_field('post') }}

                            <div class="form-group">
                                <label> كلمه السر القديمه </label>
                                <input type="password" name="oldpassword" class="form-control">
                                @if($errors->has('oldpassword'))
                                    <span class="help-block">
                                        <strong> {{ $errors->first('oldpassword') }} </strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label> كلمه السر الجديده </label>
                                <input type="password" name="password" class="form-control">
                                @if($errors->has('password'))
                                    <span class="help-block">
                                        <strong> {{ $errors->first('password') }} </strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>اعد كتابه كلمه السر الجديده </label>
                                <input type="password" name="password_confirmation" class="form-control">
                                @if($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong class="danger"> {{ $errors->first('password_confirmation') }} </strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <button type="submit" class="banner_btn" style="border: none"> <i class="fa fa-edit" style="color: #fff"></i>  تعديل كلمه السر </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @include('website.files.sidebar')
    </div>
@endsection

