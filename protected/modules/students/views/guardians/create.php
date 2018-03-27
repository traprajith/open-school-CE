<style type="text/css">
.guard_search{
	position:relative;
	width:auto;
	padding-left:5px;
	padding-right:27px;
}	
.radio_bx{
	margin:0px;
	padding:0px;
}	
	
input[type="radio"]:checked + label span{
	background:url(<?php echo Yii::app()->request->baseUrl; ?>/images/radio_btn_css3.png) 0px top no-repeat;
}
div#show{
	padding:10px;
}
.formConInner{
	padding: 15px;
	position: relative;
}
.formCon{
	margin-bottom:20px;
}
.pdtab_Con table td {
	padding: 8px 2px !important;
}
</style>

<script type="text/javascript">	
function getmode(){
	var guardian_mode = $('input[name=guardian]:checked').val();	
	if(guardian_mode == 1){
		$( "#search" ).show("slow");		
	}
	else{	
		var ward_id = <?php echo $_REQUEST['id']; ?>;		
		$("#search").hide("slow",function(){
			if (window.location.search.indexOf('status=1') > -1) {
				window.location	= "index.php?r=students/guardians/create&id="+ward_id+"&status="+1;
			}
			else{
				window.location	= "index.php?r=students/guardians/create&id="+ward_id;
			}
		});		
	}	
}
</script>

<?php
$this->breadcrumbs=array(
	Yii::t('app','Students')=>array('/students'),
	Yii::t('app','Enrolment'),
	Yii::t('app','Guardian Details'),
);
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
    	<td width="247" valign="top"><?php $this->renderPartial('/default/left_side');?></td>
    	<td valign="top">
    		<div class="cont_right formWrapper">        		
<?php        		 
				$this->renderPartial('application.modules.students.views.students.reg_tab'); 
				//Display flash error message
				Yii::app()->clientScript->registerScript(
				   'myHideEffect',
				   '$(".flash").animate({opacity: 1.0}, 3000).fadeOut("slow");',
				   CClientScript::POS_READY
				);	
				if(Yii::app()->user->hasFlash('errorMessage')): ?>
				<div class="flash" style="margin:10px; text-align:center; color:#689569; font-size:18px;">
					<?php echo Yii::app()->user->getFlash('errorMessage'); ?>
				</div>
<?php			 endif; 			
			
				//Students's guardian lists
				$criteria 				= new CDbCriteria;		
				$criteria->join 		= 'JOIN guardian_list t1 ON t.id = t1.guardian_id'; 
				$criteria->condition 	= 't1.student_id=:student_id AND t.is_delete=:is_delete';
				$criteria->params 		= array(':student_id'=>$_REQUEST['id'],'is_delete'=>0);
				$guardians 	= Guardians::model()->findAll($criteria);   
                if($guardians){
					$this->renderPartial('guardian_list',array('guardians'=>$guardians));
				}
				 
?>
        		<!-- Radio Box -->
                <div class="formCon_existng_g">                    
                    <div class="formConInner" style="padding:0px; width:auto;">
                        <div  class="guardin-exixt g-input-bg">
<?php 							
                            if($radio_flag == 1){
								$radio1 = true;
								$radio2 = false;
								$style 	= 'display:block;';                            
                            }
                            else{
								$radio1 = false;
								$radio2 = true;
								$style 	= 'display:none;';
                            }                            
                            // Already Existing Guardian Radio Button
                            echo CHtml::radioButton('guardian', $radio1, array(
								'checked' =>true,
								'id'=>'guardian1',
								'value' => '1',
								'labelOptions'=>array('style'=>'display:inline;padding-right:20px;'), 
								'onchange'=>'getmode();',
                            )); ?><label for="guardian1"><span></span><?php echo Yii::t('app','Already Existing Guardian'); ?></label>
                                                        
                        </div>                        
                    </div>           
                </div>   
        		<!-- Search Guardian -->
<?php			 
				$form=$this->beginWidget('CActiveForm', array(
					'id'=>'guardians-search-form',
					'enableAjaxValidation'=>false,
				)); 
