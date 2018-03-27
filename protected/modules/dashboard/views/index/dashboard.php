

<?php $this->breadcrumbs = array(
	Yii::t('app', 'Dashboard'),
);?>
<link href="<?php echo Yii::app()->request->baseUrl;?>/css/tabulous.css" rel="stylesheet" type="text/css" />
<link href="<?php echo Yii::app()->request->baseUrl;?>/css/portal/portal_dashboard.css" rel="stylesheet" type="text/css" />

<script src="<?php echo Yii::app()->request->baseUrl;?>/js/tab/tabulous.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl;?>/js/tab/dash_tab.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl;?>/js/scroll/perfect-scrollbar.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl;?>/js/scroll/jquery.mousewheel.js"></script>

<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl;?>/css/jquery-ui.css">
<script src="<?php echo Yii::app()->baseUrl;?>/js/jquery-ui-1.11.4.js"></script>
<script>
      jQuery(document).ready(function ($) {
        "use strict";
        $('.Default').perfectScrollbar();
      });
</script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/justgage.1.0.1.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/raphael.2.1.0.min.js"></script>

<?php 


?>



<div class="dashboard_bg" id="dashboard_block">
    <div class="clear"></div>
    <?php 
        $criteria               =   new CDbCriteria;
        $criteria->condition    =   't.is_visible=:is_visible';        
        $criteria->order        =   't.default_order ASC';
        $exist               =   DashboardSettings::model()->exists('user_id=:user_id',array(':user_id'=>Yii::app()->user->id));
        if($exist)
        {
            $criteria->join         =   "JOIN dashboard_settings `ds` ON `ds`.`block_id` = `t`.`id`";
            $criteria->condition    .=  ' AND ds.user_id=:user_id AND `ds`.`is_visible`=:visible';            
            $criteria->order        =   'ds.block_order ASC';
            $criteria->params       =   array(':is_visible'=>1, ':visible'=>1,':user_id'=>  Yii::app()->user->id);
        }
        else
            $criteria->params       =   array(':is_visible'=>1);
                
        $blocks     =   Dashboard::model()->findAll($criteria);
        if($blocks!=NULL)
        {
            foreach($blocks as $block)
            {               
                echo $this->renderPartial('dashboard_block',array('block'=>$block->block,'block_id'=>$block->id));                                       
            }
        } 
        
        ?>
        <div id="dashboard_err" style="display:none">
            <div class="yellow_bx" style="background-image:none;padding-bottom:45px;">
                    <div class="y_bx_head" style="width:650px;">
                    <?php 
                            echo Yii::t('app','All blocks in the dashboard are disabled. You can change it from Dashboard Settings');

                    ?>
                    </div>
                    <div class="y_bx_list" style="width:650px;">
                            <h1><?php 
                            if(Yii::app()->user->checkAccess('Admin') or ModuleAccess::model()->check('My Account')){
                            echo CHtml::link(Yii::t('app','Dashboard Settings'),array('/dashboard/settings')); } ?></h1>
                    </div>
            </div>
        </div><br />
        <?php
        
    ?>    
    <div class="clear"></div>
    <div id="jobDialog"></div>
</div>
<style>
.placeholder {
  background: #f3f3f3;
  visibility: visible;
  height: auto;
  float:left;
}  

</style> 
<script>
$(document).ready(function()
{
    if($('.block_class:visible').length === 0)        
        $('#dashboard_err').show('medium');
});
    
$('.dash_subhed_hide_two').click(function()
{
   //alert($(this).attr('id')); 
   var that         =   $(this);
   var $block_id    =   $(that).attr('id');
   $.ajax({
		type:'POST',
		url:'<?php echo Yii::app()->createUrl('/dashboard/settings/hideBlock');?>',
		data:{block_id : $block_id, "<?php echo Yii::app()->request->csrfTokenName;?>":"<?php echo Yii::app()->request->csrfToken;?>"},
		cache:false,
		dataType:"json",
		success: function(response)
                {
                    if(response.status=="success")
                    {                        
                        $(that).closest('.block_class').hide('slow');                        
                        if($('.block_class:visible').length-1 === 0)
                        {                            
                            $('#dashboard_err').show('medium');
                        }
                    }
                    else{
                        alert("<?php echo Yii::t("app", "Some problem found while update dashboard")?>");
                    }
		},
                error:function(){
                    alert("<?php echo Yii::t("app", "Some problem found while update dashboards")?>");
                }
	});
        
   
   
   
});  
    
    
$( function() {
    $( "#dashboard_block" ).sortable({
        forcePlaceholderSize: true,
        placeholder: 'placeholder',
        update:function(){			
			save_block_order();
		}
        
    });
    $( "#dashboard_block" ).disableSelection();       
  } );    
  
  
  function save_block_order(){
	var blocks	= [];
	$('#dashboard_block .block_class').each(function(index, element) 
        {
		var block	= {};
		block.order	= index + 1;
		block.id		= $( element ).attr('block-id');
                blocks.push(block);
        });
	
	$.ajax({
		type:"POST",
		url:"<?php echo Yii::app()->createUrl('/dashboard/index/saveOrder');?>",
		data:{user_id:<?php echo Yii::app()->user->id;?>, block_data:blocks,"<?php echo Yii::app()->request->csrfTokenName;?>":"<?php echo Yii::app()->request->csrfToken;?>"},
		success: function(){
                    
		},
                error:function(){
                alert("<?php echo Yii::t('app', 'There is some problem found while changing position');?>");
            }
	});
}
</script>