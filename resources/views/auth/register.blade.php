<!DOCTYPE html>
<html lang="en" class="body-full-height">
    
<head>        
        <!-- META SECTION -->
        <title> Admin </title>            
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        
        <link rel="icon" href="favicon.ico" type="image/x-icon" />
        <!-- END META SECTION -->
        
        <!-- CSS INCLUDE -->        
        <link rel="stylesheet" type="text/css" id="theme" href="{{asset('public/admin/css/theme-default.css')}}"/>
        <!-- EOF CSS INCLUDE -->                                     
    </head>
    <body>
       
        <div class="login-container lightmode">
        
            <div class="login-box animated fadeInDown">
                <!-- <div class="login-logo"></div> -->
                <br><br><br>
                <div class="login-body">
                    <center><div class="login-title"><strong>Register</strong> your account</div></center>
                    <form action="{{ route('register') }}" class="form-horizontal" method="post">
                    @csrf
                    <div class="form-group">

                        <div class="col-md-12">
                            <select class="form-control{{ $errors->has('role') ? ' is-invalid' : '' }}" name="role" value="{{ old('role') }} " id="role" required="required">
                                    <option value="">Select Role</option>
                                    <option value="admin">Admin</option>
                                    <option value="manager">Manager</option>
                                    <option value="technician">Technician</option>
                                    <option value="client">Client</option>
                                  
                                </select>

                            @if ($errors->has('role'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('role') }}</strong>
                                </span>
                            @endif
                        </div>
                        </div>

                    <div class="form-group">

                            <div class="col-md-12">

                                 <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus placeholder="Enter Name">

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                    </div>
                    <div class="form-group">

                        <div class="col-md-12">
                        
                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus placeholder="Enter Email">

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                        </div>
                    </div>
                    <div class="form-group">

                        <div class="col-md-12">
                        
                        <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" required autofocus placeholder="Enter username">

                                @if ($errors->has('username'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password"    required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6">
                            <!-- <a href="#" class="btn btn-link btn-block">Forgot your password?</a> -->
                        </div>
                        <div class="col-md-6">
                           <button type="submit" class="btn btn-info btn-block">Register</button>
                        </div>
                    </div>
                    <!-- <div class="login-or">OR</div> -->
                    <div class="form-group">
                        <!-- <div class="col-md-4">
                            <button class="btn btn-info btn-block btn-twitter"><span class="fa fa-twitter"></span> Twitter</button>
                        </div>
                        <div class="col-md-4">
                            <button class="btn btn-info btn-block btn-facebook"><span class="fa fa-facebook"></span> Facebook</button>
                        </div>
                        <div class="col-md-4">                            
                            <button class="btn btn-info btn-block btn-google"><span class="fa fa-google-plus"></span> Google</button>
                        </div> -->
                    </div>
                    <!-- <div class="login-subtitle">
                        Don't have an account yet? <a href="#">Create an account</a>
                    </div> -->
                    </form>
                </div>
                <div class="login-footer">
                    <!-- <div class="pull-left">
                        &copy; 2018 AppName
                    </div> -->
                    <!-- <div class="pull-right">
                        <a href="#">About</a> |
                        <a href="#">Privacy</a> |
                        <a href="#">Contact Us</a>
                    </div> -->
                </div>
            </div>
            
        </div>
        
    </body>

</html>






