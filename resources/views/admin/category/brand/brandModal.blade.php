    {{-- Brand modal start --}}
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

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
                            <input type="hidden" id="dataId" name="dataId">

                            <div class="py-2">
                                <input type="text" name="brand_name" class="form-control" placeholder="Write Category Name" required>
                                @error('name')
                                    <span class="text-danger"> {{ $message }}</span>
                                @enderror
                            </div>

                            <div class="modalEdit_avatar"> </div> {{-- image show --}}

                            <div class="py-2">
                                <input type="file" name="brand_logo" data-height="150" class="form-control dropify" required>
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
