<?php

Yii::app()->clientScript->registerScript('ajax-link-handler-main', "
$('#main_tab_students').live('click', function(event){
        $.ajax({
                'type':'get',
                'url':$(this).attr('href'),
                'dataType': 'html',
                'success':function(data){
					    $('#user_panel_handler').hide();
						$('#batch_panel_handler').hide();
						$('#main_tab_teachers').removeClass('active');
						$('#main_tab_batches').removeClass('active');
						$('#main_tab_students').addClass('active');
                        $('#student_panel_handler').html(data).show();
						
						
                }
        });
        event.preventDefault();
});
");

Yii::app()->clientScript->registerScript('ajax-link-handler-main-teacher', "
$('#main_tab_teachers').live('click', function(event){
        $.ajax({
                'type':'get',
                'url':$(this).attr('href'),
                'dataType': 'html',
                'success':function(data){
					    $('#student_panel_handler').hide();
						$('#batch_panel_handler').hide();
						$('#main_tab_teachers').addClass('active');
						$('#main_tab_batches').removeClass('active');
						$('#main_tab_students').removeClass('active');
                        $('#user_panel_handler').html(data).show();
                }
        });
        event.preventDefault();
});
");

Yii::app()->clientScript->registerScript('ajax-link-handler-main-batch', "
$('#main_tab_batches').live('click', function(event){
        $.ajax({
                'type':'get',
                'url':$(this).attr('href'),
                'dataType': 'html',
                'success':function(data){
					    $('#student_panel_handler').hide();
						$('#user_panel_handler').hide();
						$('#main_tab_teachers').removeClass('active');
						$('#main_tab_batches').addClass('active');
						$('#main_tab_students').removeClass('active');
                        $('#batch_panel_handler').html(data).show();
                }
        });
        event.preventDefault();
});
");

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



Yii::app()->clientScript->registerScript('ajax-link-handler-sem', "
$('#semstudent_div a').live('click', function(event){
	$.ajax({
                'type':'get',
                'url':$(this).attr('href'),
                'dataType': 'json',
                'success':function(data){
					var name	=	data.student_name;
					var semester=	data.semester_data;
					
					var label 	=	name.split('@#$`')[0];
					var id 		= 	name.split('@#$`')[1];
					
                        $('#name_widget').val(label);
						$('#id_widget').val(id);
						$('#explorer_handler').html('');
						
						 $('#semester_id').html(semester);
						 $('#batch_id').find('option').not(':first').remove();
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
	$setdown	=	0;
	$exp_stu	=	Students::model()->findAll();
	$exp_emp	=	Employees::model()->findAll();
	$exp_cou	=	Courses::model()->findAll();
	if(count($exp_stu)){
		$setup_stu	=	true;
		$setups++;
		$setdown++;
	}
	if(count($exp_emp)){
		$setup_emp	=	true;
		$setups++;
		$setdown++;
	}
	if(count($exp_cou)){
		$setup_cou	=	true;
		$setups++;
		$setdown++;
	}
	
	$percent	=	ceil(($setups/$setdown)*100);
	$current_academic_yr = Configurations::model()->findByAttributes(array('id'=>35));
	  if(Yii::app()->user->year)
	  {
		  $year = Yii::app()->user->year;
	  }
	  else
	  {
		  $year = $current_academic_yr->config_value;
	  }
?>
<div class="body_overlay" style="display:block"> </div>
<div class="site_drrop">
	<div class="sd_left">
   	  <div class="sd_left_loader">
      	<p><?php echo Yii::t('app','Set Up :')?> <span><?php echo $percent.'%'?></span> <?php echo Yii::t('app','Setup Completed')?></p>
        <div class="loader_bg">
        	<div class="explor-bar" style="width:<?php echo $percent.'%'?>; "></div>
        </div>
      </div>
        <div class="sd_nav">
        <ul><?php
        	if(ModuleAccess::model()->check('Students')){ ?><li <?php if($setup_stu==true){?>class="completed"<?php }?>><?php echo CHtml::link(Yii::t('app','Students'), array('/students')); ?></li><?php } ?>
   <?php  	if(ModuleAccess::model()->check('Employees')){ ?><li <?php if($setup_emp==true){?>class="completed"<?php }?>><?php echo CHtml::link(Yii::t('app','Teachers'), array('/employees')); ?></li><?php } ?>
   <?php  	if(ModuleAccess::model()->check('Courses')){ ?><li <?php if($setup_cou==true){?>class="completed"<?php }?>><?php echo CHtml::link(Yii::t('app','Courses'), array('/courses')); ?></li><?php } ?>
        </ul>
        </div>
    </div>
    <div class="sd_right">
    <div class="sd_but_con">
        	<ul>
            	<li style="padding:0px 0 0 10px;"><a href="#" class="cancel_but"></a></li>
            	<!--<li><input name="" type="button" class="sdbtm_but" value="Select" /></li>-->
            </ul>
        </div>
    	<!-- Coda Sliders-->
        
        <div class="explorer-tab-con">
        <div id="main_tab" class="explorer-tab">
        
        <?php 
		if((!isset($_REQUEST['widget'])) or (isset($_REQUEST['widget']) and $_REQUEST['widget']!=NULL and ($_REQUEST['widget']=='1'  or $_REQUEST['widget']=='sem_ex' or $_REQUEST['widget']=='s_a' or $_REQUEST['widget']=='sub_att'))) 
		{
			if(isset($_REQUEST['widget']) and $_REQUEST['widget']!=NULL and $_REQUEST['widget']=='s_a')
			{
			
			$criteria = new CDbCriteria;
			$criteria->compare('is_deleted',0);
			$criteria->condition = 'is_active=:is_active and is_deleted = :is_deleted';
			$criteria->params = array(':is_active'=>1,'is_deleted'=>0);
			//accademic status check
			$batch_stu = BatchStudents::model()->findAllByAttributes(array('result_status'=>0,'status'=>1,'academic_yr_id'=>$year));
				$students	=array();
				foreach($batch_stu as $stu)
				{
					$students[]	=	$stu->student_id;
				}
				$criteria->addInCondition('id',$students);
			//end
			$total = Students::model()->count($criteria);
		
		echo CHtml::link(Yii::t('app','Students').'<span class="ex-small">'.$total.' '.Yii::t('app','Records').'</span><span class="act-btm"></span>',array('/site/manage','val' =>(isset(Yii::app()->language) and isset(Yii::app()->params['alphabets'][Yii::app()->language]))?Yii::app()->params['alphabets'][Yii::app()->language][0]:'A','widget'=>'s_a'),array('id'=>'main_tab_students','class'=>'active'));
			}
			else
			{
				$criteria = new CDbCriteria;
				$criteria->compare('is_deleted',0);
				$criteria->condition = 'is_active=:is_active and is_deleted = :is_deleted';
				$criteria->params = array(':is_active'=>1,'is_deleted'=>0);
				$total = Students::model()->count($criteria);
				
				echo CHtml::link(Yii::t('app','Students').'<span class="ex-small">'.$total.' '.Yii::t('app','Records').'</span><span class="act-btm"></span>',array('/site/manage','val' =>(isset(Yii::app()->language) and isset(Yii::app()->params['alphabets'][Yii::app()->language]))?Yii::app()->params['alphabets'][Yii::app()->language][0]:'A'),array('id'=>'main_tab_students','class'=>'active'));
			}
		
		}
		?>
        
         <?php 
		 if(!isset($_REQUEST['widget']))
	     {
		 echo CHtml::link(Yii::t('app','Teachers').'<span class="ex-small">'.count(Employees::model()->findAll("is_deleted 	=:x", array(':x'=>0))).' '.Yii::t('app','Records').'</span><span class="act-btm"></span>',array('/site/emanage','val' =>(isset(Yii::app()->language) and isset(Yii::app()->params['alphabets'][Yii::app()->language]))?Yii::app()->params['alphabets'][Yii::app()->language][0]:'A'),array('id'=>'main_tab_teachers'));
		 
		 }
		 ?>
         
         <?php 
		 if((!isset($_REQUEST['widget'])) or (isset($_REQUEST['widget']) and $_REQUEST['widget']!=NULL and $_REQUEST['widget']!=1))
		 {
			 $batchclass = '';
			 if(isset($_REQUEST['widget']) and $_REQUEST['widget']!=NULL and $_REQUEST['widget']==2)
			 {
				 $batchclass = 'active';
			 }
			 
		 
		  $num=Batches::model()->findAll("is_deleted =:x AND is_active =:z AND academic_yr_id =:y", array(':x'=>0,':y'=>$year,':z'=>1));
                  $batch_label= Yii::app()->getModule('students')->fieldLabel("Students", "batch_id");
             if(isset($_REQUEST['widget']) and $_REQUEST['widget']!=NULL and $_REQUEST['widget']=='s_a')
			 {
		 echo CHtml::link(Yii::t('app',$batch_label).'<span class="ex-small">'.count($num).' '.Yii::t('app','Records').'</span><span class="act-btm"></span>',array('/site/bmanage','widget'=>$_REQUEST['widget'],'rurl'=>$_REQUEST['rurl']),array('id'=>'main_tab_batches','class'=>$batchclass));
			 }
			 else
			 {
				 echo CHtml::link(Yii::t('app',$batch_label).'<span class="ex-small">'.count($num).' '.Yii::t('app','Records').'</span><span class="act-btm"></span>',array('/site/bmanage'),array('id'=>'main_tab_batches','class'=>$batchclass));
			 }
		 
		 }
		 ?>
		 <div class="clear"></div>
        </div>
	<div class="explorer-tab-innercon" id="">
    
        
        <?php if((!isset($_REQUEST['widget'])) or (isset($_REQUEST['widget']) and $_REQUEST['widget']!=NULL and ($_REQUEST['widget']=='1' or $_REQUEST['widget']=='sem_ex' or $_REQUEST['widget']=='s_a' or $_REQUEST['widget']=='sub_att'))) 
		{	
		?>
    <div class="" id="student_panel_handler" >
    <?php 
	    $model=new Students;
		$criteria = new CDbCriteria;
		$criteria->order = 'first_name ASC';
		$_REQUEST['val'] = (isset(Yii::app()->language) and isset(Yii::app()->params['alphabets'][Yii::app()->language]))?Yii::app()->params['alphabets'][Yii::app()->language][0]:'A';
		$criteria->condition='first_name LIKE :match AND is_deleted=:is_del AND is_active=:is_active';
		$criteria->params = array(':match' => $_REQUEST['val'].'%',':is_del'=>0,':is_active'=>1);
		//accademic status check
		$batch_stu = BatchStudents::model()->findAllByAttributes(array('result_status'=>0,'status'=>1,'academic_yr_id'=>$year));
			$students	=array();
			foreach($batch_stu as $stu)
			{
				$students[]	=	$stu->student_id;
			}
			$criteria->addInCondition('id',$students);
		
		//end
		$total = Students::model()->count($criteria);
		$posts = Students::model()->findAll($criteria);
		
		?>
		<?php  $this->renderPartial('student_panel',array('model'=>$model,'list'=>$posts,
			
			'item_count'=>$total,'name'=>'','ad'=>'','bat'=>'',
			
			)
		);
	 ?>
        
    </div>
			<?php	} ?>
    
    
    
		<div class="" id="user_panel_handler">

		</div>
        
		<div class=""  id="batch_panel_handler">
        <?php if(isset($_REQUEST['widget']) and $_REQUEST['widget']!=NULL and $_REQUEST['widget']==2)
		{ 
		?>
		
        
        <?php  $this->renderPartial('batch_panel',array()) ; ?>
			
		
  <?php 		
		}?></div>
        
	</div><!-- .coda-slider -->
    <div class="clear"></div>
</div>
    	
        
    </div>
</div>

<script>
$(document).ready(function() {

		
  $(".site_drrop").animate({
    top: "50px",
    left: "105px",
  }, 200 );

$(".cancel_but").click(function(){
	$(".body_overlay").hide();
  $(".site_drrop").animate({
    top: "-580px",
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




     