?>	
          
                    <div class="formCon" id="search" style=" <?php echo $style; ?>; margin-bottom:0px; margin-top:0px;">
                        <div class="formConInner">
							<?php echo Yii::t('app','Search'); ?>
                            <span class="guard_search">
<?php                             
								$this->widget('zii.widgets.jui.CJuiAutoComplete',array(
									'name'=>'student_name',
									'id'=>'name_widget',
									'source'=>$this->createUrl('/site/autocomplete'),
									'htmlOptions'=>array('placeholder'=>Yii::t('app','Sibilings')),
									'options'=>
									array(
										'showAnim'=>'fold',
										'select'=>"js:function(student, ui) {
											$('#id_widget').val(ui.item.id);										
										}"
									),                            
                            	));
?>                           
                            	<?php echo CHtml::hiddenField('student_id','',array('id'=>'id_widget')); ?> 
                            	<span class="or_img"></span>                   
                            </span>
                            
                            
                            <span class="guard_search">
								<?php  
									$this->widget('zii.widgets.jui.CJuiAutoComplete',array(
										'name'=>'parent_name',
										'id'=>'parent_name_widget',
										'source'=>$this->createUrl('/site/parentautocomplete'),
										'htmlOptions'=>array('placeholder'=>Yii::t('app','Parent')),
										'options'=>
										array(
											'showAnim'=>'fold',
											'select'=>"js:function(parent, ui) {
												$('#guardian_id').val(ui.item.id);											
											}"
										),
									
									));
                            	?>
								<?php echo CHtml::hiddenField('guardian_id','',array('id'=>'guardian_id')); ?> 
                                <span class="or_img"></span>                       
                            </span>
                            
                            <span class="guard_search" style="padding-right:10px;">
								<?php  
									$this->widget('zii.widgets.jui.CJuiAutoComplete',array(
										'name'=>'parent_email',
										'id'=>'parent_email_widget',
										'source'=>$this->createUrl('/site/parentemailcomplete'),
										'htmlOptions'=>array('placeholder'=>Yii::t('app','Parent Email')),
										'options'=>
										array(
										'showAnim'=>'fold',
										'select'=>"js:function(parentemail, ui) {
											$('#guardian_mail').val(ui.item.id);										
										}"
										),									
									));
                                ?>
                                <?php echo CHtml::hiddenField('guardian_mail','',array('id'=>'guardian_mail')); ?>                    
                            </span>
                            <div class="clear"></div>
                            <div style="margin-top:10px; margin-left:49px;">
								<?php
									if(isset($_REQUEST['status']) and $_REQUEST['status'] == 1){
										echo CHtml::button(Yii::t('app','Search'), array('submit' => array('guardians/create','id'=>$_REQUEST['id'],'status'=>1),'class'=>'formbut-n')); 
									}
									else{
										echo CHtml::button(Yii::t('app','Search'), array('submit' => array('guardians/create','id'=>$_REQUEST['id']),'class'=>'formbut-n')); 
									}
								?>
                                </div>
                        </div>
                    </div>
				<?php $this->endWidget(); ?>
                   
                <div class="formCon_existng_g">
                    <div class="formConInner">
                        <div class="tableinnerlist g-input-bg">                                                           
                            <?php
                            // New Guardian Radio Button
                            echo CHtml::radioButton('guardian',$radio2, array(
                                'value' => '0', 'uncheckValue' => null,
                                'id'=>'guardian2',
                                'labelOptions'=>array('style'=>'display:inline;padding-right:20px;'), 
                                'onchange'=>'getmode();',
                            ));?><label for="guardian2"><span></span><?php echo Yii::t('app','New Guardian'); ?></label>
                        </div>
                    </div>
                </div>
        <!-- END Radio Box -->
<?php                 						
				if($existing_guardians){			
					echo $this->renderPartial('_form', array('existing_guardians'=>$existing_guardians,'check_flag'=>$check_flag));  
				}
				else{
					echo $this->renderPartial('_form', array('model'=>$model,'check_flag'=>$check_flag)); 
				}
?>
			</div>
		</td>
	</tr>
</table>