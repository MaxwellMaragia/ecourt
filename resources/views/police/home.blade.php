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
        <div class="user_summary">
            <div class="wrapper">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <figure>
                                <img src="{{ Storage::url(Auth::user()->avatar) }}">
                            </figure>
                            <h1>{{ Auth::User()->name }}</h1>
                            <span>
                                @foreach(Auth::User()->stations as $key => $station)
                                    {{ $station->name }} police station
                                @endforeach
                            </span>
                        </div>
                        <div class="col-md-6">
                            <ul>
                                <li>
                                    <strong>{{ $total_cases->count() }}</strong>
                                    <a href="{{ route('total') }}" class="tooltips" data-toggle="tooltip" data-placement="bottom" title="Total cases opened by you">Total cases</a>
                                </li>
                                <li>
                                    <strong>
                                        {{ $solved_cases->count() }}
                                    </strong>
                                    <a href="{{ route('closed') }}" class="tooltips" data-toggle="tooltip" data-placement="bottom" title="Total cases opened by you that have been solved">Solved cases</a>
                                </li>
                                <li>
                                    <strong>
                                        {{ $pending_cases->count() }}
                                    </strong>
                                    <a href="{{ route('pending') }}" class="tooltips" data-toggle="tooltip" data-placement="bottom" title="Total cases opened by you that are still pending">Pending cases</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /container -->
            </div>
        </div>
        <!-- /user_summary -->
        <div class="container margin_60_35">
            <div class="row">
                <div class="col-lg-4">
                    <div class="box_general general_info">
                        <h3>Create case <small>(Suspect accepts)</small></h3>
                        <p>
                            Create new case where the suspect has accepted the charge. Might be eligible for pardon
                        </p>
                        <a href="{{ url('accepts') }}" class="btn_1 small">Proceed</a>
                        <hr>
                        <h3>Create case <small>(Suspect denies)</small></h3>
                        <p>Create new case where the suspect denies the charge or any wrong doing. Bail payment will be triggered<br></p>
                        <a href="{{ url('denies') }}" class="btn_1 small">Proceed</a>
                        <hr>

                    </div>
                </div>
                <div class="col-lg-8">
                    @foreach($recent_cases as $case)
                        <div class="review_card">
                            <div class="row">
                                <div class="col-md-10 review_content">
                                    <div class="clearfix add_bottom_15">
                                        <span class="rating">
                                            <em>
                                               @foreach($case->offences as $offence)
                                                    {{ $offence->offence }}
                                                    @if( !$loop->last)
                                                        ,
                                                    @endif
                                                @endforeach
                                            </em>
                                        </span>
                                        <em>Opened: {{ $case->created_at->toFormattedDateString() }}</em>
                                    </div>
                                    <h4>"{{ $case->offender_name }}"</h4>
                                    <p>{{ $case->particulars }}</p>
                                    <ul>
                                        <li>
                                            <form id="delete-form-{{ $case->id }}" action="{{ route('cases.destroy',$case->id) }}" style="display: none;" method="post">
                                                {{@csrf_field()}}
                                                {{@method_field('DELETE')}}
                                            </form>
                                            <a data-toggle="tooltip" class="btn_delete"><i class="icon-trash" onclick="
                                                    if(confirm('Are you sure you want to delete this case?'))
                                                    {event.preventDefault();
                                                    document.getElementById('delete-form-{{ $case->id }}').submit();
                                                    }
                                                    else{
                                                    event.preventDefault();
                                                    }
                                                    "></i>Delete</a>
                                        </li>
                                        <li><a href="{{ route('cases.edit',$case->id) }}"><i class="icon-edit-3"></i> Edit</a></li>
                                    </ul>
                                </div>
                            </div>
                            <!-- /row -->
                        </div>
                    @endforeach
                    <!-- /review_card -->

                </div>
                <!-- /col -->

            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </main>
@endsection


