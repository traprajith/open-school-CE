<script>
function updatemode() // Function to update mode dependent dropdown after selecting batch
{
	
	var course_id = document.getElementById('cid').value;
	var batch_id = document.getElementById('batchid').value;
	var new_batch = <?php echo $_REQUEST['bid'];?>;
	window.location= 'index.php?r=courses/courses/duplicatebatch&cid='+course_id+'&bid='+batch_id+'&new_bid='+ new_batch;	
}
</script>
<?php
$this->breadcrumbs=array(
Yii::t('app','Courses')=>array('/courses'),
Yii::t('app','Manage Duplicate'.' '.Yii::app()->getModule('students')->fieldLabel("Students", "batch_id")),
);
?>
<?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'config-sms-form',
        'enableAjaxValidation'=>false,
        'action'=>CHtml::normalizeUrl(array('/courses/courses/duplicatebatch&cid='.$_REQUEST['cid'].'&bid='.$_REQUEST['bid'].'&new_bid='.$_REQUEST['new_bid'])),
    ));?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td width="247" valign="top">
        	<?php $this->renderPartial('left_side');?>        
        </td>
        <td valign="top">
            <div class="cont_right formWrapper">
                <h1><?php echo Yii::t('app','Manage Duplicate'.' '.Yii::app()->getModule('students')->fieldLabel("Students", "batch_id"));?></h1>
            
        	 <table width="80%" border="0" cellspacing="0" cellpadding="0">
              <tr>
              	<td>&nbsp;</td>
                <td style="width:200px;"><strong><?php echo Yii::t('app','Select Course');?></strong></td>
                <td>&nbsp;</td>  
                <?php
                $model=new Courses;
                $criteria = new CDbCriteria;
                $criteria->compare('is_deleted',0); ?>
                <td>
                    <?php
                    $current_academic_yr = Configurations::model()->findByPk(35);
                    $data = Courses::model()->findAllByAttributes(array('is_deleted'=>0,'academic_yr_id'=>$current_academic_yr->config_value),array('order'=>'id DESC'));  
                    echo CHtml::dropDownList('cid','',CHtml::listData($data,'id','course_name'),array('prompt'=>Yii::t('app','Select Course'),'style'=>'width:190px;',
                    'ajax' => array(
                    'type'=>'POST',
                    'url'=>CController::createUrl('/courses/courses/batchname', array('bid'=>$_REQUEST['bid'])),
                    'update'=>'#batchid',
                    'data'=>'js:$(this).serialize()'
                    ),'options'=>array($_REQUEST['cid']=>array('selected'=>true))));
                    ?>
                </td>
                <td colspan="4">&nbsp;</td>
                <td>&nbsp;</td>
                <td style="width:200px;"><strong><?php echo Yii::t('app','Select').' '.Yii::app()->getModule('students')->fieldLabel("Students", "batch_id");?></strong></td>
                <td>&nbsp;</td>
                <td>
                    <?php  
                   // echo CHtml::dropDownList('batch_id','',array(),array('prompt'=>'Select Batch','id'=>'batchid','submit'=>array('/report/default/studentattendance')));
                    if(isset($_REQUEST['bid']) and $_REQUEST['bid']!=NULL)
                    {
                        $batch_list = CHtml::listData(Batches::model()->findAllByAttributes(array('course_id'=>$_REQUEST['cid'],'is_active'=>1,'is_deleted'=>0)),'id','name');                                               
                        echo CHtml::dropDownList('batch_id','',$batch_list,array('prompt'=>Yii::t('app','Select').' '.Yii::app()->getModule('students')->fieldLabel("Students", "batch_id"),'id'=>'batchid','style'=>'width:190px;','options'=>array($_REQUEST['bid']=>array('selected'=>true)),'onchange'=>'updatemode()'));
                    }
                    else
                    {
                        echo CHtml::dropDownList('batch_id','',array(),array('prompt'=>Yii::t('app','Select').' '.Yii::app()->getModule('students')->fieldLabel("Students", "batch_id"),'id'=>'batchid','style'=>'width:190px;','onchange'=>'updatemode()'));
                    }
                    ?>
                </td>
            </tr>
         </table>
         <br />
         <br />
         	
             <div class="formCon">
				<div class="formConInner">
                    &nbsp;
                    <?php echo CHtml::checkBox('select_all','',array('class'=>'select_all'));?><?php echo Yii::t('app','Select All');?><br /><br />&nbsp;
                    
                    <?php echo CHtml::checkBox('Subjects','',array('class'=>'batch_ele ischeck'));?><?php echo Yii::t('app','Subjects');?><br /><br />&nbsp;
                    
                    <?php echo CHtml::checkBox('Electives','',array('class'=>'batch_ele ischeck'));?><?php echo Yii::t('app','Electives');?>
            	</div>
			</div>

            
            <?php echo CHtml::submitButton('Save',array('class'=>'formbut','id'=>'save','style'=>'height:auto; padding:6px 15px;')); ?>

 			</div>
         </td>
     </tr>
</table>
<?php $this->endWidget(); ?>
<script>
$(function () {
        $("#save").click(function () {
            var course = $("#cid");
			var batch = $("#batchid");
            if (course.val() == "" || batch.val()== 0) {
                //If the "Please Select" option is selected display error.
                alert("Please select Course & <?php Yii::app()->getModule('students')->fieldLabel("Students", "batch_id") ?>");
                return false;
            }
            return true;
        });
    });
/*function buttonclick(){
	if($('#cid').val()=='')
	{
		alert("Select the course or batch");
		return false;
	}
	return true;
}*/
$("#select_all").change(function(){ 
    if (this.checked) {
   $('.batch_ele').attr('checked', true);
    }
    else{
   $('.batch_ele').attr('checked', false);
    }
   });
$(".batch_ele").change(function(){
   if($('.ischeck:checked').size() > 3)
   {
    $('#select_all').attr('checked', true);
   }
   else
   {
    $('#select_all').attr('checked', false);
   }
});
</script>