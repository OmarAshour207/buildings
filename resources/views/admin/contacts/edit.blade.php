@extends('admin.layouts.app')

@section('title')
    تعديل الرساله
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                تعديل الرساله
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ url('adminpanel') }}"><i class="fa fa-dashboard"></i> الرئيسيه </a></li>
                <li><a href="{{ route('contacts.index') }}"><i class="fa fa-building-o"></i> التحكم في الرسايل </a></li>
                <li class="active"><i class="fa fa-edit"></i>  تعديل عقار </li>
            </ol>
        </section>

        <div class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title"> تعديل الرساله  </h3>
                        </div>
                        <div class="box-body">

                            @include('admin.partials._errors')

                            <form action="{{ route('contacts.update', $contact->id) }}" method="post">

                                {{ csrf_field() }}
                                {{ method_field('put') }}

                                <div class="form-group">
                                    <label> الاسم </label>
                                    <input type="text" name="name" class="form-control" value="{{ $contact->name }}" >
                                </div>

                                <div class="form-group">
                                    <label> البريد الالكتروني </label>
                                    <input type="email" name="email" class="form-control" value="{{ $contact->email }}" >
                                </div>

                                <div class="form-group">
                                    <label> نوع الرساله </label>
                                    <select class="form-control" name="subject">
                                        <option value=""> أختر النوع </option>
                                        @foreach(contact_type() as $contact_type => $key)
                                            <option value="{{ $contact_type }}" {{ $contact_type == $contact->subject ? 'selected' : '' }}> {{ $key }} </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label> محتوي الرساله </label>
                                    <textarea name="message" class="form-control" rows="4" placeholder="أكتب رسالتك هنا...">{{ $contact->message }}</textarea>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary"> <i class="fa fa-edit"></i> تعديل </button>
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
    <script>
        $(document).ready(function() {
            $('.select-place').select2({
                dir: "rtl"
            });
        });
    </script>
@endpush
