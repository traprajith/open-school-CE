<?php
	$basePath=Yii::getPathOfAlias('application.modules.message.views.asset');
	$baseUrl=Yii::app()->getAssetManager()->publish($basePath);
	$cs = Yii::app()->getClientScript();
	$cs->registerCoreScript('jquery');
	$cs->registerCssFile($baseUrl.'/css/redmond/jquery-ui-1.8.16.custom.css');
	$cs->registerCssFile($baseUrl.'/css/styles.css');
	$cs->registerScriptFile($baseUrl.'/js/jquery-ui-1.8.16.custom.min.js');
?>

<script type="text/javascript">
	$(document).ready(function() {
		$( "#receiver" ).autocomplete({
			source: function( request, response ) {
				$.ajax({
					url: "<?php echo $this->createUrl('suggest/user') ?>",
					dataType: "jsonp",
					data: {
						featureClass: "P",
						style: "full",
						maxRows: 12,
						name_startsWith: request.term
					},

					success: function(data) {
						response($.map(data.users, function(user) {
							return {
								label: user.name,
								value: user.id
							}
						}));
					}
				});
			},
			minLength: 2,
			mustMatch: true,
			focus: function(event, ui) {
				$('#receiver').val(ui.item.label);
				return false;
			},
			select: function(event, ui) {
				$('#receiver').val(ui.item.label);
				$('#Message_receiver_id').val(ui.item.value);
				return false;
			},
			open: function() {
				$(this).removeClass("ui-corner-all").addClass("ui-corner-top");
			},
			close: function() {
				$(this).removeClass("ui-corner-top").addClass("ui-corner-all");
			}
		});
	});
</script>
