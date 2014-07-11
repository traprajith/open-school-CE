<?php
$this->breadcrumbs=array(
	'Subjects'=>array('/courses'),
	$model->name,
);

/**$this->menu=array(
	array('label'=>'List ', 'url'=>array('index')),
	array('label'=>'Create ', 'url'=>array('create')),
	array('label'=>'Update ', 'url'=>array('update', 'id'=>$model->)),
	array('label'=>'Delete ', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ', 'url'=>array('admin')),
);*/
?>

<h1><?php echo Yii::t('Subjects','View Subjects');?></h1>

<?php /*?><?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'code',
		'batch_id',
		'no_exams',
		'max_weekly_classes',
		'elective_group_id',
		'is_deleted',
		'created_at',
		'updated_at',
	),
)); 

?><?php */?>
<div class="tableinnerlist" style="padding-right:25px;">
<table width="100%" border="0" cellspacing="1" cellpadding="0">
  <tr>
    <td><?php echo Yii::t('Subjects','Subject Name');?></td>
    <td><?php echo $model->name; ?></td>
  </tr>
    <tr>
    <td><?php echo Yii::t('Subjects','Subject Code');?></td>
    <td><?php echo $model->code; ?></td>
  </tr>
    <tr>
    <td><?php echo Yii::t('Subjects','Batch Name');?></td>
    <td><?php
    $posts=Batches::model()->findByAttributes(array('id'=>$model->batch_id));
	echo $posts->name;
	?></td>
  </tr>
    <tr>
    <td><?php echo Yii::t('Subjects','Max Weekly Classes');?></td>
    <td><?php echo $model->max_weekly_classes; ?></td>
  </tr>
</table>
</div>