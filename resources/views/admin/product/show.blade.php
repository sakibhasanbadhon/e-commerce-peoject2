@extends('layouts.admin')
@section('styles')
<style>
    .sl_no{
        width: 30px;
    }

</style>

@endsection
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-header p-3">
                        <h4 class=" d-flex justify-content-between"> Product View
                            <a href="{{ route('admin.product.index') }}" id=""  class="btn btn-outline-primary">Product List</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <table class="table-sm w-100 table-striped">

                            <tbody>
                                <tr>
                                    <th class="sl_no">Sl</th>
                                    <th>Subject</th>
                                    <th><span class="p-3"></span>Subject Details</th>
                                </tr>
                                <tr>
                                    <th class="sl_no">1.</th>
                                    <td>Thumbnail</td>
                                    <td><span class="p-3">:</span><img class="ml-5" src="{{ $product_show->thumbnail != null ? asset('admin/product-images/'.$product_show->thumbnail)  : 'https://via.placeholder.com/80' }}" width="150" height="110" alt=""></td>
                                </tr>
                                <tr>
                                    <th class="sl_no">2.</th>
                                    <td>Name</td>
                                    <td><span class="p-3">:</span>{{ $product_show->name }}</td>
                                </tr>
                                <tr>
                                    <th class="sl_no">3.</th>
                                    <td>Slug</td>
                                    <td><span class="p-3">:</span>{{ $product_show->slug }}</td>
                                </tr>
                                <tr>
                                    <th class="sl_no">4.</th>
                                    <td>Code</td>
                                    <td><span class="p-3">:</span>{{ $product_show->code }}</td>
                                </tr>
                                <tr>
                                    <th class="sl_no">5.</th>
                                    <td>Description</td>
                                    <td><span class="p-3">:</span>{!! $product_show->description !!}</td>
                                </tr>
                                <tr>
                                    <th class="sl_no">6.</th>
                                    <td>Category</td>
                                    <td><span class="p-3">:</span>{{ $product_show->category->category_name }}</td>
                                </tr>
                                <tr>
                                    <th class="sl_do">7.</th>
                                    <td>Subcategory</td>
                                    <td><span class="p-3">:</span>{{ $product_show->subcategory->subcategory_name }}</td>
                                </tr>
                                <tr>
                                    <th class="sl_do">8.</th>
                                    <td>Childcategory</td>
                                    <td><span class="p-3">:</span>{{ $product_show->child_category->childCategory_name ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th class="sl_no">9.</th>
                                    <td>Brand</td>
                                    <td><span class="p-3">:</span>{{ $product_show->brand->brand_name }}</td>
                                </tr>
                                <tr>
                                    <th class="sl_no">10.</th>
                                    <td>PickUp Point</td>
                                    <td><span class="p-3">:</span>{{ $product_show->pickup_point->pickup_point_name }}</td>
                                </tr>
                                <tr>
                                    <th class="sl_no">11.</th>
                                    <td>Color</th>
                                    <td><span class="p-3">:</span>{{ $product_show->color }}</td>
                                </tr>
                                <tr>
                                    <th class="sl_no">12.</th>
                                    <td>Size</td>
                                    <td><span class="p-3">:</span>{{ $product_show->size }}
                                    {{-- @foreach ($product_show as $item)
                                        <span class="badge badge-info">{{ $item->size }}</span>
                                    @endforeach --}}
                                    </td>
                                </tr>
                                <tr>
                                    <th class="sl_no">13.</th>
                                    <td>Unit</td>
                                    <td><span class="p-3">:</span>{{ $product_show->unit }}</td>
                                </tr>
                                <tr>
                                    <th class="sl_no">14</th>
                                    <td>Tags</td>
                                    <td><span class="p-3">:</span>{{ $product_show->tags }}</td>
                                </tr>
                                <tr>
                                    <th class="sl_no">15.</th>
                                    <td>Purchase Price </td>
                                    <td><span class="p-3">:</span>{{ $product_show->purchase_price }}</td>
                                </tr>
                                <tr>
                                    <th class="sl_no">16. </th>
                                    <td>Discount Price </td>
                                    <td><span class="p-3">:</span>{{ $product_show->discount_price }}</td>
                                </tr>
                                <tr>
                                    <th class="sl_no">17.</th>
                                    <td>Selling Price </th>
                                    <td><span class="p-3">:</span>{{ $product_show->selling_price }}</td>
                                </tr>
                                <tr>
                                    <th class="sl_no">18. </th>
                                    <td>Warehouse </td>
                                    <td><span class="p-3">:</span>{{ $product_show->warehouse_name->warehouse_name }}</td>
                                </tr>
                                <tr>
                                    <th class="sl_no">19. </th>
                                    <td>Stock Quantity </td>
                                    <td><span class="p-3">:</span>{{ $product_show->stock_quantity }}</td>
                                </tr>
                                <tr>
                                    <th class="sl_no">20.</th>
                                    <td>Featured</td>
                                    <td><span class="p-3">:</span>
                                        @if ($product_show->featured==1)
                                            <span class="badge badge-success">Active</span>
                                        @else
                                            <span class="badge badge-warning">Inactive</span>
                                        @endif

                                    </td>
                                </tr>
                                <tr>
                                    <th class="sl_no">21.</th>
                                    <td>Today Deal</td>
                                    <td><span class="p-3">:</span>
                                        @if ($product_show->today_deal==1)
                                            <span class="badge badge-success">Active</span>
                                        @else
                                            <span class="badge badge-warning">Inactive</span>
                                        @endif

                                    </td>
                                </tr>
                                <tr>
                                    <th class="sl_no">22.</th>
                                    <td>status</td>
                                    <td><span class="p-3">:</span>
                                        @if ($product_show->status==1)
                                            <span class="badge badge-success">Active</span>
                                        @else
                                            <span class="badge badge-warning">Inactive</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th class="sl_no">23.</th>
                                    <td>Today Deal</td>
                                    <td><span class="p-3">:</span>
                                        @if ($product_show->today_deal==1)
                                            <span class="badge badge-success">Active</span>
                                        @else
                                            <span class="badge badge-warning">Inactive</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th class="sl_no">23.</th>
                                    <td>Slider Show</td>
                                    <td><span class="p-3">:</span>
                                        @if ($product_show->slider_show==1)
                                            <span class="badge badge-success">Active</span>
                                        @else
                                            <span class="badge badge-warning">Inactive</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th class="sl_no">24.</th>
                                    <td>Created at</td>
                                    <td><span class="p-3">:</span>{{ $product_show->created_at->format('d-m-Y') }}</td>
                                </tr>
                                <tr>
                                    <th class="sl_no">25.</th>
                                    <td>Author</td>
                                    <td><span class="p-3">:</span>{{ $product_show->admin_id }}</td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



@push('scripts')
    <script>

        // filtering

        $(document).on('change','.submitable',function () {
            $('#product-datatables').DataTable().ajax.reload();
        });



        // Featured active
        $(document).on("click",'.active_featured',function(e) {
            e.preventDefault();
            let url = "{{ route('admin.product.featured_active') }}";
            let data_id = $(this).data('id');
            OnOFFSwitch(url,data_id);
        });

        // Featured active deactivate
        $(document).on("click",'.deactive_featured',function(e) {
            e.preventDefault();
            let url = "{{ route('admin.product.featured_deactivate') }}";
            let data_id = $(this).data('id');
            OnOFFSwitch(url,data_id);
        });

        // today_deal Active
        $(document).on("click",'.active_today_deal',function(e) {
            e.preventDefault();
            let url = "{{ route('admin.product.today_deal_active') }}";
            let data_id = $(this).data('id');
            OnOFFSwitch(url,data_id);
        });
        // today_deal Deactivate
        $(document).on("click",'.deactivate_today_deal',function(e) {
            e.preventDefault();
            let url = "{{ route('admin.product.today_deal_deactivate') }}";
            let data_id = $(this).data('id');
            OnOFFSwitch(url,data_id);
        });

        // status Active
        $(document).on("click",'.active_status',function(e) {
            e.preventDefault();
            let url = "{{ route('admin.product.status_active') }}";
            let data_id = $(this).data('id');
            OnOFFSwitch(url,data_id);
        });
        // status Deactivate
        $(document).on("click",'.deactivate_status',function(e) {
            e.preventDefault();
            let url = "{{ route('admin.product.status_deactivate') }}";
            let data_id = $(this).data('id');
            OnOFFSwitch(url,data_id);
        });



        // Data delete

        $(document).on('click','button#delete-btn',function(e) {
            e.preventDefault();
            let url = "{{ route('admin.product.destroy') }}";
            let data_id = $(this).data('id');
            deleteWarning(url,data_id);
        });





    </script>
@endpush


