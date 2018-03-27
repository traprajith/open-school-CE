<?php Yii::app()->clientScript->registerCoreScript('jquery');
//IMPORTANT about Fancybox.You can use the newest 2.0 version or the old one
//If you use the new one,as below,you can use it for free only for your personal non-commercial site.For more info see
//If you decide to switch back to fancybox 1 you must do a search and replace in index view file for "beforeClose" and replace with 
//"onClosed"
// http://fancyapps.com/fancybox/#license
// FancyBox2
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js_plugins/fancybox2/jquery.fancybox.js', CClientScript::POS_HEAD);
Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/js_plugins/fancybox2/jquery.fancybox.css', 'screen');
//JQueryUI (for delete confirmation  dialog)
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js_plugins/jqui1812/js/jquery-ui-1.8.12.custom.min.js', CClientScript::POS_HEAD);
Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/js_plugins/jqui1812/css/dark-hive/jquery-ui-1.8.12.custom.css','screen');
///JSON2JS
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js_plugins/json2/json2.js');
//jqueryform js
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js_plugins/ajaxform/jquery.form.js', CClientScript::POS_HEAD);
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js_plugins/ajaxform/form_ajax_binding.js', CClientScript::POS_HEAD);
Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/js_plugins/ajaxform/client_val_form.css','screen');
?>
<?php $this->renderPartial('//configurations/_leftside_links');?>
<div id="subject-name-ajax-grid"></div>
<script type="text/javascript">
	$(document).ready(function () {
		//Hide the second level menu
		$('#othleft-sidebar ul li ul').hide();            
		//Show the second level menu if an item inside it active
		$('li.list_active').parent("ul").show();
		$('#othleft-sidebar').children('ul').children('li').children('a').click(function () {                    
			if($(this).parent().children('ul').length>0){                  
				$(this).parent().children('ul').toggle();    
			}
		});
	});
	
	//CREATE 
	$('#add_subject-name-ajax').bind('click', function() {
		$.ajax({
			type: "POST",
			url: "<?php echo Yii::app()->request->baseUrl;?>/index.php?r=subjectNameAjax/returnForm",
			data:{"YII_CSRF_TOKEN":"<?php echo Yii::app()->request->csrfToken;?>"},
			beforeSend : function() {
				$("#subject-name-ajax-grid").addClass("ajax-sending");
			},
			complete : function() {
				$("#subject-name-ajax-grid").removeClass("ajax-sending");
			},
			success: function(data) {
				$.fancybox(data,{ 
					"transitionIn"      : "elastic",
					"transitionOut"   : "elastic",
					"speedIn"                : 600,
					"speedOut"            : 200,
					"overlayShow"     : false,
					"hideOnContentClick": false,
					"afterClose":    function() {
						window.location.reload();
					} 
					//onclosed function
				});//fancybox
			} //success
		});//ajax
		return false;
	});//bind
</script>