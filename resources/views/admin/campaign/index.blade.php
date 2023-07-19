@extends('layouts.admin')
@section('styles')
<style>
    tr td:last-child{
        text-align: right;
    }
</style>

@endsection
@section('content')

    {{-- compaign modal start --}}
        @include('admin.campaign.modal')
    {{-- compaign modal end --}}

    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <div class="card ">
                    <div class="card-header p-3">
                        <h5 class=" d-flex justify-content-between"> Campaign List
                            <a id="add_btn" onclick="addNewBtn('Add Campaign','Save')" class="btn btn-outline-primary">Add</a>
                        </h5>

                    </div>
                    <div class="card-body">
                        <table class="table table-sm" id="campaign-datatables">
                            <thead>
                                <tr>
                                    <th>Start Date</th>
                                    <th>Title</th>
                                    <th>Image</th>
                                    <th>Disscount(%)</th>
                                    <th>Status</th>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js" integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>

        let table = $('#campaign-datatables').DataTable({
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
                url: "{{ route('admin.campaign.get-data') }}",
                type: "POST",
                dataType: "JSON",
                data: function(d) {
                    d._token = _token
                }
            },
            columns: [
                {data: 'start_date'},
                {data: 'title'},
                {data: 'campaign_image'},
                {data: 'discount'},
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



        // image drofidy

        $('.dropify').dropify({
            messages:
            {
                'default': 'Drag and drop a file here or click',
                'replace': 'Drag and drop or click to replace',
                'remove':  'Remove',
                'error':   'Ooops, something wrong happended.'
            }
        });

        // modal show

        function addNewBtn(modalTitle,modalSaveBtn){
            $('#dataId').val('');
            $('form#ajaxForm').trigger("reset");
            $('#campaign_modal').modal('show');
            $('#modalTitle').text(modalTitle);
            $('button#modalSaveBtn').text(modalSaveBtn);

        }


        // data store and update

        $(document).on("submit",'form#ajaxForm',function(e) {
            e.preventDefault();
            let url = "{{ route('admin.campaign.store') }}";
            let form = new FormData(this);
            updateCreate(url,form);
        });


        // Data Edit

        $(document).on("click",'button#edit-btn',function(e) {
            e.preventDefault();
            let data_id = $(this).data('id');

            $('#campaign_edit_modal').modal('show');
            $('#modalTitle').text('Edit Campaign');
            $('button#modalSaveBtn').text('Save Change');
            $('#dataId').val(data_id);

            $.ajax({
                type: "post",
                url: "{{ route('admin.campaign.edit') }}",
                data: {_token:_token,data_id:data_id},
                dataType:'json',
                success: function(response) {
                    if (response) {
                        $('form#campaign-updateForm input[name="title"]').val(response.campaign.title);
                        $('form#campaign-updateForm input[name="start_date"]').val(response.campaign.start_date);
                        $('form#campaign-updateForm input[name="end_date"]').val(response.campaign.end_date);
                        $('#canpaign_status').html(response.campaign_status);
                        $('form#campaign-updateForm input[name="discount"]').val(response.campaign.discount);

                        let avatar_path = "{{ asset('admin/campaign-img') }}/"+response.campaign.image;
                        $('form#campaign-updateForm .modalEdit_avatar').html('<img src="'+avatar_path+'" width="150" height="100" class="profile_img">');



                    }
                }
            });
        });

        // update

        $(document).on("submit",'form#campaign-updateForm',function(e) {
            e.preventDefault();
            let form = new FormData(this);
            $.ajax({
                type: "post",
                url: "{{ route('admin.campaign.update') }}",
                data: form,
                contentType:false,
                processData:false,
                success: function(response) {
                    if (response) {
                        $('form#ajaxForm').trigger("reset");
                        $('#campaign_edit_modal').modal('hide');
                        table.draw();
                        toastr.success('Data Update Success');
                    }
                },
                error: function (response) {
                    $('form#editForm').trigger("reset");
                    $('#campaign_edit_modal').modal('hide');
                    toastr.error('Opps! Something went wrong');
                }
            });
        });

        // Data delete

        $(document).on('click','button#delete-btn',function(e) {
            e.preventDefault();
            let url = "{{ route('admin.campaign.destroy') }}";
            let data_id = $(this).data('id');
            deleteWarning(url,data_id)
        });





    </script>
@endpush


