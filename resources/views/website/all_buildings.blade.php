@extends('layouts.app')

@section('title')
    @if(isset($h1))
        {{ $h1 }}
    @endif

    @if(isset($array) && !empty($array))
        @foreach($array as $key => $value)
            {{ searchNameField()[$key]  }} ->
            @if($key == 'type')
                {{ building_type()[$value-1] }}
            @elseif($key == 'rent')
                {{ $value == 1 ? 'تمليك' : 'ايجار' }}
            @elseif($key == 'place')
                {{ places()[$value-1] }}
            @else
                {{ $value }}
            @endif
        @endforeach
    @endif
@endsection

@section('content')
<div class="container" >
    <div class="row-profile">
        <h3 class="h3">كل العقارات </h3>
        <div class="col-lg-9">
            <h1>
                @if(isset($h1))
                    {{ $h1 }}
                @endif
                @if(isset($array) && !empty($array))
                    @foreach($array as $key => $value)
{{--                            {{ searchNameField()[$key]  }}--}}
                        ->
                        @if($key == 'type')
                            {{ building_type()[$value-1] }}
                        @elseif($key == 'rent')
                            {{ $value == 1 ? 'تمليك' : 'ايجار' }}
                        @elseif($key == 'place')
                            {{ places()[$value-1] }}
                        @else
                            {{ $value }}
                        @endif
                    @endforeach
                @endif
            </h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb" style="background-color: #FFF;">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}" title="الرئيسيه"> الرئيسيه </a></li>
                        @if(isset($h1))
                            <li><a href="{{ url('/') }}" title="{{ $h1 }}"> {{ $h1 }} </a> </li>
                        @endif
                        @if(isset($array) && !empty($array))
                            @foreach($array as $key => $value)
                                <li class="breadcrumb-item">
                                    <a href="{{ url('/search?' . $key . '=' . $value) }}" title="{{ searchNameField()[$key] }}">
{{--                                        {{ searchNameField()[$key]  }} ->--}}
                                        @if($key == 'type')
                                            {{ building_type()[$value-1] }}
                                        @elseif($key == 'rent')
                                            {{ $value == 1 ? 'تمليك' : 'ايجار' }}
                                        @elseif($key == 'place')
                                            {{ places()[$value-1] }}
                                        @else
                                            {{ $value }}
                                        @endif
                                    </a>
                                </li>
                            @endforeach
                        @endif
                    </ol>
                </nav>
                @if(count($buildings) > 0)
                    <div class="profile-content">
                @foreach($buildings as $building)
                    <div class="col-md-4 col-sm-6 pull-right">
                        <div class="product-grid3">
                            <div class="product-image3">
                                <a href="{{  url('/building/' . $building->id) }}" title="{{ $building->name }}">
                                    <img class="pic-1" src="{{ url('uploads/buildings_images/' . $building->image) }}" title="{{ $building->name }}" alt="{{ $building->name }}">
                                    <img class="pic-2" src="{{ url('uploads/buildings_images/' . $building->image) }}" title="{{ $building->name }}" alt="{{ $building->name }}">
                                </a>
                                <ul class="social">
                                    @if($building->status == 0)
                                        <li><a href="{{ url('/building/' . $building->id) }}"><i class="fa fa-eye"></i></a></li>
                                        <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                    @else
                                        <li><i class="fa fa-eye"></i> غير مفعل </li>
                                    @endif
                                </ul>
                                <span class="product-new-label">
                                    {{ $building->rent == 1 ? 'تمليك' : 'ايجار' }}
                                </span>
                            </div>
                            <div class="product-content">
                                <h3 class="title"><a href="{{ url('/building/' . $building->id) }}">{{ $building->name }}</a></h3>
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
                                    @if($building->type == 1)
                                        شقه
                                    @elseif($building->type == 2)
                                        فيلا
                                    @else
                                        شاليه
                                    @endif
                                </div>
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
