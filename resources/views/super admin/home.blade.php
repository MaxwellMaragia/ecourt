@extends('super admin.layouts.app')

@section('main-content')

    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Dashboard
                <small>Control panel</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Dashboard</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-aqua">
                        <div class="inner">
                            <h3>{{ $stations->count() }}</h3>

                            <p>Police stations</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-home"></i>
                        </div>
                        <a href="{{ route('stations.index') }}" class="small-box-footer">View all <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-green">
                        <div class="inner">
                            <h3>{{ $courts->count() }}</h3>

                            <p>Total courts</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-gavel"></i>
                        </div>
                        <a href="{{ route('courts.index') }}" class="small-box-footer">View all <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-yellow">
                        <div class="inner">
                            <h3>{{ $station_admins->count() }}</h3>

                            <p>Station admins</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-users"></i>
                        </div>
                        <a href="{{ route('station_admins.index') }}" class="small-box-footer">View all <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-red">
                        <div class="inner">
                            <h3>
                                {{ $court_admins->count() }}
                            </h3>

                            <p>Court admins</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-user-circle"></i>
                        </div>
                        <a href="{{ route('court_admins.index') }}" class="small-box-footer">View all <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>

        </section>
        <!-- /.content -->

    </div>

    @endsection
