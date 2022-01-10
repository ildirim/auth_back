$(document).ready(function(){
	$('.btn-delete').click(function(){
		let ths = $(this);

		$('#form-confirm-delete').attr('action', ths.data('action'));
	})
})


$(document).ready(function() {
	$('.card-mask').mask('0000-0000-0000-0000');
})