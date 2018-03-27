
(function($) {
	// track selected button
	$.yiimailbox.targetinput=null;
	$.yiimailbox.ajaxerror=0;
	// how much to shift the alternating rows background color by (if alternateRows is enabled by the module).
	$.yiimailbox.altRowsColorShift = 15;
	/*
	var $_GET = {};

	document.location.search.replace(/\??(?:([^=]+)=([^&]*)&?)/g, function () {
	function decode(s) {
		return decodeURIComponent(s.split("+").join(" "));
	}

	$_GET[decode(arguments[1])] = decode(arguments[2]);
	});
	*/

	$.yiimailbox.updateMailbox = function(){
		

		/****************************************
		*	ADD BASIC WIDGET STYLES
		****************************************/

		if($.yiimailbox.juiThemes=='basic' || $.yiimailbox.juiThemes=='widget')
		{
			if($.yiimailbox.juiButtons==1)
			{
				$('#mailbox-list .btn-group').buttonset();
				$('#mailbox-list .btn').button();
				if($('.mailbox-sortby').length && ( $('.mailbox-sortby').attr('value') == '' || $('.mailbox-sortby').attr('value').match(/.*\.desc$/i) ) ) {
					$('.mailbox-sorter li a').button({
					icons: {
					secondary: "ui-icon-triangle-1-s"
					}}); 
				}
				else {
					$('.mailbox-sorter li a').button({
					icons: {
					secondary: "ui-icon-triangle-1-n"
					}});
				}
				$('.mailbox-sorter ul').addClass('ui-helper-reset');
			}
		}

		/****************************************
		*	ADD FULL WIDGET STYLES
		****************************************/

		if($.yiimailbox.juiThemes=='widget')
		{
			//console.log('full widget')
			$('.mailbox-list').addClass('ui-widget ui-widget-content ui-corner-all');
			$('.mailbox-item:first > td:first').addClass('ui-corner-tl');
			$('.mailbox-item:first > td:last').addClass('ui-corner-tr');
			$('.mailbox-item:last > td:first').addClass('ui-corner-bl');
			$('.mailbox-item:last > td:last').addClass('ui-corner-br');
			$('.mailbox-items-tbl tr').addClass('ui-widget ui-widget-content ui-helper-clearfix  ui-helper-reset ui-corner-all');
			$('.mailbox-goto').click(function(e){
				document.location = $(this).parent().find('.mailbox-link').attr('href');
			});
			//$(".mailbox-subject").textTruncate(); //<--- doesn't work evenly across all browsers
			$('.mailbox-summary .summary').text(
				$('.mailbox-summary .summary').text().replace(/^.*([0-9,]+\-[0-9,]+[^0-9]+[0-9,]+).*$/i,'$1')
			);
			
			/*
			* Message tooltips
			* Here we use the jQuery qTip (v2) plugin to apply the tooltips because the 
			* qTip plugin comes with JUI theme support. qTip has many different styles 
			* and options. To view the qTip documentation visit the following link...
			* 
			* http://craigsworks.com/projects/qtip2/docs/
			* 
			* You can apply custom colors/styles to specific types of messages here 
			* (eg. could make new mail's tooltip green and pending delivery yellow)
			*/
			$('.msg-read .mailbox-link').qtip({
				content: $(this).attr('title'),
				position: {target: 'top left'},
				style:{
					classes: 'ui-tooltip-shadow',
					widget:true
				}
			});
			$('.msg-deliver .mailbox-link').qtip({
				content: $(this).attr('title'),
				position: {target: 'top left'},
				style:{
					classes: 'ui-tooltip-shadow',
					widget:true
				}
			});
			$('.msg-new .mailbox-link,.msg-sent .mailbox-link').qtip({
				content: $(this).attr('title'),
				position: {target: 'top left'},
				style:{
					classes: 'ui-tooltip-shadow',
					widget:true
				}
			});


			/*
			* Remove buttons label
			*/
			$('.mailbox-buttons-label').hide();

			/*
			* Pager Styles
			*/
			if($('.mailbox-pager').length != 0)
			{
				$('.mailbox-pager ul ').css({'margin':'0','padding':'0'});
				$('.mailbox-pager li.next ').css({'margin-right':'0','padding-right':'0'});
				$('.mailbox-pager li > a').each(function(){
					//$(this).text($(this).text().replace(/(First|Previous|Next|Last)/ig,''));
					$(this).text($(this).text().replace(/[^a-z\s-]+/i,''));
				});
				$('.mailbox-pager').html(
						$('.mailbox-pager').html().replace(/^[a-z\s:-]+/i,'')
				);
				$('.mailbox-pager li ').hide();
				if($('.mailbox-pager li.previous').hasClass('ui-button')==0)
					$('.mailbox-pager li.previous')
						.addClass('ui-helper-reset')
						.css({'float':'left'})
						.button({
							icons: {
								primary: "ui-icon-circle-arrow-w"
							}
						})
						.show()
						.click(function(e){
							$.fn.yiiListView.update('mailbox', {url: $(this).find('a').attr('href')});
						});
				else $('.mailbox-pager li.previous').show();
				if($('.mailbox-pager li.next').hasClass('ui-button')==0)
					$('.mailbox-pager li.next') 
						.addClass('ui-helper-reset')
						.css({'float':'left'})
						.button({
							icons: {
								secondary: "ui-icon-circle-arrow-e"
							}
						})
						.show()
						.click(function(e){
							$.fn.yiiListView.update('mailbox', {url: $(this).find('a').attr('href')});
						});
				else $('.mailbox-pager li.next').show();
				//$('.mailbox-pager li a').html('<span class="mailbox-ui-pagertext">'+$('.mailbox-pager li a').text()+'</span>');
				//$('.mailbox-ui-pagertext').hide();
			}
			// remove default pager class
			if($('.yiiPager').length != 0)
				$('.yiiPager').removeClass('yiiPager');

			/*
			* Alternate row colors. Since JUI doesn't have alternating color 
			* classes we "shift" the current background color by the amount
			* specified in $.yiimailbox.altRowsColorShift
			*/
			if($('.mailbox-items-tbl tr').length != 0 && $.yiimailbox.alternateRows == 1 )
			{
				$.yiimailbox.shiftBg($('.mailbox-items-tbl tr:even > td').find('.mailbox-item-wrapper'),$.yiimailbox.altRowsColorShift);
			}


			/*
			* If mailbox is empty
			*/
			var count = $('.mailbox-count').attr('value');
			if(count == 0 || count == undefined)
			{
				$('.mailbox-empty')
					.addClass('ui-widget')
					.css({'background':'none'});
				$('.mailbox-new-msgs').text('');
			}
			else{
				$('.mailbox-new-msgs').text('('+count+')');
			}
		}
	}



	/**
	* Return an array of the selected (ie. checked) conversations
	*/
	$.yiimailbox.getConversations = function()
	{
		return $('#message-list-form input:checked').map(function(i,n) {
			return $(n).val();
		}).get(); //get converts it to an array
	}

	/**
	* Submit the ajax form for clicked buttons/drag-n-drop delete.
	*/
	$.yiimailbox.submitAjax = function(url){

		// gather input
		var convs = $.yiimailbox.getConversations();
		if(convs.length == 0) {
			alert('no items selected!');
			return false;
		}
		
		var buttonname = $.yiimailbox.targetinput.attr('name');
		var data = {'convs[]': convs};
		data[buttonname] = 1;
		//console.log(data)
		$.ajax({type: "POST",
			url: url,
			dataType: 'json',
			data: data,
			success: function(response){
				if(response.success) {
					// Tiny desc is used by drag-n-drop only
					if(response.tinydesc)
						$("#"+response.dragdrop+"-tinydesc").text(response.tinydesc).show().fadeOut(4000);
					ajaxGrowl(response.success,response.title);
					// refresh folder
					$.fn.yiiListView.update("mailbox");
					// check for empty folder
					var convs = $.yiimailbox.getConversations();
					if(convs.length == 0) {
						// reload page to display empty folder message
						location.reload();
					}
				}
				else
					ajaxGrowl(response.error, buttonname);
				return false;
			},
			error:
				// submit form without ajax
				function(response){
					//return false;
					$.yiimailbox.ajaxerror=1;
					return false;
					$.yiimailbox.targetinput.click();
					return false;
					//rebind submit button function to not do ajax call
					$.yiimailbox.targetinput.click(new function(){return true;});
					//then call submit button
					$.yiimailbox.targetinput.click();
					return false;
				}
		});
		return false;
	}

	$.yiimailbox.init = function(){

		$.yiimailbox.updateMailbox();

		/*
		* Drag-n-drop droppable area (ie. menu item labeled "trash")
		*/
		if($.yiimailbox.dragDelete==1)
		{
			$( "#mailbox-trash" ).droppable({
				greedy:true,
				tolerance:'pointer',
				activeClass: " ui-state-error",
				//hoverClass: "mailbox-trash-hover",
				drop: function( event, ui ) {
					var url = $('#message-list-form').attr('action');
					url = jQuery.param.querystring(url, 'ajax=1&dragdrop=mailbox-trash');
					$.yiimailbox.targetinput = $('#mailbox-action-delete');
					if($.yiimailbox.confirm(url)) return true;
					$.yiimailbox.submitAjax(url);
				}
			});
		}

		/*
		* Bind themeswitcher event. This is only used in the demo.
		* If you are also using the JUI themeswitcher in your application
		* you can uncomment the lines below to make sure the widget 
		* styles get reapplied to the mailbox when the theme is switched.
		* NOTE: You must also call the event from within the themeswitcher.js
		* For example in the demo's themeswitcher.js we add the following right
		* before the return statement (above the cookie plugin)...
		* $('#content').trigger('switchtheme');
		*/
		/* Uncomment below for themeswitcher */
		$('#content').bind('switchtheme', function(event) {
			if($.yiimailbox.updateMailbox!='undefined')
				$.yiimailbox.updateMailbox();

		});
	}
	/*
	setTimeout(function() {
		$.yiimailbox.shiftBg($('.mailbox-items-tbl tr:even > td'),15);
	}, 950 ); */

	$.yiimailbox.shiftBg = function(elem,amount)
	{
		amount = Number(amount);
		if(elem.length==0)
			return;
		//$('.mailbox-items-tbl tr:even').addClass(' ui-state-active ui-priority-secondary');
		var rgb = elem//('.mailbox-items-tbl tr')
				.parent().parent()
				.css('backgroundColor')
				.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/);
		//console.log(rgb)
		if(!rgb)
			return;
		rgb.shift()
		var rgbtotal = Number(rgb[0]) + Number(rgb[1]) + Number(rgb[2]);
		if(rgbtotal < 100)
		// lighten colors
		{
			for(var i in rgb)
			{
				rgb[i] = Number(rgb[i]);
				if(rgb[i] < 255 - amount)
					rgb[i] += amount;
				else
					rgb[i] = 255;
			}
		}
		else
		// shade colors
		{
			for(var i in rgb)
			{
				rgb[i] = Number(rgb[i]);
				if(rgb[i] > amount)
					rgb[i] -= amount;
				else
					rgb[i] = 0;
			}
		}
		var rgbnew = "rgba(" + rgb[0] + "," + rgb[1] + "," + rgb[2] +", 0.5)";
		//console.log(rgbnew);

		elem.animate({"backgroundColor": rgbnew}, 900);
			//.css('backgroundColor',rgbnew)
			//.fadeTo(600,0.2);
	}
	
	$.yiimailbox.confirm = function(url)
	{
		var html;
		var buttons;
		
		if($.yiimailbox.getConversations().length == 0) {
			alert('no items selected!');
			return false;
		}
		
		if( ($.yiimailbox.confirmDelete==1 && $.yiimailbox.currentFolder=='trash')
			|| $.yiimailbox.confirmDelete==2)
		{
			if($.yiimailbox.currentFolder=='trash' || $.yiimailbox.trashbox==0)
			{
				buttons = {
					"Delete forever": function() {
						$.yiimailbox.submitAjax(url);
						$( this ).dialog( "close" );
					},
					Cancel: function() {
						$( this ).dialog( "close" );
					}
				}
				html = '<div id="dialog-confirm" title="Delete items permanently?"><p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>These items will be permanently deleted. Are you sure?</p></div>';
			}
			else {
				buttons = {
					"Delete": function() {
						$.yiimailbox.submitAjax(url);
						$( this ).dialog( "close" );
					},
					Cancel: function() {
						$( this ).dialog( "close" );
					}
				}
				html = '<div id="dialog-confirm" title="Send items to trash?"><p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure you want to mark these items as deleted?</p></div>';
			}
			$( html ).dialog({
				resizable: false,
				height:180,
				modal: true,
				buttons: buttons
			});
			return true;
		}
		else 
			return false;
	}

	


})(jQuery); // jQuery
$.yiimailbox.init()
// CSS files must be loaded in order for shiftBg to apply change to the correct CSS class 
jQuery(window).load(function(){
	/* Alternating row colors for widget styles */
	if($.yiimailbox.juiThemes == 'widget' 
		&& $.yiimailbox.alternateRows == 1 
		&& $('.mailbox-items-tbl tr').length != 0)
	{
		$.yiimailbox.shiftBg($('.mailbox-items-tbl tr:even > td').find('.mailbox-item-wrapper'),$.yiimailbox.altRowsColorShift);
	}
	
});
