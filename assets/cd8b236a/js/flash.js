

jQuery(function($) {
	$(document).ready(function() {
		/*$('.mailbox-item').hover(function() {
			// Check if it should be persistent (can set to a normal bool if you like!)
			ajaxGrowl('test1','delete');
		});*/

		window.ajaxGrowl = function(flashtxt,title) {
			// Use the last visible jGrowl qtip as our positioning target
			var target = $('.qtip.jgrowl:visible:last');
			if(!title)
				title = "Server response...";
			$(document.body).qtip({
			content: {
				text: flashtxt,
				title: {
				text: title,
				button: true
				}
			},
			position: {
				my: 'top right',
				// Not really important...
				at: (target.length ? 'bottom' : 'top') + ' right',
				// If target is window use 'top right' instead of 'bottom right'
				target: target.length ? target : $(window),
				// Use our target declared above
				adjust: { y: 10},
				viewport: $(window),
				effect: function(api, newPos) {
				// Animate as usual if the window element is the target
				$(this).animate(newPos, {
					duration: 200,
					queue: false
				});

				// Store the final animate position
				api.cache.finalPos = newPos; 
				}
			},
			show: {
				event: false,
				// Don't show it on a regular event
				ready: true,
				// Show it when ready (rendered)
				effect: function() {
				$(this).stop(0, 1).fadeIn(400);
				},
				// Matches the hide effect
				delay: 0,
				// Needed to prevent positioning issues
				// Custom option for use with the .get()/.set() API, awesome!
				persistent:false
			},
			hide: {
				event: false,
				// Don't hide it on a regular event
				effect: function(api) {
				// Do a regular fadeOut, but add some spice!
				$(this).stop(0, 1).fadeOut(400).queue(function() {
					// Destroy this tooltip after fading out
					api.destroy();

					// Update positions
					updateGrowls();
				})
				}
			},
			style: {
				classes: 'ui-tooltip-rounded ui-tooltip-shadow mailbox-growls',
				widget: true,
				// Some nice visual classes
				tip: false // No tips for this one (optional ofcourse)
			},
			events: {
				render: function(event, api) {
				// Trigger the timer (below) on render
				timer.call(api.elements.tooltip, event);
				}
			}
			}).removeData('qtip');
		};

		// Make it a window property see we can call it outside via updateGrowls() at any point
		window.updateGrowls = function() {
			// Loop over each jGrowl qTip
			var each = $('.qtip.jgrowl'),
			width = each.outerWidth(),
			height = each.outerHeight(),
			gap = each.eq(0).qtip('option', 'position.adjust.y'),
			pos;

			each.each(function(i) {
			var api = $(this).data('qtip');
			// Set target to window for first or calculate manually for subsequent growls
			api.options.position.target = !i ? $(window) : [
				pos.left + width, pos.top + (height * i) + Math.abs(gap * (i-1))
			];
			api.set('position.at', 'top right');

			// If this is the first element, store its finak animation position
			// so we can calculate the position of subsequent growls above
			if(!i) { pos = api.cache.finalPos; }
			});
		};

		// Setup our timer function
		function timer(event) {
			var api = $(this).data('qtip'),
			lifespan = 5000; // 5 second lifespan

			// If persistent is set to true, don't do anything.
			if (api.get('show.persistent') === true) { return; }

			// Otherwise, start/clear the timer depending on event type
			clearTimeout(api.timer);
			if (event.type !== 'mouseover') {
			api.timer = setTimeout(api.hide, lifespan);
			}
		}

		// Utilise delegate so we don't have to rebind for every qTip!
		$(document).delegate('.qtip.jgrowl', 'mouseover mouseout', timer);
	});
	
}); // jQuery