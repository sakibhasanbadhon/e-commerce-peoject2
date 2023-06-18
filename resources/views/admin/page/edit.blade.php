@extends('layouts.admin')
@section('styles')
<style>

</style>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="ibox">
                <div class="ibox-head bg-info text-white">
                    <div class="ibox-title"> Page Edit</div>
                    <div class="ibox-tools">
                        <a class="ibox-collapse text-white"><i class="fa fa-minus"></i></a>
                        <a class="fullscreen-link text-white"><i class="fa fa-expand"></i></a>
                    </div>
                </div>
                <div class="ibox-body">
                    <form action="{{ route('admin.page.update',$pages->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label> Page Position</label>
                            <select name="page_position" class="form-control">
                                <option value="1" {{ $pages->page_position== 1 ? 'selected' : '' }}>Line 1</option>
                                <option value="2" {{ $pages->page_position== 2 ? 'selected' : '' }}>Line 2</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label> Page name</label>
                            <input class="form-control" name="page_name" value="{{ $pages->page_name }}" type="text">
                            @error('page_name')
                                <div class="text-danger py-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label> Page Title</label>
                            <input class="form-control" name="page_title" value="{{ $pages->page_title }}" type="text">
                            @error('page_title')
                                <div class="text-danger py-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label> Page Descriptiion</label>
                            <textarea rows="2" id="summernote" value="" name="page_description">{{ $pages->page_description }}</textarea>
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
