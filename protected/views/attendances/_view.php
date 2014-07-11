<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('student_id')); ?>:</b>
	<?php echo CHtml::encode($data->student_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('period_table_entry_id')); ?>:</b>
	<?php echo CHtml::encode($data->period_table_entry_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('forenoon')); ?>:</b>
	<?php echo CHtml::encode($data->forenoon); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('afternoon')); ?>:</b>
	<?php echo CHtml::encode($data->afternoon); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('reason')); ?>:</b>
	<?php echo CHtml::encode($data->reason); ?>
	<br />


</div>