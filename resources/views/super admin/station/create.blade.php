@extends('super admin.layouts.app')
@section('main-content')


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Add police station
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="{{ route('stations.index') }}">Stations</a></li>
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
                            <h3 class="box-title">Stations</h3>
                        </div>
                        <!-- /.box-header -->

                        <!-- form start -->
                        <form role="form" method="post" action="{{ route('stations.store') }}">
                            {{csrf_field()}}
                            <div class="box-body">
                                @include('includes.messages')
                                <div class="col-md-offset-3 col-md-6">
                                    <div class="form-group">
                                        <label for="name">Station name</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="eg Kilimani police station">
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Location</label>
                                        <input type="text" class="form-control" id="location" name="location" placeholder="eg Kilimani">
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Court</label>
                                        <select name="court" id="court" class="form-control" required="required">
                                            <option value="">Select court</option>
                                            @foreach($courts as $court)
                                                <option value="{{ $court->id }}">{{ $court->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                            </div>

                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a class="btn btn-warning" href="{{ route('stations.index') }}">Back</a>
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
