    {{-- Campaign modal start --}}
    <div class="modal fade" id="campaign_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

        <form method="POST" id="ajaxForm">
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

                        <div class="py-2">
                            <label for="start_date"> Campaign Title</label>
                            <input type="text" name="title" class="form-control" placeholder="Write campaign Title" required>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="py-2">
                                    <label for="start_date"> Start Date</label>
                                    <input type="date" name="start_date" id="start_date" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="py-2">
                                    <label for="end_date"> End Date</label>
                                    <input type="date" name="end_date" id="end_date" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="py-2">
                                    <label for="status"> Status</label>
                                    <select name="status" class="form-control">
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="py-2">
                                    <label for="discount"> Discount</label>
                                    <input type="text" name="discount" id="discount" class="form-control custom-select" required>
                                    <small class="text-danger">Dscount percentage are apply for all product selling price.</small>
                                </div>
                            </div>
                        </div>


                        <div class="modalEdit_avatar"> </div> {{-- image show --}}

                        <div class="py-2">
                            <input type="file" name="image" data-height="150" class="form-control dropify">
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

{{-- Brand modal end --}}


{{-- Campaign modal start --}}
<div class="modal fade" id="campaign_edit_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <form method="POST" id="campaign-updateForm">
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
                        <label for="start_date"> Campaign Title</label>
                        <input type="text" name="title" class="form-control" placeholder="Write campaign Title" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="py-2">
                                <label for="start_date"> Start Date</label>
                                <input type="date" name="start_date" id="start_date" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="py-2">
                                <label for="end_date"> End Date</label>
                                <input type="date" name="end_date" id="end_date" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="py-2">
                                <label for="status"> Status</label>
                                <select name="status" id="canpaign_status" class="form-control">
                                    {{-- data come from controller --}}
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="py-2">
                                <label for="discount"> Discount</label>
                                <input type="text" name="discount" id="discount" class="form-control custom-select" required>
                                <small class="text-danger">Dscount percentage are apply for all product selling price.</small>
                            </div>
                        </div>
                    </div>


                    <div class="modalEdit_avatar"> </div> {{-- image show --}}

                    <div class="py-2">
                        <input type="file" name="image" data-height="150" class="form-control dropify">
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


