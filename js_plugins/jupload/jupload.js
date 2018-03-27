(function($) {

	$.jupload = function(element, options) {
		this.options 		= {};
		this.$handle		= element;
		this.id				= (this.$handle.data('id'))?this.$handle.data('id'):1;
		//copy of current instance
		var that			= this;
		
		that.init = function(element, options) {
			that.options = $.extend({}, $.jupload.defaultOptions, options);
			
			that.$previewContainer = (options.previewContainer!=null)?$($(options.previewContainer)):null;
			
			//making fle element
			var file	= $('<input type="file" />');
			file.attr({
				name 	 : 'jupload-file-' + that.id,
				style	 : 'display:none',
				multiple : that.options.multiple,
			});
			
			file.change(function(e) {
				that.readurl(this);                
            });
			
			file.insertAfter(that.$handle);
			
			//on mouse click event on handle
			that.$handle.click(function(event){
				file.click();
			});			
		};
		
		//Public function
		that.readurl = function(input){
			var files	= input.files;
			
			var validfiles	= [];
			
			//validation
			$.each(files, function(index, file){
				var ext = file.name.split('.').pop().toLowerCase();				
				if($.inArray(ext, that.options.allowedExtensions) > -1) {
					validfiles.push(file);
				}
			});	
			var flag = false;
			$.each(files, function(index, file){
				var size = file.size;				
				if(size>that.options.maxfilesize){ flag = true; return false; }
			});		
			
			if(flag){
				alert('File size is greater than 1MB');
				return;
			}
				
			if(validfiles.length==0){ alert("select a valid image"); return; }			
			if(that.options.preview && that.$previewContainer){
				$.each(validfiles, function(index, file){
					var reader = new FileReader();
					reader.onload = function (e) {
						var img	= $('<img />');
						img.attr('src', e.target.result);
						if(index==0)
							that.$previewContainer.html(img);
						else
							that.$previewContainer.append(img);
					}
					reader.readAsDataURL(file);
				});
			}
			
			that.select(validfiles);
						
			//start uploading
			that.upload(validfiles);
		};
		
		//callback function
		that.select = function(files){			
			that.options.select(files);
		};
		
		//upload function
		that.upload = function(files){			
			$.each(files, function(index, file){
				var formData = new FormData();
				// Main magic with files here
				formData.append('file', file);
				var data	= that.options.data;				
				$.each(data, function(key, value){
					formData.append(key, value);
				});
				
				$.ajax({
					url: that.options.url,
					data: formData,
					processData: false,
 					contentType: false,
					type: 'POST',
					success: function(response){
						that.complete(response);
					},
					// THIS MUST BE DONE FOR FILE UPLOADING
					xhr: function() {
						var xhr = $.ajaxSettings.xhr();						
						if ( xhr.upload ) {
							console.log('xhr upload');							
							xhr.upload.onprogress = function(e) {							
								var progressDone	= e.position || e.loaded,
									progressTotal	= e.totalSize || e.total;
								
								that.uploadProgress(e, progressDone, progressTotal);
							};
						}						
						return xhr;
					}
				});
			});
		};
		
		that.uploadProgress = function(event, progressDone, progressTotal){
			var percentComplete	= ( progressDone / progressTotal ) * 100;
			that.options.uploadProgress(event, progressDone, progressTotal, percentComplete);
		},
		
		that.complete	= function(response){
			that.options.complete(response);
		},
		//calling init()
		that.init(element, options);
	};
		
	$.fn.jupload = function(options) { //Using only one method off of $.fn  
		return this.each(function() {
			new $.jupload($(this), options); 
		});
	};

	$.jupload.defaultOptions = {
		url				 : null,
		data			 : {},
		preview			 : true,
		previewContainer : null,
		multiple		 : false,
		allowedExtensions: ['gif','png','jpg','jpeg'],
		maxfilesize		 : '1048576',
		select			 : function(files){},	//callback on value change			
		uploadProgress	 : function(event, progressDone, progressTotal, percentComplete){},
		complete		 : function(response){},
	}
	
})(jQuery);