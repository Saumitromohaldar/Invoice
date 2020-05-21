@extends('layouts.app')

@section('content')

 <div class="login-box">

      <!-- /.login-logo -->
      <div class="login-box-body">
        <div class="login-logo">
            <a href="{{url('/')}}"><img src="{{asset('backend/images/logo.png')}}" alt="Rakib Trade"></a>
        </div>

        <form method="POST" action="{{ route('login') }}">
          {{ csrf_field() }}
          <div class="form-group has-feedback{{ $errors->has('email') ? ' has-error' : '' }}">

            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus placeholder="Email">

            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif

          </div>
          <div class="form-group has-feedback{{ $errors->has('password') ? ' has-error' : '' }}">

             <input id="password" type="password" class="form-control" name="password" placeholder="Password" required>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>

            @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif

          </div>

          <div class="row">
            {{-- <div class="col-xs-8">
              <div class="checkbox icheck">
                <label>
                  <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                </label>
              </div>
            </div> --}}
            <!-- /.col -->
            <div class="col-xs-12">

                <button type="submit" class="btn btn-primary btn-block btn-flat">
                    Login
                </button>
            </div>
            <!-- /.col -->
          </div>

        </form>


      </div>
      <!-- /.login-box-body -->
    </div>
    <!-- /.login-box -->


@endsection
