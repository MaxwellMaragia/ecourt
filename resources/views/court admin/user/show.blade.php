@extends('admin.layouts.app')
@section('headSection')
    <link rel="stylesheet" href="{{ asset('admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection
@section('main-content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Users
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('admin.home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Users</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <div class="box">
                <div class="box-header">
                    <a href="{{ route('user.create') }}" class="btn btn-primary"><span class="fa fa-plus"></span>   Add new</a>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    @include('includes.messages')
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>S.no</th>
                                <th>Avatar</th>
                                <th>Name</th>
                                <th>Roles</th>
                                <th>Email</th>
                                <th>Active</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($admins as $admin)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>
                                        <img src="{{ Storage::url($admin->avatar) }}" alt="" height="50px" width="50px">
                                    </td>
                                    <td>{{ $admin->name }}</td>
                                    <td>
                                        @foreach($admin->roles as $role)
                                            {{ $role->role }}
                                            @if( !$loop->last)
                                                ,
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>{{ $admin->email }}</td>
                                    <td>
                                        @if($admin->status === 1)
                                            <span class="badge bg-green">Yes</span>
                                        @else
                                            <span class="badge bg-red">No</span>
                                        @endif
                                    </td>
                                    <td><a data-toggle="tooltip" data-placement="bottom" title="Edit" href="{{ route('user.edit',$admin->id) }}" class="badge bg-light-blue"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                        <form id="delete-form-{{ $admin->id }}" action="{{ route('user.destroy',$admin->id) }}" style="display: none;" method="post">
                                            {{@csrf_field()}}
                                            {{@method_field('DELETE')}}
                                        </form>
                                        <a data-toggle="tooltip" data-placement="bottom" title="Delete" onclick="
                                                if(confirm('Are you sure you want to delete this user? he/she might be logged in'))
                                                {event.preventDefault();
                                                document.getElementById('delete-form-{{ $admin->id }}').submit();
                                                }
                                                else{
                                                event.preventDefault();
                                                }
                                                " class="badge bg-red"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>S.no</th>
                                <th>Avatar</th>
                                <th>Name</th>
                                <th>Roles</th>
                                <th>Email</th>
                                <th>Active</th>
                                <th>Actions</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>

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