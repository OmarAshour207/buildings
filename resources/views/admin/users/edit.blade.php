@extends('admin.layouts.app')

@section('title')
    تعديل عضو
@endsection

@section('content')
    <div class="content-wrapper">

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                تعديل عضو
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ url('adminpanel') }}"><i class="fa fa-dashboard"></i> الرئيسيه </a></li>
                <li><a href="{{ route('users.index') }}"><i class="fa fa-user"></i> التحكم في الأعضاء </a></li>
                <li class="active"><i class="fa fa-edit"></i>  تعديل عضو </li>
            </ol>
        </section>

        <div class="content">
            <div class="row">
                <div class="col-lg-3">

                    <div class="content">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="box">
                                    <div class="box-header">
                                        <h3 class="box-title"> تعديل بيانات عضو  </h3>
                                    </div>
                                    <div class="box-body">

                                        @include('admin.partials._errors')

                                        <form action="{{ route('users.update', $user->id) }}" method="post" enctype="multipart/form-data">

                                            {{ csrf_field() }}
                                            {{ method_field('put') }}

                                            <div class="form-group">
                                                <label> أسم المستخدم </label>
                                                <input type="text" name="name" class="form-control" value="{{ $user->name }}" >
                                            </div>

                                            <div class="form-group">
                                                <label>البريد الألكتروني </label>
                                                <input type="email" name="email" class="form-control" value="{{ $user->email }}" >
                                            </div>

                                            <div class="form-group">
                                                <label>صوره المستخدم </label>
                                                <input type="file" name="image" class="form-control image">
                                            </div>

                                            <div class="form-group">
                                                <img src="{{  $user->ImagePath }}" style="width: 100px" class="img-thumbnail image-preview" alt="User Image">
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

                <div class="col-md-9">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#activity" data-toggle="tab" aria-expanded="true">عقاراتي المفعله</a></li>
                            <li class=""><a href="#timeline" data-toggle="tab" aria-expanded="false">عقاراتي الغير مفعله</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="activity">
                                @if($approvedBuildings)
                                    <table class="table table-bordered">
                                        <tr>
                                            <td> أسم العقار </td>
                                            <td> أضيف في </td>
                                            <td> نوع العقار </td>
                                            <td> ملكيه العقار </td>
                                            <td> سعر العقار </td>
                                            <td> مساحه العقار </td>
                                            <td> موقع العقار </td>
                                            <td> تغيير حاله العقار </td>
                                        </tr>
                                        @foreach($approvedBuildings as $approvedBuilding)
                                            <tr>
                                                <td>
                                                    <a href="{{ url('adminpanel/buildings/'. $approvedBuilding->id . '/edit') }}">
                                                        {{ $approvedBuilding->name }}
                                                    </a>
                                                </td>
                                                <td>
                                                    {{ $approvedBuilding->created_at }}
                                                </td>
                                                <td>
                                                    {{ building_type()[$approvedBuilding->type] }}
                                                </td>
                                                <td>
                                                    {{ building_rent()[$approvedBuilding->rent] }}
                                                </td>
                                                <td>
                                                    {{ $approvedBuilding->price }}
                                                </td>
                                                <td>
                                                    {{ $approvedBuilding->square }}
                                                </td>
                                                <td>
                                                    {{ places()[$approvedBuilding->place] }}
                                                </td>
                                                <td>
                                                    <a href="{{ url('adminpanel/change_status/'.$approvedBuilding->id.'/0') }}">
                                                          الغاء تفعيل
                                                        <div class="fa fa-close"></div>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>

                                @else
                                    <div class="info info-box"> لا يوجد اي عقارات مفعله لهذا العضو </div>
                                @endif
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="timeline">
                                @if($unapprovedBuildings)
                                    <table class="table table-bordered">
                                        <tr>
                                            <td> أسم العقار </td>
                                            <td> أضيف في </td>
                                            <td> نوع العقار </td>
                                            <td> ملكيه العقار </td>
                                            <td> سعر العقار </td>
                                            <td> مساحه العقار </td>
                                            <td> موقع العقار </td>
                                            <td> تفعيل </td>
                                        </tr>
                                        @foreach($unapprovedBuildings as $unapprovedBuilding)
                                            <tr>
                                                <td>
                                                    <a href="{{ url('adminpanel/buildings/'. $unapprovedBuilding->id . '/edit') }}">
                                                        {{ $unapprovedBuilding->name }}
                                                    </a>
                                                </td>
                                                <td>
                                                    {{ $unapprovedBuilding->created_at }}
                                                </td>
                                                <td>
                                                    {{ building_type()[$unapprovedBuilding->type]  }}
                                                </td>
                                                <td>
                                                    {{ building_rent()[$unapprovedBuilding->rent] }}
                                                </td>
                                                <td>
                                                    {{ $unapprovedBuilding->price }}
                                                </td>
                                                <td>
                                                    {{ $unapprovedBuilding->square }}
                                                </td>
                                                <td>
                                                    {{ places()[$unapprovedBuilding->place] }}
                                                </td>
                                                <td>
                                                    <a href="{{ url('adminpanel/change_status/'.$unapprovedBuilding->id.'/1') }}">
                                                        تفعيل <div class="fa fa-check-circle"></div>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                    <div class="text-center">
                                        {{ $unapprovedBuildings->appends(Request::except('page'))->render() }}
                                    </div>

                                @else
                                    <div class="info info-box"> لا يوجد اي عقارات غير مفعله لهذا العضو </div>
                                @endif
                            </div>
                            <!-- /.tab-pane -->

                        </div>
                        <!-- /.tab-content -->
                    </div>
                    <!-- /.nav-tabs-custom -->
                </div>

            </div>
        </div>
    </div>


@endsection
