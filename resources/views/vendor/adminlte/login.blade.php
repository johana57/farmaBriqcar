@extends('adminlte::master')

@section('adminlte_css')
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/plugins/iCheck/square/blue.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/css/auth.css') }}">
    @yield('css')
@stop



<style type="text/css">


    body {
    position: relative;
    background-image:url('{{ asset('images/farmaBriqcarPortada.png') }} ');
    opacity: 0.9;
    background-repeat:no-repeat;
    background-size:100% 115vh;
    }

    .shadow {
        border-radius: 5px;
        -webkit-box-shadow: -16px 10px 5px 0px rgba(0,0,0,0.68);
        -moz-box-shadow: -16px 10px 5px 0px rgba(0,0,0,0.68);
        box-shadow: -16px 10px 5px 0px rgba(0,0,0,0.68);
     }

     .textShadow{
        text-shadow: -5px 3px 4px rgba(150, 150, 150, 0.93);
     }
     
     img {
        opacity: 0.5;
        filter: alpha(opacity=50); /* For IE8 and earlier */
    }
</style>
<body style="background-color:#e8eeec;">
@section('body')
    <div class="login-box" style="width: 35%; min-width: 300px; max-width: 800px; " >
        <!-- /.login-logo -->
        <div class="login-box-body shadow" style="background-color: #fff;">
            <div class="login-logo" >
                <a href="{{ url(config('adminlte.dashboard_url', 'home')) }}" style="color:#000;">{!! config('adminlte.logo', '<b>Admin</b>LTE') !!} <i class="fa fa-medkit"></i></a>
            </div>
            <p class="login-box-msg">{{ trans('adminlte::adminlte.login_message') }}</p>
            <form action="{{ url(config('adminlte.login_url', 'login')) }}" method="post">
                {!! csrf_field() !!}

                <div class="form-group has-feedback {{ $errors->has('username') ? 'has-error' : '' }}">
                    <input type="text" name="username" class="form-control" value="{{ old('username') }}"
                           placeholder="{{ trans('adminlte::adminlte.username') }}">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    @if ($errors->has('username'))
                        <span class="help-block">
                            <strong>{{ $errors->first('username') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group has-feedback {{ $errors->has('password') ? 'has-error' : '' }}">
                    <input type="password" name="password" class="form-control"
                           placeholder="{{ trans('adminlte::adminlte.password') }}">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="row">
<!--                    <div class="col-xs-8">
                        <div class="checkbox icheck">
                            <label>
                                <input type="checkbox" name="remember"> {{ trans('adminlte::adminlte.remember_me') }}
                            </label>
                        </div>
                    </div>-->
                    <!-- /.col -->
                    <div class="col-md-12  " style="text-align:center;">
                        <button type="submit" class="btn btn-primary btn-block " style="text-align:center;">{{ trans('adminlte::adminlte.sign_in') }}
                        </button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
            <div class="auth-links">
<!--                <a href="{{ url(config('adminlte.password_reset_url', 'password/reset')) }}"
                   class="text-center"
                >{{ trans('adminlte::adminlte.i_forgot_my_password') }}</a>-->
                <br>
                @if (config('adminlte.register_url', 'register'))
                    <a href="{{ url(config('adminlte.register_url', 'register')) }}"
                       class="text-center"
                    >{{ trans('adminlte::adminlte.register_a_new_membership') }}</a>
                @endif
            </div>
        </div>
        <!-- /.login-box-body -->
    </div><!-- /.login-box -->
@stop

@section('adminlte_js')
    <script src="{{ asset('vendor/adminlte/plugins/iCheck/icheck.min.js') }}"></script>
    <script>
        $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });
        });
    </script>
    @yield('js')
@stop
