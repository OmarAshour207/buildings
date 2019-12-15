@extends('layouts.app')

@section('title')
    أضافه عقار
@endsection

@push('home_styles')
    {{--noty--}}
    <link rel="stylesheet" href="{{ asset('dashboard_files/plugins/noty/noty.css') }}">
    <script src="{{ asset('dashboard_files/plugins/noty/noty.min.js') }}"></script>
@endpush

@section('content')
    <div class="container">
        <div class="row-profile">
            <h3 class="h3"> أضافه عقار </h3>
            <div class="col-md-9">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb" style="background-color: #FFF;">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}" title="الرئيسيه"> الرئيسيه </a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('store.create') }}" title="أضافه عقار"> أضافه عقار </a></li>
                    </ol>
                </nav>

                <div class="profile-content">
                    <div class="box-body">

                        @include('admin.partials._errors')

                        <form action="{{ route('store.store') }}" method="post" enctype="multipart/form-data">

                            {{ csrf_field() }}
                            {{ method_field('post') }}

                            <div class="form-group">
                                <label> أسم العقار </label>
                                <input type="text" name="name" class="form-control" value="{{ old('name') }}" >
                            </div>

                            <div class="form-group">
                                <label> وصف العقار بالتفصيل  </label>
                                <textarea name="content" class="form-control" placeholder="برجاء الوصف بدقه كل معلومه هي مهمه لدي الزبون " rows="4">{{ old('content') }}</textarea>
                            </div>


                            <div class="form-group">
                                <label> نوع العقار </label>
                                <select class="form-control" name="type">
                                    <option value=""> أختر النوع </option>
                                    <option value="0"> فيلا </option>
                                    <option value="1"> شقه </option>
                                    <option value="2"> شاليه </option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label> مساحه العقار </label>
                                <input type="text" name="square" class="form-control" value="{{ old('square') }}" >
                            </div>

                            <div class="form-group">
                                <label> ملكيه العقار </label>
                                <select class="form-control" name="rent">
                                    <option value=""> اختر ملكيه العقار </option>
                                    <option value="1"> تمليك </option>
                                    <option value="2"> ايجار </option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label> عدد الغرف </label>
                                <input type="number" name="rooms" class="form-control" value="{{ old('rooms') }}" >
                            </div>

                            <div class="form-group">
                                <label> السعر </label>
                                <input type="text" name="price" class="form-control" value="{{ old('price') }}" >
                            </div>

                            <div class="form-group">
                                <label> كلمات دلاليه </label>
                                <input type="text" name="meta" class="form-control" value="{{ old('meta') }}" >
                            </div>

                            <div class="form-group">
                                <input type="hidden" name="latitude" class="form-control" value="{{ old('latitude') }}" >
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="longitude" class="form-control" value="{{ old('longitude') }}" >
                            </div>

                            <div class="form-group">
                                <label> المنطقه </label>
                                {!! Form::select('place', places(), null, ['class' => 'form-control select-place', 'placeholder' => 'المنطقه']) !!}
                            </div>

                            <div class="form-group">
                                <label> صوره العقار </label>
                                <input type="file" name="image" class="form-control image">
                            </div>

                            <div class="form-group">
                                <img src="{{ asset('uploads/buildings_images/default.png') }}" style="width: 100px" class="img-thumbnail image-preview" alt="صوره العقار" title="صوره العقار">
                            </div>

                            <div class="form-group">
                                <button type="submit" class="banner_btn" style="border: none"> <i class="fa fa-plus" style="color: #fff"></i> أضافه </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @include('website.files.sidebar')
    </div>
@endsection

