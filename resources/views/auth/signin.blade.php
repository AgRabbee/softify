<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Softify | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css')}}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('AdminLTE/dist/css/adminlte.min.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <style media="screen">
      .login-box{
        margin: 6% auto;
        width: 400px;
    }

    .blink{
    		text-align: center;
    	}
    .blink a{
    		font-size: 34px;
    		animation: blink 2.5s ease-in-out  infinite;
    	}
    @keyframes blink{
    0%{opacity: 0;font-weight: 0;}
    25%{opacity: .5;font-weight: 400;}
    50%{opacity: 1; font-weight: 400;}
    75%{opacity: .5;font-weight: 400;}
    100%{opacity: 0;font-weight: 0;}
    /* 0%{opacity: 0;}
    50%{opacity: .5;}
    100%{opacity: 1;} */
    }

  </style>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo blink">
    <a href="{{url('/')}}">Softify</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">

      @if (count($errors) > 0)
          <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
      @endif

      @if (session()->has('message'))
          <div class="alert alert-{{ session('type') }}">
              {{ session('message') }}
          </div>
      @endif


      <form id="sign_in" method="POST" action="{{ url('signin') }}" class="col-xs-12">
          {{ csrf_field() }}
        <div class="input-group mb-3">
          <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email" required autofocus>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
          @error('email')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password" placeholder="Password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <!-- /.col -->
          <div class="col-12 text-center">
{{--            <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>--}}
              <input type="submit" class="btn btn-primary btn-block btn-flat" value="Sign In">
          </div>
          <!-- /.col -->
        </div>
      </form>

      <div class="social-auth-links text-center mb-3">
        <p>- OR -</p>
        <a href="{{ url('auth/facebook') }}" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
        </a>
        <a href="{{ url('auth/google') }}" class="btn btn-block btn-danger">
          <i class="fab fa-google mr-2"></i> Sign in using Google
        </a>
      </div>
      <!-- /.social-auth-links -->

      <div class="d-flex justify-content-between row m-1">
          <div class="col-xs-6">
              <a href="{{ url('/signup') }}">Sign Up here!</a>
          </div>
      </div>

    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{ asset('AdminLTE/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>


</body>
</html>
