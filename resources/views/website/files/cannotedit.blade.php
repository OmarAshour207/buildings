@extends('layouts.app')

@section('title')
    هذا العقار ينتظر موافقه الاداره
@endsection

@section('content')
    <div class="container" >
        <div class="row-profile">
            <h3 class="h3"> هذا العقار لا يمكنك التعديل عليه </h3>
            <div class="col-lg-9">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb" style="background-color: #FFF;">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"> الرئيسيه </a></li>
                        <li class="breadcrumb-item active"> العقار لا يمكنك التعديل عليه </li>
                    </ol>
                </nav>
                <div class="alert alert-danger">
                    <b>
                        تنبيه :
                    </b>
                    العقار
                    {{ $building->name }}
                    لا يمكنك التعديل عليه
                </div>

            </div>

            @include('website.files.sidebar')
        </div>

    </div>
    <hr>
@endsection

