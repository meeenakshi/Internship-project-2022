<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tradio </title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon.png">
    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="./vendor/waves/waves.min.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>

<div id="preloader">
    <div class="sk-three-bounce">
        <div class="sk-child sk-bounce1"></div>
        <div class="sk-child sk-bounce2"></div>
        <div class="sk-child sk-bounce3"></div>
    </div>
</div>

<div id="main-wrapper">

    <div class="authincation section-padding">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-xl-5 col-md-6">
                    <div class="mini-logo text-center my-5">
                        <a href="index.html"><img src="./images/logo.png" alt=""></a>
                    </div>
                    <div class="auth-form card">
                        <div class="card-header justify-content-center">
                            <h4 class="card-title">Sign in</h4>
                        </div>
                        <div class="card-body">
                            <form method="post" name="myform" class="signin_validate" action="otp-1.html">
                                <div class="mb-3">
                                    <label>Email</label>
                                    <input type="email" class="form-control" placeholder="hello@example.com"
                                           name="email">
                                </div>
                                <div class="mb-3">
                                    <label>Password</label>
                                    <input type="password" class="form-control" placeholder="Password"
                                           name="password">
                                </div>
                                <div class="row d-flex justify-content-between mt-4 mb-2">
                                    <div class="mb-3 mb-0">
                                        <label class="toggle">
                                            <input class="toggle-checkbox" type="checkbox">
                                            <span class="toggle-switch"></span>
                                            <span class="toggle-label">Remember me</span>
                                        </label>
                                    </div>
                                    <div class="mb-3 mb-0">
                                        <a href="reset.html">Forgot Password?</a>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-success w-100">Sign in</button>
                                </div>
                            </form>
                            <div class="new-account mt-3">
                                <p>Don't have an account? <a class="text-primary" href="signup.html">Sign
                                        up</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>


<script src="./js/global.js"></script>

<script src="./vendor/waves/waves.min.js"></script>

<script src="./vendor/validator/jquery.validate.js"></script>
<script src="./vendor/validator/validator-init.js"></script>

<script src="./js/scripts.js"></script>
</body>

</html>
