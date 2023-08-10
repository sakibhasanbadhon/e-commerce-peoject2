@extends('layouts.admin')
@section('styles')
<style>

</style>
@endsection

@section('content')
<div class="container">
    <div class="row ${1| ,row-cols-2,row-cols-3, auto,justify-content-md-center,|}">
        <div class="col-md-8">
            <div class="ibox">
                <div class="ibox-head text-white" style="background-color:#374f65 !important">
                    <div class="ibox-title">SMTP Setting</div>
                    <div class="ibox-tools">
                        <a class="ibox-collapse text-white"><i class="fa fa-minus"></i></a>
                        <a class="fullscreen-link text-white"><i class="fa fa-expand"></i></a>
                    </div>
                </div>
                <div class="ibox-body">
                    <form action="{{ route('admin.setting.smtp.update',$smtp->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Mailer</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="mailer" value="{{ $smtp->mailer }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Host</label>
                            <div class="col-sm-8">
                                <input class="form-control" name="host" value="{{ $smtp->host }}" type="text">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Port</label>
                            <div class="col-sm-8">
                                <input class="form-control" name="port" value="{{ $smtp->port }}" type="text">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">User Name</label>
                            <div class="col-sm-8">
                                <input class="form-control" name="user_name" value="{{ $smtp->user_name }}" type="text">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Password</label>
                            <div class="col-sm-8">
                                <input class="form-control" name="password" value="{{ $smtp->password }}" type="text">
                            </div>
                        </div>



                        <div class="form-group row">
                            <div class="col-sm-10 ml-sm-auto">
                                <label class="ui-checkbox ui-checkbox-gray">
                                    <input type="checkbox">
                                    <span class="input-span"></span>Remamber me</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-10 ml-sm-auto">
                                <button class="btn btn-info" type="submit">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
