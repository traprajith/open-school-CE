<style type="text/css">
.flash-notice{ right:35%;
	font-size: 11px;
	top:26px;
	width: 342px;
	right:30%}
	
.flash-success{top:32px;
	font-size: 11px;
	right: 230px;
    width: 339px;}

</style>

<?php

foreach(Yii::app()->user->getFlashes() as $key => $message) {
	
	if(!isset($registerScript_animate_flash))
	{
		
		Yii::app()->clientScript->registerScript(
			'animateFlashMsg',
			'$(".flash-message").animate({opacity: 1.0}, 3000).fadeOut("slow");',
			CClientScript::POS_READY
		);
		$registerScript_animate_flash = 1;
	} 
	echo '<div class="flash-message flash-' . $key . '" style="color:#F00; padding-left:15px; font-weight: bold; ">' . $message . "</div>\n";
}
?>
