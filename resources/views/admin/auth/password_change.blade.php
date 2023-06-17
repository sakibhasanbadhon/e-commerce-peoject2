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
                <div class="ibox-head bg-info text-white">
                    <div class="ibox-title">Password Change</div>
                    <div class="ibox-tools">
                        <a class="ibox-collapse text-white"><i class="fa fa-minus"></i></a>
                        <a class="fullscreen-link text-white"><i class="fa fa-expand"></i></a>
                    </div>
                </div>
                <div class="ibox-body">
                    <form action="{{ route('admin.password.update') }}" method="post" class="form-horizontal">
                        @csrf
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Old Password</label>
                            <div class="col-sm-10">
                                <input class="form-control" name="old_password" type="password" placeholder="Old Password">
                                @error('old_password')
                                    <span class="text-danger py-1"> {{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">New Password</label>
                            <div class="col-sm-10">
                                <input class="form-control" name="password" type="password" placeholder="New Password">
                                @error('password')
                                    <span class="text-danger py-1"> {{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Confirmed Password</label>
                            <div class="col-sm-10">
                                <input class="form-control" name="password_confirmation" type="password" placeholder="Confirmed Password">
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
