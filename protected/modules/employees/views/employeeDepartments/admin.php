<?php
$this->breadcrumbs=array(
	'Employee Departments'=>array('admin'),
	'Manage',
);



Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('employee-departments-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="247" valign="top">
    
    <?php $this->renderPartial('/employees/left_side');?>
    
    </td>
    <td valign="top">
    <div class="cont_right formWrapper">
<h1><?php echo Yii::t('employees','Manage Employee Departments');?></h1>

<div class="edit_bttns " style="top:20px; right:20px;">
    <ul>
    <li><?php echo CHtml::link(Yii::t('employees','<span>Add Department</span>'), array('create'),array('class'=>'addbttn last ')); ?></li>
    </ul>
  </div>
<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<?php
    Yii::app()->clientScript->registerScript(
       'myHideEffect',
       '$(".flash-success").animate({opacity: 1.0}, 3000).fadeOut("slow");',
       CClientScript::POS_READY
    );
?>
 
<?php if(Yii::app()->user->hasFlash('notification')):?>
    <div class="flash-success" style="color:#F00; padding-left:150px; font-size:12px">
        <?php echo Yii::app()->user->getFlash('notification'); ?>
    </div>
<?php endif; ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
 
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'employee-departments-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	 'pager'=>array('cssFile'=>Yii::app()->baseUrl.'/css/formstyle.css'),
 	'cssFile' => Yii::app()->baseUrl . '/css/formstyle.css',
	'columns'=>array(
		/*'id',*/
		'code',
		'name',
		/*'status',*/
		array(
			'class'=>'CButtonColumn',
			'template' => '{update}{delete}',
			
		),
	),
)); ?>
</div>
    </td>
  </tr>
</table>