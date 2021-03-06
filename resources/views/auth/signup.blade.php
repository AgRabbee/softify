<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Softify| Log in</title>
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
      .register-box {
        margin: 2% auto;
        width: 660px;
    }
    .blink{
            text-align: center;
        }
    .blink a{
            font-size: 36px;
            animation: blink 2.5s ease-in-out  infinite;
        }
    @keyframes blink{
    0%{opacity: 0;font-weight: 0;}
    25%{opacity: .5;font-weight: 400;}
    50%{opacity: 1; font-weight: 500;}
    75%{opacity: .5;font-weight: 400;}
    100%{opacity: 0;font-weight: 0;}
    /* 0%{opacity: 0;}
    50%{opacity: .5;}
    100%{opacity: 1;} */
    }
  </style>
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo blink">
    <a href="{{ url('/') }}">Softify</a>
  </div>

  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">Register here</p>

    <form id="sign_up" method="POST" action="{{ url('/signup') }}">
        {{ csrf_field() }}

        <div class="col-md-12">

            <div class="row px-2">
                <label for="name">Name</label> <span class="text-danger">*</span>
                <div class="input-group mb-3">
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"  autocomplete="name" placeholder="Your name..." required >

                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-user"></span>
                    </div>
                  </div>
                  @error('name')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                </div>
            </div>

            <div class="row px-2">
                <label for="email">Email</label> <span class="text-danger">*</span>
                <div class="input-group mb-3">
                    <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  autocomplete="email" placeholder="Email Address..." required >

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
            </div>

        <div class="row">
            <div class="col-md-6">
                <label for="password">Your Password</label> <span class="text-danger">*</span>
                <div class="input-group mb-3">
                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Password" required>

                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-lock"></span>
                    </div>
                  </div>
                  @error('password')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                </div>
            </div>
            <div class="col-md-6">
                <label for="password_confirmation">Confirm Your Password</label> <span class="text-danger">*</span>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" name="password_confirmation" minlength="6" placeholder="Confirm Password" required>
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-lock"></span>
                    </div>
                  </div>
                </div>
            </div>
        </div>
        <div class="row">
          <!-- /.col -->
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Sign up</button>
          </div>
          <!-- /.col -->
        </div>
    </div>

      </form>

    <div class="col-md-12">
        <div class="social-auth-links text-center">
            <p>- OR -</p>
            <a href="{{ url('auth/facebook') }}" class="btn btn-block btn-primary">
                <i class="fab fa-facebook mr-2"></i>
                Sign up using Facebook
            </a>
            <a href="{{ url('auth/google') }}" class="btn btn-block btn-danger">
                <i class="fab fa-google mr-2"></i>
                Sign up using Google
            </a>
        </div>
    </div>


      <a href="{{ url('/signin') }}" class="text-center mt-3 px-2">I already have a membership</a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="{{ asset('AdminLTE/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
</body>
</html>
