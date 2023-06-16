@extends('layouts.admin')
@section('styles')
<style>
    tr td:last-child{
        text-align: right;
    }
</style>

@endsection
@section('content')

<div class="content-wrapper">
    <!-- START PAGE CONTENT-->
    <div class="page-content fade-in-up">
        <div class="row">
            <div class="col-md-8">
                <div class="alert-message"></div>
                <div class="card p-5">
                    <div class="card-header p-3">
                        <h4 class=" d-flex justify-content-between"> Child-Category Edit
                            <a href="{{ route('admin.childCategory.index') }}" id="add_btn" class="btn btn-outline-primary">Back</a>
                        </h4>

                    </div>
                    <form action="{{ route('admin.childCategory.update',$childCategory->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-sm-8">
                                <div class="mb-3 py-2">
                                    <strong><label for="category" class="form-label">Category</label></strong>
                                    <select class="form-control form-control" name="category_id" id="category" aria-label="Default select example">
                                        <option value="" > --- Select category ---</option>
                                        @foreach ($category as $categories)
                                            <option value="{{ $categories->id }}" {{ $categories->id == $childCategory->category_id ? 'selected' : ''  }} > {{ $categories->category_name }}</option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="mb-3 py-2">
                                    <strong><label for="subcategory" class="form-label">Subcategory</label></strong>
                                    <select class="form-control form-control" name="subcategory_id" id="subcategory" aria-label="Default select example">
                                        <option value="" > --- Select category --- </option>
                                        @foreach ($subcategory as $subcategories)
                                            <option value="{{ $subcategories->id }}" {{ $subcategories->id == $childCategory->category_id ? 'selected' : ''  }} > {{ $subcategories->subcategory_name }}</option>
                                        @endforeach

                                    </select>
                                </div>

                                <div class="mb-3 py-2">
                                    <strong><label for="subcategory_name" class="form-label">Brand Name</label></strong>
                                    <input type="text" name="childCategory_name" value="{{ $childCategory->childCategory_name }}" class="form-control" id="subcategory_name">

                                </div>


                            </div>

                        </div>


                        <div class="d-flex justify-content-end mr-3">
                            <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>



@endsection

@push('scripts')


@endpush
