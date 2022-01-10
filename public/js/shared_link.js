$('.checkbox').on('change', function() {
	$('.checkbox').prop('checked', false);
	$(this).prop('checked', true);

	let url = `${baseUrl}/set-active-link`;
    $.ajax({
        url: url,
        type: 'POST',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: 'id=' + $(this).data('id'),
        success: function(response){
            var result = JSON.parse(response);
        },
        error: function (jqXhr, textStatus, errorMessage) {
        	console.log(errorMessage);
        }
    });

})