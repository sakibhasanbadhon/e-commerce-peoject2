
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
                    {{-- <input type="hidden" id="dataId" name="dataId"> --}}

                    <div class="py-2">
                        <input type="text" name="coupon_code" class="form-control" placeholder="Coupon Code" required>
                    </div>

                    <div class="py-2">
                        <select class="form-control" name="type" id="">
                            <option value="1">Fixed</option>
                            <option value="2">Percentage</option>
                        </select>
                    </div>

                    <div class="py-2">
                        <input type="text" name="coupon_amount" class="form-control" placeholder="Coupon Amount" required>
                    </div>

                    <div class="py-2">
                        <input type="date" name="valid_date" class="form-control" required>
                    </div>
                    <div class="py-2">
                        <select class="form-control" name="status" id="">
                            <option value="1">Active</option>
                            <option value="0">Pending</option>
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
