@extends('admin.layouts.app')
@section('main-content')


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Add user
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('admin.home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="{{ route('user.index') }}">Users</a></li>
                <li class="active">Create</li>
            </ol>
        </section>



        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-12">

                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Users</h3>
                        </div>
                        <!-- /.box-header -->

                        <!-- form start -->
                        <form role="form" method="post" action="{{ route('user.store') }}">
                            {{csrf_field()}}
                            <div class="box-body">
                                @include('includes.messages')
                                <div class="col-md-offset-3 col-md-6">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="eg Margaret Wambui Mwangi" value="{{ old('name') }}" required="required">
                                    </div>

                                    <div class="form-group">
                                        <label for="name">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter email address" value="{{ old('email') }}" required="required">
                                    </div>

                                    <div class="form-group">
                                        <label for="name">Phone number</label>
                                        <input type="text" class="form-control" id="mobile" name="phone" placeholder="eg +254707338839" value="{{ old('phone') }}" required="required">
                                    </div>

                                    <div class="form-group">
                                        <label for="slug">Password</label>
                                        <input type="password" class="form-control"  name="password" placeholder="Initial password"  required="required">
                                    </div>

                                    <div class="form-group">
                                        <label for="slug">Confirm password</label>
                                        <input type="password" class="form-control" id="slug" name="password_confirmation" placeholder="Confirm password" required="required">
                                    </div>


                                    <div class="form-group">
                                        <label for="slug">Account status</label><br>
                                        <div class="checkbox">
                                            <label><input type="checkbox" value="1" name="status"
                                                @if(old('status')==1)
                                                    checked
                                                @endif
                                                > Activate</label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Assign role</label>
                                        <div class="row">
                                            @foreach($roles as $role)
                                                <div class="col-md-3">
                                                    <div class="checkbox">
                                                        <label><input type="checkbox" value="{{ $role->id }}" name="role[]"
                                                            @if(old('role')==$role->id)
                                                                checked
                                                            @endif
                                                            >{{ $role->role }}</label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a class="btn btn-warning" href="{{ route('user.index') }}">Back</a>
                            </div>
                        </form>
                    </div>
                    <!-- /.box -->


                </div>
                <!-- /.col-->
            </div>
            <!-- ./row -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection