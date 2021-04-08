@extends('court admin.layouts.app')
@section('main-content')


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Add Users
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="{{ route('magistrates.index') }}">magistrates</a></li>
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
                            <h3 class="box-title">magistrates</h3>
                        </div>
                        <!-- /.box-header -->

                        <!-- form start -->
                        <form role="form" method="post" action="{{ route('magistrates.store') }}">
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
                                        <label for="name">Staff id</label>
                                        <input type="text" class="form-control" id="mobile" name="staff_id" placeholder="eg job id" value="{{ old('staff_id') }}" required="required">
                                    </div>

                                    <div class="form-group">
                                        <label for="name">Category</label>
                                        <select name="category" id="category" class="form-control" required="required">
                                            <option value="">Select category</option>
                                            <option value="magistrate">Magistrate</option>
                                            <option value="prosecutor">Prosecutor</option>
                                        </select>
                                    </div>

                                </div>

                            </div>

                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a class="btn btn-warning" href="{{ route('magistrates.index') }}">Back</a>
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
