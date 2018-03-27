<style>
.ui-widget-content{
height:auto !important;
width: 300px !important;	
}
.ui-dialog .ui-dialog-content {
    padding: 22px;
	box-sizing:border-box;
}
.ui-dialog .ui-dialog-title {
    font-size: 14px;
}
.ui-widget input[type="text"], textArea, select{ box-sizing:border-box; width:100% !important;}
.ui-widget input[type="text"], textArea, select:focus{ outline:none !important;}
</style>

<p><?php echo Yii::t('app','Fields with');?><span class="required"> * </span><?php echo Yii::t('app','are required').'.';?></p>
<div class="formCon">
    <div class="formConInner">
        <div  style="background:none">
            <?php $form=$this->beginWidget('CActiveForm', array(
				'id'=>'timetable-entries-form',	
			)); ?>
            <?php if(isset($_REQUEST['id']) and $_REQUEST['id']){ ?>
            <input type="hidden" value="<?php echo $_REQUEST['id']; ?>" name="id" />
            <?php } 
			if($_REQUEST['employee_id']!=NULL)
				$eid	=	$_REQUEST['employee_id'];
			else
				$eid	=	$model->employee_id;
			?>    
            <?php
				echo $form->hiddenField($model,'weekday_id',array('value'=>$_REQUEST['weekday_id'])); 
				echo $form->hiddenField($model,'employee_id',array('value'=>$_REQUEST['employee_id'])); 
				echo $form->hiddenField($model,'timetable_id',array('value'=>$_REQUEST['timetable_id'])); 
				echo $form->hiddenField($model,'subject_id',array('value'=>$_REQUEST['subject_id'])); 
				echo $form->hiddenField($model,'date',array('value'=>$_REQUEST['date']));
            ?>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td>
                        <?php echo $form->labelEx($model,'reason'); ?>
                        <?php echo $form->textField($model,'reason'); ?>
                        <?php echo $form->error($model,'reason'); ?>
                    </td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                </tr>
                <?php
				$employee = Employees::model()->findByPk($eid);	
				if($employee->gender == 'M'){
					$gender=1;
				}
				if($employee->gender == 'F'){
					$gender=2;
				}
				$criteria=new CDbCriteria;
				$criteria->condition='(gender=:gender OR gender=0) AND is_deleted=:is_deleted';
				$criteria->params=array(':gender'=>$gender, ':is_deleted'=>0);
				$leave_types =LeaveTypes::model()->findAll($criteria);  ?>
                <?php 
                $leave_type = CHtml::listData($leave_types,'id','type');?>
                <tr>
                    <td>
                        <?php echo $form->labelEx($model,'leavetype_id');?>
                        <?php echo $form->dropDownList($model,'leavetype_id',$leave_type,array('empty' => Yii::t('app','Select Leave Type'))); ?>
                    </td>
                </tr>
            </table>
            <div style="padding:20px 0 0 0px; text-align:left">
				<?php echo CHtml::ajaxSubmitButton(
                    Yii::t('app','Save'),
                    CHtml::normalizeUrl(array('teacherSubjectAttendance/mark','render'=>false)),
                    array(
                        'dataType'=>'json',
						'beforeSend'=>'js: function(){
							$(".action_btn").attr("disabled", true);
							$(".errorMessage").remove();
						}',
                        'success'=>'js: function(data) {
                            if (data.status == "success"){
                                $("#jobDialog").dialog("close");
                                if(data.flag==1){				
                                    window.location.reload();
                                }
                            }
                            else{
                                $(".errorMessage").remove();
								$(".action_btn").attr("disabled", false);
                                var errors	= JSON.parse(data.errors);						
                                $.each(errors, function(index, value){
                                    var err	= $("<div class=\"errorMessage\" />").text(value[0]);
                                    err.insertAfter($("#" + index));
                                });
                            }
                        }'
                    ),
                    array(
                        'id'=>'closeJobDialog',
                        'name'=>Yii::t('app','Submit'),
						'class'=>'action_btn'
                    )
                ); ?>
            </div>
        	<?php $this->endWidget(); ?>
        </div>
    </div>
</div><!-- form -->