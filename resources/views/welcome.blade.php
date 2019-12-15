@extends('layouts.app')

@section('title')
    أهلا بك أخي الكريم
@endsection

@section('content')
    <div class="banner text-center">
        <div class="container">
            <div class="banner-info">
                <h1> {{ setting()->namesetting }} </h1>
                <p> {{ setting()->description }} <br> </p>
                <p>
                <form action="{{ url('/search') }}" method="get">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 pull-right">
                            {!! Form::text('price_from', null, ['class'  => 'form-control', 'placeholder'    => ' سعر العقار من']) !!}
                        </div>
                        <div class="col-md-6 pull-left">
                            {!! Form::text('price_to', null, ['class'  => 'form-control', 'placeholder'    => 'سعر العقار الي']) !!}
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            {!! Form::select('place', places(), null, ['class' => 'form-control select-place', 'placeholder' => 'المنطقه']) !!}
                        </div>
                    </div>
                    <br>

                    <div class="row">
                        <div class="col-md-6">
                            {!! Form::text('rooms', null, ['class'  => 'form-control ', 'placeholder'    => 'عدد الغرف']) !!}
                        </div>
                        <div class="col-md-6">
                            {!! Form::text('square', null, ['class'  => 'form-control ', 'placeholder'    => 'المساحه']) !!}
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            {!! Form::select('type', ['1' => 'شقه', '2' => 'فيلا', '3' => 'شاليه'] ,null, ['class'  => 'form-control ', 'placeholder'    => 'نوع العقار']) !!}
                        </div>
                        <div class="col-md-6">
                            {!! Form::select('rent', ['2' => 'ايجار', '1' => 'تمليك'] ,null, ['class'  => 'form-control ', 'placeholder'    => 'نوع العمليه']) !!}
                        </div>
                    </div>


                    <input type="submit" value="بحث" class="banner_btn" style="border: none;">

                </form>
                </p>
                <a class="banner_btn" href="{{ route('store.create') }}" title=" أضف عقارك"> أضف عقارك </a> </div>
        </div>
    </div>
    <div class="main">
        <div class="content_white">
            <h2>Featured Services</h2>
            <p>Quisque cursus metus vitae pharetra auctor, sem massa mattis semat interdum magna.</p>
        </div>
        <div class="featured_content" id="feature">
            <div class="container">
                <div class="row text-center">
                    <div class="col-mg-3 col-xs-3 feature_grid1"> <i class="fa fa-cog fa-3x"></i>
                        <h3 class="m_1"><a href="services.html">Legimus graecis</a></h3>
                        <p class="m_2">Lorem ipsum dolor sit amet, facilisis egestas sodales non luctus, sem quas potenti malesuada vel phasellus.</p>
                        <a href="services.html" class="feature_btn">More</a> </div>
                    <div class="col-mg-3 col-xs-3 feature_grid1"> <i class="fa fa-comments-o fa-3x"></i>
                        <h3 class="m_1"><a href="services.html">Mazim minimum</a></h3>
                        <p class="m_2">Lorem ipsum dolor sit amet, facilisis egestas sodales non luctus, sem quas potenti malesuada vel phasellus.</p>
                        <a href="services.html" class="feature_btn">More</a> </div>
                    <div class="col-md-3 col-xs-3 feature_grid1"> <i class="fa fa-globe fa-3x"></i>
                        <h3 class="m_1"><a href="services.html">Modus altera</a></h3>
                        <p class="m_2">Lorem ipsum dolor sit amet, facilisis egestas sodales non luctus, sem quas potenti malesuada vel phasellus.</p>
                        <a href="services.html" class="feature_btn">More</a> </div>
                    <div class="col-md-3 col-xs-3 feature_grid2"> <i class="fa fa-history fa-3x"></i>
                        <h3 class="m_1"><a href="services.html">Melius eligendi</a></h3>
                        <p class="m_2">Lorem ipsum dolor sit amet, facilisis egestas sodales non luctus, sem quas potenti malesuada vel phasellus.</p>
                        <a href="services.html" class="feature_btn">More</a> </div>
                </div>
            </div>
        </div>
        <div class="about-info">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="block-heading-two">
                            <h2><span>About Our Company</span></h2>
                        </div>
                        <p>Consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero.</p>
                        <br>
                        <p>Sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p>
                        <a class="banner_btn" href="about.html">Read More</a> </div>
                    <div class="col-md-4">
                        <div class="block-heading-two">
                            <h3><span>Our Advantages</span></h3>
                        </div>
                        <div class="panel-group" id="accordion-alt3">
                            <div class="panel">
                                <div class="panel-heading">
                                    <h4 class="panel-title"> <a data-toggle="collapse" data-parent="#accordion-alt3" href="#collapseOne-alt3"> <i class="fa fa-angle-right"></i> Quisque cursus metus vitae pharetra auctor</a> </h4>
                                </div>
                                <div id="collapseOne-alt3" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <p>Consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="panel">
                                <div class="panel-heading">
                                    <h4 class="panel-title"> <a data-toggle="collapse" data-parent="#accordion-alt3" href="#collapseTwo-alt3"> <i class="fa fa-angle-right"></i> Duis autem vel eum iriure dolor in hendrerit</a> </h4>
                                </div>
                                <div id="collapseTwo-alt3" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <p>Consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="panel">
                                <div class="panel-heading">
                                    <h4 class="panel-title"> <a data-toggle="collapse" data-parent="#accordion-alt3" href="#collapseThree-alt3"> <i class="fa fa-angle-right"></i> Quisque cursus metus vitae pharetra auctor </a> </h4>
                                </div>
                                <div id="collapseThree-alt3" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <p>Consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="panel">
                                <div class="panel-heading">
                                    <h4 class="panel-title"> <a data-toggle="collapse" data-parent="#accordion-alt3" href="#collapseFour-alt3"> <i class="fa fa-angle-right"></i> Duis autem vel eum iriure dolor in hendrerit</a> </a> </h4>
                                </div>
                                <div id="collapseFour-alt3" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <p>Consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="highlight-info">
            <div class="overlay spacer">
                <div class="container">
                    <div class="row text-center">
                        <div class="col-sm-3 col-xs-6"> <i class="fa fa-smile-o fa-5x"></i>
                            <h4>120+ Happy Clients</h4>
                        </div>
                        <div class="col-sm-3 col-xs-6"> <i class="fa fa-check-square-o fa-5x"></i>
                            <h4>600+ Projects Completed</h4>
                        </div>
                        <div class="col-sm-3 col-xs-6"> <i class="fa fa-trophy fa-5x"></i>
                            <h4>25 Awards Won</h4>
                        </div>
                        <div class="col-sm-3 col-xs-6"> <i class="fa fa-map-marker fa-5x"></i>
                            <h4>3 Offices</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="testimonial-area">
            <div class="testimonial-solid">
                <div class="container">
                    <h2>Client Testimonials</h2>
                    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"> <a href="#"></a> </li>
                            <li data-target="#carousel-example-generic" data-slide-to="1" class=""> <a href="#"></a> </li>
                            <li data-target="#carousel-example-generic" data-slide-to="2" class=""> <a href="#"></a> </li>
                            <li data-target="#carousel-example-generic" data-slide-to="3" class=""> <a href="#"></a> </li>
                        </ol>
                        <div class="carousel-inner">
                            <div class="item active">
                                <p>"Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam quis nostrud exerci tation."</p>
                                <p><strong>- John Doe -</strong></p>
                            </div>
                            <div class="item">
                                <p>"Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam quis nostrud exerci tation."</p>
                                <p><strong>- Jane Doe -</strong></p>
                            </div>
                            <div class="item">
                                <p>"Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam quis nostrud exerci tation."</p>
                                <p><strong>- John Smith -</strong></p>
                            </div>
                            <div class="item">
                                <p>"Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam quis nostrud exerci tation."</p>
                                <p><strong>- Linda Smith -</strong></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Go to www.addthis.com/dashboard to customize your tools -->
        <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5db1fcd8dfdeea02"></script>

@endsection
