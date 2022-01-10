$(document).on('click', '#btn-store-package', function(){
    let url = '/package/store';
    let trCount = $('#table-package tbody tr').length;
    let data = $('#form-create-package').serialize() + '&trCount=' + trCount;
    $.ajax({
        url: url,
        type: 'POST',
        data: data,
        success: function(response){
            var result = JSON.parse(response);

            if(result.message)
            {
                $('.bg-light-success').remove();
                $('#kt_content_container').prepend(result.successMessage);

                $('#table-package tbody').append(result.data);
                $('#form-create-package').trigger("reset");
                $('#modal-create-package').modal('hide');
            }
        },
        error: function (jqXhr, textStatus, errorMessage) {
            $('.bg-light-danger').remove();
            $('#kt_content_container').prepend(errorMessage);
        },
        complete: function() { removeSpinner(); }
    });
});

$(document).on('click', '.btn-edit-package', function(){
    let ths = $(this);
    let id = ths.data('id');
    $('#form-edit-package').attr('action', baseUrl + '/package/update/' + id);
    $('#form-edit-package input[name=name]').val(ths.closest('tr').find('td:nth-child(2)').text());
    $('#form-edit-package input[name=card_count]').val(ths.closest('tr').find('td:nth-child(3)').text());
    $('#form-edit-package input[name=price]').val(ths.closest('tr').find('td:nth-child(4)').text());
});

$(document).on('click', '#btn-update-package', function(){
    let ths = $(this);
    let url = '/package/update'
    let data = $('#form-edit-package').serialize();
    $.ajax({
        url: url,
        type: 'POST',
        data: data,
        success: function(response){
            var result = JSON.parse(response);
            if(result.message)
            {
                $('.bg-light-success').remove();
                $('#kt_content_container').prepend(result.successMessage);
                $('#' + $('#form-edit-package input[name=id]').val() + ' td:gt(0)').remove();
                $('#' + $('#form-edit-package input[name=id]').val() + ' td:nth-child(1)').after(result.data);
                $('#modal-edit-package').modal('hide');
            }
        },
        error: function (jqXhr, textStatus, errorMessage) {
            $('.bg-light-danger').remove();
            $('#kt_content_container').prepend(errorMessage);
        },
        complete: function() { removeSpinner(); }
    });
});

$(document).on('click', '.btn-delete-package', function(){
    swal({
        title: 'Silmək istədiyinizdən əminsiniz?',
        icon: "warning",
        buttons: [
            'Xeyr',
            'Bəli'
        ],
        dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {
            let ths = $(this);
            let url = '/package/delete'
            let id = ths.data('id');
            let data = 'id=' + id;
            $.ajax({
                url: url,
                type: 'POST',
                data: data,
                success: function(response){
                    var result = JSON.parse(response);
                    if(result.message)
                    {
                        $('.bg-light-success').remove();
                        $('#kt_content_container').prepend(result.successMessage);
                        $('#' + id).remove();
                    }
                },
                error: function (jqXhr, textStatus, errorMessage) {
                    $('.bg-light-danger').remove();
                    $('#kt_content_container').prepend(errorMessage);
                }
            });
        }
    }); 
});