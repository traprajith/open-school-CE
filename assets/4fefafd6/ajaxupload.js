// Copyright (c) 2008 Andris Valums, http://valums.com
// Licensed under the MIT license (http://valums.com/mit-license/)
// Thanks to Loic Fontaine, Mark Feldman, Andras Popovics, Faisal for contribution
/*
Changelog:
Version 0.6 - Fixed bugs:
	1. Disabling button while uploading resulted in empty upload
	2. Submitting empty file input in Chrome, when user clicked cancel
 */
(function($){
	// we need jQuery to run
	if ( ! $) return;

	$.ajax_upload = function(button, options){
		// make sure it is jquery object
		button = $(button);

		if (button.size() != 1 ){
			console.error('You passed ', button.size(),' elements to ajax_upload at once');
			return false;
		}

		return new Ajax_upload(button, options);
	};


	/**
	 * Function generates unique id
	 * @return unique id
	 */
	var get_uid = function(){
		var uid = 0;
		return function(){
			return uid++;
		}
	}();

	/**
	 * @param button Element that will be used as file upload button
	 * @param option User options
	 */
	var Ajax_upload = function(button, options){
		this.button = button;

		this.wrapper = null;
		this.form = null;
		this.input = null;
		this.iframe = null;

		this.disabled = false;
		this.submitting = false;

		this.settings = {
			// Location of the server-side upload script
			action: 'upload.php',
			// File upload name
			name: 'userfile',
			// Additional data to send
			data: {},
			// Fired when user selects file
			// You can return false to cancel upload
			onSubmit: function(file, extension) {},
			// Fired when file upload is completed
			onComplete: function(file, response) {},
			// Fired when server returns the "success" string
			onSuccess: function(file){},
			// Fired when server return something else
			onError: function(file, response){}
		};

		// Merge the users options with our defaults
		$.extend(this.settings, options);

		this.create_wrapper();
		this.create_input();

		if (jQuery.browser.msie){
			// fix ie transparent background bug
			this.make_parent_opaque();
		}

		this.create_iframe();
	}
	// assigning methods to our class
	Ajax_upload.prototype = {
		set_data : function(data){
			this.settings.data = data;
		},
		disable : function(){
			this.disabled = true;
			if ( ! this.submitting){
				this.input.attr('disabled', true);
			}
		},
		enable : function(){
			this.disabled = false;
			this.input.attr('disabled', false);
		},
		/**
		 * Creates wrapper for button and invisible file input
		 */
		create_wrapper : function(){
			// Shorten names
			var button = this.button, wrapper;

			wrapper = this.wrapper = $('<div></div>')
				.insertAfter(button)
				.append(button);

			// wait a bit because of FF bug
			// it can't properly calculate the outerHeight
			setTimeout(function(){
				wrapper.css({
					position: 'relative'
					,display: 'block'
					,overflow: 'hidden'

					,height: button.outerHeight(true)
					,width: button.outerWidth(true)
				});
			}, 1);

			var self = this;
			wrapper.mousemove(function(e){
				// Move the input with the mouse, so the user can't misclick it
				if (!self.input) {
					return;
				}

				self.input.css({
					top: e.pageY - wrapper.offset().top - 5 + 'px'
					,left: e.pageX - wrapper.offset().left - 170 + 'px'
				});
			});


		},
		/**
		 * Creates invisible file input above the button
		 */
		create_input : function(){
			var self = this;

			this.input =
				$('<input type="file" />')
				.attr('name', this.settings.name)
				.css({
					'position' : 'absolute'
					,'margin': 0
					,'padding': 0
					,'width': '220px'
					,'heigth': '10px'
					,'opacity': 0
				})
				.change(function(){
					if ($(this).val() == ''){
						// there is no file
						return;
					}

					// we need to lock "disable" method
					self.submitting = true;

					// Submit form when value is changed
					self.submit();

					// unlock "disable" method
					self.submitting = false;
				})
				.appendTo(this.wrapper)

				//
				.hover(
					function(){self.button.addClass('hover');}
					,function(){self.button.removeClass('hover');}
				);

			if (this.disabled){
				this.input.attr('disabled', true);
			}

		},
		/**
		 *
		 */
		create_iframe : function(){
			//
			//     getTime,
			//    : (
			var name = 'iframe_au' + get_uid();

			//  ,   Dont
			this.iframe =
				$('<iframe name="' + name + '"></iframe>')
				.css('display', 'none')
				.appendTo('body');
		},
		/**

		 */
		submit : function(){
			var self = this, settings = this.settings;

			//
			var file = this.file_from_path(this.input.val());

			//
			if (settings.onSubmit.call(this, file, this.get_ext(file)) === false){
				// Do not continue if user function returns false
				if (self.disabled){
					this.input.attr('disabled', true);
				}
				return;
			}

			this.create_form();
			this.input.appendTo(this.form);
			this.form.submit();

			this.input.remove(); this.input = null;
			this.form.remove();	this.form = null;

			this.submitting = false;

			//
			this.create_input();

			var iframe = this.iframe;
			iframe.load(function(){
				var response = iframe.contents().find('body').html();

				settings.onComplete.call(self, file, response);
				if (response == 'success'){
					settings.onSuccess.call(self, file);
				} else {
					settings.onError.call(self, file, response);
				}

				// CLEAR ( ,   FF2 )
				setTimeout(function(){
					iframe.remove();
				}, 1);
			});

			//   ,
			this.create_iframe();
		},
		/**
		 * 	 ,
		 */
		create_form : function(){
			// Enctype
			//    ATTR " "
			this.form =
				$('<form method="post" enctype="multipart/form-data"></form>')
				.appendTo('body')
				.attr({
					"action" : this.settings.action
					,"target" : this.iframe.attr('name')
				});

			//     ,
			for (var i in this.settings.data){
				$('<input type="hidden" />')
					.appendTo(this.form)
					.attr({
						'name': i
						,'value': this.settings.data[i]
					});
			}
		},
		file_from_path : function(file){
			var i = file.lastIndexOf('\\');
			if (i !== -1 ){
				return file.slice(i+1);
			}
			return file;
		},
		get_ext : function(file){
			var i = file.lastIndexOf('.');

			if (i !== -1 ){
				return file.slice(i+1);
			}
			return '';
		},
		make_parent_opaque : function(){
			// ie
			this.button.add(this.button.parents()).each(function(){
				var color = $(this).css('backgroundColor');
				var image = $(this).css('backgroundImage');

				if ( color != 'transparent' ||  image != 'none'){
					$(this).css('opacity', 1);
					return false;
				}
			});
		}

	};
})(jQuery);