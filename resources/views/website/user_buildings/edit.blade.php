@extends('layouts.app')

@section('title')
    تعديل عقار {{ $building->name }}
@endsection

@push('home_styles')
    {{--noty--}}
    <link rel="stylesheet" href="{{ asset('dashboard_files/plugins/noty/noty.css') }}">
    <script src="{{ asset('dashboard_files/plugins/noty/noty.min.js') }}"></script>
@endpush

@section('content')
    <div class="container">
        <div class="row-profile">
            <h3 class="h3"> تعديل عقار </h3>
            <div class="col-md-9">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb" style="background-color: #FFF;">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"> الرئيسيه </a></li>
                        <li class="breadcrumb-item active"> تعديل عقار </li>
                    </ol>
                </nav>

                <div class="profile-content">
                    <div class="box-body">

                        @include('admin.partials._errors')

                        <form action="{{ url('edit/building/' . $building->id) }}" method="post" enctype="multipart/form-data">

                            {{ csrf_field() }}
                            {{ method_field('put') }}

                            <div class="form-group">
                                <label> أسم العقار </label>
                                <input type="text" name="name" class="form-control" value="{{ $building->name }}" >
                            </div>

                            <div class="form-group">
                                <label> وصف العقار بالتفصيل  </label>
                                <textarea name="content" class="form-control" placeholder="برجاء الوصف بدقه كل معلومه هي مهمه لدي الزبون " rows="4">
                                    {{ $building->content }}
                                </textarea>
                            </div>


                            <div class="form-group">
                                <label> نوع العقار </label>
                                <select class="form-control" name="type">
                                    <option value=""> أختر النوع </option>
                                    <option value="0" {{ $building->type == 0 ? 'selected' : '' }}> فيلا </option>
                                    <option value="1" {{ $building->type == 1 ? 'selected' : '' }}> شقه </option>
                                    <option value="2" {{ $building->type == 2 ? 'selected' : '' }}> شاليه </option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label> مساحه العقار </label>
                                <input type="text" name="square" class="form-control" value="{{ $building->square }}" >
                            </div>

                            <div class="form-group">
                                <label> ملكيه العقار </label>
                                <select class="form-control" name="rent">
                                    <option value=""> اختر ملكيه العقار </option>
                                    <option value="1" {{ $building->rent == 1 ? 'selected' : '' }}> تمليك </option>
                                    <option value="2" {{ $building->rent == 2 ? 'selected' : '' }}> ايجار </option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label> عدد الغرف </label>
                                <input type="number" name="rooms" class="form-control" value="{{ $building->rooms }}" >
                            </div>

                            <div class="form-group">
                                <label> السعر </label>
                                <input type="text" name="price" class="form-control" value="{{ $building->price }}" >
                            </div>

                            <div class="form-group">
                                <label> كلمات دلاليه </label>
                                <input type="text" name="meta" class="form-control" value="{{ $building->meta }}" >
                            </div>

                            <div class="form-group">
                                <input type="hidden" name="latitude" class="form-control" value="{{ $building->latitude }}" >
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="longitude" class="form-control" value="{{ $building->longitude }}" >
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
                                <img src="{{ $building->imagePath }}" style="width: 100px" class="img-thumbnail image-preview" alt="صوره العقار">
                            </div>

                            <div class="form-group">
                                <button type="submit" class="banner_btn" style="border: none"> <i class="fa fa-edit" style="color: #fff"></i> تعديل </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @include('website.files.sidebar')
    </div>
@endsection

