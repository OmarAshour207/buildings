@extends('admin.layouts.app')

@section('title')
    تعديل عقارو
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                تعديل عقار
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ url('adminpanel') }}"><i class="fa fa-dashboard"></i> الرئيسيه </a></li>
                <li><a href="{{ url('adminpanel/buildings') }}"><i class="fa fa-building-o"></i> التحكم في العقارات </a></li>
                <li class="active"><i class="fa fa-edit"></i>  تعديل عقار </li>
            </ol>
        </section>

        <div class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title"> تعديل عقار  </h3>
                        </div>
                        <div class="box-body">

                            <div class="">
                                <div class="col-md-10">
                                    @if($ownerUser == '')
                                        <p> تمت أضافه العقار بواسطه زائر </p>
                                    @else
                                        <p>
                                            الاسم :
                                            {{ $ownerUser->name }}
                                        </p>
                                        <p>
                                            الايميل :
                                            {{ $ownerUser->email }}
                                        </p>
                                    <p>
                                        للمزيد :
                                        <a href="{{ route('users.edit', $ownerUser->id) }}">
                                            أضغط هنا
                                        </a>
                                    </p>
                                    @endif
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <br>
                            @include('admin.partials._errors')

                            <form action="{{ route('buildings.update', $building->id) }}" method="post" enctype="multipart/form-data">

                                {{ csrf_field() }}
                                {{ method_field('put') }}

                                <div class="form-group">
                                    <label> أسم العقار </label>
                                    <input type="text" name="name" class="form-control" value="{{ $building->name }}" >
                                </div>

                                <div class="form-group">
                                    <label> وصف العقار باختصار </label>
                                    <input type="text" name="description" class="form-control" value="{{ $building->description }}" >
                                </div>

                                <div class="form-group">
                                    <label> نوع العقار </label>
                                    <select class="form-control" name="type">
                                        @for($i = 0; $i < 3; $i++)
                                            <option value=""> أختر النوع </option>
                                            <option value="0" {{ $building->type == $i ? 'selected' : '' }}> فيلا </option>
                                            <option value="1" {{ $building->type == $i ? 'selected' : '' }}> شقه </option>
                                            <option value="2" {{ $building->type == $i ? 'selected' : '' }}> شاليه </option>
                                        @endfor
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
                                    <label> وصف العقار بالتفصيل  </label>
                                    <textarea name="content" class="form-control" placeholder="برجاء الوصف بدقه كل معلومه هي مهمه لدي الزبون " rows="4">
                                        {{ $building->content }}
                                    </textarea>
                                    <br>
                                    <div class="alert alert-danger">
                                        *لا يمكن ادخال أكثر من 160 حرف حسب معايير البحث في جوجل
                                    </div>
                                </div>

                                <div class="form-group">
                                    <input type="hidden" name="latitude" class="form-control" value="{{ $building->latitude }}" >
                                </div>
                                <div class="form-group">
                                    <input type="hidden" name="longitude" class="form-control" value="{{ $building->longitude }}" >
                                </div>

                                <div class="form-group">
                                    <div class="form-group">
                                        <label> المنطقه </label>
                                        {!! Form::select('place', places(), null, ['class' => 'form-control select-place', 'placeholder' => 'المنطقه']) !!}
                                    </div>
                                </div>

                                <div class="form-group" >
                                    <label> حاله العقار </label>
                                    <select class="form-control" name="status">
                                        <option value=""> أختر مستخدم </option>
                                        <option value="1" {{ $building->status == 1 ? 'selected' : '' }}> مفعل </option>
                                        <option value="2" {{ $building->status == 2 ? 'selected' : '' }}>في انتظار التفعيل  </option>
                                        <option value="3" {{ $building->status == 3 ? 'selected' : '' }}> غير مفعل </option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label> صوره العقار </label>
                                    <input type="file" name="image" class="form-control image">
                                </div>

                                <div class="form-group">
                                    <img src="{{ $building->imagePath }}" style="width: 100px" class="img-thumbnail image-preview" alt="صوره العقار">
                                </div>

                                <div class="form-group">
                                    <label> المستخدم </label>
                                    <select class="form-control" name="user_id">
                                        <option value=""> أختر مستخدم </option>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}" {{ $user->id == $building->user_id ? 'selected' : '' }}> {{ $user->name }} </option>
                                        @endforeach
                                    </select>
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
