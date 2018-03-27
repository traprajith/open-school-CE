<?php
$this->breadcrumbs=array(
	Yii::t('app','Student Document Lists')=>array('index'),
	$model->name,
);
?>

<h1><?php echo Yii::t('fees','View Student Document Type'); ?></h1>
<?php /*?><?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		//'id',
		'name',
		array('name'=>'is_require','label'=>'Is Required',),
	),
)); ?><?php */?>
<div class="tableinnerlist" style="padding-right:25px;">
<table width="100%" border="0" cellspacing="1" cellpadding="0">
  <tr>
    <td><?php echo Yii::t('app','Name');?></td>
    <td><?php echo $model->name; ?></td>
  </tr>
  	<tr>
    <td><?php echo Yii::t('app','Mandatory');?></td>
    <td>
    	<?php 
			if($model->mandatory=='0')
			{
				echo Yii::t('app',"No");				
			}
			elseif($model->mandatory=='1')
			{
				echo Yii::t('app',"Yes,cannot be skipped");
			}
			else
			{
				echo Yii::t('app',"Yes,can be skipped");
			}
		?>
    </td>
  </tr>
    <tr>
    <td><?php echo Yii::t('app','Is Required');?></td>
    <td>
    	<?php 
			if($model->is_required=='1')
			{
				echo Yii::t('app',"Yes");				
			}
			else
			{
				echo Yii::t('app',"No");
			}
		?>
    </td>
  </tr>
  
</table>
</div>
