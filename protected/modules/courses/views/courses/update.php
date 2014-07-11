 <?php
$this->breadcrumbs=array(
	'Courses'=>array('/courses'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);


?>
 <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ui-style.css" />
<?php /*?><?php
$this->breadcrumbs=array(
	'Courses'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Courses', 'url'=>array('index')),
	array('label'=>'Create Courses', 'url'=>array('create')),
	array('label'=>'View Courses', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Courses', 'url'=>array('admin')),
);
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="247" valign="top">
    
    <?php $this->renderPartial('left_side');?>
    
    </td>
    <td valign="top">
    <div class="cont_right formWrapper">

<h1>Update Courses <?php echo $model->id; ?></h1><?php */?>
<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
					'id'=>'jobDialog11',
					'options'=>array(
                    'title'=>Yii::t('job','Update'),
                    'autoOpen'=>true,
                    'modal'=>'true',
                    'width'=>'400',
                    'height'=>'auto',
					'resizable'=>false,
					
                ),
                ));
				?>
                
<?php 
echo $this->renderPartial('_form1', array('model'=>$model,'val1'=>$val1)); ?>
<?php $this->endWidget('zii.widgets.jui.CJuiDialog');?>
<?php /*?> 	</div>
    </td>
  </tr>
</table><?php */?>