$( document ).ready(function(e) {
	if($('#workarea').is(':visible')){
		populate_attributes();
	}    
});

$('#setupattrs').click(function(){
	if(!$('#workarea').is(':visible')){
		$('#workarea').slideDown(function(){
			populate_attributes();
		});
	}
	else{
		populate_attributes();
	}
	$(this).remove();	
});

$('#model').change(function(e) {
	if($('#workarea').is(':visible'))
    	populate_attributes();
});

$('#exportattrs').click(function(){
	if( ! $('.attr-input-hidden').length){
		$('#exportmsg').html('<span style="display: block; margin-bottom: 10px; color:#F00;">Choose columns to export !!</span>');
	}
	else{
		var confirm_msg	= "Export model '" + $('#model option:selected').text() + "' with attributes ";
		var cols	=	$('#reqColumns .model-attr');
		cols.each(function(index, element) {
            confirm_msg	+= $(element).attr("data-label") ;
			if(index < (cols.length - 1))
				confirm_msg	+= ", ";
        });
		confirm_msg	+= "?";
		if ( confirm( confirm_msg ) ){
			return true;
		}
	}
	return false;
});

$( "#reqColumns" ).droppable({
	hoverClass: "drop-hover",
	drop: function( event, ui ) {		
		if(!ui.draggable.hasClass('req-columns')){			
			var attr		= ui.draggable.attr('data-attr'),
				label		= ui.draggable.attr('data-label');
				
			var	attr_bx		= $('<div />'),
				attr_lbl	= $('<span />'),
				attr_input	= $('<input />');
			attr_bx.attr({class:'model-attr req-columns', 'data-attr':attr, 'data-label':label});
			attr_lbl.text(label);
			attr_input.attr({name:'reqColumns[]', class:'attr-input-hidden', type:'hidden', value:attr});
			attr_bx.append(attr_input).append(attr_lbl);
			$(this).append(attr_bx);
			ui.draggable.remove();

			//setting count
			set_total_attrs();
			
			$('#exportattrs').show();		
		}
	}
});
$('#alColumns').droppable({
	hoverClass: "drop-hover",
	drop: function( event, ui ) {
		if(ui.draggable.hasClass('req-columns')){
			ui.draggable.remove();
			
			var attr		= ui.draggable.attr('data-attr'),
				label		= ui.draggable.attr('data-label');
				
			var	attr_bx		= $('<div />');
			attr_bx.attr({class:'model-attr', 'data-attr':attr, 'data-label':label});
			attr_bx.text(label);
			attr_bx.draggable({revert:true});
			$(this).append(attr_bx);
			
			
			
			//setting count
			set_total_attrs();
			
			if(!$('.attr-input-hidden').length){
				$('#exportattrs').hide();
			}
		}
	}
});
$('#reqColumns').sortable({revert:true});

function set_total_attrs(){	
	$('#attrRemaining').text($('#alColumns').find('.model-attr').length);
	$('#attrSelected').text($('#reqColumns').find('.attr-input-hidden').length);
}

function populate_attributes(){
	$('html, body').animate({scrollTop:$('#content').position().top}, 'slow');
	
	$('#alColumns, #reqColumns').html('');
	$('#exportattrs').hide();
	
	var loading	= $('<img />');
	loading.attr({ class:'', src:'<?php echo Yii::app()->baseurl;?>/images/loading.gif'});
	loading.css({margin:'58px auto 0 112px', width:'100px'})
	$('#alColumns').append(loading);
	$.ajax({
		url:_attributes_url,
		data:{model:$('#model').val()},
		dataType:"json",
		success:function(response){
			$('#alColumns').html('');
			if(response.result=="success"){
				var total_attrs=0;
				for(var key in response.data){
					var attribute	=	response.data[key];
					var newelem	= $('<div />');
					newelem.draggable({revert:true});
					newelem.attr({class:'model-attr', 'data-attr':key, 'data-label':attribute});
					newelem.text(attribute);
					$('#alColumns').append(newelem);
					total_attrs++;
				}
				//setting count
				set_total_attrs();
			}
		}		
	});
}