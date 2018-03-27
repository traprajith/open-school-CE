<?php
$this->breadcrumbs=array(
	Yii::app()->getModule('students')->fieldLabel("Students", "batch_id")=>array('/courses'),
	Yii::t('app','Manage'),
);

$this->menu=array(
	array('label'=>'List'.' '.Yii::app()->getModule('students')->fieldLabel("Students", "batch_id"), 'url'=>array('index')),
	array('label'=>'Create'.' '.Yii::app()->getModule('students')->fieldLabel("Students", "batch_id"), 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('batches-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?php echo Yii::t('app','Manage').' '.Yii::app()->getModule('students')->fieldLabel("Students", "batch_id")?></h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'batches-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'name',
		'course_id',
		'start_date',
		'end_date',
		'is_active',
		/*
		'is_deleted',
		'employee_id',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
