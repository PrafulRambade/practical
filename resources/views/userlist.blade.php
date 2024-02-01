@extends('layouts.app')
@section('title', 'User List')
@section('content')

<div class="animsition">
    <div class="page-wrapper">
      
        <!-- PAGE CONTAINER-->
        <div class="page-container">

            {{-- {{$sr_no = 1}} --}}
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                    <div class="col-sm-6">
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Designations</li>
                        </ol>
                    </div>
                    </div>
                </div><!-- /.container-fluid -->
                </section>
                <section class="content">
                    <div class="container-fluid">
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-12">
                        <!-- general form elements -->
                        <!-- /.card -->
                        <div class="card card-primary">
                            <div class="card-header">
                            <h3 class="card-title">All Users</h3>
                            @can('designation-create')
                            <a class="float-right btn btn-success" href="{{route('designation.create')}}"><i class="fa fa-plus"></i> Add Designation</a>
                            @endcan
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                            <table id="employee_details" class="table table-borderless table-striped table-earning" style="width:100%">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Organization Name</th>
                                    <th>Designation</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $usr)
                                        {{--print_r($designation)--}}
                                        <tr>
                                            <td>{{$usr->name}}</td>
                                            <td>{{$usr->email}}</td>
                                            <td>{{$usr->organization_name}}</td>
                                            <td>{{$usr->designation}}</td>
                                        </tr>
                                    @endforeach    
                                    
                                </tbody>
                            </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        </div>
                        <!--/.col (left) -->
                    </div>
                    <!-- /.row -->
                    </div><!-- /.container-fluid -->

                </section>


                <!-- /.content -->
            </div>
        </div>
        
    </div>
</div>    
@endsection
