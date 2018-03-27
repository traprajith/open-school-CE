<?php
$this->breadcrumbs=array(
	Yii::t('app','Form Fields')=>array('admin'),
	Yii::t('app','Create'),
);


?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td width="247" valign="top">
        	<?php $this->renderPartial('/default/left_side');?>
        </td>
        <td valign="top">
            <div class="cont_right formWrapper">
                <h1><?php echo Yii::t('app','Field Details');?></h1>
                <?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		
		'varname',
		'title',
		'field_type',
		'field_size',
		'field_size_min',
		'required',
		
		'position',
		'visible',
		'model',
		'label',
		'admin_student_reg_form',
		'online_admission_form',
		'student_profile_pdf',
		'student_portal',
		'parent_portal',
		'teacher_portal',
		'form_field_type',
		'tab_selection',
		'tab_sub_section',
		'order',
		'is_dynamic',
	),
)); ?>

				
				
            </div>
        </td>
    </tr>
</table>
