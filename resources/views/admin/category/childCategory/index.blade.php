@extends('layouts.admin')
@section('styles')
<style>
    tr td:last-child{
        text-align: right;
    }
</style>

@endsection
@section('content')

    {{-- subcategory modal start  --}}
        @include('admin.category.childCategory.createModal')
    {{-- subcategory modal end  --}}

        {{-- subcategory modal start  --}}
        <form action="" method="post" id="editForm">
            @csrf
            <div class="modal fade" id="child_cat_edit_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="child_category_modal_title"> </h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label"> Category: </label>
                            <select name="subcategory_id" id="category_id" class="form-control" required>
                                <option value=""> -- Select Category -- </option>
                                @foreach ($category as $item)
                                    <option class="text-primary" disabled="">--{{ $item->category_name }}--</option>
                                    @php
                                        $subcategory = DB::table('subcategories')->where('category_id',$item->id)->get();
                                    @endphp

                                    @foreach ($subcategory as $item)
                                        <option value="{{ $item->id }}" >{{ $item->subcategory_name }}</option>
                                    @endforeach
                                @endforeach

                            </select>

                            <input type="hidden" name="child_cat_hide_id" id="dataId">
                        </div>


                        <div class="form-group">
                          <label for="recipient-name" class="col-form-label">Child Category Name:</label>
                          <input type="text" name="childCategory_name" class="form-control" id="recipient-name" required>

                        </div>


                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="submit" id="modal_save_botton" class="btn btn-primary">Save</button>
                    </div>
                  </div>
                </div>
            </div>
        </form>

        {{-- subcategory modal end  --}}




    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="alert-message"></div>
                <div class="card ">
                    <div class="card-header p-3">
                        <h4 class=" d-flex justify-content-between"> Child Category List
                            <button id="add_btn" onclick="addNewBtn('Add Child_Category','Save')" class="btn btn-outline-primary">Add</button>
                        </h4>

                    </div>
                    <div class="card-body">
                        <table class="table table-sm" id="childCategory-datatables">
                            <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Childcategory Name</th>
                                    <th>Category</th>
                                    <th>SubCategory</th>
                                    <th>Created_at</th>
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

        let table = $('#childCategory-datatables').DataTable({
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
                url: "{{ route('admin.childCategory.get-data') }}",
                type: "POST",
                dataType: "JSON",
                data: function(d) {
                    d._token = _token
                }
            },
            columns: [
                {data: 'id'},
                {data: 'childCategory_name'},
                {data: 'category_id'},
                {data: 'subcategory_id'},
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



        // category wise subcategory select
        $(document).ready(function() {
            $('#category_id').on('change', function() {
                var categoryId = $(this).val();

                if (categoryId) {
                $.ajax({
                    url: 'subcategories/' + categoryId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                    $('#subcategory').empty().prop('disabled', false);

                    $.each(data, function(key, subcategory) {
                        $('#subcategory').append('<option value="' + subcategory.id + '">' + subcategory.subcategory_name + '</option>');
                    });
                    },
                    error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    }
                });
                } else {
                $('#subcategory').empty().prop('disabled', true);
                }
            });
        });


        // when click save button
        function addNewBtn(modalTitle,modalSaveBtn){
            $('#dataId').val('');
            $('form#ajaxForm').trigger("reset"); //create form
            $('#child_cat_create_modal').modal('show');
            $('#child_category_modal_title').text(modalTitle);
            $('button#modal_save_botton').text(modalSaveBtn);

        }



        // data store and update

        $(document).on("submit",'form#ajaxForm',function(e) {
            e.preventDefault();
            let url = "{{ route('admin.childCategory.store') }}";
            let form = new FormData(this);
            updateCreate(url,form);
        });


        // Data Edit

        $(document).on("click",'button#edit-btn',function(e) {
            e.preventDefault();
            let data_id = $(this).data('id');
            $('form#editForm').trigger("reset");
            $('#child_cat_edit_modal').modal('show');
            $('#child_category_modal_title').text('Edit Child-Category');
            $('button#modalSaveBtn').text('Save Change');
            $('#dataId').val(data_id);


            $.ajax({
                type: "post",
                url: "{{ route('admin.childCategory.edit') }}",
                data: {_token:_token,data_id:data_id},
                dataType:'json',
                success: function(response) {
                    if (response) {
                        $('form#editForm input[name="childCategory_name"]').val(response.childCategory_name);

                    }
                }
            });
        });


        // Data Update

        $(document).on("submit",'form#editForm',function(e) {
            e.preventDefault();
            let form = new FormData(this);
            $.ajax({
                type: "post",
                url: "{{ route('admin.childCategory.update') }}",
                data: form,
                contentType:false,
                processData:false,
                success: function(response) {
                    if (response) {
                        $('form#ajaxForm').trigger("reset");
                        $('#child_cat_edit_modal').modal('hide');
                        table.draw();
                        toastr.success('Data Update Success');
                    }
                },
                error: function (response) {
                    $('form#editForm').trigger("reset");
                    $('#child_cat_edit_modal').modal('hide');
                    toastr.error('Opps! Something went wrong');
                }
            });
        });



        // Data delete

        $(document).on('click','button#delete-btn',function(e) {
            e.preventDefault();
            let url = "{{ route('admin.childCategory.destroy') }}";
            let data_id = $(this).data('id');
            deleteWarning(url,data_id);
        });

        $(document).on('click','button#delete-btn',function(e) {
            e.preventDefault();

        });







    </script>
@endpush


