@if(\Illuminate\Support\Facades\Auth::user())
<div class="col-md-3">
    <div class="profile-sidebar">
        <h2 style="padding-right: 10px;"> خيارات العضو </h2>
        <!-- SIDEBAR MENU -->
        <div class="profile-usermenu" style="padding: 10px;">
            <ul class="nav" style="padding-right: 0px;">
                <li class="{{ setActive(['user', 'profile']) }}">
                    <a href="{{ url('user/profile') }}">
                        <i class="fa fa-user"></i>
                        تعديل معلوماتي الشخصيه
                    </a>
                </li>
                <li class="{{ setActive(['store']) }}">
                    <a href="{{ route('store.index') }}">
                        <i class="fa fa-building-o"></i>
                         عقاراتي المفعله
                        <label class="label label-default pull-left">
                            ( {{ provedBuildings() }} )
                        </label>
                    </a>
                </li>
                <li class="{{ setActive(['user', 'unproved', 'stores']) }}">
                    <a href="{{ url('user/unproved/stores') }}">
                        <i class="fa fa-building"></i>
                        عقاراتي الغير مفعله
                       <label class="label label-default pull-left">
                           ( {{ unProvedBuildings() }} )
                       </label>
                    </a>
                </li>
                <li class="{{ setActive(['user']) }}">
                    <a href="{{ route('store.create') }}">
                        <i class="fa fa-plus"></i>
                        أضافه عقار
                    </a>
                </li>
            </ul>
        </div>
        <!-- END MENU -->
    </div>
    <br>
</div>

@endif

<div class="col-md-3 pull-right">
    <div class="profile-sidebar">
        <h2 style="padding-right: 10px;"> خيارات البحث </h2>
        <!-- SIDEBAR MENU -->
        <div class="profile-usermenu" style="padding: 10px;">
            <ul class="nav" style="padding-right: 0px;">
                {{--                        {!! Form::open(['url' => '/search', 'action' => 'GET']) !!}--}}
                <form action="{{ url('/search') }}" method="get">
                    @csrf
                    <li>
                        {!! Form::text('price_from', null, ['class'  => 'form-control', 'placeholder'    => ' سعر العقار من']) !!}
                    </li>
                    <li>
                        {!! Form::text('price_to', null, ['class'  => 'form-control', 'placeholder'    => 'سعر العقار الي']) !!}
                    </li>
                    <li>
                        {!! Form::select('place', places(), null, ['class' => 'form-control select-place', 'placeholder' => 'المنطقه']) !!}
                    </li>
                    <li>
                        {!! Form::text('rooms', null, ['class'  => 'form-control', 'placeholder'    => 'عدد الغرف']) !!}
                    </li>
                    <li>
                        {!! Form::select('type', ['1' => 'شقه', '2' => 'فيلا', '3' => 'شاليه'] ,null, ['class'  => 'form-control', 'placeholder'    => 'نوع العقار']) !!}
                    </li>
                    <li>
                        {!! Form::select('rent', ['2' => 'ايجار', '1' => 'تمليك'] ,null, ['class'  => 'form-control', 'placeholder'    => 'نوع العمليه']) !!}
                    </li>
                    <li>
                        {!! Form::text('square', null, ['class'  => 'form-control', 'placeholder'    => 'المساحه']) !!}
                    </li>
                    <li>
                        <input type="submit" value="بحث" class="banner_btn" style="border: none;">
                    </li>
                </form>
                {{--                        {!! Form::close() !!}--}}
            </ul>
        </div>
        <!-- END MENU -->
    </div>
    <br>
    <div class="profile-sidebar">
        <h2 style="padding-right: 10px;"> خيارات العقارات </h2>
        <!-- SIDEBAR MENU -->
        <div class="profile-usermenu">
            <ul class="nav" style="padding-right: 0px;">
                <li class="{{ setActive(['all_buildings']) }}">
                    <a href="{{ url('/all_buildings') }}">
                        <i class="fa fa-building"></i>
                        كل العقارات
                    </a>
                </li>
                <li class="{{ setActive(['rent']) }}">
                    <a href="{{ url('/rent') }}">
                        <i class="fa fa-calendar"></i>
                        ايجار
                    </a>
                </li>
                <li class="{{ setActive(['buy']) }}">
                    <a href="{{ url('/buy') }}">
                        <i class="fa fa-building-o"></i>
                        تمليك
                    </a>
                </li>
                <li class="{{ setActive(['type', '0']) }}">
                    <a href="{{ url('/type/0') }}">
                        <i class="fa fa-home"></i>
                        الشقق
                    </a>
                </li>
                <li class="{{ setActive(['type', '1']) }}">
                    <a href="{{ url('/type/1') }}">
                        <i class="fa fa-home"></i>
                        الفلل
                    </a>
                </li>
                <li class="{{ setActive(['type', '2']) }}">
                    <a href="{{ url('/type/2') }}">
                        <i class="fa fa-institution"></i>
                        الشاليهات
                    </a>
                </li>
            </ul>
        </div>
        <!-- END MENU -->
    </div>
</div>
