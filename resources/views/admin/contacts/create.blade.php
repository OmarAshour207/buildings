@extends('admin.layouts.app')

@section('title')
    أضافه عضو
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                أضافه عقار
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ url('adminpanel') }}"><i class="fa fa-dashboard"></i> الرئيسيه </a></li>
                <li><a href="{{ route('contacts.index') }}"><i class="fa fa-user"></i> التحكم في المواسلات </a></li>
                <li class="active"><i class="fa fa-plus"></i>  أضافه مواسله </li>
            </ol>
        </section>

        <div class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title"> أضف مراسله جديد </h3>
                        </div>
                        <div class="box-body">

                            @include('admin.partials._errors')

                            <form action="{{ route('contacts.store') }}" method="post">

                                {{ csrf_field() }}
                                {{ method_field('post') }}

                                <div class="form-group">
                                    <label> الاسم </label>
                                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" >
                                </div>

                                <div class="form-group">
                                    <label> البريد الالكتروني </label>
                                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" >
                                </div>

                                <div class="form-group">
                                    <label> نوع الرساله </label>
                                    <select class="form-control" name="subject">
                                        <option value=""> أختر النوع </option>
                                        @foreach(contact_type() as $contact => $key)
                                            <option value="{{ $contact }}"> {{ $key }} </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label> محتوي الرساله </label>
                                    <textarea name="message" class="form-control" rows="4" placeholder="أكتب رسالتك هنا...">{{ old('message') }}</textarea>
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
@push('scripts')

@endpush

