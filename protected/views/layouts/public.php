
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
  <!--<link rel="shortcut icon" href="images/favicon.png" type="image/png">-->
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/res_js/jquery-1.10.2.min.js"></script>
    <title><?php $college=Configurations::model()->findByPk(1); ?><?php echo $college->config_value ; ?></title>
    
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/res_css/os.style.default.css" rel="stylesheet">
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/res_css/jquery.datatables.css" rel="stylesheet">
    
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/res_css/theme.css" rel="stylesheet">
  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="js/html5shiv.js"></script>
  <script src="js/respond.min.js"></script>
  <![endif]-->
  <?php if(Yii::app()->controller->action->id != 'step3'){ ?>
  	<script src="<?php echo Yii::app()->request->baseUrl; ?>/res_js/jquery-1.10.2.min.js"></script>
  <?php } ?>  
</head>
<body class="se_body">

<!-- Preloader -->
<div id="preloader">
    <div id="status"><i class="fa fa-spinner fa-spin"></i></div>
</div>

<section>
  <?php

      $settings=UserSettings::model()->findByAttributes(array('user_id'=>1));
	  if($settings!=NULL)
	  {
		  $lan=$settings->language;
	  }
	  else
	  {
		  $lan='en_us';
	  }
	 Yii::app()->translate->setLanguage($lan);


 
?>
 <?php echo $content; ?>
  
</section>
<!--modal box-->
<div aria-hidden="false" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade in">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
        <h4 id="myModalLabel" class="modal-title"></h4>
      </div>
      <div class="modal-body cmmodal_b">
        <?php echo Yii::t('app', 'Content goes here...');?>
      </div>
      <!--<div class="modal-footer">
        <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>        
      </div>-->
    </div><!-- modal-content -->
  </div><!-- modal-dialog -->
</div>
<!--modal box end-->



<script src="<?php echo Yii::app()->request->baseUrl; ?>/res_js/jquery-migrate-1.2.1.min.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/res_js/bootstrap.min.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/res_js/modernizr.min.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/res_js/jquery.sparkline.min.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/res_js/toggles.min.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/res_js/retina.min.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/res_js/jquery.cookies.js"></script>

<script src="<?php echo Yii::app()->request->baseUrl; ?>/res_js/jquery.datatables.min.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/res_js/chosen.jquery.min.js"></script>

<script src="<?php echo Yii::app()->request->baseUrl; ?>/res_js/custom.js"></script>
<script>
  jQuery(document).ready(function() {
    
    jQuery('#table1').dataTable();
    
    jQuery('#table2').dataTable({
      "sPaginationType": "full_numbers"
    });
    
    // Chosen Select
    jQuery("select").chosen({
      'min-width': '100px',
      'white-space': 'nowrap',
      disable_search_threshold: 10
    });
    
    // Delete row in a table
    jQuery('.delete-row').click(function(){
      var c = confirm("<?php echo Yii::t('app', 'Continue delete?');?>");
      if(c)
        jQuery(this).closest('tr').fadeOut(function(){
          jQuery(this).remove();
        });
        
        return false;
    });
    
    // Show aciton upon row hover
    jQuery('.table-hidaction tbody tr').hover(function(){
      jQuery(this).find('.table-action-hide a').animate({opacity: 1});
    },function(){
      jQuery(this).find('.table-action-hide a').animate({opacity: 0});
    });
  
  
  });
</script>
<script>
function open_popup_links(){
	$('.open_popup').unbind('click');
	$('.open_popup').on('click', function(e) {
		$('#myModal .modal-body, #myModalLabel').html('<?php echo Yii::t('app', 'Loading...');?>');
		var url		= $(this).attr('data-ajax-url'),
			label	= $(this).attr('data-modal-label') || $(this).text();
		$('#myModalLabel').text(label);
		$.ajax({
			url:url,
			success: function(response){
				$('#myModal .modal-body').html(response);
			}
		});
	});
}
open_popup_links();
</script>
</body>
</html>

