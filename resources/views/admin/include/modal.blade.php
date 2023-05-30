
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <form method="POST" id="ajaxForm">
        @csrf
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h3 class="modal-title fs-5" id="exampleModalLabel">Add Category</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                        <div class="py-2">
                            <input type="text" name="name" class="form-control" placeholder="Category Name" required>
                            @error('name')
                                <span class="text-danger"> {{ $message }}</span>
                            @enderror
                        </div>

                        <div class="py-2">
                            <input type="text" name="slug" class="form-control" placeholder="Category Slug" required>
                        </div>

                        {{-- <select name="status" id="" class="form-control">
                            <option value="">Select Status</option>
                            <option value="1">Active</option>
                            <option value="0">Pending</option>
                        </select> --}}

                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </form>
  </div>
