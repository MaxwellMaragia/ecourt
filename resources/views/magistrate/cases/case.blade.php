@extends('magistrate.layouts.app')
@section('headSection')
    <link rel="stylesheet" href="{{ asset('admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection
@section('main-content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Case for {{ $case->offender_name }}
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Case</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="box">

                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">

                        <div class="form-group">
                            @include('includes.messages')
                            @if($case->status == '1' && is_null($case->magistrate) && $case->dismissed == 0)
                                <form action="{{ route('decidecase',$case->id) }}" method="post">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="outcome" id="terminate"  checked="" value="0">
                                                Terminate/Pardon case (Invalid or lack of evidence)
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="outcome" id="proceed" value="1">
                                                Proceed with case (Set fine amount)
                                            </label>
                                        </div>
                                    </div>
                                    <div class="hide check">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <input type="number" class="form-control" placeholder="Enter fine amount" id="fine" name="fine" value="{{ old('fine') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label style="margin-top:5px;">Outcome reason</label>
                                            <textarea class="form-control" rows="3" placeholder="Outcome reason" name="reason" required="required">

                                        </textarea>
                                        </div>
                                    </div>
                                    <button class="btn btn-info left" type="submit" style="margin-top:10px;">Proceed</button>
                                </form>
                                @endif
                        </div>
                        <table class="table table-bordered table-stripped">
                            <tr>
                                <td><b>Case number</b></td>
                                <td>{{ $case->id }}</td>
                            </tr>
                            <tr>
                            </tr>
                            <td><b>Case verdict</b></td>
                            <td>
                                @if($case->status == '0')
                                    Invalid case
                                @elseif($case->status == '1')
                                    Valid case
                                @else
                                    Not set yet
                                @endif
                            </td>
                            <tr>
                                <td><b>Case status</b></td>
                                <td>
                                    @if($case->dismissed == 0)
                                        Active
                                    @else
                                        Dismissed
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><b>Offenders name</b></td>
                                <td>{{ $case->offender_name }}</td>
                            </tr>
                            <tr>
                                <td><b>Identification</b></td>
                                <td>{{ $case->identification }}</td>
                            </tr>
                            <tr>
                                <td><b>Mobile number</b></td>
                                <td>{{ $case->offender_mobile }}</td>
                            </tr>
                            <tr>
                                <td><b>Age</b></td>
                                <td>{{ $case->age }}</td>
                            </tr>
                            <tr>
                                <td><b>Address</b></td>
                                <td>{{ $case->address }}</td>
                            </tr>
                            <tr>
                                <td><b>Nationality</b></td>
                                <td>{{ $case->nationality }}</td>
                            </tr>
                            <tr>
                                <td><b>Gender</b></td>
                                <td>{{ $case->gender }}</td>
                            </tr>
                            <tr>
                                <td><b>Car registration number</b></td>
                                <td>{{ $case->car_registration }}</td>
                            </tr>
                            <tr>
                                <td><b>Location of offence</b></td>
                                <td>{{ $case->offence_location }}</td>
                            </tr>
                            <tr>
                                <td><b>Time of offence</b></td>
                                <td>{{ date('Y-m-d H:i:s', strtotime($case->time)) }}</td>
                            </tr>
                            <tr>
                                <td><b>Offence category</b></td>
                                <td>
                                    @foreach($case->offences as $offence)
                                        {{ $offence->offence }}
                                        @if( !$loop->last)
                                            ,
                                        @endif
                                    @endforeach
                                </td>
                            </tr>
                            <tr>
                                <td><b>Particulars of offence</b></td>
                                <td>{{ $case->particulars }}</td>
                            </tr>
                            <tr>
                                <td><b>Mitigating circumstances</b></td>
                                <td>{{ $case->mitigating }}</td>
                            </tr>
                            <tr>
                                <td><b>Scene image</b></td>
                                <td>
                                    <img src="{{ Storage::url($case->image) }}" height="160px" width="160px">
                                </td>
                            </tr>
                            <tr>
                                <td><b>Reporting officer</b></td>
                                <td>{{ $police->name }}</td>
                            </tr>
                            <tr>
                                <td><b>Prosecutor</b></td>
                                <td>

                                    @if(!is_null($prosecutor))
                                        {{ $prosecutor->name }}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><b>Prosecutor decision</b></td>
                                <td>
                                    @if($case->prosecutor_decision == 1)
                                        Case is valid
                                    @elseif($case->prosecutor_decision == 0 && !is_null($case->prosecutor_decision))
                                        Case invalid/dismissed
                                    @else
                                        N/A
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><b>Prosecutor decision reason</b></td>
                                <td>
                                    @if(strlen($case->prosecutor_decision_reason) > 0)
                                        {{ $case->prosecutor_decision_reason }}
                                    @else
                                        N/A
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><b>Magistrate</b></td>
                                <td>
                                    @if(!is_null($magistrate))
                                        {{ $magistrate->name }}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><b>Magistrate decision</b></td>
                                <td>
                                    @if($case->magistrate_decision == 1)
                                        Case is valid
                                    @elseif($case->magistrate_decision == 0 && !is_null($case->magistrate_decision))
                                        Case invalid/dismissed
                                    @else
                                        N/A
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><b>Magistrate decision reason</b></td>
                                <td>
                                    @if(strlen($case->magistrate_decision_reason) > 0)
                                        {{ $case->magistrate_decision_reason }}
                                    @else
                                        N/A
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><b>Fine (if any)</b></td>
                                <td>
                                    {{ $case->fine }}
                                </td>
                            </tr>
                            <tr>
                                <td><b>Fine amount paid</b></td>
                                <td>
                                    {{ $case->fine_paid }}
                                </td>
                            </tr>
                            <tr>
                                <td><b>Bail (if any)</b></td>
                                <td>
                                    {{ $case->bail }}
                                </td>
                            </tr>
                            <tr>
                                <td><b>Bail amount paid</b></td>
                                <td>
                                    {{ $case->bail_paid }}
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

        </section>
        <!-- /.content -->
    </div>

@section('footerSection')
    <script>

        $('#proceed').change(function(){
            if($(this).is(":checked")) {

                $('div.check').removeClass("hide");
                $('#fine').attr('required','required');

            }
        });
        $('#terminate').change(function(){
            if($(this).is(":checked")) {
                $('div.check').addClass("hide");
                $('#fine').removeAttr('required');

            }
        });

    </script>
@endsection

@endsection
