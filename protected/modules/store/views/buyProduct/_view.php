<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('student_id')); ?>:</b>
	<?php echo CHtml::encode($data->student_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pr_name')); ?>:</b>
	<?php echo CHtml::encode($data->pr_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pr_brand')); ?>:</b>
	<?php echo CHtml::encode($data->pr_brand); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('product_id')); ?>:</b>
	<?php echo CHtml::encode($data->product_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('issued_date')); ?>:</b>
	<?php echo CHtml::encode($data->issued_date); ?>
	<br />


</div>