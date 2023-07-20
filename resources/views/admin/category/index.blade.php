@extends('layouts.admin')
@section('styles')
<style>
    tr td:last-child{
        text-align: right;
    }
</style>

@endsection
@section('content')
    @include('admin.category.modal')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-header p-3">
                        <h4 class=" d-flex justify-content-between"> Category List
                            <a id="add_btn" onclick="addNewBtn('Add Category','Save')" class="btn btn-outline-primary">Add</a>
                        </h4>

                    </div>
                    <div class="card-body">
                        <table class="table table-sm" id="category-datatables">
                            <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Category Name</th>
                                    <th>Category Name</th>
                                    <th>Home Page</th>
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

        let table = $('#category-datatables').DataTable({
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
                url: "{{ route('admin.category.get-data') }}",
                type: "POST",
                dataType: "JSON",
                data: function(d) {
                    d._token = _token
                }
            },
            columns: [
                {data: 'id'},
                {data: 'category_name'},
                {data: 'category_slug'},
                {data: 'home_page'},
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

        // modal show

        function addNewBtn(modalTitle,modalSaveBtn){
            $('#dataId').val('');
            $('form#ajaxForm').trigger("reset");
            $('.modal').modal('show');
            $('#modalTitle').text(modalTitle);
            $('button#modalSaveBtn').text(modalSaveBtn);

        }


        // data store and update

        $(document).on("submit",'form#ajaxForm',function(e) {
            e.preventDefault();
            let url = "{{ route('admin.category.store') }}";
            let form = new FormData(this);
            updateCreate(url,form);
        });


        // Data Edit

        $(document).on("click",'button#edit-btn',function(e) {
            e.preventDefault();
            let data_id = $(this).data('id');
            $('.modal').modal('show');
            $('#modalTitle').text('Edit category');
            $('button#modalSaveBtn').text('Save Change');
            $('#dataId').val(data_id);

            $.ajax({
                type: "post",
                url: "{{ route('admin.category.edit') }}",
                data: {_token:_token,data_id:data_id},
                dataType:'json',
                success: function(response) {
                    if (response) {
                        $('form#ajaxForm input[name="name"]').val(response.category.category_name);
                        // $('#home_page]').html(response.category_home_page);
                        $('#category_home_page').html(response.category_home_page);

                    }
                }
            });

        });

        // Data delete

        $(document).on('click','button#delete-btn',function(e) {
            e.preventDefault();
            let url = "{{ route('admin.category.destroy') }}";
            let data_id = $(this).data('id');
            dataDelete(url,data_id);
        });





    </script>
@endpush


