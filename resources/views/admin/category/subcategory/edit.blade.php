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
                        <h4 class=" d-flex justify-content-between"> Subcategory List
                            <a href="{{ route('admin.subcategory.index') }}" id="add_btn" class="btn btn-outline-primary">Back</a>
                        </h4>

                    </div>
                    <form action="{{ route('admin.subcategory.update',$subcategory->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-sm-8">
                                <div class="mb-3 py-2">
                                    <strong><label for="brand_status" class="form-label">Category</label></strong>
                                    <select class="form-control form-control" name="category_id" id="brand_status" aria-label="Default select example">
                                        <option value="" > ----Select category----</option>
                                        @foreach ($category as $categories)
                                            <option value="{{ $categories->id }}" {{ $subcategory->category_id == $categories->id ? 'selected' : ''  }} >{{ $categories->category_name }}</option>
                                        @endforeach

                                    </select>
                                </div>

                                <div class="mb-3 py-2">
                                    <strong><label for="subcategory_name" class="form-label">Brand Name</label></strong>
                                    <input type="text" name="subcategory_name" value="{{ $subcategory->subcategory_name }}" class="form-control" id="subcategory_name">

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
