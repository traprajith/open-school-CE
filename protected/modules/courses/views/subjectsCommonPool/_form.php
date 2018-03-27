
<div class="form">

<?php

$form=$this->beginWidget('CActiveForm', array(
	'id'=>'subjects-common-pool-form',
	//'enableAjaxValidation'=>false,
)); ?>

	<p class="note"><?php echo Yii::t('app','Fields with');?><span class="required">*</span><?php echo Yii::t('app',' are required.');?></p>

	<?php echo $form->errorSummary($model); ?>
<div style="width:90%" >
    <div>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
             <?php 
			 	if(isset($_GET['val1']) and $_GET['val1'] !='null'){
					$model->course_id = $_GET['val1'];
				}
					
							if(Yii::app()->user->year)
							{
								$year = Yii::app()->user->year;
							}
							else
							{
								$current_academic_yr = Configurations::model()->findByAttributes(array('id'=>35));
								$year = $current_academic_yr->config_value;
							}
							
							$criteria = new CDbCriteria;							
							$criteria->condition = 'is_deleted = :is_deleted and academic_yr_id = :academic_yr_id';
							$criteria->params = array(':is_deleted'=>0,':academic_yr_id'=>$year);
                            echo $form->dropDownList($model,'course_id',CHtml::listData(Courses::model()->findAll($criteria), 'id', 'course_name'),array(
                            'class'=>'form-control','encode'=>false,'empty'=>Yii::t('app','Select Course'))); 
			
			 	?>
             <?php if(isset($_REQUEST['sub_id']) and Yii::app()->controller->action->id=='addupdate'){
            			 echo $form->hiddenField($model,'id',array('size'=>40,'maxlength'=>255,'value'=>$_REQUEST['sub_id'],''));
			 		}	?>
            </tr>
                <tr>
                <td>&nbsp;</td>
             </tr>
           
            <tr>
                <td width="90%"><?php echo $form->labelEx($model,'subject_name'); ?></td>
            </tr>
            <tr>
           
                <td width="90%"><div><?php  
				echo $form->textField($model,'subject_name',array('encode'=>false,'size'=>20,'maxlength'=>255,'style'=>'width:100%')); ?>
                <?php echo $form->error($model,'subject_name'); ?>
               <?php /*?> <input type="text" name="myTextInput" value="<?= html_entity_decode($model->subject_name, ENT_QUOTES); ?>" /><?php */?>
                </div></td>
             
            </tr>
             <tr>
                <td>&nbsp;</td>
             </tr>
            <?php /*?> <tr>
                <td width="90%"><?php echo $form->labelEx($model,'subject_code'); ?></td>
              </tr>
            <tr>
                <td width="90%"><div><?php echo $form->textField($model,'subject_code',array('size'=>20,'maxlength'=>255,'style'=>'width:100%')); ?>
                <?php echo $form->error($model,'subject_code'); ?></div></td>
            </tr>
             <tr>
                <td>&nbsp;</td>
             </tr><?php */?>
             <tr>
                <td width="90%"><?php echo $form->labelEx($model,'max_weekly_classes'); ?></td>
             </tr>
            <tr>
                <td width="90%"><div>
				<?php 
					if($model->max_weekly_classes == NULL){
						$model->max_weekly_classes = '';
					}
					echo $form->textField($model,'max_weekly_classes',array('size'=>20,'maxlength'=>255,'style'=>'width:100%')); 
				?>
                <?php echo $form->error($model,'max_weekly_classes'); ?></div></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>             
                  <tr>
                    <td> <?php echo $form->checkBox($model,'split_subject'); ?>
                    <?php echo Yii::t('app','Split Subject'); ?></td>                    
                  </tr>
                  <tr>
           		 <td>&nbsp;</td>
           		</tr> 
                <?php  
				if(!$model->isNewRecord){
					$common_cps	=	SubjectCommonpoolSplit::model()->findAllByAttributes(array('subject_id'=>$model->id));
					$k=1;
					foreach($common_cps as $common_cp){
						$att			=	'subject_tilte'.$k;
						$model->$att	=$common_cp->split_name; 
						$k++;
					}
				} 
				for($i=1;$i<=2;$i++){
					?>
                    <tr class="split" style="display:none">
                        <td width="90%"><?php echo $form->labelEx($model,'subject_tilte'.$i); ?>&nbsp;<span class="required">*</span></td>
                    </tr> 
                    <tr class="split" style="display:none"> 
                      <td> <?php echo $form->textField($model,'subject_tilte'.$i,array('encode'=>false,'size'=>20,'maxlength'=>255,'style'=>'width:100%'));
					  echo $form->error($model,'subject_tilte'.$i); ?>
                      
                      </td>                   
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                    </tr> 
                    <?php
				}?>
                    
                     <?php
			  if($model->isNewRecord){ ?>
                  <tr>
                    <td> <?php echo $form->checkBox($model,'all_batches',array('checked'=>"true")); ?>
                    <?php echo Yii::t('app','All').' '.Yii::app()->getModule('students')->fieldLabel("Students", "batch_id"); ?></td>                    
                  </tr>
              <?php } ?> 
                <tr>
               		 <td>&nbsp;</td>
           		</tr> 
        </table>
  

	<div class="row buttons">
    
    
     <?php	echo CHtml::ajaxSubmitButton(Yii::t('app','Save'),CHtml::normalizeUrl(array('subjectsCommonPool/create','render'=>false)),array('dataType'=>'json','success'=>'js: function(data) {
					if (data.status == "success")
					{
					 $("#jobDialogs").dialog("close");
					 if(data.flag==1)
					 {
						 //window.location.href = "'.Yii::app()->request->baseUrl.'/index.php?r=courses/courses/managecourse"; 
						 window.location.reload();
					 }
					}
					else{
						$(".errorMessage").remove();
						var errors	= JSON.parse(data.errors);						
						$.each(errors, function(index, value){
							var err	= $("<div class=\"errorMessage\" />").text(value[0]);
							err.insertAfter($("#" + index));
						});
					}
                    }'),array('id'=>'closeJobDialog','name'=>Yii::t('app','Submit'))); ?>
		<?php //echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php 

$this->endWidget();
if(isset($model->split_subject) and $model->split_subject==1){
	$split_value	=	1;
}else{
	$split_value	=	0;
}
 ?>
</div><!-- form -->

<script>
var split_subject	=	<?php echo $split_value;?>;
if(split_subject == 1){
	$(".split").show();
}
$("#SubjectsCommonPool_split_subject").click(function(){
	if($(this).is(":checked")){
		$(".split").show();
	}else{
		$("#SubjectsCommonPool_subject_tilte1").val('');
		$("#SubjectsCommonPool_subject_tilte2").val('');
		$(".split").hide();
	}
});   
</script>