<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('exam_group_id')); ?>:</b>
	<?php echo CHtml::encode($data->exam_group_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('subject_id')); ?>:</b>
	<?php echo CHtml::encode($data->subject_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('start_time')); ?>:</b>
	<?php echo CHtml::encode($data->start_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('end_time')); ?>:</b>
	<?php echo CHtml::encode($data->end_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('maximum_marks')); ?>:</b>
	<?php echo CHtml::encode($data->maximum_marks); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('minimum_marks')); ?>:</b>
	<?php echo CHtml::encode($data->minimum_marks); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('grading_level_id')); ?>:</b>
	<?php echo CHtml::encode($data->grading_level_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('weightage')); ?>:</b>
	<?php echo CHtml::encode($data->weightage); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('event_id')); ?>:</b>
	<?php echo CHtml::encode($data->event_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_at')); ?>:</b>
	<?php echo CHtml::encode($data->created_at); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('updated_at')); ?>:</b>
	<?php echo CHtml::encode($data->updated_at); ?>
	<br />

	*/ ?>

</div>