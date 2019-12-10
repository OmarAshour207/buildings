@extends('layouts.app')

@section('title')
    عقار
    {{ $building->name }}
@endsection

@push('home_styles')
    {!! Html::style('website/css/buildings.css') !!}
@endpush

@section('content')
    <div class="container">
    <div class="row-profile">
        <h3 class="h3"> عقار {{ $building->name }} </h3>
        <div class="col-lg-9">

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb" style="background-color: #FFF;">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"> الرئيسيه </a></li>
                    <li class="breadcrumb-item"><a href="{{ url('all_buildings') }}"> كل العقارات </a></li>
                    <li class="breadcrumb-item active"><span> {{ $building->name }} </span></li>

                </ol>
            </nav>

            <div class="profile-content">
                <h1> {{ $building->name }} </h1>
                <hr>

                <a href="/search?name={{ $building->name }}">
                    <span class="btn btn-default">
                        {{ searchNameField()['name']  .' : ' . $building->name }}
                    </span>
                </a>
                <a href="/search?square={{ $building->square }}">
                    <span class="btn btn-default">
                        {{ searchNameField()['name']  . ' : ' . $building->square }}
                    </span>
                </a>
                <a href="/search?rooms={{ $building->rooms }}">
                    <span class="btn btn-default">
                        {{ searchNameField()['rooms']  . ' : ' . $building->rooms   }}
                    </span>
                </a>
                <a href="/search?rent={{ $building->rent }}">
                    <span class="btn btn-default">
                        {{ searchNameField()['rent']  . ' : '  }}
                        {{ $building->rent == 1 ? 'تمليك' :  'ايجار' }}
                    </span>
                </a>

                <a href="/search?type={{ $building->type }}">
                    <span class="btn btn-default">
                        {{ searchNameField()['type']  .' : '   }}
                        @if($building->type == 1)
                            {{ 'شقه' }}
                        @elseif ($building->type == 2)
                            {{ 'فيلا' }}
                        @else
                            {{ 'شاليه' }}
                        @endif
                    </span>
                </a>

                <a href="/search?price_from={{ $building->price }}">
                    <span class="btn btn-default">
                        {{ searchNameField()['price_from']  . ' : ' . $building->price  }}
                    </span>
                </a>

                <span class="btn btn-default">
                    {{ $building->user->name }}
                </span>
                <br>
                <hr>
                <img src="{{ $building->imagePath }}" class="img-responsive">
                <p>
                    {!! nl2br($building->content) !!}
                </p>
                <br>
                <hr>
                <div id="googleMap" style="width:100%;height:400px;"></div>
            </div>

            <br>

                @include('website.files.show_buildings', ['buildings' => $sameRent])
                <hr>
                @include('website.files.show_buildings', ['buildings' => $sameType])

        </div>

        @include('website.files.sidebar')
    </div>
</div>
    <br>
@endsection

@push('home_scripts')
    <script>

        function myMap() {
            var mapProp= {
                center: new google.maps.LatLng( {{ $building->latitude }}, {{ $building->longitude }}),
                zoom:5,
            };
            var map = new google.maps.Map(document.getElementById("googleMap"), mapProp);
            var marker = new google.maps.Marker({
                animation:google.maps.Animation.BOUNCE
            });

            marker.setMap(map);
        }
    </script>

    <script src="https://maps.googleapis.com/maps/api/js?key=&callback=myMap"></script>

@endpush
{{--// AIzaSyBwxuW2cdXbL38w9dcPOXfGLmi1J7AVVB8--}}
