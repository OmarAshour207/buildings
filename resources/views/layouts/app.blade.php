<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keyword" content="{{ setting()->slug }}">
    <meta name="keyword" content="{{ setting()->namesetting }}">

    <title>
        {{ setting()->namesetting }}
        | @yield('title')
    </title>
    {!! Html::style('website/css/bootstrap.min.css') !!}
    {!! Html::style('website/css/flexslider.css') !!}
    {!! Html::style('website/css/style.css') !!}
    {!! Html::style('website/css/font-awesome.min.css') !!}

    {!! Html::style('website/css/all_buildings.css') !!}
    {!! Html::style('website/css/sidebar.css') !!}

    {{--    Select2 --}}
    {!! Html::style('dashboard_files/plugins/select2/css/select2.min.css') !!}

    {!! Html::script('website/js/jquery.min.js') !!}

    {{--noty--}}
    <link rel="stylesheet" href="{{ asset('dashboard_files/plugins/noty/noty.css') }}">
    <script src="{{ asset('dashboard_files/plugins/noty/noty.min.js') }}"></script>



    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900' rel='stylesheet' type='text/css'>
    <style>
        *{
        font-family:  'SansSerif' , sans-serif;
        }
    </style>

    <style>
        .dropdown-item {
            margin: 5px;
        }
    </style>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @yield('header')


</head>
<body style="direction: rtl">
    <div class="header">
    <div class="container"> <a class="navbar-brand pull-right" href="{{ url('/') }}" title="الصفحه الرئيسيه"><i class="fa fa-paper-plane"></i> {{ setting()->namesetting }} </a>
        <div class="menu pull-left"> <a class="toggleMenu" href="#"><img src="{{ asset('website/images/nav_icon.png') }}" alt="" /> </a>
            <ul class="nav" id="nav">
                <li class="{{ setActive([''], 'current') }}"><a href="{{ url('/') }}" title="الصفحه الرئيسيه"> الصفحه الرئيسيه <i class="fa fa-home"></i></a></li>
                <li  class="{{ setActive(['all_buildings'], 'current') }}"><a href="{{ url('/all_buildings/كل_العقارات') }}" title="كل العقارات"> كل العقارات <i class="fa fa-building-o"></i></a></li>
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="{{ url('/buy/تمليك') }}" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre title="تمليك">
                        تمليك<span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-right {{ setActive(['search'], 'current') }}" aria-labelledby="navbarDropdown">
                        @foreach(building_type() as $keyType => $type)
                            <li style="display: block"> <a class="dropdown-item" href="{{ url('search/'.str_replace(' ', '_', $type . ' تمليك').'?rent=1&type='.($keyType+1)) }}" title="{{ $type }}"> {{ $type }} </a> </li>
                        @endforeach
                    </ul>
                </li>

                <li class="nav-item dropdown {{ setActive(['search'], 'current') }}">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="{{ url('rent/ايجار') }}" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre title="ايجار">
                        ايجار<span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        @foreach(building_type() as $keyType => $type)
                            <li style="display: block"> <a class="dropdown-item" href="{{ url('search/'. str_replace(' ', '_', $type . ' ايجار') .'?rent=2&type='.($keyType+1)) }}" title="{{ $type }}"> {{ $type }} </a> </li>
                        @endforeach
                    </ul>

                </li>

                <li  class="{{ setActive(['contact']) }}">
                    <a href="{{ url('/contact') }}" title="أتصل بنا"> أتصل بنا <i class="fa fa-phone"></i></a>
                </li>
                @guest
                    <li class="nav-item  {{ setActive(['login']) }}">
                        <a class="nav-link" href="{{ route('login') }}" title="تسجيل الدخول"> تسجيل الدخول <i class="fa fa-arrow-right"></i></a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item {{ setActive(['login']) }}">
                            <a class="nav-link" href="{{ route('register') }}" title="تسجيل عضويه"> تسجيل عضويه <i class="fa fa-home"></i></a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre title="{{ Auth::user()->name }}">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}" title="تسجيل الخروج"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                تسجيل الخروج
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                            <hr>
                            <a class="dropdown-item" href="{{ url('user/profile') }}" title="تعديل معلوماتي الشخصيه">
                                <i class="fa fa-user"></i>
                                تعديل معلوماتي الشخصيه
                            </a>
                            <hr>
                            <a class="dropdown-item"  href="{{ route('store.index') }}"  title="عقاراتي المفعله">
                                <i class="fa fa-building-o"></i>
                                عقاراتي المفعله
                            </a>
                            <hr>
                            <a class="dropdown-item"  href="{{ url('user/unproved/stores') }}" title="عقاراتي الغير مفعله">
                                <i class="fa fa-building-o"></i>
                                عقاراتي الغير مفعله
                            </a>
                            <hr>
                            <a class="dropdown-item"  href="{{ route('store.create') }}" title="أضافه عقار">
                                <i class="fa fa-plus"></i>
                                أضافه عقار
                            </a>
                        </div>
                    </li>
        @endguest
        </div>
        <div class="clear"></div>
            </ul>

        </div>
    </div>
</div>

    @yield('content')

    <div class="footer">
        <div class="footer_bottom">
            <div class="follow-us">
                <a class="fa fa-facebook social-icon" rel="nofollow" href="{{ setting()->facebook }}"></a>
                <a class="fa fa-twitter social-icon" rel="nofollow" href="{{ setting()->facebook }}"></a>
                <a class="fa fa-instagram social-icon" rel="nofollow" href="{{ setting()->instagram }}"></a>
            </div>
            <div class="copy">
                <p>Copyright &copy; 2015 Company Name. Design by <a href="http://www.templategarden.com" rel="nofollow">TemplateGarden</a></p>
            </div>
        </div>
    </div>

    {!! Html::script('website/js/bootstrap.min.js') !!}
    {!! Html::script('website/js/jquery.flexslider.js') !!}
    {!! Html::script('website/js/responsive-nav.js') !!}
    <!-- Go to www.addthis.com/dashboard to customize your tools -->
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5db1fcd8dfdeea02"></script>

    {{--    Select2 --}}
    {!! Html::script('dashboard_files/plugins/select2/js/select2.min.js') !!}

    @stack('home_scripts')

    @include('admin.partials._session')


    <script>
        $(document).ready(function () {

            //delete
            $('.dataTable').on('click', '.delete', function (e) {

                var that = $(this)

                e.preventDefault();

                var n = new Noty({
                    text: "هل أنت متأكد من حذف هذا العضو ؟",
                    type: "warning",
                    killer: true,
                    buttons: [
                        Noty.button("نعم", 'btn btn-success mr-2', function () {
                            that.closest('form').submit();
                        }),

                        Noty.button("لا", 'btn btn-primary mr-2', function () {
                            n.close();
                        })
                    ]
                });

                n.show();

            });//end of delete

            {{--CKEDITOR.config.language =  "{{ app()->getLocale() }}";--}}

        });//end of ready

    </script>
        @yield('footer')

</body>
</html>
