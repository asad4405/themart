<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from wpocean.com/html/tf/themart/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 15 Jun 2023 08:56:28 GMT -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="wpOceans">
    <link rel="shortcut icon" type="image/png" href="{{ asset('frontend/assets') }}/images/favicon.png">
    <title>Themart - eCommerce HTML5 Template</title>
    <link href="{{ asset('frontend/assets') }}/css/themify-icons.css" rel="stylesheet">
    <link href="{{ asset('frontend/assets') }}/css/font-awesome.min.css" rel="stylesheet">
    <link href="{{ asset('frontend/assets') }}/css/flaticon_ecommerce.css" rel="stylesheet">
    <link href="{{ asset('frontend/assets') }}/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('frontend/assets') }}/css/animate.css" rel="stylesheet">
    <link href="{{ asset('frontend/assets') }}/css/owl.carousel.css" rel="stylesheet">
    <link href="{{ asset('frontend/assets') }}/css/owl.theme.css" rel="stylesheet">
    <link href="{{ asset('frontend/assets') }}/css/slick.css" rel="stylesheet">
    <link href="{{ asset('frontend/assets') }}/css/slick-theme.css" rel="stylesheet">
    <link href="{{ asset('frontend/assets') }}/css/swiper.min.css" rel="stylesheet">
    <link href="{{ asset('frontend/assets') }}/css/owl.transitions.css" rel="stylesheet">
    <link href="{{ asset('frontend/assets') }}/css/jquery.fancybox.css" rel="stylesheet">
    <link href="{{ asset('frontend/assets') }}/css/odometer-theme-default.css" rel="stylesheet">
    <link href="{{ asset('frontend/assets') }}/sass/style.css" rel="stylesheet">
    <script src="https://www.google.com/recaptcha/api.js?render={{ env('GOOGLE_RECAPTCHA_KEY') }}"></script>
</head>

<body>

    <!-- start page-wrapper -->
    <div class="page-wrapper">

        <div class="wpo-login-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <form class="wpo-accountWrapper" action="{{ route('customer.logged') }}" method="POST" id="contactUSForm">
                            @csrf
                            <div class="wpo-accountInfo">
                                <div class="wpo-accountInfoHeader">
                                    <a href="{{ route('customer.login') }}"><img
                                            src="{{ asset('frontend/assets') }}/images/logo-2.svg" alt=""></a>
                                    <a class="wpo-accountBtn" href="{{ route('customer.register') }}">
                                        <span class="">Create Account</span>
                                    </a>
                                </div>
                                <div class="image">
                                    <img src="{{ asset('frontend/assets') }}/images/login.svg" alt="">
                                </div>
                                <div class="back-home">
                                    <a class="wpo-accountBtn" href="{{ route('index') }}">
                                        <span class="">Back To Home</span>
                                    </a>
                                </div>
                            </div>
                            <div class="wpo-accountForm form-style">
                                <div class="fromTitle">
                                    <h2>Login</h2>
                                    <p>Sign into your pages account</p>
                                </div>
                                @if (session('reset'))
                                    <div class="alert alert-success">{{ session('reset') }}</div>
                                @endif
                                @if (session('verify_email'))
                                    <div class="alert alert-success">{{ session('verify_email') }}</div>
                                @endif
                                @if (session('verify'))
                                    <div class="alert alert-success">
                                        <span>{{ session('verify') }}</span>
                                        <a href="{{ route('resend.email.verify') }}">Resend Verification Link</a>
                                    </div>
                                @endif
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-12">
                                        <label>Email</label>
                                        <input type="text" id="email" name="email">
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        @error('exists')
                                            <span class="text-danger">{{ $exists }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-12">
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input class="pwd6" type="password" placeholder="" name="password">
                                            <span class="input-group-btn">
                                                <button class="btn btn-default reveal6" type="button"><i
                                                        class="ti-eye"></i></button>
                                            </span>
                                            @error('password')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            @error('wrong')
                                                <span class="text-danger">{{ $wrong }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    @if ($errors->has('g-recaptcha-response'))
                                            <span class="text-danger">{{ $errors->first('g-recaptcha-response') }}</span>
                                        @endif
                                    <div class="col-lg-12 col-md-12 col-12">
                                        <div class="check-box-wrap">

                                            <div class="forget-btn">
                                                <a href="{{ route('forgot.password') }}">Forgot Password?</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-12">
                                        <button type="submit" class="wpo-accountBtn">Login</button>
                                    </div>
                                </div>
                                <h4 class="or"><span>OR</span></h4>
                                <ul class="wpo-socialLoginBtn">
                                    <li><button class="bg-danger" tabindex="0" type="button"><span><i
                                                    class="ti-google"></i></span></button></li>
                                    <li>
                                        <button class="bg-secondary" tabindex="0" type="button"><span><i
                                                    class="ti-github"></i></span></button>
                                    </li>
                                </ul>
                                <p class="subText">Don't have an account? <a
                                        href="{{ route('customer.register') }}">Create free
                                        account</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <!-- end of page-wrapper -->

    <!-- All JavaScript files
    ================================================== -->
    <script src="{{ asset('frontend/assets') }}'/js/jquery.min.js"></script>
    <script src="{{ asset('frontend/assets') }}/js/bootstrap.bundle.min.js"></script>
    <!-- Plugins for this template -->
    <script src="{{ asset('frontend/assets') }}/js/modernizr.custom.js"></script>
    <script src="{{ asset('frontend/assets') }}/js/jquery.dlmenu.js"></script>
    <script src="{{ asset('frontend/assets') }}/js/jquery-plugin-collection.js"></script>
    <!-- Custom script for this template -->
    <script src="{{ asset('frontend/assets') }}/js/script.js"></script>

    <script type="text/javascript">
        $('#contactUSForm').submit(function(event) {
            event.preventDefault();

            grecaptcha.ready(function() {
                grecaptcha.execute("{{ env('GOOGLE_RECAPTCHA_KEY') }}", {
                    action: 'subscribe_newsletter'
                }).then(function(token) {
                    $('#contactUSForm').prepend(
                        '<input type="hidden" name="g-recaptcha-response" value="' + token +
                        '">');
                    $('#contactUSForm').unbind('submit').submit();
                });;
            });
        });
    </script>
</body>

</html>
