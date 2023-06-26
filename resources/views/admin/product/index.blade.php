@extends('layouts.admin')
@section('styles')
<style>
    tr td:last-child{
        text-align: right;
    }

</style>

@endsection
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-header p-3">
                        <h4 class=" d-flex justify-content-between"> Product List
                            <a href="{{ route('admin.product.create') }}" id=""  class="btn btn-outline-primary">Add</a>
                        </h4>

                    </div>
                    <div class="card-body">
                        <table class="table table-sm" id="product-datatables">
                            <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Thumbnail</th>
                                    <th>Name</th>
                                    <th>Code</th>
                                    <th>Category</th>
                                    <th>Subcategory</th>
                                    <th>Brand</th>
                                    <th>Featured</th>
                                    <th>Today Deal</th>
                                    <th>status</th>
                                    <th>created_at</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

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

        let table = $('#product-datatables').DataTable({
            processing: true,
            serverSide: true,
            order: [], //Initial no order
            bInfo: true, //TO show the total number of data
            bFilter: false, //For datatable default search box show/hide
            responsive: true,
            ordering: false,
            lengthMenu: [
                [5, 10, 15, 25, 50, 100, 1000, 10000, -1],
                [5, 10, 15, 25, 50, 100, 1000, 10000, "All"]
            ],
            pageLength: 25, //number of data show per page
            ajax: {
                url: "{{ route('admin.product.get-data') }}",
                type: "POST",
                dataType: "JSON",
                data: function(d) {
                    d._token = _token
                }
            },
            columns: [
                {data: 'id'},
                {data: 'thumbnail'},
                {data: 'name'},
                {data: 'code'},
                {data: 'category_id'},
                {data: 'subcategory_id'},
                {data: 'brand_id'},
                {data: 'featured'},
                {data: 'today_deal'},
                {data: 'status'},
                {data: 'created_at'},
                {data: 'operation'},
            ],
            language: {
                processing: '<img src="{{ asset('/table-loading.svg') }}">',
                emptyTable: '<strong class="text-danger">No Data Found</strong>',
                infoEmpty: '',
                zeroRecords: '<strong class="text-danger">No Data Found</strong>',
                oPaginate: {
                    sPrevious: "Previous", // This is the link to the previous page
                    sNext: "Next", // This is the link to the next page
                },
                lengthMenu: "_MENU_"
            },
            dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6' <'float-right pr-15'B>>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'<'float-right pr-15'p>>>",
            buttons: {
                buttons: [
                    {
                        text: '<i class="fa fa-refresh" aria-hidden="true"></i> Reload',
                        className: 'btn btn-sm btn-primary',
                        action: function (e, dt, node, config) {
                            dt.ajax.reload(null, false);
                        }
                    },
                    {
                        extend: 'pdf',
                        title: 'Role List',
                        filename: 'roles_{{ date("d-m-Y") }}',
                        text: '<i class="fa fa-file-pdf-o" aria-hidden="true"></i> PDF',
                        className: 'pdfButton btn btn-sm btn-primary',
                        orientation: "landscape",
                        pageSize: "A3",
                        exportOptions: {
                            columns: '0,1,2,3,4'
                        },
                        customize: function(doc) {
                            doc.defaultStyle.alignment = 'center';
                        }
                    },
                    {
                        extend: 'excel',
                        title: 'Role List',
                        filename: 'roles_{{ date("d-m-Y") }}',
                        text: '<i class="fa fa-file-excel-o" aria-hidden="true"></i> Excel',
                        className: 'excelButton btn btn-sm btn-primary',
                        exportOptions: {
                            columns: '0,1,2,3,4'
                        },
                    },
                    {
                        extend: 'print',
                        text: '<i class="fa fa-print" aria-hidden="true"></i> Print',
                        className: 'printButton btn btn-sm btn-primary',
                        orientation: "landscape",
                        pageSize: "A3",
                        exportOptions: {
                            columns: '0,1,2,3,4'
                        }
                    }
                ]
            }
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

        // $(document).on('click','button#delete-btn',function(e) {
        //     e.preventDefault();
        //     let url = "";
        //     let data_id = $(this).data('id');
        //     dataDelete(url,data_id);
        // });





    </script>
@endpush


