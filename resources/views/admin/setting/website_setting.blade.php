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
                    <div class="ibox-title">Website Setting</div>
                    <div class="ibox-tools">
                        <a class="ibox-collapse text-white"><i class="fa fa-minus"></i></a>
                        <a class="fullscreen-link text-white"><i class="fa fa-expand"></i></a>
                    </div>
                </div>
                <div class="ibox-body">
                    <form action="{{ route('admin.website.update',$websiteSettings->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Currency</label>
                            <select name="currency" class="form-control col-sm-8" id="">
                                <option value="৳">BDT (৳)</option>
                                <option value="$">USD ($) </option>
                                <option value="₹">RUPEE (₹)</option>
                            </select>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Phone</label>
                            <div class="col-sm-8">
                                <input class="form-control" name="phone_one" value="{{ $websiteSettings->phone_one }}" type="text">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Phone 2</label>
                            <div class="col-sm-8">
                                <input class="form-control" name="phone_two" value="{{ $websiteSettings->phone_two }}" type="text">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Email</label>
                            <div class="col-sm-8">
                                <input class="form-control" name="main_email" value="{{ $websiteSettings->main_email }}" type="email">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Support email</label>
                            <div class="col-sm-8">
                                <input class="form-control" name="support_mail" value="{{ $websiteSettings->support_mail }}" type="text">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Address</label>
                            <div class="col-sm-8">
                                <input class="form-control" name="address" value="{{ $websiteSettings->address }}" type="text">
                            </div>
                        </div>

                        <strong class="text-info"> Social Link</strong>

                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Facebook</label>
                            <div class="col-sm-8">
                                <input class="form-control" name="facebook" value="{{ $websiteSettings->facebook }}" type="text">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Twitter</label>
                            <div class="col-sm-8">
                                <input class="form-control" name="twitter" value="{{ $websiteSettings->twitter }}" type="text">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Linkedin</label>
                            <div class="col-sm-8">
                                <input class="form-control" name="linkedin" value="{{ $websiteSettings->linkedin }}" type="text">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Youtube</label>
                            <div class="col-sm-8">
                                <input class="form-control" name="youtube" value="{{ $websiteSettings->youtube }}" type="text">
                            </div>
                        </div>

                        <strong class="text-info pt-2"> Logo & favicon</strong>

                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Logo</label>
                            <div class="col-sm-8">
                                <input class="form-control" name="logo" type="file">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Favicon</label>
                            <div class="col-sm-8">
                                <input class="form-control" name="favicon" type="file">
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
