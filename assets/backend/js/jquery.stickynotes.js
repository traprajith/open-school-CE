(function(jQuery) {
	
	jQuery.fn.stickyNotes = function(options) {
		jQuery.fn.stickyNotes.options = jQuery.extend({}, jQuery.fn.stickyNotes.defaults, options);
		jQuery.fn.stickyNotes.prepareContainer(this);
		jQuery.each(jQuery.fn.stickyNotes.options.notes, function(index, note){
			jQuery.fn.stickyNotes.renderNote(note);
			jQuery.fn.stickyNotes.notes.push(note);
		});
	};
	
	
	jQuery.fn.stickyNotes.getNote = function(note_id) {
		var result = null;
		jQuery.each(jQuery.fn.stickyNotes.notes, function(index, note) {
			if (note.id == note_id) {
				result = note;
				return false;
			}
		});
		return result;
	}
	
	jQuery.fn.stickyNotes.getNotes = function() {
		return jQuery.fn.stickyNotes.notes;
	}	
	
	jQuery.fn.stickyNotes.deleteNote =  function(note_id) {
		jQuery.each(jQuery.fn.stickyNotes.notes, function(index, note) {
			if (note.id == note_id) {
				jQuery.fn.stickyNotes.notes.splice(index, 1);
				return false;
			}
		});
	}
	
	jQuery.fn.stickyNotes.prepareContainer = function(container) {
		jQuery(container).append('<div id="sticky-container" class="sticky-container"></div>');
		if (jQuery.fn.stickyNotes.options.controls) {
			jQuery("#sticky-container").html('<button id="add_note">Add Note</button>');			
			jQuery("#add_note").click(function() {
				jQuery.fn.stickyNotes.createNote();
				return false;
			});	
		}
		jQuery("#sticky-container").click(function() {
			var note_ids = jQuery.fn.stickyNotes.currentlyEditedNotes();
			for (var i = note_ids.length - 1; i >= 0; i--){
				var note_id = note_ids[i]
				if (note_id != null) {
					jQuery.fn.stickyNotes.stopEditing(note_id);
				}				
			};
		}); 
	};
	
	jQuery.fn.stickyNotes.createNote = function() {
		var pos_x = 0;
		var pos_y = 0;		
		var note_id = jQuery.fn.stickyNotes.notes.length + 1;
		var _note_content = jQuery(document.createElement('textarea'));

		var _div_note 	= 	jQuery(document.createElement('div')).addClass('jStickyNote');
        var _div_background = jQuery.fn.stickyNotes.createNoteBackground();
		_div_note.append(_note_content);
		var _div_delete = 	$(document.createElement('div'))
							.addClass('jSticky-delete')
							.click(function(){jQuery.fn.stickyNotes.deleteNote(this);});
		var _div_wrap 	= 	$(document.createElement('div'))
							.css({'position':'absolute','top':pos_x,'left':pos_y, 'float' : 'left'})
							.attr("id", "note-" + note_id)
							.append(_div_background)
							.append(_div_note)
							.append(_div_delete);	
		_div_wrap.addClass('jSticky-medium');		
		if (jQuery.fn.stickyNotes.options.resizable) {
			_div_wrap.resizable({stop: function(event, ui) { jQuery.fn.stickyNotes.resizedNote(note_id)}});
		}		
		_div_wrap.draggable({containment: '#sticky-container', scroll: false, stop: function(event, ui){jQuery.fn.stickyNotes.movedNote(note_id)}}); 
		

		$('#sticky-container').append(_div_wrap);
		
		jQuery.fn.stickyNotes.setCurrentlyEditedNote(note_id);
		jQuery("#note-" + note_id).click(function() {
			return false;
		})
		jQuery("#note-" + note_id).find("textarea").focus();
		var note = {"id":note_id,
		      "text":"",
			  "pos_x": pos_x,
			  "pos_y": pos_y,	
			  "width": jQuery(_div_wrap).width(),							
			  "height": jQuery(_div_wrap).height()};
		jQuery.fn.stickyNotes.notes.push(note);
        jQuery(_note_content).css({
            'width': jQuery("#note-" + note_id).width() - 44, 
            'height': jQuery("#note-" + note_id).height() - 15
        });
		if (jQuery.fn.stickyNotes.options.createCallback) {
			jQuery.fn.stickyNotes.options.createCallback(note);
		}		
		
	}
	
	jQuery.fn.stickyNotes.stopEditing = function(note_id) {
		var note = jQuery.fn.stickyNotes.getNote(note_id);
		note.text = $("#note-" + note_id).find('textarea').val();
		var _p_note_text = 	$(document.createElement('p')).attr("id", "p-note-" + note_id)
							.html(note.text);
		$("#note-" + note_id).find('textarea').replaceWith(_p_note_text); 
		$("#p-note-" + note_id).dblclick(function() {
			jQuery.fn.stickyNotes.editNote(this);
		});	
		jQuery.fn.stickyNotes.removeCurrentlyEditedNote(note_id);
		if (jQuery.fn.stickyNotes.options.editCallback) {
			jQuery.fn.stickyNotes.options.editCallback(note);
		}
	};
	
	jQuery.fn.stickyNotes.deleteNote = function(delete_button) {
		var note_id = jQuery(delete_button).parent().attr("id").replace(/note-/, "");
		var note = jQuery.fn.stickyNotes.getNote(note_id);
		jQuery("#note-" + note_id).remove();
		if (jQuery.fn.stickyNotes.options.deleteCallback) {
			jQuery.fn.stickyNotes.options.deleteCallback(note);
		}
		jQuery.fn.stickyNotes.deleteNote(note_id);
	}
	
	jQuery.fn.stickyNotes.editNote = function(paragraph) {
		var note_id = jQuery(paragraph).parent().parent().attr("id").replace(/note-/, "");
		var textarea = 	$(document.createElement('textarea')).attr("id", "textarea-note-" + note_id)
							.val(
									$("#note-" + note_id)
									.find('p')
									.html()
									);

		$("#p-note-" + note_id).replaceWith(textarea);

        jQuery(textarea).css({
            'width': jQuery("#note-" + note_id).width() - 44, 
            'height': jQuery("#note-" + note_id).height() - 15
        });
		jQuery("#note-" + note_id).find("textarea").focus();
		jQuery.fn.stickyNotes.setCurrentlyEditedNote(note_id);
	}
	
	jQuery.fn.stickyNotes.currentlyEditedNotes = function() {
		return jQuery.fn.stickyNotes.currentlyEditedNoteIds;
	}
	
	jQuery.fn.stickyNotes.setCurrentlyEditedNote = function(note_id) {
		jQuery.fn.stickyNotes.currentlyEditedNoteIds.push(note_id);
	}	
	
	jQuery.fn.stickyNotes.removeCurrentlyEditedNote = function(note_id) {
		var notes = jQuery.fn.stickyNotes.currentlyEditedNotes();
		var pos = -1;
		for (var i = notes.length - 1; i >= 0; i--){
			if (notes[i] == note_id) {
				pos = i;
				break;
			}
		};
		jQuery.fn.stickyNotes.currentlyEditedNoteIds.splice(pos, 1);
	}
	
	jQuery.fn.stickyNotes.renderNote = function(note) {
		var _p_note_text = 	$(document.createElement('p')).attr("id", "p-note-" + note.id)
							.html( note.text);		
		var _div_note 	= 	jQuery(document.createElement('div')).addClass('jStickyNote');
        var _div_background = jQuery.fn.stickyNotes.createNoteBackground();
		_div_note.append(_p_note_text);
		var _div_delete = 	$(document.createElement('div'))
							.addClass('jSticky-delete')
							.click(function(){jQuery.fn.stickyNotes.deleteNote(this);});
		var _div_wrap 	= 	$(document.createElement('div'))
							.css({'position':'absolute','top':note.pos_y,'left':note.pos_x, 'float': 'left',"width":note.width,"height":note.height})
							.attr("id", "note-" + note.id)
							.append(_div_background)
							.append(_div_note)
							.append(_div_delete);	
		_div_wrap.addClass('jSticky-medium');
		if (jQuery.fn.stickyNotes.options.resizable) {
			_div_wrap.resizable({stop: function(event, ui) { jQuery.fn.stickyNotes.resizedNote(note.id)}});
		}
		_div_wrap.draggable({containment: '#sticky-container', scroll: false, stop: function(event, ui){jQuery.fn.stickyNotes.movedNote(note.id)}}); 
		

		$('#sticky-container').append(_div_wrap);
		jQuery("#note-" + note.id).click(function() {
			return false;
		})
		$(_p_note_text).dblclick(function() {
			jQuery.fn.stickyNotes.editNote(this);
		});		
	}
	
	jQuery.fn.stickyNotes.movedNote = function(note_id) {
		var note = jQuery.fn.stickyNotes.getNote(note_id);
		note.pos_x=jQuery("#note-" + note_id).css("left").replace(/px/, "");
		note.pos_y=jQuery("#note-" + note_id).css("top").replace(/px/, "");
		if (jQuery.fn.stickyNotes.options.moveCallback) {
			jQuery.fn.stickyNotes.options.moveCallback(note);
		}		
	}
	
	jQuery.fn.stickyNotes.resizedNote = function(note_id) {
		var note = jQuery.fn.stickyNotes.getNote(note_id);
		note.width=jQuery("#note-" + note_id).width();
		note.height=jQuery("#note-" + note_id).height();
		if (jQuery.fn.stickyNotes.options.resizeCallback) {
			jQuery.fn.stickyNotes.options.resizeCallback(note);
		}		
	}
    jQuery.fn.stickyNotes.createNoteBackground = function() {
        var background = null;
        if (jQuery.browser.msie && jQuery.browser.version <= 6)  {
            background = $(document.createElement('div')).addClass("background").html('<img src="images/spacer.gif" class="stretch" style="margin-top:5px;filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src=\'images/sticky/sticky-bg.png\',sizingMethod=\'scale\'");" alt="" />');
        } else {
            background = $(document.createElement('div')).addClass("background").html('<img src="images/sticky/sticky-bg.png" class="stretch" style="margin-top:5px;" alt="" />');
        }
        return background;

    }
	

	jQuery.fn.stickyNotes.defaults = {
		notes 	: [],
		resizable : true,
		controls: true,
		editCallback: false, 
		createCallback: false,
		deleteCallback: false,
		moveCallback: false,
		resizeCallback: false
	};
	
	jQuery.fn.stickyNotes.options = null;
	jQuery.fn.stickyNotes.currentlyEditedNoteIds = new Array();
	jQuery.fn.stickyNotes.notes = new Array();
})(jQuery);
