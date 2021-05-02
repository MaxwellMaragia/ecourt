@extends('police/layouts/app')
@section('meta')
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="case listing">
    <meta name="author" content="CODEI SYSTEMS">
    <title>ECOURT | Police portal</title>

@endsection
@section('main-content')
    <main class="margin_main_container">

        <!-- /user_summary -->
        <div class="container margin_60_35">
            <div class="row">
                <div class="col-lg-8">
                    <div class="settings_panel">
                        <h3>Personal settings</h3>
                        <hr>
                        @include('includes.messages')
                        <form role="form" action="{{ route('profile.update',$user->id) }}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            {{ method_field('PATCH') }}
                        <figure>
                            <img src="{{ Storage::url($user->avatar) }}" id="preview" onchange="previewImage(this)" height="100px" width="100px">
                        </figure>
                        <div class="form-group">
                            <label>Edit Photo</label>
                            <div class="fileupload"><input type="file" name="file" id="avatar" accept="image/*"></div>
                        </div>
                        <div class="form-group">
                            <label>Edit Email</label>
                            <input class="form-control" type="email" value="{{ $user->email }}" name="email">
                        </div>
                        <div class="form-group">
                            <label>Edit Full name</label>
                            <input class="form-control" type="text" value="{{ $user->name }}" name="name">
                        </div>
                        <div class="form-group">
                            <label>New Password</label>
                            <input class="form-control" type="password" id="password1" name="password">
                        </div>
                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input class="form-control" type="password" id="password2" name="password_confirmation">
                        </div>


                            <button class="btn_1" type="submit" >Save personal info</button>
                        </form>
                    </div>

                    <!-- /settings_panel -->
                    <!-- /settings_panel -->
                </div>
                <!-- /col -->

            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </main>
@section('footerSection')

    <script type="text/javascript">
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
@endsection
@endsection


