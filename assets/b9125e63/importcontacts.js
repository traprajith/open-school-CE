$(document).ready(function() {
     /* First Step: file upload */

    var button = $('input#select_file_with_contacts'), interval;
    
    $.ajax_upload(button, {
        action : browseActionPath,
        name : 'myfile',
        onSubmit : function(file, ext) {
            this.disable();
			$('#secondStep').html('Fetching datas...');
        },
        onComplete : function(file, response) {
			this.enable();
			$('#secondStep').html(response);
        }
    });
});