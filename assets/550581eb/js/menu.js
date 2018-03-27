

jQuery(document).ready(function(){
		if( ($.yiimailbox.juiThemes=='basic' || $.yiimailbox.juiThemes=='widget') && $.yiimailbox.juiButtons==1)
		{
			$('.mailbox-menu-item').button();
			$('.mailbox-menu-newmsg span').button();
			if($.yiimailbox.juiIcons==1)
			{
				$('#mailbox-inbox').button({
					icons: {
						primary: "ui-icon-mail-closed"
					}
				});
				$('#mailbox-sent').button({
					icons: {
						primary: "ui-icon-mail-open"
					}
				});
				$('#mailbox-trash').button({
					icons: {
						primary: "ui-icon-trash"
					}
				});
				$('.mailbox-menu-newmsg span').button({
					icons: {
						primary: "ui-icon-pencil"
					}
				});
			}
		}
		if($.yiimailbox.juiThemes=='widget')
		{
			if($.yiimailbox.menuPosition=='top')
			{
				$('.mailbox-menu-folders').addClass(' ui-widget ui-widget-content ui-corner-all');
				$('.mailbox-menu-newmsg').addClass(' ui-widget ui-widget-content ui-corner-all');
			}
			else
			{
				$('.mailbox-menu-folders').addClass(' ui-widget ui-widget-content ui-corner-top');
				$('.mailbox-menu-newmsg').addClass(' ui-widget ui-widget-content ui-corner-bottom');
			}

		}

		$('.mailbox-menu-item').click(function(e){
			var newLocation = $(this).find('a').attr('href');
			if(newLocation==$('#message-list-form').attr('action'))
				$.fn.yiiListView.update("mailbox");
			else
				document.location = newLocation;
		}); 
}); // ready