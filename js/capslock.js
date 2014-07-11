/*
 * Capslock 0.4 - jQuery plugin to detect if a user's caps lock is on or not.
 *
 * Provides events, "caps_lock_on" and "caps_lock_off", that custom functions can be bound to.
 * The capslock function can be called on a specific element, or a set of elements:
 * 		$("#my_textarea").capslock(options);	// One textarea
 * 		$("textarea").capslock(options);		// All textareas
 *
 * Copyright (c) 2009 Arthur McLean
 *
 * Dual licensed under the MIT and GPL licenses:
 *   http://www.opensource.org/licenses/mit-license.php
 *   http://www.gnu.org/licenses/gpl.html
 *
 * Special thanks to driehle and Adrian D. Alvarez for sending in contributions that supurred
 * further development.
 *
 */

; // Just in case the previously included plug-in failed to close with a semi-colon.
(function($) {

	$.fn.capslock = function(options) {

		if (options) $.extend($.fn.capslock.defaults, options);

		this.each(function() {
			$(this).bind("caps_lock_on", $.fn.capslock.defaults.caps_lock_on);
			$(this).bind("caps_lock_off", $.fn.capslock.defaults.caps_lock_off);
			$(this).bind("caps_lock_undetermined", $.fn.capslock.defaults.caps_lock_undetermined);

			$(this).keypress(function(e){
				check_caps_lock(e);
			});
		});

		return this;
	};



	// The actual check:
	function check_caps_lock(e) {

		var ascii_code	= e.which;
		var letter		= String.fromCharCode(ascii_code);
		var upper		= letter.toUpperCase();
		var lower		= letter.toLowerCase();
		var shift_key	= e.shiftKey;

		// If the upper and lower case characters are the same, then we have no way to know if capslock is on
		if(upper !== lower) {

			if( letter === upper && !shift_key ) {
				$(e.target).trigger("caps_lock_on");
			} else if( letter === lower && !shift_key ) {
				$(e.target).trigger("caps_lock_off");
			} else if( letter === lower && shift_key) {
				// Must be a Windows user!
				$(e.target).trigger("caps_lock_on");
			} else if( letter === upper && shift_key ) {
				// Either caps lock is off, or the caps lock is on and they are on a Mac

				if( navigator.platform.toLowerCase().indexOf("win") !== -1 ) {
					// You are on Windows, so we know caps lock is off
					$(e.target).trigger("caps_lock_off");
				} else {
					// Ug, we don't know

					if( navigator.platform.toLowerCase().indexOf("mac") !== -1
						&&
						$.fn.capslock.defaults.mac_shift_hack ) {
						// Assue that the caps lock is off
						$(e.target).trigger("caps_lock_off");
					} else {
						$(e.target).trigger("caps_lock_undetermined");
					}
				}

			} else {
				$(e.target).trigger("caps_lock_undetermined");
			}

		} else {
			$(e.target).trigger("caps_lock_undetermined");
		}


		if($.fn.capslock.defaults.debug) {
			if(console) {
				console.log("Ascii code: " + ascii_code);
				console.log("Letter: " + letter);
				console.log("Upper Case: " + upper);
				console.log("Shift key: " + shift_key);
			}
		}

	}

	// Public definition of defaults for easy overriding:
	$.fn.capslock.defaults = {
		caps_lock_on:	function() {},
		caps_lock_off:	function() {},
		caps_lock_undetermined:	function() {},
		mac_shift_hack:	true,
		debug:			false
	};

})(jQuery);

// JavaScript Document