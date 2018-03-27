

;(function($) {
	
	$.fn.yiiMailboxMessage = function(options) {
		return this.each(function(){
			var settings = $.extend({}, $.fn.yiiMailboxMessage.defaults, options || {});
			var $this = $(this);
			var id = $this.attr('id');
			$.fn.yiiMailboxMessage.settings[id] = settings;
			
			message = $(this);
			
			if(settings.juiThemes=='widget')
			{
				message.find('.mailbox-message-subject').addClass('ui-widget-header ui-corner-all');
				message.find('.mailbox-message-header').addClass('ui-widget-header ui-corner-top');
				message.find('.mailbox-message-text').addClass('ui-widget-content ui-corner-bottom');
				message.find('.mailbox-message-reply').addClass('ui-widget-content ui-corner-all');
				message.find('.mailbox-message-reply').css({'padding':'10px'});
				message.find('.mailbox-message-reply textarea').addClass('ui-widget-header ui-corner-all');
			}
		});
	}

	$.fn.yiiMailboxMessage.defaults = {
		trashbox: 0,
		dragDelete: 0,
		confirmDelete: 0,
		menuPosition: 'top',
		juiThemes: 0,
		juiButtons: 0,
		juiIcons: 0,
		alternateRows: 0,
		highlightRows: 0,
		ajaxerror: 0,
		sortBy:''
	};
	
	$.fn.yiiMailboxMessage.settings = {};
})(jQuery);