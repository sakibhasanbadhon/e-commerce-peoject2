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
                    <form action="{{ route('admin.setting.seo.update',$seoData->id) }}" method="post">
                        @csrf

                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Meta Title</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="meta_title" value="{{ $seoData->meta_title }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Meta Author</label>
                            <div class="col-sm-8">
                                <input class="form-control" name="meta_author" value="{{ $seoData->meta_author }}" type="text">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Meta Tag</label>
                            <div class="col-sm-8">
                                <input class="form-control" name="meta_tag" value="{{ $seoData->meta_tag}}" type="text">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Meta Description</label>
                            <div class="col-sm-8">
                                <input class="form-control" name="meta_description" value="{{ $seoData->meta_description }}" type="text">
                            </div>
                        </div>

                        <div class="text-primary py-2"> --- Others Option ---</div>

                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Meta Keyword</label>
                            <div class="col-sm-8">
                                <input class="form-control" name="meta_keyword" value="{{ $seoData->meta_keyword }}" type="text">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Google Verification</label>
                            <div class="col-sm-8">
                                <input class="form-control" name="google_verification" value="{{ $seoData->google_verification }}" type="text">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Alexa Verification</label>
                            <div class="col-sm-8">
                                <input class="form-control" name="alexa_verification" value="{{ $seoData->alexa_verification }}" type="text">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Google Adsense</label>
                            <div class="col-sm-8">
                                <input class="form-control" name="google_adsense" value="{{ $seoData->google_adsense}}" type="text">
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
