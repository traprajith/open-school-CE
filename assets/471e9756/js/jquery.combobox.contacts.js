

(function( $ ) {
	
	var cache = {},
	lastXhr;
	$.widget( "ui.combobox", {
		_create: function() {
			var input,
				self = this,
				input = this.element.hide(),
				select = $('.mailbox-support-list').hide(),
				value = this.element.attr('value') ? this.element.attr('value') : "",
				wrapper = $( "<span>" )
					.addClass( "ui-combobox" )
					.insertAfter( input );

			input = $( "<input>" )
				.appendTo( wrapper )
				.val( value )
				.addClass( "ui-state-default" )
				.autocomplete({
					delay: 900,
					minLength: 0,
					source: function( request, response ) {
						// cache
						var term = request.term;
						if ( term in cache ) {
							response( cache[ term ] );
							return;
						}
						
						// local options
						var matcher = new RegExp( $.ui.autocomplete.escapeRegex(term), "i" );
						var localdata = $('.mailbox-support-list').children('option').map(function() {
							var newval = $(this).attr('value');
							var title = $(this).text();
							if ( this.value && ( !term || matcher.test(newval) ) )
								return {
									label: title.replace(
										new RegExp(
											"(?![^&;]+;)(?!<[^<>]*)(" +
											$.ui.autocomplete.escapeRegex(term) +
											")(?![^<>]*>)(?![^&;]+;)", "gi"
										), "<strong>$1</strong>" ),
									value: newval,
									option: this
								};
						});
						
						// remote list
						var remotedata = [];
						xhr = $.getJSON( $('#message-form').attr('autocomplete'), request, function( data, status, xhr ) {
							
							//localdata.merge(data);
							//return xhr;
							//remotedata.push(data);
							
							for(var key in data){
								var title = data[key].label;
								var newval = data[key].value;
								
								if (  !term || matcher.test(newval) )
									data[key] = {
										label: title.replace(
											new RegExp(
												"(?![^&;]+;)(?!<[^<>]*)(" +
												$.ui.autocomplete.escapeRegex(term) +
												")(?![^<>]*>)(?![^&;]+;)", "gi"
											), "<strong>$1</strong>" ),
										value: newval,
									};
							}
							
							var res = $.merge(localdata,data);
							cache[ term ] = res;
							if ( xhr === lastXhr ) {
								response(res);
							}
						});
								//response( localdata
								 //);
						lastXhr = xhr;
						
					}
					
					,
					select: function( event, ui ) {
						
						self.element.attr('value',ui.item.value);
						/*
						ui.item.option.selected = true;
						self._trigger( "selected", event, {
							item: ui.item.option
						}); */
					},
					change: function( event, ui ) {
						self.element.attr('value',$(this).val()); return false;
						if ( !ui.item ) {
							var matcher = new RegExp( "^" + $.ui.autocomplete.escapeRegex( $(this).val() ) + "$", "i" ),
								valid = false;
							select.children( "option" ).each(function() {
								if ( $( this ).text().match( matcher ) ) {
									this.selected = valid = true;
									return false;
								}
							});
							if ( !valid ) {
								// remove invalid value, as it didn't match anything
								$( this ).val( "" );
								select.val( "" );
								input.data( "autocomplete" ).term = "";
								return false;
							}
						}
					}
				})
				.addClass( "ui-widget ui-widget-content ui-corner-left" );

			input.data( "autocomplete" )._renderItem = function( ul, item ) {
				return $( "<li></li>" )
					.data( "item.autocomplete", item )
					.append( "<a>" + item.label + "</a>" )
					.appendTo( ul );
			};

			$( "<a>" )
				.attr( "tabIndex", -1 )
				.attr( "title", "Show All Items" )
				.appendTo( wrapper )
				.button({
					icons: {
						primary: "ui-icon-triangle-1-s"
					},
					text: false
				})
				.removeClass( "ui-corner-all" )
				.addClass( "ui-corner-right ui-button-icon ui-combobox-btn" )
				.click(function() {
					// close if already visible
					if ( input.autocomplete( "widget" ).is( ":visible" ) ) {
						//input.autocomplete( "close" );
						return;
					}

					// work around a bug (likely same cause as #5265)
					$( this ).blur();

					// pass empty string as value to search for, displaying all results
					input.autocomplete( "search", "" );
					input.focus();
				});
		},

		destroy: function() {
			this.wrapper.remove();
			this.element.show();
			$.Widget.prototype.destroy.call( this );
		}
	});
})( jQuery );




