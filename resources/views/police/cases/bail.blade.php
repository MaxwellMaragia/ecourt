@extends('police/layouts/app')
@section('meta')
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="case listing">
    <meta name="author" content="CODEI SYSTEMS">
    <title>ECOURT | Bail cases</title>

@endsection
@section('main-content')
    <main style="margin-top:60px;">
        <div id="results">
            <div class="container">
                <div class="row justify-content-between">
                    <div class="col-lg-3 col-md-4 col-10">
                        <h1><strong>{{ $total }}</strong> Pending cases</h1>
                    </div>
                    <div class="col-xl-5 col-md-6 col-2">
                        <a href="#0" class="search_mob btn_search_mobile"></a> <!-- /open search panel -->
                        <form class="row no-gutters custom-search-input-2 inner" method="post" action="{{ route('search') }}">
                            {{csrf_field()}}
                            <div class="col-lg-7">
                                <div class="form-group">
                                    <input class="form-control" type="text" placeholder="Search case using suspect id" name="id" required="required">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <select class="wide" name="category">
                                    <option value="all">All Categories</option>
                                    {{--                                    <option value="closed">Closed</option>--}}
                                    {{--                                    <option value="pending">Pending</option>--}}
                                </select>
                            </div>
                            <div class="col-xl-1 col-lg-1">
                                <input type="submit" value="Search">
                            </div>
                        </form>
                    </div>
                </div>

                <!-- /row -->
                <div class="search_mob_wp">
                    <div class="custom-search-input-2">
                        <div class="form-group">
                            <input class="form-control" type="text" placeholder="Search using id">
                            <i class="icon_search"></i>
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="text" placeholder="Where">
                            <i class="icon_pin_alt"></i>
                        </div>
                        <select class="wide">
                            <option value="all">All Categories</option>
                            {{--                            <option value="closed">Closed</option>--}}
                            {{--                            <option value="pending">Pending</option>--}}
                        </select>
                        <input type="submit" value="Search">
                    </div>
                </div>
                <!-- /search_mobile -->
            </div>
            <!-- /container -->
        </div>
        <!-- /results -->

        <!-- /Filters -->

        <div class="container margin_60_35">

            <div class="isotope-wrapper">
                @if($total_cases->count()>0)
                    @foreach($total_cases as $case)
                        <div class="company_listing isotope-item high">
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="company_info">
                                        <h3>{{ $case->offender_name }}</h3>
                                        <span class="rating"><strong>
                                            @foreach($case->offences as $offence)
                                                    {{ $offence->offence }}
                                                    @if( !$loop->last)
                                                        ,
                                                    @endif
                                                @endforeach
                                        </strong></span>
                                        <p>{{ $case->particulars }}</p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="text-center float-lg-right">
                                        <span class="rating"><strong>Opened: {{ $case->created_at->toFormattedDateString() }}</strong></span>
                                        <a href="{{ route('cases.show',$case->id) }}" class="btn_1 small">Open case</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /company_listing -->
                    @endforeach
                    @else
                    <div class="alert alert-warning">No active cases with bail opened by you could be found</div>
                    @endif

            </div>
            <!-- /isotope-wrapper -->
            {{ $total_cases->render("pagination::default") }}


        </div>
        <!-- /container -->

    </main>
@endsection


