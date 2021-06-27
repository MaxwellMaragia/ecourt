<!doctype html>

<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $case->offender_name }} case number {{ $case->id }}</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <style>
        .data {
            margin-top:20px;
        }

        .data td, .data .table, .data tr, .data th{
            border: 1px solid black;
            border-collapse: collapse;
        }
    </style>
</head>
<body>
<div class="row">
    <div class="col-md-12">
        <table class="table table-borderless">
            <tr>
                <td width="20%">
                    Police
                </td>
                <td width="40%">
                    THE KENYA POLICE
                    <br>
                    <b>CHARGE SHEET</b>
                </td>
                <td width="40%">
                    POLICE CASE NUMBER <b>PL/{{ $case->id }}</b><br>
                    DATE TO COURT <b>{{ $case->court_appearance_date ?? 'N/A' }}</b><br>
                    COURT FILE NO <b>CRT/{{ $case->id }}</b>
                </td>
            </tr>
        </table>
    </div>
    <div class="col-md-12">
        <b>NAMES: {{ $case->offender_name }}</b>
    </div>
    <div class="col-md-12 data">
        <table class="table">
            <thead>
            <tr>
                <th>
                    Christian names <br>
                    <b><small>{{ $case->offender_name }}</small></b>
                </th>
                <th>
                    Identity certificate no <br>
                    <b><small>{{ $case->identification }}</small></b>
                </th>
                <th>
                    Gender <br>
                    <small>{{ $case->gender }}</small>
                </th>
                <th>
                    Nationality <br>
                    <small>{{ $case->nationality }}</small>
                </th>
                <th>
                    Apparent age <br>
                    <small>{{ $case->age }}</small>
                </th>
                <th style="border-left: 1px solid black;">
                    Address <br>
                    <small>{{ $case->address }}</small>
                </th>
            </tr>
            </thead>
            <tbody>

            <tr>
                <td>
                    <b>CHARGE/S</b>
                </td>
{{--                <td colspan="18">--}}
{{--                    @foreach($case->offences as $offence)--}}
{{--                        {{ $offence->offence }}--}}
{{--                        @if( !$loop->last)--}}
{{--                            ,--}}
{{--                        @endif--}}
{{--                    @endforeach--}}
{{--                </td>--}}
                <td colspan="18">
                    {{ $case->charge ?? 'N/A' }}
                </td>
            </tr>
            <tr>
                <td>
                    <b>PARTICULARS OF THE OFFENCE</b>
                </td>
                <td colspan="18">
                    <small>{{ $case->particulars }}</small>
                </td>
            </tr>
            <tr>
                <td>
                    If accussed arrested
                </td>
                <td>
                    Date of arrest
                </td>
                <td>
                    With or without warrant
                </td>
                <td>
                    Date apprehension report to court
                </td>
                <td>
                    Bond or bail amount
                </td>
                <td colspan="14">
                    Is application made for summons to issue
                </td>
            </tr>
            <tr>
                <td>

                </td>
                <td>

                </td>
                <td>

                </td>
                <td>

                </td>
                <td>
                    {{ $case->bail ?? 'N/A' }}
                </td>
                <td colspan="14">

                </td>
            </tr>
            <tr>
                <td>
                    Complainant and address
                </td>
                <td colspan="18">
                    {{ $station->name }}
                </td>
            </tr>
            <tr>
                <td>
                    Witnesses
                </td>
                <td colspan="18">

                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
