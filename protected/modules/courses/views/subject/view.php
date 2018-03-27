<style type="text/css">
.fancybox-outer h1{ font-size:19px;}

.tableinnerlist td{ text-align:left;}
</style>

<?php
$this->breadcrumbs=array(
	Yii::t('app','Subjects')=>array('/courses'),
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

<h1><?php echo Yii::t('app','View Subject Details');?></h1>

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
<div class="tableinnerlist" style="padding-right:15px;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><?php echo Yii::t('app','Subject Name');?></td>
    <td><?php echo $model->name; ?></td>
  </tr>
  <?php /*?>  <tr>
    <td><?php echo Yii::t('app','Subject Code');?></td>
    <td><?php echo $model->code; ?></td>
  </tr><?php */?>
    <tr>
    <td><?php echo Yii::app()->getModule('students')->fieldLabel("Students", "batch_id").' '.Yii::t('app','Name');?></td>
    <td><?php
    $posts=Batches::model()->findByAttributes(array('id'=>$model->batch_id));
	echo $posts->name;
	?></td>
  </tr>
  <tr>
    <td><?php echo Yii::t('app','Max Weekly Classes');?></td>
    <td><?php echo $model->max_weekly_classes; ?></td>
  </tr>
  <?php
	if(!$model->isNewRecord){
		$common_cps	=	SubjectSplit::model()->findAllByAttributes(array('subject_id'=>$model->id));
		foreach($common_cps as $common_cp){
			?>
            <tr>
                <td><?php echo Yii::t('app','First Sub Category');?></td>
                <td><?php echo $common_cp->split_name ?></td>
            </tr>
			<?php 
		}
	}
  ?>
</table>
</div>