/*
 * 

(function( $ ) {
	
	var cache = {},
	lastXhr;
	$.widget( "ui.combobox", {
		_create: function() {
			var input,
				self = this,
				select = this.element.hide(),
				selected = select.children( ":selected" ),
				value = selected.val() ? selected.text() : "",
				wrapper = $( "<span>" )
					.addClass( "ui-combobox" )
					.insertAfter( select );

			input = $( "<input>" )
				.appendTo( wrapper )
				.val( value )
				.addClass( "ui-state-default" )
				.autocomplete({
					delay: 900,
					minLength: 2,
					source: function( request, response ) {
						// cache
						var term = request.term;
						if ( term in cache ) {
							response( cache[ term ] );
							return;
						}
						
						// local options
						var matcher = new RegExp( $.ui.autocomplete.escapeRegex(term), "i" );
						var localdata = select.children( "option" ).map(function() {
							var text = $( this ).text();
							if ( this.value && ( !term || matcher.test(text) ) )
								return {
									label: text.replace(
										new RegExp(
											"(?![^&;]+;)(?!<[^<>]*)(" +
											$.ui.autocomplete.escapeRegex(term) +
											")(?![^<>]*>)(?![^&;]+;)", "gi"
										), "<strong>$1</strong>" ),
									value: text,
									option: this
								};
						});
						
						// remote list
						lastXhr = $.getJSON( $('#message-form').attr('autocomplete'), request, function( data, status, xhr ) {
							data = $.merge(data,localdata);
							cache[ term ] = data;
							if ( xhr === lastXhr ) {
								response( data );
							}
						});
						
					}
					
					,
					select: function( event, ui ) {
					if(typeof(ui.item.option) == "undefined" || ui.item.option === null)
						return;
						ui.item.option.selected = true;
						self._trigger( "selected", event, {
							item: ui.item.option
						});
					},
					change: function( event, ui ) {
						if ( !ui.item ) {
							var matcher = new RegExp( "^" + $.ui.autocomplete.escapeRegex( $(this).val() ) + "$", "i" ),
								valid = false;
							select.children( "option" ).each(function() {
								if ( $( this ).text().match( matcher ) ) {
									this.selected = valid = true;
									return false;
								}
							});
							if ( !valid ) {
								// remove invalid value, as it didn't match anything
								$( this ).val( "" );
								select.val( "" );
								input.data( "autocomplete" ).term = "";
								return false;
							}
						}
					}
				})
				.addClass( "ui-widget ui-widget-content ui-corner-left" );

			input.data( "autocomplete" )._renderItem = function( ul, item ) {
				return $( "<li></li>" )
					.data( "item.autocomplete", item )
					.append( "<a>" + item.label + "</a>" )
					.appendTo( ul );
			};

			$( "<a>" )
				.attr( "tabIndex", -1 )
				.attr( "title", "Show All Items" )
				.appendTo( wrapper )
				.button({
					icons: {
						primary: "ui-icon-triangle-1-s"
					},
					text: false
				})
				.removeClass( "ui-corner-all" )
				.addClass( "ui-corner-right ui-button-icon" )
				.click(function() {
					// close if already visible
					if ( input.autocomplete( "widget" ).is( ":visible" ) ) {
						input.autocomplete( "close" );
						return;
					}

					// work around a bug (likely same cause as #5265)
					$( this ).blur();

					// pass empty string as value to search for, displaying all results
					input.autocomplete( "search", "" );
					input.focus();
				});
		},

		destroy: function() {
			this.wrapper.remove();
			this.element.show();
			$.Widget.prototype.destroy.call( this );
		}
	});
})( jQuery );

 */
