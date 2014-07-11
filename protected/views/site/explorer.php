 <!-- Begin Coda Stylesheets -->
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.coda-slider-2.0.js"></script>
          
 <script type="text/javascript">
			$().ready(function() {
				$('#coda-slider-1').codaSlider({
				dynamicArrows: false,
				slideEaseDuration: 0,
				autoHeightEaseDuration: 300,
				});
			});
 </script>
   
    <?php


Yii::app()->clientScript->registerScript('ajax-link-handler', "
$('#filter_action a').live('click', function(event){
        $.ajax({
                'type':'get',
                'url':$(this).attr('href'),
                'dataType': 'html',
                'success':function(data){
                        $('#student_panel_handler').html(data);
                }
        });
        event.preventDefault();
});
");

Yii::app()->clientScript->registerScript('ajax-link-handler-user', "
$('#userfilter_action a').live('click', function(event){
        $.ajax({
                'type':'get',
                'url':$(this).attr('href'),
                'dataType': 'html',
                'success':function(data){
                        $('#user_panel_handler').html(data);
                }
        });
        event.preventDefault();
});
");

Yii::app()->clientScript->registerScript('ajax-link-handler2', "
$('#loaddrop_link a').live('click', function(event){
	   $.ajax({
                'type':'get',
                'url':$(this).attr('href'),
                'dataType': 'html',
                'success':function(data){
                        $('#student_panel_handler').html(data);
						
                }
        });
        event.preventDefault();
});
");

Yii::app()->clientScript->registerScript('ajax-link-handler2-user', "
$('#userloaddrop_link a').live('click', function(event){
	   $.ajax({
                'type':'get',
                'url':$(this).attr('href'),
                'dataType': 'html',
                'success':function(data){
                        $('#user_panel_handler').html(data);
						
                }
        });
        event.preventDefault();
});
");





Yii::app()->clientScript->registerScript('ajax-link-handler1', "
$('#student_div a').live('click', function(event){
	$.ajax({
                'type':'get',
                'url':$(this).attr('href'),
                'dataType': 'html',
                'success':function(data){
					var label = data.split('@#$`')[0];
					var id = data.split('@#$`')[1];
					
                        $('#name_widget').val(label);
						$('#id_widget').val(id);
						$('#explorer_handler').html('');
						
						
						
                }
        });
        event.preventDefault();
});
");

Yii::app()->clientScript->registerScript('ajax-link-handler1-user', "
$('#user_div a').live('click', function(event){
	$.ajax({
                'type':'get',
                'url':$(this).attr('href'),
                'dataType': 'html',
                'success':function(data){
					var label = data.split('@#$`')[0];
					var id = data.split('@#$`')[1];
					
                        $('#name_widget').val(label);
						$('#id_widget').val(id);
						$('#explorer_handler').html('');
						
						
						
                }
        });
        event.preventDefault();
});
");

?>
<?php
	$setup_stu	=	false;
	$setup_emp	=	false;
	$setup_cou	=	false;
	$setup_fee	=	false;
	$setup_tim	=	false;
	$setup_lib	=	false;
	$setup_hos	=	false;
	$setup_tra	=	false;
	$setups		=	0;
	$exp_stu	=	Students::model()->findAll();
	$exp_emp	=	Employees::model()->findAll();
	$exp_cou	=	Courses::model()->findAll();
	$exp_fee	=	FinanceFeeCategories::model()->findAll();
	$exp_tim	=	TimetableEntries::model()->findAll();
	Yii::app()->getModule('library');
	$exp_lib	=	Book::model()->findAll();
	Yii::app()->getModule('hostel');
	$exp_hos	=	Hosteldetails::model()->findAll();
	Yii::app()->getModule('transport');
	$exp_tra	=	RouteDetails::model()->findAll();
	if(count($exp_stu)){
		$setup_stu	=	true;
		$setups++;
	}
	if(count($exp_emp)){
		$setup_emp	=	true;
		$setups++;
	}
	if(count($exp_cou)){
		$setup_cou	=	true;
		$setups++;
	}
	if(count($exp_fee)){
		$setup_fee	=	false;
		
	}
	if(count($exp_tim)){
		$setup_tim	=	false;
		
	}
	if(count($exp_lib)){
		$setup_lib	=	false;
		
	}
	if(count($exp_hos)){
		$setup_hos	=	false;
		
	}
	if(count($exp_tra)){
		$setup_tra	=	false;
		
	}
	$percent	=	ceil(($setups/8)*100);
?>

<div class="site_drrop">
	<div class="sd_left">
   	  <div class="sd_left_loader">
      	<p>Set Up : <span><?php echo $percent.'%'?></span> Setup Completed</p>
        <div class="loader_bg">
        	<div style="width:<?php echo $percent.'%'?>; height:7px; background:url(images/load-bg-grn.png) repeat-x; border:1px #5fab08 solid;"></div>
        </div>
      </div>
        <div class="sd_nav">
        <ul>
        	<li <?php if($setup_stu==true){?>class="completed"<?php }?>><?php echo CHtml::link(Yii::t('app','Students'), array('/students')); ?></li>
          	<li <?php if($setup_emp==true){?>class="completed"<?php }?>><?php echo CHtml::link(Yii::t('app','Employees'), array('/employees')); ?></li>
          	<li <?php if($setup_cou==true){?>class="completed"<?php }?>><?php echo CHtml::link(Yii::t('app','Courses'), array('/courses')); ?></li>
          	<li class="pro"><?php echo CHtml::link(Yii::t('app','Fees'), array('/fees')); ?></li>
          	<li class="pro"><?php echo CHtml::link(Yii::t('app','Timetable'), array('/timetable')); ?></li>
          	<li class="pro"><?php echo CHtml::link(Yii::t('app','Library'), array('/library')); ?></li>
          	<li class="pro"><?php echo CHtml::link(Yii::t('app','Hostel'), array('/hostel')); ?></li>
          	<li class="pro"><?php echo CHtml::link(Yii::t('app','Transport'), array('/transport')); ?></li>
            <li class="pro"><?php echo CHtml::link(Yii::t('app','Reports'), array('/report')); ?></li>
            <li class="pro"><?php echo CHtml::link(Yii::t('app','Downloads'), array('/downloads')); ?></li>
        </ul>
        </div>
        <div class="sd_left_comm_logo"></div>
    </div>
    <div class="sd_right">
    	<!-- Coda Sliders-->
        <div class="coda-slider-wrapper">
	<div class="coda-slider preload" id="coda-slider-1">
    <?php 
	    $model=new Students;
		$criteria = new CDbCriteria;
		$criteria->order = 'first_name ASC';
		$_REQUEST['val'] = 'A';
		$criteria->condition='first_name LIKE :match AND is_deleted=:is_del';
		$criteria->params = array(':match' => $_REQUEST['val'].'%',':is_del'=>0);
		
		$total = Students::model()->count($criteria);
		//$pages = new CPagination($total);
        //$pages->setPageSize(Yii::app()->params['listPerPage']);
        //$pages->applyLimit($criteria);  // the trick is here!
		$posts = Students::model()->findAll($criteria);
		
		?>
        
        <?php if((!isset($_REQUEST['widget'])) or (isset($_REQUEST['widget']) and $_REQUEST['widget']!=NULL and ($_REQUEST['widget']=='1' or $_REQUEST['widget']=='s_a'))) 
		{?>
    <div class="panel" id="student_panel_handler" >
   <?php // $this->renderPartial('_partial',array('model'=>$model,'list'=>$posts,'item_count'=>$total,'name'=>'','ad'=>'','bat'=>''),false,true); ?>
		<?php  $this->renderPartial('student_panel',array('model'=>$model,
		'list'=>$posts,
		//'pages' => $pages,
		'item_count'=>$total,'name'=>'','ad'=>'','bat'=>''
		//'page_size'=>Yii::app()->params['listPerPage']
		)
		) ; ?>
        
    </div>
    <?php } ?>
    
    <?php if(!isset($_REQUEST['widget']))
	{ ?>
    
		<div class="panel" id="user_panel_handler">
			<?php 
			
			$model=new Employees;
		$criteria = new CDbCriteria;
		$criteria->order = 'first_name ASC';
		
		$_REQUEST['val'] = 'A';
		$criteria->condition='first_name LIKE :match AND is_deleted=:is_del';
		$criteria->params = array(':match' => $_REQUEST['val'] .'%',':is_del'=>0);
		
		$total = Employees::model()->count($criteria);
		//echo $criteria->condition;
		//print_r($criteria->params); 
		//$pages = new CPagination($total);
        //$pages->setPageSize(Yii::app()->params['listPerPage']);
        //$pages->applyLimit($criteria);  // the trick is here!
		$posts = Employees::model()->findAll($criteria);
		
		 
		$this->renderPartial('user_panel',array('model'=>$model,

		'list'=>$posts,
		//'pages' => $pages,
		'item_count'=>$total,'name'=>'','ad'=>'','bat'=>''
		//'page_size'=>Yii::app()->params['listPerPage'],
		)
		) ;
			
			?>
		</div>
        <?php } ?>
		
        <?php if((!isset($_REQUEST['widget'])) or (isset($_REQUEST['widget']) and $_REQUEST['widget']!=NULL and $_REQUEST['widget']!=1))
		{ ?>
		<div class="panel">
        
        <?php  $this->renderPartial('batch_panel',array()) ; ?>
			
		</div>
        <?php } ?>
        
	</div><!-- .coda-slider -->
    <div class="clear"></div>
</div>
    	
        <div class="sd_but_con">
        	<ul>
            	<li style="padding:0px 0 0 10px;"><a href="#" class="cancel_but">Cancel</a></li>
            	<!--<li><input name="" type="button" class="sdbtm_but" value="Select" /></li>-->
            </ul>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
	
  $(".site_drrop").animate({
    top: "0px",
    left: "105px",
  }, 200 );

$(".cancel_but").click(function(){
  $(".site_drrop").animate({
    top: "-500px",
    left: "105px",
  }, 200 );
});

});
</script>

<!--small drop-->
 <script>
$(document).ready(function() {
$(".sd_action_but").click(function(){
	
            	if ($(".sd_actions").is(':hidden')){
                	$(".sd_actions").show();
					$(".sd_action_but").addClass("sd_action_but_active");

				}
            	else{
                	$(".sd_actions").hide();
					$(".sd_action_but").removeClass("sd_action_but_active");
            	}
            return false;
       			 });
				  $('.sd_actions').click(function(e) {
            		e.stopPropagation();
					
        			});
        		$(document).click(function() {
					if (!$(".sd_actions").is(':hidden')){
            		$('.sd_actions').hide();
					$(".sd_action_but").removeClass("sd_action_but_active");
					}
        			});	
                
});
</script>
<script>
$(document).ready(function() {
	$("#exptxtsrh").keyup(function(){
		var text = $("#exptxtsrh").val();
		if ($("#exptxtsrh").val()==''){$("#expli").hide("slide", { direction: "left" }, 100);return;}
		if ($("#expli").is(':hidden')){
                	//$("#expli").show();
					$('#espname').html(text);
					$("#expli").show("slide", { direction: "left" }, 100);

					$('#espname').html(text);
				}
            	else{
                	$('#espname').html(text);
            	}
		
		 });
});
</script> 




     

