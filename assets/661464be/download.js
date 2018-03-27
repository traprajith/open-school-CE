$(document).ready(function() {
     /* First Step: file upload */

    var button = $('a#browse_from_file'), interval;
    
    $.ajax_upload(button, {
        action : browseActionPath,
        name : 'myfile',
        onSubmit : function(file, ext) {
            this.disable();
			$('#browse_resp').html('Fetching numbers...');
        },
        onComplete : function(file, response) {
			this.enable();
			$('#browse_resp').html('');
			response	= JSON.parse(response);
			if(response.status=="success"){
				var numbers	= response.numbers;
				$( '#recipients_tag, #recipients' ).val('');
				$('#recipients_tagsinput span.tag').remove();
				$.each(numbers, function(index, element) {
					var value	= "";
					if(typeof element.name !== "undefined")
						value		= element.name + ":";					
					value		+= element.number;			
					$('#recipients').addTag(value);
				});
			}
			else{
				$('#browse_resp').html(response.message);
			}			
        }
    });
});