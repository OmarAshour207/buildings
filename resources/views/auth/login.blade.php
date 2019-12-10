@extends('layouts.app')

@section('title')
    صفحه تسجيل الدخول
@endsection

@section('content')

    <div class="container">
        <div class="contact_bottom">
            <h3 > تسجيل الدخول </h3>
            <hr>
            <form method="POST" action="{{ route('login') }}">
                @csrf

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
                <div class="form-group">
                    <div class="col-md-6">
                        <input id="email" type="email" placeholder="البريد الالكتروني" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                        @endif
                    </div>
                </div>
                <div class="clearfix"></div>
                <br>
                <div class="form-group">
                    <div class="col-md-12 offset-md-12">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                                تذكرني
                            </label>
                        </div>
                    </div>
                </div>

                <div class="text2">
                    <div class="col-md-12 offset-md-12">
                        <button type="submit" class="banner_btn" style="border: none">
                            تسجيل الدخول
                        </button>

                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                هل نسيت كلمه المرور ؟
                            </a>
                        @endif
                    </div>
                </div>

            </form>
        </div>
        <div class="clearfix"></div>
        <br>
    </div>
@endsection
