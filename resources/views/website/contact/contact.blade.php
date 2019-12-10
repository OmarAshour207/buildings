@extends('layouts.app')

@section('title')
    تواصل معنا
@endsection

@push('home_styles')
<style>
    .jumbotron {
        background: #2ABB9B;
        color: #FFF;
        border-radius: 0px;
    }
    .jumbotron-sm { padding-top: 24px;
        padding-bottom: 24px; }
    .jumbotron small {
        color: #FFF;
    }
    .h1 small {
        font-size: 24px;
    }
    .banner_btn {
        border: none;
    }
</style>
@endpush

@section('content')
    <div class="jumbotron jumbotron-sm">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-lg-12">
                    <h1 class="h1">
                        تواصل معنا <small> تواصل بحريه</small></h1>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                @include('admin.partials._errors')
                <div class="well well-sm">
                    {!! Form::open(['url' => '/adminpanel/contacts', 'method' => 'post']) !!}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">
                                        رساله</label>
                                    <textarea name="message" id="message" class="form-control" rows="9" cols="25" required="required"
                                              placeholder="أكتب رسالتك هنا..."></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">الأسم</label>
                                    <input type="text" name="name" class="form-control" id="name" placeholder="أدخل الأسم" required="required" />
                                </div>
                                <div class="form-group">
                                    <label for="email">
                                        البريد الألكتروني</label>
                                    <div class="input-group">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span>
                                    </span>
                                        <input type="email" name="email" class="form-control" id="email" placeholder="أدخل البريد الألكتروني" value="{{ \Illuminate\Support\Facades\Auth::user() ? \Illuminate\Support\Facades\Auth::user()->email : '' }}" required/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="subject">
                                        الموضوع</label>
                                    <select id="subject" name="subject" class="form-control" required="required">
                                        <option value="" selected="">أختر موضوع :</option>
                                        <option value="1">خدمه عملاء</option>
                                        <option value="2">أقتراحات</option>
                                        <option value="3">دعم التطبيق</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="banner_btn pull-right" id="btnContactUs">
                                    أرسال رساله</button>
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
            <div class="col-md-4">
                <form>
                    <legend><span class="glyphicon glyphicon-globe"></span> مكتبنا</legend>
                    <address>
                        <strong>Twitter, Inc.</strong><br>
                        795 Folsom Ave, Suite 600<br>
                        San Francisco, CA 94107<br>
                        <abbr title="Phone">
                            P:</abbr>
                        (123) 456-7890
                    </address>
                    <address>
                        <strong>البريد الألكتروني</strong><br>
                        <a href="mailto:#">first.last@example.com</a>
                    </address>
                </form>
            </div>
        </div>
    </div>
    <!-- Go to www.addthis.com/dashboard to customize your tools -->
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5db1fcd8dfdeea02"></script>

@endsection
