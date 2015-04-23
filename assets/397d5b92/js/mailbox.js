
function updateMailboxList(id,data){
	$('.mailbox-item:even').find('td').addClass('mailbox-item-even');
	$('.mailbox-item:odd').find('td').addClass('mailbox-item-odd');
	//$('.mailbox-item:first').find('.mailbox-check,.mailbox-received').addClass('ui-corner-all');
	$('.mailbox-draggable-row').hover(function(e){
		$(this).find('td:first').addClass('mailbox-item-hover');
	}, function(e){
		$(this).find('td:first').removeClass('mailbox-item-hover');
	});
	$('.mailbox-goto').click(function(e){
		document.location = $(this).parent().find('.mailbox-link').attr('href');
	});
	//$(".mailbox-subject").textTruncate();
	

	$( ".mailbox-drag" ).draggable({ 
		revert: "invalid", // when not dropped, the item will revert back to its initial position
		containment: 'touch',//$( "#content" ).length ? "#content" : "document", // stick to demo-frame if present
		helper: "clone",
		cursor: "grabbing", 
		cursorAt: { top: 30, left: 5 },
		helper: function(){
			var selected = $('#message-list-form input:checked');
			if (selected.length === 0) {
				selected = $(this).parent().parent().find(':checkbox').attr('checked','checked');

			}
			var container = $('<div>').attr('id', 'draggingContainer');
			container.addClass('mailbox-dragger');
			container.addClass('ui-widget-header');
			container.addClass('ui-corner-all');
			container.append(selected.length+' item selected');
			return container; 
		},
		stop: function() {
			/* Bug fix FF */
			$('.mailbox-menu-item').removeClass('ui-widget-header');
		}
		
	});
	
	
	

}



$(document).ready(function(){
	updateMailboxList('inboxAjax',null);
	
	$( "#mailbox-trash" ).droppable({
		greedy:true,
		tolerance:'pointer',
		activeClass: "mailbox-trash-active",
		hoverClass: "mailbox-trash-hover",
		drop: function( event, ui ) {
			var url = $('#message-list-form').attr('action');
			url = jQuery.param.querystring(url, 'ajax=1&ajaxdelete=1');
			var count = 0;
			var convs = $('#message-list-form input:checked').map(function(i,n) {
				return $(n).val();
			}).get(); //get converts it to an array

			if(convs.length == 0) { 
				alert('no items selected!');
				return false;
			}
			$.ajax({type: "POST",
				url: url,
				dataType: 'json',
				data: {'convs[]': convs, 'button[delete]':'delete'},
				success: function(response){
					console.log($(response).attr('error'));
					if(response.success) {
						$("#mailbox-trash-sub").text(response.success).show().fadeOut(4000);
						// refresh folder
						$.fn.yiiListView.update("mailbox");
					}
					else
						$('#mailbox-action-delete').click();
				},
				error:
					function(response){
						$('#mailbox-action-delete').click();
					}
			});

			
			$(this).find('.mailbox-trash-sub').html(count+' Deleted!');
			$(this).removeClass("ui-state-highlight", 500);
		}
	});
	
	$('.mailbox-menu-item').removeClass('ui-widget-header');
	$('.mailbox-menu-item').mouseover(function(e){
		$(this).toggleClass('ui-widget-header');
	}).mouseout(function(e){
		$(this).toggleClass('ui-widget-header');
	});
	
	$('.mailbox-menu-item').click(function(e){
		var newLocation = $(this).find('a').attr('href');
		if(newLocation==$('#message-list-form').attr('action'))
			$.fn.yiiListView.update("mailbox");
		else
			document.location = newLocation;
	});
	
	$('.btn').button();
	
	/*
	 * Check/Uncheck All using checkbox
	 */
	
	$('.checkall').click(function(e){
		if($('.checkall').attr('checked')){
			$('#message-list-form').find(':checkbox').not('.checkall').attr('checked','checked');
		}
		else{
			$('#message-list-form').find(':checkbox').not('.checkall').attr('checked',false);
		}
	});
	
	/*
	 * Uncheck checkall box if, one among checkbox list is unchecked
	 */
	
	$('#message-list-form').find(':checkbox').not('.checkall').click(function(e){
		if($('.checkall').attr('checked')){
			$('.checkall').attr('checked',false);
		}
	});
	
	
	
	/*
	 * Autocomplete
	 */
	var cache = {},
	lastXhr;
	$( "#message-to" ).autocomplete({
		minLength: 2,
		source: function( request, response ) {
			var term = request.term;
			if ( term in cache ) {
				response( cache[ term ] );
				return;
			}

			lastXhr = $.getJSON( $('#message-form').attr('autocomplete'), request, function( data, status, xhr ) {
				cache[ term ] = data;
				if ( xhr === lastXhr ) {
					response( data );
				}
			});
		}
	});
	
}); 

