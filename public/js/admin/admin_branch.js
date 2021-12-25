$(document).ready(function() {
    $("body").on("click", "#add-selection", function(e) {
		let selectedType = $('select[name=type]').val();
    	if(Number.isInteger(parseInt(selectedType)))
    	{
	        $(".main-selection").after(
	            `<div class="next-referral mb-3">
	            	<input type="text" class="form-control label mb-3" required placeholder="Başlıq `+ $('select[name=type] option:selected').text().toLowerCase() +`" name="labels[]" />`
	            	+ selectionType(selectedType) +
	            `</div>`
	        );
	    }
    });
    $("body").on("click", "#delete-selection", function(e) {
		if($('.next-referral').length > 1)
    	    $(".next-referral").last().remove();
    });

    $('input[name=black_list_checkbox]').on('click', function(){
        $(".note").toggle(this.checked);
    });

    $('select[name=type]').change(function(){
    	let buttons;
    	let selectedType = $(this).val();
    	if(Number.isInteger(parseInt(selectedType)))
    	{
    		$('.next-referral').remove();
    		$('.s-increase-decrease').remove();
    		if($('.next-referral').length == 0)
    		{
    			buttons =  `<div class="s-increase-decrease mt-2" style="float: right;">
                                    <a href="javascript:void(0);" class="btn btn-sm btn-icon btn-success me-2 mb-2" id="add-selection">
                                        +
                                    </a>
                                    <a href="javascript:void(0);" class="btn btn-sm btn-icon btn-danger me-2 mb-2" id="delete-selection">
                                        -
                                    </a>
                                </div>`;
                $(".main-selection").append(buttons);
                $(".main-selection").after(
		            `<div class="next-referral mb-3">
		            	<input type="text" class="form-control label mb-3" required placeholder="Başlıq `+ $('select[name=type] option:selected').text().toLowerCase() +`" name="labels[]" />`
		            	+ selectionType(selectedType) +
		            `</div>`
		        );
    		}
	    }
    })

});

function selectionType(type)
{
	let types =  {
		'1': '<input type="hidden" value="1" class="form-control type" name="types[]" />',
		// '2': '<input type="hidden" value="2" class="form-control type" name="types[]" />',
		'3': '<input type="hidden" value="3" class="form-control type" name="types[]" />',
		'4': '<input type="hidden" value="4" class="form-control type" name="types[]" />',
		'5': '<input type="hidden" value="5" class="form-control type" name="types[]" />',
		'6': '<input type="hidden" value="6" class="form-control type" name="types[]" />',
		'7': '<input type="hidden" value="7" class="form-control type" name="types[]" />',
		'8': '<input type="hidden" value="8" class="form-control type" name="types[]" />',
	};

	return types[type];
}