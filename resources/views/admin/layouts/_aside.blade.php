<aside class="main-sidebar">

    <section class="sidebar">

        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('dashboard_files/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ auth()->guard('admin')->user()->name }}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <ul class="sidebar-menu" data-widget="tree">
            <li>
                <a href="{{ url('/adminpanel') }}"><i class="fa fa-th"></i><span>الصفحة الرئيسيه</span></a>
            </li>
            <li>
                <a href="{{ url('/adminpanel/settings') }}"><i class="fa fa-cogs"></i><span>أعدادات الموقع</span></a>
            </li>
            <li class="treeview">
                <a href="{{ route('users.index') }}">
                    <i class="fa fa-user"></i><span> المستخدمين </span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="{{ route('users.index') }}"><i class="fa fa-user"></i> كل المستخدمين </a>
                    </li>
                    <li>
                        <a href="{{ route('users.create') }}"><i class="fa fa-plus"></i> أضافه مستخدم </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="{{ url('/adminpanel/buildings') }}"><i class="fa fa-building-o"></i><span>العقارات</span></a>
            </li>
            <li>
                <a href="{{ url('/adminpanel/contacts') }}"><i class="fa fa-phone"></i><span> التواصلات </span></a>
            </li>
            <li>
                <a href="{{ url('/adminpanel/building/year/statistics') }}"><i class="fa fa-bar-chart"></i><span> أحصائيه أضافه العقار </span></a>
            </li>
        </ul>


    </section>

</aside>

