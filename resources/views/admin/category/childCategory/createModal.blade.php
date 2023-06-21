    {{-- subcategory modal start  --}}
    <form action="" method="post" id="ajaxForm">
        @csrf
        <div class="modal fade" id="child_cat_create_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <select name="category_id" id="category_id" class="form-control" required>
                            <option value=""> -- Select Category -- </option>
                            @foreach ($category as $item)
                                <option id="category_option" value="{{ $item->id }}" data-id="{{ $item->id }}" > {{ $item->category_name }} </option>
                            @endforeach

                        </select>
                    </div>
                    <div class="form-group">
                      <label for="recipient-name" class="col-form-label"> Sub Category: </label>
                      <select id="subcategory" name="subcategory_id" class="form-control">
                        <option value="">-- Select a Subcategory --</option>
                      </select>
                    </div>

                    <div class="form-group">
                      <label for="recipient-name" class="col-form-label">Child Category Name:</label>
                      <input type="text" name="childCategory_name" class="form-control" id="recipient-name" required>
                        @error('childCategory_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
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
