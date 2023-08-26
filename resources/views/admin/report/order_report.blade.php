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
                        <h4>Order Reports </h4>
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
                                    <th>Order Id</th>
                                    <th>Name</th>
                                    <th>Payment Type</th>
                                    {{-- <th>subtotal</th> --}}
                                    <th>Total</th>
                                    <th>Date</th>
                                    <th>status</th>
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
                url: "{{ route('admin.order.report.getData') }}",
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
                {data: 'order_id'},
                {data: 'c_name'},
                {data: 'payment_type'},
                // {data: 'subtotal'},.
                {data: 'total'},
                {data: 'date'},
                {data: 'status'},
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
                            columns: '0,1,2,3,4,5'
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
                            columns: '0,1,2,3,4,5'
                        },
                    },
                    {
                        extend: 'print',
                        text: '<i class="fa fa-print" aria-hidden="true"></i> Print',
                        className: 'printButton btn btn-sm btn-primary',
                        orientation: "landscape",
                        pageSize: "A3",
                        exportOptions: {
                            columns: '0,1,2,3,4,5'
                        }
                    }
                ]
            }
        });


        // filtering

        $(document).on('change','.submitable',function () {
            $('#orders-datatables').DataTable().ajax.reload();
        });


    </script>
@endpush


