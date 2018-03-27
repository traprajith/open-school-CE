;(function($) {
	
	$.fn.yiiMailboxCompose = function(options) {
		return this.each(function(){
			var settings = $.extend({}, $.fn.yiiMailboxCompose.defaults, options || {});
			var $this = $(this);
			var id = $this.attr('id');
			
			$.fn.yiiMailboxCompose.settings[id] = settings;
			/*
			* Autocomplete
			*/
			var cache = {},
			lastXhr;

			$this.find( "#message-to" ).combobox();
			$this.find( "#toggle" ).click(function() {
				$this.find( "#message-to" ).toggle();
			});

			/*
			* Prevent wrong value for To field from being submitted
			* because autocomplete uses setTimeOut for the change event.
			*/
			$this.find("#message-form").submit(function (event) {
				var form = this;
				//Wait for autocomplete to change value
				setTimeout(function() {
					form.submit();
				}, 250 ); //Make sure delay is greater than 150 ms, as in autocomplete widget.
				event.preventDefault();
			});

			/*
			* JUI Themes
			*/
			if(settings.juiThemes=='basic' || settings.juiThemes=='widget')
			{
				$this.find('.mailbox-input ').addClass( "ui-state-default  ui-widget ui-widget-content ui-corner-all" );
				$this.find('.mailbox-message-input ').addClass( "ui-widget ui-widget-header ui-corner-all" );
				$this.find('.mailbox-compose-inputwrap').css({'padding-right':'10px'});
			}
			if(settings.juiThemes=='widget')
			{
				$this.addClass('ui-widget ui-widget-content ui-corner-all');
			}
			
		})
	}
	

	$.fn.yiiMailboxCompose.defaults = {
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
	
	$.fn.yiiMailboxCompose.settings = {};
})(jQuery);
