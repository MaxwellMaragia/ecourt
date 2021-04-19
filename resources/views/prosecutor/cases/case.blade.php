@extends('prosecutor.layouts.app')
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

                        <div class="form-group">
                            @include('includes.messages')
                            <form action="{{ route('assignmagistrate',$case->id) }}" method="post">
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
                                            Proceed with case (Select magistrate)
                                        </label>
                                    </div>
                                </div>
                                <div class="hide check">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <select name="magistrate" id="prosecutor" class="form-control ">
                                                <option value="">Select magistrate</option>

                                                @foreach($users as $user)
                                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                @endforeach
                                            </select>
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
                                    <img src="{{ Storage::url($case->image) }}" height="200px" width="200px">
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

        $('#proceed').change(function(){
            if($(this).is(":checked")) {

                $('div.check').removeClass("hide");
                $('#prosecutor').attr('required','required');

            }
        });
        $('#terminate').change(function(){
            if($(this).is(":checked")) {
                $('div.check').addClass("hide");
                $('#prosecutor').removeAttr('required');

            }
        });

    </script>
@endsection

@endsection
