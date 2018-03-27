<?php
$this->breadcrumbs=array(
	
	Yii::t('app','Settings')=>array('/configurations'),
	Yii::t('app','Academic Years')=>array('create'),
	Yii::t('app','Update'),
);

/*$this->menu=array(
	array('label'=>'List AcademicYears', 'url'=>array('index')),
	array('label'=>'Create AcademicYears', 'url'=>array('create')),
	array('label'=>'View AcademicYears', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage AcademicYears', 'url'=>array('admin')),
);*/
?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
        <td width="247" valign="top">
            <?php $this->renderPartial('left_side');?>        
        </td>
        <td valign="top">
            <div class="cont_right formWrapper">
            	<h1><?php echo Yii::t('app','Update Academic Year'); ?></h1>
				<?php echo $this->renderPartial('_form1', array('model'=>$model)); ?>
			</div>
		</td>
	</tr>
</table>


