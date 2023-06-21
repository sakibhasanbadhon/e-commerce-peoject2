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
                    <div class="ibox-title">Password Change</div>
                    <div class="ibox-tools">
                        <a class="ibox-collapse text-white"><i class="fa fa-minus"></i></a>
                        <a class="fullscreen-link text-white"><i class="fa fa-expand"></i></a>
                    </div>
                </div>
                <div class="ibox-body">
                    <form action="" method="post">
                        @csrf
                        @method('PUT')

                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label for="">Product Name</label>
                                <input type="text" class="form-control" name="">
                            </div>
                            <div class="col-sm-6">
                                <label for="">Product Code</label>
                                <input type="text" class="form-control" name="">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label for="">Category</label>
                                <select name="" id="" class="form-control">
                                    <option value="1">1</option>
                                    <option value="1">2</option>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label for="">Brand</label>
                                <select name="" id="" class="form-control">
                                    <option value="1">1</option>
                                    <option value="1">2</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label for="">SubCategory</label>
                                <select name="" id="" class="form-control">
                                    <option value="1">1</option>
                                    <option value="1">2</option>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label for="">Unit</label>
                                <select name="" id="" class="form-control">
                                    <option value="1">1</option>
                                    <option value="1">2</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label for="">Child Category</label>
                                <select name="" id="" class="form-control">
                                    <option value="1">1</option>
                                    <option value="1">2</option>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label for="">Pickup Point</label>
                                <select name="" id="" class="form-control">
                                    <option value="1">1</option>
                                    <option value="1">2</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-4">
                                <label for="">Perchase Price</label>
                                <input type="text" class="form-control" name="">
                            </div>
                            <div class="col-sm-4">
                                <label for="">Selling Price</label>
                                <input type="text" class="form-control" name="">
                            </div>
                            <div class="col-sm-4">
                                <label for="">Discount Price</label>
                                <input type="text" class="form-control" name="">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label for="">Warehouse</label>
                                <select name="" id="" class="form-control">
                                    <option value="1">1</option>
                                    <option value="1">2</option>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label for="">Stock</label>
                                <input type="text" class="form-control" name="">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label for="">color</label>
                                <input type="text" class="form-control" name="">
                            </div>
                            <div class="col-sm-6">
                                <label for="">size</label>
                                <input type="text" class="form-control" name="">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label for="">Stock</label>
                                <textarea name="" id="summernote"  rows="4"> </textarea>
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

        <div class="col-md-4 bg-white">
            <div class="form-group">
                <label for="">Main Thumbnail</label>
                <input type="file" name="brand_logo" data-height="150" class="form-control dropify" placeholder="Write Category Slug" required>
            </div>
            <div class="form-group">
                <small class="text-secondary py-1">More images:(click add more image)</small>
                <table class="table table-bordered" id="dynamicAddRemove">
                    <tr>
                        <td><input type="file" name="addMoreInputFields[0][subject]" placeholder="Enter subject" class="form-control" />
                        </td>
                        <td><button type="button" name="add" id="dynamic-ar" class="btn btn-outline-primary">Add</button></td>
                    </tr>
                </table>
            </div>

            <div class="card p-5">
                <h6>Featured Product</h6>
                <div class = "toggle-switch">
                    <label class="switch-label" for="feature">
                    <input type = "checkbox" name="feature" class="input-feature" id="feature">
                        <span class = "pr-2 text-right switch_slider"> <span style="padding-right:15px">OFF</span> </span>
                        <span class = "switch_slider">ON</span>
                    </label>
                </div>
            </div>

            <div class="card p-5">
                <h6>Today Deal</h6>
                <div class = "toggle-switch">
                    <label class="switch-label" for="todaydeal">
                    <input type = "checkbox" name="todaydeal" class="input-todaydeal" id="todaydeal">
                        <span class = "pr-2 text-right switch_slider"> <span style="padding-right:15px">OFF</span> </span>
                        <span class = "switch_slider">ON</span>
                    </label>
                </div>
            </div>

            <div class="card p-5">
                <h6>Status</h6>
                <div class = "toggle-switch">
                    <label class="switch-label" for="status">
                    <input type = "checkbox" name="status" class="input-status" id="status">
                        <span class = "pr-2 text-right switch_slider"> <span style="padding-right:15px">OFF</span> </span>
                        <span class = "switch_slider">ON</span>
                    </label>
                </div>
            </div>


        </div>
    </div>
</div>

@endsection

@push('scripts')
    <script>
        var i = 0;
        $("#dynamic-ar").click(function () {
            ++i;
            $("#dynamicAddRemove").append('<tr><td><input type="file" name="addMoreInputFields[' + i +'][subject]" placeholder="Enter subject" class="form-control" /></td><td><button type="button" class="btn btn-outline-danger remove-input-field">Remove</button></td></tr>'
                );
        });
        $(document).on('click', '.remove-input-field', function () {
            $(this).parents('tr').remove();
        });
    </script>

@endpush
