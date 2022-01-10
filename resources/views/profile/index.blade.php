@extends('layouts.main')
@section('main')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Profile</h1>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- /.col -->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#profile" data-toggle="tab">Profile</a></li>
                                <li class="nav-item"><a class="nav-link" href="#password" data-toggle="tab">Password</a></li>
                            </ul>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <!-- /.tab-pane -->
                                <div  class="active tab-pane" id="profile">
                                    <form class="form-horizontal" method="post" action="{{ route('myProfileUpdate') }}">
                                        @csrf
                                        <div class="form-group row">
                                            <label for="inputName" class="col-sm-2 col-form-label">Full name</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="full_name" value="{{ auth()->user()->full_name }}" class="form-control" id="inputName" placeholder="Full name">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                            <div class="col-sm-10">
                                                <input type="email" name="email" value="{{ auth()->user()->email }}" class="form-control" id="inputEmail" placeholder="Email">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputName2" class="col-sm-2 col-form-label">Phone</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="phone" value="{{ auth()->user()->phone }}" class="form-control" id="inputName2" placeholder="Phone">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputSkills" class="col-sm-2 col-form-label">Card no</label>
                                            <div class="col-sm-10">
                                                {{ auth()->user()->card_no }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <button type="submit" class="btn btn-primary">Update</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.tab-pane -->

                                <!-- /.tab-pane -->
                                <div  class="tab-pane" id="password">
                                    <form class="form-horizontal" method="post" action="{{ route('changePassword') }}">
                                        @csrf
                                        <div class="form-group row">
                                            <label for="inputCurrentPassword" class="col-sm-2 col-form-label">Current password</label>
                                            <div class="col-sm-10">
                                                <input type="password" name="current_password" class="form-control" id="inputCurrentPassword" >
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputNewPassword" class="col-sm-2 col-form-label">New password</label>
                                            <div class="col-sm-10">
                                                <input type="password" name="new_password" class="form-control" id="inputNewPassword" >
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputConfirmPassword" class="col-sm-2 col-form-label">New confirm password</label>
                                            <div class="col-sm-10">
                                                <input type="password" name="new_confirm_password" class="form-control" id="inputConfirmPassword">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <button type="submit" class="btn btn-primary">Update password</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@include('message/success')
@include('message/error')

@endsection
