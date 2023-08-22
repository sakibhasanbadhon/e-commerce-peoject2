@extends('layouts.admin')
@section('styles')
<style>
    tr td:last-child{
        text-align: right;
    }

</style>

@endsection
@section('content')

    {{-- edit modal  --}}
    <div class="modal fade" id="editeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <form id="ajaxForm">
            @csrf
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h3 class="modal-title fs-5" id="modalTitle"></h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="dataId" name="dataId">

                        <div class="py-2">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" value="" class="form-control" required>
                        </div>

                        <div class="py-2">
                            <label for="address">Address</label>
                            <input type="text" name="address" id="address" value="" class="form-control"  required>
                        </div>

                        <div class="py-2">
                            <label for="phone">Phone</label>
                            <input type="text" name="phone" id="phone" value="" class="form-control" required>
                        </div>
                        <div class="py-2">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" value="" class="form-control" required>
                        </div>

                        <div class="py-2">
                            <label for="status">Order Status</label>
                            <select name="order_status" id="order_status" class="form-control">

                            </select>

                        </div>

                    </div>
                    <div class="modal-footer">
                    <button type="reset" class="btn btn-danger">Reset</button>
                    <button type="submit" class="btn btn-primary" id="modalSaveBtn"></button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    {{-- view modal --}}

    <div class="modal fade bd-example-modal-lg" id="order_view_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Order Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="order_view_body">

                </div>

            </div>
        </div>
    </div>





    <div class="container">

        <div class="row">
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-header p-3">
                        <h4>Total Orders </h4>
                    </div>

                    <div class="row p-2">
                        <div class="form-group col-4">
                            <label for="">Status</label>
                            <select name="status" class="form-control submitable" id="status">
                                <option value="">All</option>
                                <option value="0">Pending</option>
                                <option value="1">Received</option>
                                <option value="2">Shipped</option>
                                <option value="3">Complete</option>
                                <option value="4">Return</option>
                                <option value="5">Cancel</option>
                            </select>
                        </div>

                        <div class="form-group col-4">
                            <label for="">Payment</label>
                            <select name="payment_type" class="form-control submitable" id="payment_type">
                                <option value="">All</option>
                                <option value="Hand cash">Hand cash</option>
                                <option value="Paypal">Paypal</option>
                                <option value="Aamarpay">Aamarpay</option>

                            </select>
                        </div>

                        <div class="form-group col-4">
                            <label for="date">Date</label>
                            <input type="date" class="form-control submitable" id="date">
                        </div>
                    </div>

                    <div class="card-body">
                        <table class="table table-sm" id="orders-datatables">
                            <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Name</th>
                                    <th>phone</th>
                                    <th>Email</th>
                                    <th>subtotal</th>
                                    <th>Total</th>
                                    <th>Payment Type</th>
                                    <th>Date</th>
                                    <th>status</th>
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
        // var _token = "{{ csrf_token() }}";
        let table = $('#orders-datatables').DataTable({
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
                url: "{{ route('admin.order.get-data') }}",
                type: "POST",
                dataType: "JSON",
                data: function(d) {
                    d._token = _token
                    d.status = $("#status").val(); //#status value going to controller request
                    d.payment_type = $("#payment_type").val(); //#status value going to controller request
                    d.date = $("#date").val();  //#date value going to controller request
                }
            },
            columns: [
                {data: 'id'},
                {data: 'c_name'},
                {data: 'c_phone'},
                {data: 'c_email'},
                {data: 'subtotal'},
                {data: 'total'},
                {data: 'payment_type'},
                {data: 'date'},
                {data: 'status'},
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


        // filtering

        $(document).on('change','.submitable',function () {
            $('#orders-datatables').DataTable().ajax.reload();
        });


        $(document).on("click",'button#edit-btn',function(e) {
            e.preventDefault();
            let url = "{{ route('admin.order.edit') }}";
            let data_id = $(this).data('id');
            $('#editeModal').modal('show');
            $('#modalTitle').text('Order Update');
            $('button#modalSaveBtn').text('Save Change');
            $('#dataId').val(data_id);

            $.ajax({
                type: "post",
                url: url,
                data: {_token:_token,data_id:data_id},
                dataType:'json',
                success: function(response) {
                    if (response) {
                        $('form#ajaxForm input[name="name"]').val(response.orders.c_name);
                        $('form#ajaxForm input[name="address"]').val(response.orders.c_address);
                        $('form#ajaxForm input[name="phone"]').val(response.orders.c_phone);
                        $('form#ajaxForm input[name="email"]').val(response.orders.c_email);
                        $('form#ajaxForm #order_status').html(response.order_status);

                    }
                }
            });
        });


        // Data Update



        // Data Update

        $(document).on("submit",'form#ajaxForm',function(e) {
            e.preventDefault();
            let form = new FormData(this);
                $.ajax({
                    type: "post",
                    url: "{{ route('admin.order.update') }}",
                    data: form,
                    contentType:false,
                    processData:false,
                    success: function(response) {
                        if (response) {
                            $('form#ajaxForm').trigger("reset");
                            $('.modal').modal('hide');
                            table.draw();
                            toastr.success(response.message);
                        }
                    },
                    error: function (response) {
                        $('form#ajaxForm').trigger("reset");
                        $('.modal').modal('hide');
                        toastr.error('Opps! Something went wrong');
                    }
            });
        });


        // Order View
        // $(document).on("click",'button#view-btn',function(e) {
        //     alert('It\$\'s work');
        //     e.preventDefault();
        //     let url = "{{ route('admin.order.edit') }}";
        //     let data_id = $(this).data('id');
        //     $('.modal').modal('show');
        //     $('#modalTitle').text('Order Update');
        //     $('button#modalSaveBtn').text('Save Change');
        //     $('#dataId').val(data_id);

        //     $.ajax({
        //         type: "post",
        //         url: url,
        //         data: {_token:_token,data_id:data_id},
        //         dataType:'json',
        //         success: function(response) {
        //             if (response) {
        //                 $('form#ajaxForm input[name="name"]').val(response.orders.c_name);
        //                 $('form#ajaxForm input[name="address"]').val(response.orders.c_address);
        //                 $('form#ajaxForm input[name="phone"]').val(response.orders.c_phone);
        //                 $('form#ajaxForm input[name="email"]').val(response.orders.c_email);
        //                 $('form#ajaxForm #order_status').html(response.order_status);

        //             }
        //         }
        //     });
        // });

        $(document).on('click',"button#view-btn",function (e) {
            e.preventDefault();
             let button_id = $(this).data('id');
             $('#order_view_modal').modal('show');
            //  alert(button_id);
            $.ajax({
                url: "{{ route('admin.order.view') }}",
                type: "GET",
                data: {_token:_token,button_id:button_id},
                success: function (response) {
                    $("#order_view_body").html(response);

                }
            });

        });


        // order view status update
        $(document).on("submit",'form#status_form',function(e) {
            e.preventDefault();
            let form = new FormData(this);
                $.ajax({
                    type: "post",
                    url: "{{ route('admin.status.update') }}",
                    data: form,
                    contentType:false,
                    processData:false,
                    success: function(response) {
                        if (response) {
                            $('form#status_form').trigger("reset");
                            $('.modal').modal('hide');
                            table.draw();
                            toastr.success(response.message);
                        }
                    },
                    error: function (response) {
                        $('form#status_form').trigger("reset");
                        $('.modal').modal('hide');
                        toastr.error('Opps! Something went wrong');
                    }
            });
        });



         // Data delete

         $(document).on('click','button#delete-btn',function(e) {
            e.preventDefault();
            let url = "{{ route('admin.order.delete') }}";
            let data_id = $(this).data('id');
            deleteWarning(url,data_id)
        });





    </script>
@endpush


