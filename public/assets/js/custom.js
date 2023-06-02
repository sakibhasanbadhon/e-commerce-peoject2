
// data store and update

function updateCreate(url,form) {
    $.ajax({
        type: "post",
        url: url,
        data: form,
        contentType:false,
        processData:false,
        success: function(response) {
            if (response.status == 'success') {
                $('form#ajaxForm').trigger("reset");
                $('.modal').modal('hide');
                table.draw();
                toastr.success('Data Update Success');
        }
    },
        error: function (response) {
            $('form#ajaxForm').trigger("reset");
            $('.modal').modal('hide');
            toastr.error('Opps! Something went wrong');
        }
    });

}



    // Data Edit


    function dataEdit(url,data_id) {
        $('.modal').modal('show');
        $('#modalTitle').text('Edit category');
        $('button#modalSaveBtn').text('Save Change');
        $('#dataId').val(data_id);


        $.ajax({
            type: "post",
            url: url,
            data: {_token:_token,data_id:data_id},
            dataType:'json',
            success: function(response) {
                if (response) {
                    $('form#ajaxForm input[name="name"]').val(response.category_name);
                    $('form#ajaxForm input[name="slug"]').val(response.category_slug);

                }
            }
        });
    }





// Data delete

function dataDelete(url,data_id) {
    $.ajax({
        type: "post",
        url: url,
        data: {_token:_token,data_id:data_id},
        success: function(response) {
            if (response.status == 'success') {
                table.draw();
                toastr.success('Data Delete Success');
            }
        },
        error: function (response) {
            toastr.error('Opps! Something went wrong');

        }
    });

}
