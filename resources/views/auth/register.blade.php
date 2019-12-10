@extends('layouts.app')

@section('title')
    صفحه تسجيل المستخدم
@endsection

@section('content')
<div class="container">
    <div class="contact_bottom">
        <h3 > تسجيل الدخول </h3>
        <hr>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="form-group">

                <div class="col-md-12 mb-4">
                    <input id="name" type="text" placeholder="الاسم" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }} " style="margin-bottom: 10px" name="name" value="{{ old('name') }}" required autofocus>

                    @if ($errors->has('name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group mb-4">

                <div class="col-md-12">
                    <input id="email" type="email" placeholder="البريد الالكتروني" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" style="margin-bottom: 10px" name="email" value="{{ old('email') }}" required>

                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6">
                    <input id="password-confirm" type="password" placeholder="تأكيد كلة المرور" class="form-control" name="password_confirmation" required>
                </div>
            </div>
            <div class="form-group">

                <div class="col-md-6">
                    <input id="password" type="password" placeholder="كلمة المرور" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                    @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="clearfix"></div>
            <br>

            <div class="form-group">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">
                        تسجيل
                    </button>
                </div>
            </div>
        </form>
    </div>
    <div class="clearfix"></div>
    <br>
</div>
@endsection
