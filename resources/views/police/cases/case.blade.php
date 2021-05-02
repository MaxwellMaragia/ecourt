@extends('police/layouts/app')
@section('meta')
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="case listing">
    <meta name="author" content="CODEI SYSTEMS">
    <title>ECOURT | Case for {{ $case->offender_name }}</title>

@endsection
@section('main-content')
    <main>
        <div class="row justify-content-center">
            <div class="col-lg-6" style="margin-top:100px;">
                <div class="table-responsive">
                    <table class="table table-bordered table-stripped">
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
                        {{--            <tr>--}}
                        {{--                <td><b>Prosecutor</b></td>--}}
                        {{--                <td>--}}

                        {{--                    @if(!is_null($prosecutor))--}}
                        {{--                        {{ $prosecutor->name }}--}}
                        {{--                    @endif--}}
                        {{--                </td>--}}
                        {{--            </tr>--}}
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
                        {{--            <tr>--}}
                        {{--                <td><b>Magistrate</b></td>--}}
                        {{--                <td>--}}
                        {{--                    @if(!is_null($magistrate))--}}
                        {{--                        {{ $magistrate->name }}--}}
                        {{--                    @endif--}}
                        {{--                </td>--}}
                        {{--            </tr>--}}
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
        </div>
    </main>

@endsection


