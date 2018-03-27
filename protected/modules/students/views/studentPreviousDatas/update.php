<?php
$this->breadcrumbs=array(
	Yii::t('app','Students')=>array('/students'),
	Yii::t('app','Enrolment'),
	Yii::t('app','Previous Details'),
);

?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td width="247" valign="top">
        
        <?php $this->renderPartial('/default/left_side');?>
        
        </td>
        <td valign="top">
            <div class="cont_right formWrapper">            
            <?php $this->renderPartial('application.modules.students.views.students.reg_tab');  ?>              
            <?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
            </div>
        </td>
    </tr>
</table>