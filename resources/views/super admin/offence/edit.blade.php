@extends('super admin.layouts.app')
@section('main-content')


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                <small>Edit {{ $offence->offence }}</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="{{ route('offences.index') }}">offences</a></li>
                <li class="active">Edit offence</li>
            </ol>
        </section>



        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-12">

                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Edit</h3>
                        </div>
                        <!-- /.box-header -->

                    <!-- form start -->
                        <form role="form" method="post" action="{{ route('offences.update',$offence->id) }}">
                            {{ csrf_field() }}
                            {{ method_field('PATCH') }}
                            <div class="box-body">
                                @include('includes.messages')
                                <div class="col-md-offset-3 col-md-6">
                                    <div class="form-group">
                                        <label for="name">offence</label>
                                        <input type="text" class="form-control" id="name" name="offence" value="{{ $offence->offence }}" readonly="readonly">
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Fine amount</label>
                                        <input type="number" class="form-control" id="location" name="fine" value="{{ $offence->fine }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Bail amount</label>
                                        <input type="number" class="form-control" id="location" name="bail"value="{{ $offence->bail }}">
                                    </div>
                                </div>

                            </div>

                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a class="btn btn-warning" href="{{ route('offences.index') }}">Back</a>
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
