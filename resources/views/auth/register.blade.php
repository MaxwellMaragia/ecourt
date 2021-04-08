<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ECOURT | Create account</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ asset('admin/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('admin/bower_components/font-awesome/css/font-awesome.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('admin/bower_components/Ionicons/css/ionicons.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('admin/dist/css/AdminLTE.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/iCheck/square/blue.css') }}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <style>
        .file {
            position: relative;
            height: 35px;
        }
        .file > input[type="file"] {
            position: absolute;
            opacity: 0;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0
        }
    </style>
</head>
<body class="hold-transition login-page">
<div class="login-box">

    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Interested in writing articles? register here</p>
        @include('includes.messages')
        <form action="{{ route('register') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group text-center">
                <img src="{{ Storage::url('public/avatar.png') }}" class="img-circle" alt="User Image" id="preview" height="100px" width="100px" onchange="previewImage(this)">
            </div>

            <div class="form-group text-center">
                <div class="file text-center">
                    <label for="avatar" class="btn bg-navy btn-flat"><span class="fa fa-upload"></span>   Browse profile picture</label>
                    <input type="file" name="avatar" accept="image/*" class="form-control" id="avatar" required="required">
                </div>
            </div>
            <div class="form-group has-feedback">
                <input type="text" class="form-control" placeholder="Full names" name="name" required="required" value="{{ old('name') }}">
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="email" class="form-control" placeholder="Email" name="email" required="required" value="{{ old('email') }}">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="tel" class="form-control" placeholder="Mobile number" name="phone" required="required" value="{{ old('phone') }}">
                <span class="glyphicon glyphicon-phone form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control" placeholder="Password" name="password" required="required">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control" placeholder="Retype password" name="password_confirmation" required="required">
                <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
            </div>

            <div class="row">
                <!-- /.col -->
                <div class="col-xs-12">
                    <label>
                            I agree to <a href="{{ url('policy') }}">privacy policy, terms and conditions</a>
                    </label>
                </div>
                <div class="col-lg-12">
                    <button type="submit" class="btn btn-primary btn-block btn-flat" style="margin-bottom:10px;margin-top:5px;">Create account</button>
                </div>
                <!-- /.col -->
                <div class="col-md-12">
                    <a href="{{ route('login') }}" class="text-center" >Back to login</a>
                </div>
            </div>
        </form>
    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="{{ asset('admin/bower_components/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('admin/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- iCheck -->
<script src="{{ asset('admin/plugins/iCheck/icheck.min.js') }}"></script>
<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' /* optional */
        });
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#preview').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#avatar").change(function(){
        readURL(this);
    });
</script>

</body>
</html>
