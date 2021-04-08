@extends('court admin.layouts.app')
@section('headSection')
    <link rel="stylesheet" href="{{ asset('admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection
@section('main-content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Users under your court
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Users</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="box">
                <div class="box-header">
                    <a href="{{ route('magistrates.create') }}" class="btn btn-info"><span class="fa fa-plus"></span> Add new</a>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    @include('includes.messages')
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>S.no</th>
                                <th>Names</th>
                                <th>Staff id</th>
                                <th>Category</th>
                                <th>Email</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($magistrates as $magistrate)
                                @if($magistrate->category == 'magistrate' || $magistrate->category == 'prosecutor' )
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $magistrate->name }}</td>
                                        <td>{{ $magistrate->staff_id }}</td>
                                        <td>{{ $magistrate->category }}</td>
                                        <td>{{ $magistrate->email }}</td>
                                        <td>
                                            <a data-toggle="tooltip" data-placement="bottom" title="Edit" href="{{ route('magistrates.edit',$magistrate->id) }}" class="badge bg-light-blue " disabled><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                            <form id="delete-form-{{ $magistrate->id }}" action="{{ route('magistrates.destroy',$magistrate->id) }}" style="display: none;" method="post">
                                                {{@csrf_field()}}
                                                {{@method_field('DELETE')}}
                                            </form>
                                            <a data-toggle="tooltip" data-placement="bottom" title="Delete" onclick="
                                                if(confirm('Are you sure you want to delete this user?'))
                                                {event.preventDefault();
                                                document.getElementById('delete-form-{{ $magistrate->id }}').submit();
                                                }
                                                else{
                                                event.preventDefault();
                                                }
                                                " class="badge bg-red"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>S.no</th>
                                <th>Names</th>
                                <th>Staff id</th>
                                <th>Category</th>
                                <th>Email</th>
                                <th>Actions</th>
                            </tr>
                            </tfoot>
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
    <script src="{{ asset('admin/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <script>
        $(function () {
            $('#example1').DataTable()
            $('#example2').DataTable({
                'paging'      : true,
                'lengthChange': false,
                'searching'   : false,
                'ordering'    : true,
                'info'        : true,
                'autoWidth'   : false
            })
        })
    </script>
@endsection

@endsection
