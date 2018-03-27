<?php $this->breadcrumbs = array(
	Yii::t('app','Rights')=>Rights::getBaseUrl(),
	Yii::t('app', 'Permissions'),
); ?>

<div id="permissions">

	<h1><?php echo Yii::t('app', 'Permissions'); ?></h1>

	<p>
		<?php echo Yii::t('app', 'Here you can view and manage the permissions assigned to each role.'); ?><br />
		<?php echo Yii::t('app', 'Authorization items can be managed under {roleLink}, {taskLink} and {operationLink}.', array(
			'{roleLink}'=>CHtml::link(Yii::t('app', 'Roles'), array('authItem/roles')),
			'{taskLink}'=>CHtml::link(Yii::t('app', 'Tasks'), array('authItem/tasks')),
			'{operationLink}'=>CHtml::link(Yii::t('app', 'Operations'), array('authItem/operations')),
		)); ?>
	</p>

	<p><?php echo CHtml::link(Yii::t('app', 'Generate items for controller actions'), array('authItem/generate'), array(
	   	'class'=>'generator-link',
	)); ?></p>

	<?php /*?><?php $this->widget('zii.widgets.grid.CGridView', array(
		'dataProvider'=>$dataProvider,
		'template'=>'{items}',
		'emptyText'=>Yii::t('app', 'No authorization items found.'),
		'htmlOptions'=>array('class'=>'grid-view permission-table'),
		'columns'=>$columns,
	)); ?><?php */?>

	<p class="info">*) <?php echo Yii::t('app', 'Hover to see from where the permission is inherited.'); ?></p>

	<script type="text/javascript">

		/**
		* Attach the tooltip to the inherited items.
		*/
		jQuery('.inherited-item').rightsTooltip({
			title:'<?php echo Yii::t('app', 'Source'); ?>: '
		});

		/**
		* Hover functionality for rights' tables.
		*/
		$('#rights tbody tr').hover(function() {
			$(this).addClass('hover'); // On mouse over
		}, function() {
			$(this).removeClass('hover'); // On mouse out
		});

	</script>

</div>
