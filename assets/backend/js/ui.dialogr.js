/*
 * jQuery Dialogr
 *
 * This plugins is a modified copy of jQuery UI Dialog widget, adding minimize, restore and maximize buttons
 * Developed by Carlos Carvalhar (http://carvalhar.com) with the help of Ciro Anunciacao (http://voxelmidia.com.br) when working at PixFly (http://pixfly.com.br). Updated by Arnaud Lorenzi (arl@formaltis.fr) from Formaltis (http://www.formaltis.fr).
 *
 * This code was based in two resources:
 * http://www.profissionaisti.com.br/2008/11/jquery-dialog-melhorias-interessantes  by Jackson Caset
 * http://old.nabble.com/How-to-%22properly%22-extend-the-jQuery-UI-Dialog-widget-----td24182676s27240.html
 *  
 *  
 * Depends:
 *	jQuery  (http://jquery.com)
 *  jQuery UI Core, Draggable, Resizable (http://jqueryui.com)
 *
 */
(function($) {
	
	var setDataSwitch = {
	  dragStart : "start.draggable",
	  drag : "drag.draggable",
	  dragStop : "stop.draggable",
	  maxHeight : "maxHeight.resizable",
	  minHeight : "minHeight.resizable",
	  maxWidth : "maxWidth.resizable",
	  minWidth : "minWidth.resizable",
	  resizeStart : "start.resizable",
	  resize : "drag.resizable",
	  resizeStop : "stop.resizable"
	};

	var uiDialogClasses =
		'ui-dialog ' +
		'ui-widget ' +
		'ui-widget-content ' +
		'ui-corner-all ',
	sizeRelatedOptions = {
		buttons: true,
		height: true,
		maxHeight: true,
		maxWidth: true,
		minHeight: true,
		minWidth: true,
		width: true
	},
	resizableRelatedOptions = {
		maxHeight: true,
		maxWidth: true,
		minHeight: true,
		minWidth: true
	};
	
	$.widget("ui.dialogr", {
	  options : {
	    autoOpen : true,
	    bgiframe : false,
	    buttons : {},
	    closeOnEscape : true,
	    closeText : 'close',
	    dialogClass : '',
	    draggable : true,
	    hide : null,
	    height : 'auto',
	    maxHeight : false,
	    maxWidth : false,
	    minHeight : 150,
	    minWidth : 150,
	    modal : false,
	    position : 'center',
	    resizable : true,
	    maximized : true,
	    minimized : true,
	    show : null,
	    stack : true,
	    title : '',
	    width : 300,
	    zIndex : 1000,
	    parent : document.body
	  },
	  _create : function() {
		  this.originalTitle = this.element.attr('title');
		  
		  if (!this.options.parent)
		  	this.options.parent = document.body;
		  
		  var self = this, options = this.options,

		  title = options.title || this.originalTitle || '&nbsp;', titleId = $.ui.dialogr.getTitleId(this.element),

		  uiDialog = (this.uiDialog = $('<div/>')).appendTo(this.options.parent).hide().addClass(uiDialogClasses + options.dialogClass).css( {
		    position : 'absolute',
		    overflow : 'hidden',
		    zIndex : options.zIndex
		  })
		  // setting tabIndex makes the div focusable
		      // setting outline to 0 prevents a border on focus in Mozilla
		      .attr('tabIndex', -1).css('outline', 0).keydown(function(event) {
			      (options.closeOnEscape && event.keyCode && event.keyCode == $.ui.keyCode.ESCAPE && self.close(event));
		      }).attr( {
		        role : 'dialog',
		        'aria-labelledby' : titleId
		      }).mousedown(function(event) {
			      self.moveToTop(false, event);
		      }),

		  uiDialogContent = this.element.show().removeAttr('title').addClass('ui-dialog-content ' + 'ui-widget-content').appendTo(uiDialog),

		  uiDialogTitlebar = (this.uiDialogTitlebar = $('<div></div>')).addClass('ui-dialog-titlebar ' + 'ui-widget-header ' + 'ui-corner-all ' + 'ui-helper-clearfix').prependTo(uiDialog),

		  uiDialogTitlebarClose = $('<a href="#"/>').addClass('ui-dialog-titlebar-close ' + 'ui-corner-all').attr('role', 'button').hover(function() {
			  uiDialogTitlebarClose.addClass('ui-state-hover');
		  }, function() {
			  uiDialogTitlebarClose.removeClass('ui-state-hover');
		  }).focus(function() {
			  uiDialogTitlebarClose.addClass('ui-state-focus');
		  }).blur(function() {
			  uiDialogTitlebarClose.removeClass('ui-state-focus');
		  }).mousedown(function(ev) {
			  ev.stopPropagation();
		  }).click(function(event) {
			  self.close(event);
			  return false;
		  }).appendTo(uiDialogTitlebar),

		  uiDialogTitlebarCloseText = (this.uiDialogTitlebarCloseText = $('<span/>')).addClass('ui-icon ' + 'ui-icon-closethick').text(options.closeText).appendTo(uiDialogTitlebarClose),

		  uiDialogTitle = $('<span/>').addClass('ui-dialog-title').attr('id', titleId).html(title).prependTo(uiDialogTitlebar);
		  
		  uiDialogTitlebar.find("*").add(uiDialogTitlebar).disableSelection();
		  
		  (options.draggable && $.fn.draggable && this._makeDraggable());
		  (options.resizable && $.fn.resizable && this._makeResizable());
		  
		  this._createButtons(options.buttons);
		  this._isOpen = false;
		  
		  (options.bgiframe && $.fn.bgiframe && uiDialog.bgiframe());
		  (options.autoOpen && this.open());
		  
		  this.originalSize();
		  $(".ui-resizable-se").css('z-index', 99999);
		  this.changeTheSize();
		  
		  this.uiDialog.bind('dragstop', function(event, ui) {
			  if (self.minimized) {
				  return false;
			  }
		  }).bind('resize', function(event, ui) {
			  self.changeTheSize();
			  
		  });
		  
		  /* Adding maximize button */
		  if (self.options.maximized) {
			  uiDialogTitlebar.append('<a href="#" id="dialog-maximize" class="ui-dialog-titlebar-max"><span>Max</span></a>');
			  this.uiDialogTitlebarMax = $('#dialog-maximize', uiDialogTitlebar).hover(function() {
				  $(this).addClass('ui-dialog-titlebar-max-hover');
			  }, function() {
				  $(this).removeClass('ui-dialog-titlebar-max-hover');
			  }).mousedown(function(ev) {
				  ev.stopPropagation();
			  }).click(function() {
				  self.maximize();
				  return false;
			  });
			  
			  /* Allow titlebar doubleclick to maximize/restore the dialog. */
			  uiDialogTitlebar.bind("dblclick", function() {
				  if (window.maximized) {
					  self.restore();
				  } else {
					  self.maximize();
				  }
			  });
		  }
		  
		  /* Adding minimize button */

		  if (self.options.minimized) {
			  uiDialogTitlebar.append('<a href="#" id="dialog-minimize" class="ui-dialog-titlebar-min"><span>Min</span></a>');
			  this.uiDialogTitlebarMax = $('#dialog-minimize', uiDialogTitlebar).hover(function() {
				  $(this).addClass('ui-dialog-titlebar-min-hover');
			  }, function() {
				  $(this).removeClass('ui-dialog-titlebar-min-hover');
			  }).mousedown(function(ev) {
				  ev.stopPropagation();
			  }).click(function() {
				  self.minimize();
				  return false;
			  });
			  
		  }
		  
		  /* Adding restore button */

		  if (self.options.minimized || self.options.maximized) {
			  
			  uiDialogTitlebar.append('<a href="#" id="dialog-restore" class="ui-dialog-titlebar-rest"><span>Restore</span></a>');
			  this.uiDialogTitlebarMin = $('#dialog-restore', uiDialogTitlebar).hover(function() {
				  $(this).addClass('ui-dialog-titlebar-rest-hover');
			  }, function() {
				  $(this).removeClass('ui-dialog-titlebar-rest-hover');
			  }).mousedown(function(ev) {
				  ev.stopPropagation();
			  }).click(function() {
				  self.restore();
				  return false;
			  }).hide();
		  }
	  },
	  
	  destroy : function() {
		  (this.overlay && this.overlay.destroy());
		  this.uiDialog.hide();
		  this.element.unbind('.dialog').removeData('dialog').removeClass('ui-dialog-content ui-widget-content').hide().appendTo('body');
		  this.uiDialog.remove();
		  
		  (this.originalTitle && this.element.attr('title', this.originalTitle));
	  },
	  
	  close : function(event) {
		  
		//code added because if the dialog is minimized then closed
		//when it opens again it's still with the state minimized		
		if (window.minimized) {
			 $('.ui-dialog-titlebar-rest', this.uiDialog).click();
		}
		
		
		  var self = this;

	  
		  if (false === self._trigger('beforeclose', event)) {
			  return;
		  }
		  
		  
		  
		  (self.overlay && self.overlay.destroy());
		  self.uiDialog.unbind('keypress.ui-dialog');
		  
		  (self.options.hide ? self.uiDialog.hide(self.options.hide, function() {
			  self._trigger('close', event);
		  }) : self.uiDialog.hide() && self._trigger('close', event));
		  
		  $.ui.dialogr.overlay.resize();
		  
		  self._isOpen = false;
		  
		  // adjust the maxZ to allow other modal dialogs to continue to work (see #4309)
		  if (self.options.modal) {
			  var maxZ = 0;
			  $('.ui-dialog').each(function() {
				  if (this != self.uiDialog[0]) {
					  maxZ = Math.max(maxZ, $(this).css('z-index'));
				  }
			  });
			  $.ui.dialogr.maxZ = maxZ;
		  }
	  },
	  
	  isOpen : function() {
		  return this._isOpen;
	  },
	  
	  // the force parameter allows us to move modal dialogs to their correct
	  // position on open
	  moveToTop : function(force, event) {
		  
		  if ((this.options.modal && !force) || (!this.options.stack && !this.options.modal)) {
			  return this._trigger('focus', event);
		  }
		  
		  if (this.options.zIndex > $.ui.dialogr.maxZ) {
			  $.ui.dialogr.maxZ = this.options.zIndex;
		  }
		  (this.overlay && this.overlay.$el.css('z-index', $.ui.dialogr.overlay.maxZ = ++$.ui.dialogr.maxZ));
		  
		  //Save and then restore scroll since Opera 9.5+ resets when parent z-Index is changed.
		  //  http://ui.jquery.com/bugs/ticket/3193
		  var saveScroll = {
		    scrollTop : this.element.attr('scrollTop'),
		    scrollLeft : this.element.attr('scrollLeft')
		  };
		  this.uiDialog.css('z-index', ++$.ui.dialogr.maxZ);
		  this.element.attr(saveScroll);
		  this._trigger('focus', event);
	  },
	  
	  open : function() {
		  if (this._isOpen) {
			  return;
		  }
		  
		  var options = this.options, uiDialog = this.uiDialog;
		  
		  this.overlay = options.modal ? new $.ui.dialogr.overlay(this) : null;
		  (uiDialog.next().length && uiDialog.appendTo('body'));
		  this._size();
		  this._position(options.position);
		  uiDialog.show(options.show);
		  this.moveToTop(true);
		  
		  // prevent tabbing out of modal dialogs
		  (options.modal && uiDialog.bind('keypress.ui-dialog', function(event) {
			  if (event.keyCode != $.ui.keyCode.TAB) {
				  return;
			  }
			  
			  var tabbables = $(':tabbable', this), first = tabbables.filter(':first')[0], last = tabbables.filter(':last')[0];
			  
			  if (event.target == last && !event.shiftKey) {
				  setTimeout(function() {
					  first.focus();
				  }, 1);
			  } else if (event.target == first && event.shiftKey) {
				  setTimeout(function() {
					  last.focus();
				  }, 1);
			  }
		  }));
		  
		  // set focus to the first tabbable element in the content area or the first button
		  // if there are no tabbable elements, set focus on the dialog itself
		  $( []).add(uiDialog.find('.ui-dialog-content :tabbable:first')).add(uiDialog.find('.ui-dialog-buttonpane :tabbable:first')).add(uiDialog).filter(':first').focus();
		  
		  this._trigger('open');
		  this._isOpen = true;
		  
		  /* Bug: Google Chrome can't render very well, so without this part changeTheSize() doesn't work */
		  var is_chrome = navigator.userAgent.toLowerCase().indexOf('chrome') > -1;
		  if (is_chrome) {
			  var obj = this;
			  setTimeout(function() {
				  obj.restore();
			  }, 100);
		  }
		  
	  },
	  
	  _createButtons : function(buttons) {
		  var self = this, hasButtons = false, uiDialogButtonPane = $('<div></div>').addClass('ui-dialog-buttonpane ' + 'ui-widget-content ' + 'ui-helper-clearfix');
		  
		  // if we already have a button pane, remove it
		  this.uiDialog.find('.ui-dialog-buttonpane').remove();
		  
		  (typeof buttons == 'object' && buttons !== null && $.each(buttons, function() {
			  return !(hasButtons = true);
		  }));
		  if (hasButtons) {
			  $.each(buttons, function(name, fn) {
				  $('<button type="button"></button>').addClass('ui-state-default ' + 'ui-corner-all').text(name).click(function() {
					  fn.apply(self.element[0], arguments);
				  }).hover(function() {
					  $(this).addClass('ui-state-hover');
				  }, function() {
					  $(this).removeClass('ui-state-hover');
				  }).focus(function() {
					  $(this).addClass('ui-state-focus');
				  }).blur(function() {
					  $(this).removeClass('ui-state-focus');
				  }).appendTo(uiDialogButtonPane);
			  });
			  uiDialogButtonPane.appendTo(this.uiDialog);
		  }
	  },
	  
	  _makeDraggable : function() {
		  var self = this, options = this.options, heightBeforeDrag;
		  
		  this.uiDialog.draggable( {
		    cancel : '.ui-dialog-content',
		    handle : '.ui-dialog-titlebar',
		    containment : 'document',
		    start : function() {
			    heightBeforeDrag = options.height;
			    $(this).height($(this).height()).addClass("ui-dialog-dragging");
			    (options.dragStart && options.dragStart.apply(self.element[0], arguments));
		    },
		    drag : function() {
			    (options.drag && options.drag.apply(self.element[0], arguments));
		    },
		    stop : function() {
			    $(this).removeClass("ui-dialog-dragging").height(heightBeforeDrag);
			    (options.dragStop && options.dragStop.apply(self.element[0], arguments));
			    $.ui.dialogr.overlay.resize();
		    }
		  });
	  },
	  
	  _makeResizable : function(handles) {
		  handles = (handles === undefined ? this.options.resizable : handles);
		  var self = this, options = this.options, resizeHandles = typeof handles == 'string' ? handles : 'n,e,s,w,se,sw,ne,nw';
		  
		  this.uiDialog.resizable( {
		    cancel : '.ui-dialog-content',
		    alsoResize : this.element,
		    maxWidth : options.maxWidth,
		    maxHeight : options.maxHeight,
		    minWidth : options.minWidth,
		    minHeight : options.minHeight,
		    start : function() {
			    $(this).addClass("ui-dialog-resizing");
			    (options.resizeStart && options.resizeStart.apply(self.element[0], arguments));
		    },
		    resize : function() {
			    (options.resize && options.resize.apply(self.element[0], arguments));
		    },
		    handles : resizeHandles,
		    stop : function() {
			    $(this).removeClass("ui-dialog-resizing");
			    options.height = $(this).height();
			    options.width = $(this).width();
			    (options.resizeStop && options.resizeStop.apply(self.element[0], arguments));
			    $.ui.dialogr.overlay.resize();
		    }
		  }).find('.ui-resizable-se').addClass('ui-icon ui-icon-grip-diagonal-se');
	  },
	  
	  _position : function(pos) {
		  var wnd = $(window), doc = $(document), pTop = doc.scrollTop(), pLeft = doc.scrollLeft(), minTop = pTop;
		  
		  if ($.inArray(pos, [
		      'center', 'top', 'right', 'bottom', 'left'
		  ]) >= 0) {
			  pos = [
			      pos == 'right' || pos == 'left' ? pos : 'center', pos == 'top' || pos == 'bottom' ? pos : 'middle'
			  ];
		  }
		  if (pos.constructor != Array) {
			  pos = [
			      'center', 'middle'
			  ];
		  }
		  if (pos[0].constructor == Number) {
			  pLeft += pos[0];
		  } else {
			  switch (pos[0]) {
				  case 'left':
					  pLeft += 0;
					  break;
				  case 'right':
					  pLeft += wnd.width() - this.uiDialog.outerWidth();
					  break;
				  default:
				  case 'center':
					  pLeft += (wnd.width() - this.uiDialog.outerWidth()) / 2;
			  }
		  }
		  if (pos[1].constructor == Number) {
			  pTop += pos[1];
		  } else {
			  switch (pos[1]) {
				  case 'top':
					  pTop += 0;
					  break;
				  case 'bottom':
					  pTop += wnd.height() - this.uiDialog.outerHeight();
					  break;
				  default:
				  case 'middle':
					  pTop += (wnd.height() - this.uiDialog.outerHeight()) / 2;
			  }
		  }
		  
		  // prevent the dialog from being too high (make sure the titlebar
		  // is accessible)
		  pTop = Math.max(pTop, minTop);
		  this.uiDialog.css( {
		    top : pTop,
		    left : pLeft
		  });
	  },
	  
	  	_setOptions: function( options ) {
		var self = this,
			resizableOptions = {},
			resize = false;

		$.each( options, function( key, value ) {
			self._setOption( key, value );
			
			if ( key in sizeRelatedOptions ) {
				resize = true;
			}
			if ( key in resizableRelatedOptions ) {
				resizableOptions[ key ] = value;
			}
		});

		if ( resize ) {
			this._size();
		}
		if ( this.uiDialog.is( ":data(resizable)" ) ) {
			this.uiDialog.resizable( "option", resizableOptions );
		}
	},

	  
	  _setOption : function(key, value) {
		  (setDataSwitch[key] && this.uiDialog.data(setDataSwitch[key], value));
		  switch (key) {
			  case "buttons":
				  this._createButtons(value);
				  break;
			  case "closeText":
				  this.uiDialogTitlebarCloseText.text(value);
				  break;
			  case "dialogClass":
				  this.uiDialog.removeClass(this.options.dialogClass).addClass(uiDialogClasses + value);
				  break;
			  case "draggable":
				  (value ? this._makeDraggable() : this.uiDialog.draggable('destroy'));
				  break;
			  case "height":
				  this.uiDialog.height(value);
				  break;
			  case "position":
				  this._position(value);
				  break;
			  case "resizable":
				  var uiDialog = this.uiDialog, isResizable = this.uiDialog.is(':data(resizable)');
				  
				  // currently resizable, becoming non-resizable
				  (isResizable && !value && uiDialog.resizable('destroy'));
				  
				  // currently resizable, changing handles
				  (isResizable && typeof value == 'string' && uiDialog.resizable('option', 'handles', value));
				  
				  // currently non-resizable, becoming resizable
				  (isResizable || this._makeResizable(value));
				  break;
			  case "title":
				  $(".ui-dialog-title", this.uiDialogTitlebar).html(value || '&nbsp;');
				  break;
			  case "width":
				  this.uiDialog.width(value);
				  break;
		  }
		  
		  $.Widget.prototype._setOption.apply(this, arguments);
		  //this._update();
		  
	  },
	  
	  /* Allow restore the dialog */
	  restore : function() {
		  window.maximized = false; /* reset both states (restored) */
		  window.minimized = false;
		  this.uiDialog.find('.ui-dialog-content').show();
		 $('.ui-dialog-titlebar-rest', this.uiDialog).hide();
		 $('.ui-dialog-titlebar-max', this.uiDialog).show();
		 $('.ui-dialog-titlebar-min', this.uiDialog).show();
		  this.uiDialog.css( {
		    position : 'absolute',
		    width : this.options.width,
		    height : this.options.height
		  });
		  this.position(this.options.position);
		  this.uiDialog.find('#dialog-restore').css('right', '1.5em');
		  this._setOption("resizable", true);
		  this._setOption("draggable", true);
		  this.uiDialog.removeClass("dialogr-minimized");
		  //$('.ui-dialog-titlebar ').css('background', 'none repeat scroll 0 0 #FFFFFF');
		  this.originalSize();
		  this.changeTheSize();
		  this.adjustScrollContent();
		  this.moveToTop(true);
		  
		  /*
		   * FORMALTIS :
		   * auto position minimized windows (taskbar style).
		   * eventually resize windows
		   */
		  // total width available
		  var tw = this.uiDialog.parent().width();
		  // Compute windows' width
		  var nb = $('.dialogr-minimized:visible').size();
		  var w = Math.min((tw - 2 * 10 - (nb - 1) * 5) / nb, 250);
		  // and do it !
		  var left = 10;
		  $('.dialogr-minimized:visible').each(function() {
			  var $t = $(this);
			  $t.width(w);
			  $t.css('left', left);
			  left += w + 5;
		  });
		  
		   reSizeIframe(this.uiDialog.find('.ui-dialog-content'));
		  /* end */
	  },
	  
	  /* Minimize to a custom position */
	  minimize : function() {
		  window.minimized = true; /* save the current state: minimized */
		  window.maximized = false;
		  this.uiDialog.find('.ui-dialog-content').hide();
		  this._setOption("resizable", false);
		  this._setOption("draggable", false);
		  this.uiDialog.addClass("dialogr-minimized");
		 $('.ui-dialog-titlebar-rest', this.uiDialog).show();
		 $('.ui-dialog-titlebar-max', this.uiDialog).show();
		 $('.ui-dialog-titlebar-min', this.uiDialog).hide();
		 $('.ui-dialog-titlebar-rest', this.uiDialog).css('right', '2.8em');
		  this.uiDialog.css('top', 'auto'); /* needed because top has a default value and this breaks bottom value */
		  this.size();
		  
		  this.uiDialog.css( {
		    position : "absolute",
		    left : 10,
		    width : 250,
		    height : 100,
		    bottom : "-60px"
		  });
		  this.uiDialog.css('position', 'fixed'); /* sticky the dialog at the page to avoid scrolling */
		  $('.ui-dialog-titlebar-rest', this.uiDialog).css('display', 'block');
		  
		  /*
		   * FORMALTIS :
		   * auto position minimized windows (taskbar style).
		   * eventually resize windows
		   */
		  // total width available
		  var tw = this.uiDialog.parent().width();
		  // Compute windows' width
		  var nb = $('.dialogr-minimized:visible').size();
		  var w = Math.min((tw - 2 * 10 - (nb - 1) * 5) / nb, 250);
		  // and do it !
		  var left = 10;
		  $('.dialogr-minimized:visible').each(function() {
			  var $t = $(this);
			  $t.width(w);
			  $t.css('left', left);
			  left += w + 5;
		  });
		  /* end */
	  },
	  
	  /* Maximize to the whole visible size of the window */
	  maximize : function() {
		  window.maximized = true; /* save the current state: maximized */
		  window.minimized = false;
		  this._setOption("resizable", true);
		  this._setOption("draggable", true);
		  this.uiDialog.find('.ui-dialog-content').show();
		  
		  /* A different width and height for each browser...wondering why? */
		  marginHDialog = 25;
		  marginWDialog = 25;
		  if ($.browser.msie && $.browser.version == 8) {
			  marginHDialog = 25;
			  marginWDialog = 52;
		  }
		  marginHDialog = $(window).height() - marginHDialog;
		  marginWDialog = $('body').width() - marginWDialog;
		  //console.log('maximize to '+marginWDialog+", $('body').width() : "+$('body').width());
		  this.uiDialog.css( {
		    left : 10,
		    top : $(document).scrollTop() + 5,
		    width : marginWDialog + "px",
		    height : marginHDialog + "px"
		  });
		  
		  //$('.ui-dialog').trigger("resize");
		  this.uiDialog.removeClass("dialogr-minimized");
		  //$('.ui-dialog-titlebar ').css('background', 'none repeat scroll 0 0 #FFFFFF');
		 
		 $('.ui-dialog-titlebar-rest', this.uiDialog).show();
		 $('.ui-dialog-titlebar-max', this.uiDialog).hide();
		 $('.ui-dialog-titlebar-min', this.uiDialog).show();
		  
		  
		  $('.ui-dialog-titlebar-rest', this.uiDialog).css('right', '1.5em');
		  this.size();
		  this.uiDialog.css('position', 'absolute');
		  this.adjustScrollContent();
		  this.moveToTop(true);
		  
		  /*
		   * FORMALTIS :
		   * auto position minimized windows (taskbar style).
		   * eventually resize windows
		   */
		  // total width available
		  var tw = this.uiDialog.parent().width();
		  // Compute windows' width
		  var nb = $('.dialogr-minimized:visible').size();
		  var w = Math.min((tw - 2 * 10 - (nb - 1) * 5) / nb, 250);
		  // and do it !
		  var left = 10;
		  $('.dialogr-minimized:visible').each(function() {
			  var $t = $(this);
			  $t.width(w);
			  $t.css('left', left);
			  left += w + 5;
		  });
		  reSizeIframe(this.uiDialog.find('.ui-dialog-content'));
		  //alert( );
		  /* end */
	  },
	  
	  /* Store the size of dialog, before it gets minimized or maximized */
	  originalSize : function() {
		  this.options.height = this.uiDialog.height();
		  this.options.width = this.uiDialog.width();
	  },
	  
	  changeTheSize : function() {
		  marginH = 11;
		  marginW = 17;
		  
		  /* Can't understand why, but all browsers have different heights and widht... */
		  if ($.browser.msie) {
			  marginH = 10;
			  marginW = 18;
		  }
		  if ($.browser.safari) {
			  marginH = 12;
			  marginW = 16;
		  }
		  
		  $('#dialog').css('width', ($('#dialog').width() - 3) + "px");
		  $('.ui-resizable-w').css('height', ($('.ui-dialog').height() - $('.ui-resizable-sw').height() - marginH) + "px");
		  $('.ui-resizable-e').css('height', ($('.ui-dialog').height() - $('.ui-resizable-se').height() - marginH)) + "px";
		  $('.ui-resizable-n').css('width', ($('.ui-dialog').width() - $('.ui-resizable-ne').width() - $('.ui-resizable-nw').width() + marginW)) + "px";
		  $('.ui-resizable-s').css('width', ($('.ui-dialog').width() - $('.ui-resizable-se').width() - $('.ui-resizable-sw').width() + marginW) + "px");
	  },
	  
	  /* Saves all css related to the dialog position before maximize or minimize */
	  position : function(pos) {
		  var wnd = $(window), doc = $(document), pTop = doc.scrollTop(), pLeft = doc.scrollLeft(), minTop = pTop;
		  
		  if ($.inArray(pos, [
		      'center', 'top', 'right', 'bottom', 'left'
		  ]) >= 0) {
			  pos = [
			      pos == 'right' || pos == 'left' ? pos : 'center', pos == 'top' || pos == 'bottom' ? pos : 'middle'
			  ];
		  }
		  if (pos.constructor != Array) {
			  pos = [
			      'center', 'middle'
			  ];
		  }
		  if (pos[0].constructor == Number) {
			  pLeft += pos[0];
		  } else {
			  switch (pos[0]) {
				  case 'left':
					  pLeft += 0;
					  break;
				  case 'right':
					  pLeft += wnd.width() - this.uiDialog.width();
					  break;
				  default:
				  case 'center':
					  pLeft += (wnd.width() - this.uiDialog.width()) / 2;
			  }
		  }
		  if (pos[1].constructor == Number) {
			  pTop += pos[1];
		  } else {
			  switch (pos[1]) {
				  case 'top':
					  pTop += 0;
					  break;
				  case 'bottom':
					  pTop += wnd.height() - this.uiDialog.height();
					  break;
				  default:
				  case 'middle':
					  pTop += (wnd.height() - this.uiDialog.height()) / 2;
			  }
		  }
		  
		  // prevent the dialog from being too high (make sure the titlebar is accessible)
		  pTop = Math.max(pTop, minTop);
		  this.uiDialog.css( {
		    top : pTop,
		    left : pLeft
		  });
	  },
	  
	  /* Adjuste the content inside the dialog on maximize/restore */
	  adjustScrollContent : function() {
		
		  var heightDialog = (this.uiDialog.height() - 72) + 'px';
		  //var widthDialog = (this.uiDialog.width() - 0) + 'px';
		  this.uiDialog.find('.ui-dialog-content').css( {
		    width : 'auto',
		    height : heightDialog
		  });
		  this.uiDialog.find('#dialog').css( {
		    width : 'auto',
		    height : heightDialog
		  });
	  },
	  
	  dispatchThisEvent : function(elId) {
		  
		  var evt;
		  var el = elId;
		  if (document.createEvent) {
			  evt = document.createEvent("Event");
			  evt.initEvent("resize", true, true, window, 0, 0, 0, 0, 0, false, false, false, false, 0, null);
		  }
		  (evt) ? el.dispatchEvent(evt) : (el.resize && el.resize());
		  
	  },
	  
	  size : function() {
		  var container = this.uiDialogTitlebar.parent(), titlebar = this.uiDialogTitlebar, content = this.element, tbMargin = parseInt(content.css('margin-top'), 10) + parseInt(content.css('margin-bottom'), 10), lrMargin = parseInt(content.css('margin-left'), 10)
		      + parseInt(content.css('margin-right'), 10);
		  
		  content.height(container.height() - titlebar.outerHeight() - tbMargin /* More precision on scroll content */- 8);
		  content.width(container.width() - lrMargin);
		  
	  },
	  
	  _size : function() {
		  /* If the user has resized the dialog, the .ui-dialog and .ui-dialog-content
		   * divs will both have width and height set, so we need to reset them
		   */
		  var options = this.options;
		  
		  // reset content sizing
		this.element.css( {
		  height : 0,
		  minHeight : 0,
		  width : 'auto'
		});
		
		// reset wrapper sizing
		// determine the height of all the non-content elements
		var nonContentHeight = this.uiDialog.css( {
		  height : 'auto',
		  width : options.width
		}).height();
		
		this.element.css( {
		  minHeight : Math.max(options.minHeight - nonContentHeight, 0),
		  height : options.height == 'auto' ? 'auto' : Math.max(options.height - nonContentHeight, 0)
		});
	}
	});
	
	$.extend($.ui.dialogr, {
	  version : "1.7.2",
	  defaults : {
	    autoOpen : true,
	    bgiframe : false,
	    buttons : {},
	    closeOnEscape : true,
	    closeText : 'close',
	    dialogClass : '',
	    draggable : true,
	    hide : null,
	    height : 'auto',
	    maxHeight : false,
	    maxWidth : false,
	    minHeight : 150,
	    minWidth : 150,
	    modal : false,
	    position : 'center',
	    resizable : true,
	    maximized : true,
	    minimized : true,
	    show : null,
	    stack : true,
	    title : '',
	    width : 300,
	    zIndex : 1000
	  },
	  
	  getter : 'isOpen',
	  
	  uuid : 0,
	  maxZ : 0,
	  
	  getTitleId : function($el) {
		  return 'ui-dialog-title-' + ($el.attr('id') || ++this.uuid);
	  },
	  
	  overlay : function(dialog) {
		  this.$el = $.ui.dialogr.overlay.create(dialog);
	  }
	});
	
	$.extend($.ui.dialogr.overlay, {
	  instances : [],
	  maxZ : 0,
	  events : $.map('focus,mousedown,mouseup,keydown,keypress,click'.split(','), function(event) {
		  return event + '.dialog-overlay';
	  }).join(' '),
	  create : function(dialog) {
		  if (this.instances.length === 0) {
			  // prevent use of anchors and inputs
		// we use a setTimeout in case the overlay is created from an
		// event that we're going to be cancelling (see #2804)
		setTimeout(function() {
			// handle $(el).dialog().dialog('close') (see #4065)
				if ($.ui.dialogr.overlay.instances.length) {
					$(document).bind($.ui.dialogr.overlay.events, function(event) {
						var dialogZ = $(event.target).parents('.ui-dialog').css('zIndex') || 0;
						return (dialogZ > $.ui.dialogr.overlay.maxZ);
					});
				}
			}, 1);
		
		// allow closing by pressing the escape key
		$(document).bind('keydown.dialog-overlay', function(event) {
			(dialog.options.closeOnEscape && event.keyCode && event.keyCode == $.ui.keyCode.ESCAPE && dialog.close(event));
		});
		
		// handle window resize
		$(window).bind('resize.dialog-overlay', $.ui.dialogr.overlay.resize);
	}
	
	var $el = $('<div></div>').appendTo(document.body).addClass('ui-widget-overlay').css( {
		width : this.width(),
		height : this.height()
	});
	
	(dialog.options.bgiframe && $.fn.bgiframe && $el.bgiframe());
	
	this.instances.push($el);
	return $el;
},

destroy : function($el) {
	this.instances.splice($.inArray(this.instances, $el), 1);
	
	if (this.instances.length === 0) {
		$( [
			  document, window
		]).unbind('.dialog-overlay');
	}
	
	$el.remove();
	
	// adjust the maxZ to allow other modal dialogs to continue to work (see #4309)
		var maxZ = 0;
		$.each(this.instances, function() {
			maxZ = Math.max(maxZ, this.css('z-index'));
		});
		this.maxZ = maxZ;
	},
	
	height : function() {
		// handle IE 6
		if ($.browser.msie && $.browser.version < 7) {
			var scrollHeight = Math.max(document.documentElement.scrollHeight, document.body.scrollHeight);
			var offsetHeight = Math.max(document.documentElement.offsetHeight, document.body.offsetHeight);
			
			if (scrollHeight < offsetHeight) {
				return $(window).height() + 'px';
			} else {
				return scrollHeight + 'px';
			}
			// handle "good" browsers
		} else {
			return $(document).height() + 'px';
		}
	},
	
	width : function() {
		// handle IE 6
		if ($.browser.msie && $.browser.version < 7) {
			var scrollWidth = Math.max(document.documentElement.scrollWidth, document.body.scrollWidth);
			var offsetWidth = Math.max(document.documentElement.offsetWidth, document.body.offsetWidth);
			
			if (scrollWidth < offsetWidth) {
				return $(window).width() + 'px';
			} else {
				return scrollWidth + 'px';
			}
			// handle "good" browsers
		} else {
			return $(document).width() + 'px';
		}
	},
	
	resize : function() {
		/* If the dialog is draggable and the user drags it past the
		 * right edge of the window, the document becomes wider so we
		 * need to stretch the overlay. If the user then drags the
		 * dialog back to the left, the document will become narrower,
		 * so we need to shrink the overlay to the appropriate size.
		 * This is handled by shrinking the overlay before setting it
		 * to the full document size.
		 */
		var $overlays = $( []);
		$.each($.ui.dialogr.overlay.instances, function() {
			$overlays = $overlays.add(this);
		});
		
		$overlays.css( {
		  width : 0,
		  height : 0
		}).css( {
		  width : $.ui.dialogr.overlay.width(),
		  height : $.ui.dialogr.overlay.height()
		});
	}
	});
	
	$.extend($.ui.dialogr.overlay.prototype, {
		destroy : function() {
			$.ui.dialogr.overlay.destroy(this.$el);
		}
	});
	
})(jQuery);
