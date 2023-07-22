
<div class="modal fade" id="category_create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

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
                        <label for="icon">Category Icon</label>
                        <input type="file" name="icon" class="form-control dropify" id="icon">
                        @error('name')
                            <span class="text-danger"> {{ $message }}</span>
                        @enderror
                    </div>

                    <div class="py-2">
                        <label for="name">Category Name</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="Write Category Name" required>
                        @error('name')
                            <span class="text-danger"> {{ $message }}</span>
                        @enderror
                    </div>

                    <div class="py-2">
                        <label for="home_page"> Home Page</label>
                        <select name="home_page" class="form-control">
                            <option value="0">NO</option>
                            <option value="1">Yes</option>
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


<div class="modal fade" id="category_update_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <form method="POST" id="categoryForm">
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

                    <span id="category_icon"> </span>

                    <div class="py-2">
                        <label for="icon">Category Icon</label>
                        <input type="file" name="icon" class="form-control dropify" id="icon">
                        @error('name')
                            <span class="text-danger"> {{ $message }}</span>
                        @enderror
                    </div>

                    <div class="py-2">
                        <label for="name">Category Name</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="Write Category Name" required>
                        @error('name')
                            <span class="text-danger"> {{ $message }}</span>
                        @enderror
                    </div>

                    <div class="py-2">
                        <label for="home_page"> Home Page</label>
                        <select name="home_page" id="category_home_page" class="form-control">
                            <option value="0">NO</option>
                            <option value="1">Yes</option>
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
