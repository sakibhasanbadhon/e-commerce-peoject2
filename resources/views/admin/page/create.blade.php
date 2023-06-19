@extends('layouts.admin')
@section('styles')
<style>

</style>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 ms-auto">
            <a href="{{ route('admin.page.index') }}" class="float-right py-2"> << Back</a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="ibox">
                <div class="ibox-head bg-info text-white">
                    <div class="ibox-title"> Add Page</div>
                    <div class="ibox-tools">
                        <a class="ibox-collapse text-white"><i class="fa fa-minus"></i></a>
                        <a class="fullscreen-link text-white"><i class="fa fa-expand"></i></a>
                    </div>
                </div>
                <div class="ibox-body">
                    <form action="{{ route('admin.page.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label> Page Position</label>
                            <select name="page_position" class="form-control" id="">
                                <option value="1"> line 1</option>
                                <option value="2"> line 2</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label> Page name</label>
                            <input class="form-control" name="page_name" value="" type="text">
                            @error('page_name')
                                <div class="text-danger py-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label> Page Title</label>
                            <input class="form-control" name="page_title" type="text">
                            @error('page_title')
                                <div class="text-danger py-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label> Page Descriptiion</label>
                            <textarea rows="2" id="summernote" name="page_description"></textarea>
                            @error('page_description')
                                <div class="text-danger py-2">{{ $message }}</div>
                            @enderror
                        </div>



                        <div class="form-group row">
                            <div class="col-sm-10">
                                <label class="ui-checkbox ui-checkbox-gray">
                                    <input type="checkbox">
                                    <span class="input-span"></span>Remamber me</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-10">
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
