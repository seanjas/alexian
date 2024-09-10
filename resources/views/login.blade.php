<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <title>Login | Alexian Brothers Health and Wellness Center, Inc.</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="CQA Review Center">
        <meta name="author" content="Infinit Soloutions">
        <link rel="shortcut icon" href="{{ asset('images/accounts/icon/icon.png') }}">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="{{ asset('login/css/style.css') }}">
    </head>
    <body>
        @include('sweetalert::alert')
        <section class="ftco-section">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12 col-lg-10">
                        <div class="wrap d-md-flex">
                            <div class="img" style="background-image: url({{ asset('images/accounts/banner/sidebanner.png') }}); width: 480px; height: 515px;">
                            </div>
                            <div class="login-wrap p-4 p-md-4">
                                <div class="d-flex justify-content-center">
                                    <img src="{{ asset('images/accounts/logo/logo.png') }}" class="img-circle elevation-2" style="width:80px;height:80px;" alt="">
                                </div>
                                <div class="d-flex justify-content-center">
                                    <h5 class="text-center" style="color:gray;">Alexian Brothers Health and Wellness Center, Inc.</h5>
                                </div>
                                <p><small>PLEASE LOGIN YOUR ACCOUNT</small></p>
                                @if(session('errorMessage'))
                                    <p style="color:red;"><small>{{ session('errorMessage') }}</small></p>
                                @endif
                               
                                <form method="POST" action="{{ action('App\Http\Controllers\LoginController@validateUser') }}">
                                {{ csrf_field() }}
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="email">E-Mail</label>
                                            <input class="form-control" type="email" name="email" />
                                        </div>
                                        <div class="col-md-12 password">Password</label>
                                            <input class="form-control" type="password" name="password" />
                                        </div>
                                        <div class="col-md-12 col-sm-12 mb-2 mt-2">
                                            <button class="btn btn-secondary btn-block" style="background-color:#313131;color:white;" type="submit"><span class="fa fa-sign-in"></span> Login</button>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 mb-2">
                                            <p class="text-center"><a href="{{ action('App\Http\Controllers\MainController@registration') }}" style="color:#ff6c00">Don't have an account? Register</a></p>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <script src="{{ asset('login/js/jquery.min.js') }}"></script>
        <script src="{{ asset('login/js/popper.js') }}"></script>
        <script src="{{ asset('login/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('login/js/main.js') }}"></script>
    </body>
</html>
