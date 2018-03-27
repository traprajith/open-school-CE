<?php
$this->breadcrumbs=array(
	'Subjects Common Pools'=>array('index'),
	'Manage',
);
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td width="247" valign="top">
        	<?php $this->renderPartial('left_side');?>        
        </td>
        <td valign="top">
<h1>Manage Subjects Common Pools</h1>
            <div class="cont_right formWrapper">

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'subjects-common-pool-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'course_id',
		'subject_name',
		'subject_code',
		'max_weekly_classes',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
</div></td></tr></table>
