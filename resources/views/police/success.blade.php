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
        <div class="container margin_60">
            <div class="row justify-content-center">
                <div class="col-md-5">
                    <div id="confirm">
                        <div class="icon icon--order-success svg add_bottom_15">
                            <svg xmlns="http://www.w3.org/2000/svg" width="72" height="72">
                                <g fill="none" stroke="#8EC343" stroke-width="2">
                                    <circle cx="36" cy="36" r="35" style="stroke-dasharray:240px, 240px; stroke-dashoffset: 480px;"></circle>
                                    <path d="M17.417,37.778l9.93,9.909l25.444-25.393" style="stroke-dasharray:50px, 50px; stroke-dashoffset: 0px;"></path>
                                </g>
                            </svg>
                        </div>
                        @if(session('message')=='update')
                            <h2>Case updated!</h2>
                            <p>Your case with case number <b>{{ session('number')?? 'Invalid' }}</b> has been updated successfully.</p>
                        @elseif(session('message')=='submit')
                            <h2>Case submitted!</h2>
                            <p>Your case with case number <b>{{ session('number')?? 'Invalid' }}</b> has been submitted successfully.</p>
                        @elseif(session('message')=='delete')
                            <h2>Case deleted!</h2>
                            <p>Your case with case number <b>{{ session('number')?? 'Invalid' }}</b> has been deleted successfully.</p>
                        @endif
                        <br>
                        <a href="{{ url('accepts') }}" class="btn_top">Open new case</a>
                    </div>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->


        <!-- /bg_color_1 -->
    </main>
@endsection


