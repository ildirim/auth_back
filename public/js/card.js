$(document).on('click', '#btn-store-card', function(){
    let url = '/card/store';
    let trCount = $('#table-card tbody tr').length;
    let data = $('#form-create-card').serialize() + '&trCount=' + trCount;
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

                $('#table-card tbody').append(result.data);
                $('#form-create-card').trigger("reset");
                $('#modal-create-card').modal('hide');
            }
        },
        error: function (jqXhr, textStatus, errorMessage) {
            $('.bg-light-danger').remove();
            $('#kt_content_container').prepend(errorMessage);
        },
        complete: function() { removeSpinner(); }
    });
});

$(document).on('click', '.btn-edit-card', function(){
    let ths = $(this);
    let id = ths.data('id');
    $('#form-edit-card').attr('action', baseUrl + '/card/update/' + id);
    $('#form-edit-card input[name=card_no]').val(ths.closest('tr').find('td:nth-child(2)').text());
});

$(document).on('click', '#btn-update-card', function(){
    let ths = $(this);
    let url = '/card/update'
    let data = $('#form-edit-card').serialize();
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
                $('#' + $('#form-edit-card input[name=id]').val() + ' td:gt(0)').remove();
                $('#' + $('#form-edit-card input[name=id]').val() + ' td:nth-child(1)').after(result.data);
                $('#modal-edit-card').modal('hide');
            }
        },
        error: function (jqXhr, textStatus, errorMessage) {
            $('.bg-light-danger').remove();
            $('#kt_content_container').prepend(errorMessage);
        },
        complete: function() { removeSpinner(); }
    });
});

$(document).on('click', '.btn-delete-card', function(){
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
            let url = '/card/delete'
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