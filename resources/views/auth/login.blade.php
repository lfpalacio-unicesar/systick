@extends('layouts.app')

@section('content')

{{-- INICIA NUEVA PLANTILLA --}}
<body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>      

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form method="post" action="{{ route('login') }}">
                {{ csrf_field() }}              
              <h1>...::: SYSTICK :::...</h1>
              <div align="center">
                <IMG src="logocorpo.png" width="327" height="130">
              </div>
              <div>
                <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                    <input type="text" class="form-control" id="username" name="username" placeholder="Usuario" required="" value="{{ old('username') }}" />

                    @if ($errors->has('username'))
                        <span class="help-block">
                            <strong>{{ $errors->first('username') }}</strong>
                        </span>
                    @endif

                </div>
              </div>
              <div>
                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña" required="" />

                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif

                </div>  
              </div>
              <div>
                  <button class="btn btn-default submit" type="submit">Ingresar</button>
                {{-- <a class="btn btn-default submit" href="production/index.html">Ingresar</a> --}}
                {{-- <a class="reset_pass" href="#">¿Olvidó su contraseña?</a> --}}
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <!--
                <p class="change_link">¿Es nuevo en el sitio?
                  <a href="#signup" class="to_register"> Crear cuenta </a>
                </p>
            	-->

                <div class="clearfix"></div>
                <br />

                <div>
                  <!--<i class="fa fa-paw"></i>-->
                  <h2>Sistema de Solicitud de Tickets para Soporte Tecnico</h2>
                  <p>Corporacion Autonoma Regional del Cesar</p>
                  <p>CORPOCESAR</p>
                </div>
              </div>
            </form>
          </section>
        </div>

        <div id="register" class="animate form registration_form">
          <section class="login_content">
            
          </section>
        </div>
      </div>
    </div>
</body>


{{-- INICIA LA PLANTILLA ORIGINAL --}}

{{-- <div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                            <label for="username" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" required autofocus>

                                @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>

                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    Forgot Your Password?
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}
@endsection
