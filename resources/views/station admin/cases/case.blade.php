@extends('station admin.layouts.app')
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
            <li><a href="{{ url('active_cases') }}">Cases</a></li>
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

                    <div class="form-group form-inline">
                        @if($edit == 1)
                            @include('includes.messages')
                            <form action="{{ route('assignprosecutor',$case->id) }}" method="post">
                                {{ csrf_field() }}
                                <select name="court" id="court"  class="form-control" required="required">
                                    <option value="">Select court</option>
                                    @foreach($courts as $court)
                                        <option value="{{ $court->id }}">{{ $court->name }}</option>
                                    @endforeach
                                </select>
                                <select name="prosecutor" id="prosecutor" class="form-control" required="required">
                                    <option value="">Select prosecutor</option>
                                </select>
                                <button class="btn btn-info" type="submit">Assign case</button>
                            </form>
                        @endif
                    </div>


                    <table class="table table-bordered table-stripped">
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
                            <td><b>Prosecutor</b></td>
                            <td>
                                {{ $prosecutor->name }}
                            </td>
                        </tr>
                        <tr>
                            <td><b>Prosecutor decision</b></td>
                            <td>
                                @if($case->prosecutor_decision == 1)
                                    Case is valid
                                @elseif($case->prosecutor_decision == 0)
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
                                {{ $magistrate->name }}
                            </td>
                        </tr>
                        <tr>
                            <td><b>Magistrate decision</b></td>
                            <td>
                                @if($case->magistrate_decision == 1)
                                    Case is valid
                                @elseif($case->magistrate_decision == 0)
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
                                @if($case->fine < 1)
                                    No fine set
                                @else
                                    {{ $case->fine }}
                                @endif
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
        $('#court').change(function(){
            var cid = $(this).val();
            if(cid){
                $.ajax({
                    type:"get",
                    url:"{{ url('/getProsecutor')}}/"+cid,
                    success:function(res)
                    {
                        if(res)
                        {
                            $("#prosecutor").empty();
                            $("#prosecutor").append('<option value="">Select Prosecutor</option>');
                            $.each(res,function(key,value){
                                $("#prosecutor").append('<option value="'+key+'">'+value+'</option>');
                            });
                        }
                    }
                });
            }
        });
    </script>
@endsection

@endsection