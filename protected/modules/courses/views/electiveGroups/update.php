<?php
$this->breadcrumbs=array(
	Yii::t('app','Elective Groups')=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	Yii::t('app','Update'),
);

$this->menu=array(
	array('label'=>Yii::t('app','List Elective Groups'), 'url'=>array('index')),
	array('label'=>Yii::t('app','Create Elective Groups'), 'url'=>array('create')),
	array('label'=>Yii::t('app','View Elective Groups'), 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>Yii::t('app','Manage Elective Groups'), 'url'=>array('admin')),
);
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="247" valign="top">
    
    <?php $this->renderPartial('//courses/left_side');?>
    
    </td>
    <td valign="top">
    <div class="cont_right formWrapper">
<h1><?php echo Yii::t('app','Update Elective Group : ').$model->name; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>
    </td>
  </tr>
</table>