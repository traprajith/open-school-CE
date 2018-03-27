$(document).ready(function() {
     /* First Step: file upload */

    var button = $('a#browse_from_file'), interval;
    
    $.ajax_upload(button, {
        action : browseActionPath,
        name : 'myfile',
		data: {"YII_CSRF_TOKEN":$("input[name='YII_CSRF_TOKEN']").val()},
        onSubmit : function(file, ext) {
            this.disable();
			$('#browse_resp').html('Fetching numbers...');
        },
        onComplete : function(file, response) {
			this.enable();
			$('#browse_resp').html('');
                        // alert(response);
			response	= JSON.parse(response);
			if(response.status=="success"){
                            
                           
				var numbers	= response.email;
				$( '#recipients_tag, #recipients' ).val('');
				$('#recipients_tagsinput span.tag').remove();
				$.each(numbers, function(index, element) {
					var value	= "";
					if(typeof element.name !== "undefined")
						value		= element.name + ":";					
					value		+= element.email;			
					$('#recipients').addTag(value);
				});
			}
			else{
				$('#browse_resp').html(response.message);
			}			
        }
    });
});