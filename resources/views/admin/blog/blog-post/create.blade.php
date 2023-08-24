@extends('layouts.admin')
@section('styles')


@endsection
@section('content')


    {{-- edit modal  --}}

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-header p-3">
                        <h4 class=" d-flex justify-content-between"> All Blog Post
                            <a href="{{ route('admin.blog.post.index') }}" id="add_btn" class="btn btn-outline-primary">Blog List</a>
                        </h4>

                    </div>
                    <div class="card-body">

                        <form action="{{ route('admin.blog.post.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-8">

                                    <div class="py-2">
                                        <label for="title">Title</label>
                                        <input type="text" name="title" id="title" class="form-control" placeholder="Blog title" required>
                                    </div>
                                    <div class="py-2">
                                        <label for="description">Description</label>
                                        <textarea name="description" id="summernote" cols="30" rows="10"></textarea>
                                    </div>
                                    <div class="py-2">
                                        <label for="tags">Tags</label>
                                        <input type="text" name="tags" value="{{ old('tags') }}" class="form-control" id="tags" data-role="tagsinput">
                                    </div>


                                </div>
                                <div class="col-md-4">
                                    <div class="py-2">
                                        <label for="thumbnail">Thumbnail</label>
                                        <input type="file" name="thumbnail" data-height="150" id="thumbnail" class="form-control dropify"required>
                                    </div>
                                    <div class="py-2">
                                        <label for="category">Category</label>
                                        <select name="category" id="category" class="form-control">
                                            <option value="">-- select category --</option>
                                            @foreach ($blog_category as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="py-2">
                                        <label for="status">Status</label>
                                        <select name="status" id="status" class="form-control">
                                            <option value="1">Active</option>
                                            <option value="0">inactive</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <button style="float:right" type="submit" class="btn btn-info my-5 mx-3">Submit</button>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>



    </script>
@endpush


