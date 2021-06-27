@extends('prosecutor.layouts.app')
@section('headSection')
    <link rel="stylesheet" href="{{ asset('admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
    <style>
        .table-responsive {
            margin: 30px 0;
        }
        .table-wrapper {

            background: #fff;
            margin: 0 auto;
            padding: 20px 30px 5px;
            box-shadow: 0 0 1px 0 rgba(0,0,0,.25);
        }
        .table-title .btn-group {
            float: right;
        }
        .table-title .btn {
            min-width: 50px;
            border-radius: 2px;
            border: none;
            padding: 6px 12px;
            font-size: 95%;
            outline: none !important;
            height: 30px;
        }
        .table-title {
            min-width: 100%;
            border-bottom: 1px solid #e9e9e9;
            padding-bottom: 15px;
            margin-bottom: 5px;
            background: rgb(0, 50, 74);
            margin: -20px -31px 10px;
            padding: 15px 30px;
            color: #fff;
        }
        .table-title h2 {
            margin: 2px 0 0;
            font-size: 24px;
        }
    </style>
@endsection
@section('main-content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Active cases in your court
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Active cases</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="box">
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <div class="table-wrapper">
                            <div class="table-title">
                                <div class="row">
                                    <div class="col-sm-6"><h4>Filter using suspect/s decision on case</h4></div>
                                    <div class="col-sm-6">
                                        <div class="btn-group" data-toggle="buttons">
                                            <label class="btn btn-info active">
                                                <input type="radio" name="status" value="all" checked="checked"> All
                                            </label>
                                            <label class="btn btn-success">
                                                <input type="radio" name="status" value="Accepted"> Suspect accepted
                                            </label>
                                            <label class="btn btn-danger">
                                                <input type="radio" name="status" value="Denied"> Suspect denied
                                            </label>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <table id="example" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>S.no</th>
                                    <th>Names</th>
                                    <th>Identification</th>
                                    <th>Mobile</th>
                                    <th>Incident location</th>
                                    <th>Offences</th>
                                    <th>Case dismissed</th>
                                    <th>Suspect decision</th>
                                    <th>Open</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($cases as $case)
                                    @if($case->status == '1' && is_null($case->prosecutor))

                                        <tr @if($case->offender_decision == 1)
                                            data-status="Accepted"
                                            @elseif($case->offender_decision == 0)
                                            data-status="Denied"
                                            @endif>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $case->offender_name }}</td>
                                            <td>{{ $case->identification }}</td>
                                            <td>{{ $case->offender_mobile }}</td>
                                            <td>{{ $case->offence_location }}</td>
                                            <td>
                                                @foreach($case->offences as $offence)
                                                    {{ $offence->offence }}
                                                    @if( !$loop->last)
                                                        ,
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td>
                                                @if($case->dismissed == 1)
                                                    <span class="label label-success">Dismissed</span>
                                                @elseif($case->dismissed == 0)
                                                    <span class="label label-danger">Not dismissed</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($case->offender_decision == 1)
                                                    <span class="label label-success">Accepted</span>
                                                @elseif($case->offender_decision == 0)
                                                    <span class="label label-danger">Denied</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a data-toggle="tooltip" data-placement="bottom" title="Edit" href="{{ url('case_outcome',$case->id) }}" class="badge bg-light-blue " disabled><i class="fa fa-eye" aria-hidden="true"></i></a>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>S.no</th>
                                    <th>Names</th>
                                    <th>Identification</th>
                                    <th>Mobile</th>
                                    <th>Incident location</th>
                                    <th>Offences</th>
                                    <th>Suspect decision</th>
                                    <th>Open</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

        </section>
        <!-- /.content -->
    </div>

@section('footerSection')
    <script src="{{ asset('admin/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js" ></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.bootstrap.min.js"> </script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js" ></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js" ></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"> </script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"> </script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"> </script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"> </script>
    <script>

        $(document).ready(function(){
            $(".btn-group .btn").click(function(){
                var inputValue = $(this).find("input").val();
                if(inputValue != 'all'){
                    var target = $('table tr[data-status="' + inputValue + '"]');
                    $("table tbody tr").not(target).hide();
                    target.fadeIn();
                } else {
                    $("table tbody tr").fadeIn();
                }
            });
            // Changing the class of status label to support Bootstrap 4
            var bs = $.fn.tooltip.Constructor.VERSION;
            var str = bs.split(".");
            if(str[0] == 4){
                $(".label").each(function(){
                    var classStr = $(this).attr("class");
                    var newClassStr = classStr.replace(/label/g, "badge");
                    $(this).removeAttr("class").addClass(newClassStr);
                });
            }
        });


        $(function () {
            var table = $('#example').DataTable({
                buttons: [ 'copy', 'excel', 'pdf', 'colvis' ]
            });
            table.buttons().container().appendTo( '#example_wrapper .col-sm-6:eq(0)' );
        })
    </script>
@endsection

@endsection
