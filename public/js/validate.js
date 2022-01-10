$(function () {
	$('form').on('submit', function (e) {
		if (!validateForm($(this))) {
			e.preventDefault();
		}
	});

	function validateForm(ths) {
		let requiredInput = ths.closest('form').find('.custom-req');
		let isValidated = true;
		requiredInput.each(function () {
			if ($(this).val() == "") {
				console.log($(this).val())
				$(this).css('border-color', '#f1416c');
				isValidated = false

				// $(this).parent().removeClass('valid');
			} else {
				$(this).css('border-color', '');
			}
		});

		return isValidated;
	}

});