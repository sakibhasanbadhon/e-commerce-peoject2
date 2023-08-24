
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

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
                        <input type="text" name="name" class="form-control" placeholder="Category name" required>
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
