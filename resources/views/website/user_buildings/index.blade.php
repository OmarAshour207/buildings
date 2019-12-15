@extends('layouts.app')

@section('title')
    عقاراتي
@endsection

@section('content')
    <div class="container" >
        <div class="row-profile">
            <h3 class="h3">كل العقارات </h3>
            <div class="col-lg-9">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb" style="background-color: #FFF;">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"> الرئيسيه </a></li>
                        <li class="breadcrumb-item active"> عقاراتي </li>
                    </ol>
                </nav>
                @if(count($buildings) > 0)
                    <div class="profile-content">
                        @foreach($buildings as $building)
                            <div class="col-md-4 col-sm-6 pull-right">
                                <div class="product-grid3">
                                    <div class="product-image3">
                                        <a href="{{  url('/building/' . $building->id) }}" title="{{ $building->name }}">
                                            <img class="pic-1" src="{{ $building->imagePath }}" title="{{ $building->name }}" alt="{{ $building->name }}">
                                            <img class="pic-2" src="{{ $building->imagePath }}" title="{{ $building->name }}" alt="{{ $building->name }}">
                                        </a>
                                        <ul class="social">
                                            <li><a href="{{ url('/building/' . $building->id) }}" title="{{ $building->name }}"><i class="fa fa-eye"></i></a></li>
                                            <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                        </ul>
                                        <span class="product-new-label">
                                    {{ $building->rent == 1 ? 'تمليك' : 'ايجار' }}
                                </span>
                                    </div>
                                    <div class="product-content">
                                        <h3 class="title"><a href="{{ url('/building/' . $building->id) }}" title="{{ $building->name }}">{{ $building->name }}</a></h3>
                                        <div class="price">
                                            {{ $building->square }} متر مربع
                                        </div>

                                        <ul class="rating">
                                            <li class="fa fa-star"></li>
                                            <li class="fa fa-star"></li>
                                            <li class="fa fa-star"></li>
                                            <li class="fa fa-star disable"></li>
                                            <li class="fa fa-star disable"></li>
                                        </ul>
                                        <hr>
                                        <div class="price">
                                            {{ $building->price }} جنيه
                                        </div>
                                        <div class="price pull-right">
                                            @if($building->type == 0)
                                                شقه
                                            @elseif($building->type == 1)
                                                فيلا
                                            @else
                                                شاليه
                                            @endif
                                        </div>
                                        @if($building->status == 0)
                                            <hr>
                                            <div class="btn btn-danger btn-sm pull-right" role="button">
                                                في أنتظار التفعيل
                                            </div>
                                            <a href="{{ url('/edit/building/' . $building->id  ) }}"><i class="fa fa-edit"></i>
                                                تعديل العقار
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    {{ $buildings->appends(request()->query())->links() }}
                @else
                    <div class="alert alert-danger">
                        لا يوجد عقارات حاليا
                    </div>
                @endif
            </div>

            @include('website.files.sidebar')
        </div>

    </div>
    <hr>
@endsection

@push('home_scripts')
    <script>
        $(document).ready(function() {
            $('.select-place').select2({
                dir: "rtl"
            });
        });
    </script>
@endpush
