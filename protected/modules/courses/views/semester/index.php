<?php
$this->breadcrumbs=array(
	'Semesters'=>array('index'),
	'Manage',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('semester-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td width="247" valign="top">
        	<?php $this->renderPartial('/courses/left_side');?>        
        </td>
        <td valign="top">
            <div class="cont_right formWrapper">
<h1><?php echo Yii::t('app','Manage Semester');?></h1>
                <?php
				if(Configurations::model()->isSemesterEnabled()== 1)
				{
				?>

<div class="button-bg">
<div class="top-hed-btn-left"> </div>
<div class="top-hed-btn-right">
<ul>                                    
<li> <?php echo CHtml::link('<span>'.Yii::t('app','Add Semester').'</span>', array('create'),array('class'=>'a_tag-btn
')); ?></li>                                   
</ul>
</div> 

</div>
<style>
	.sem-view-block th, td{ border:none;}
</style>

                <?php
				}
			 $this->widget('zii.widgets.grid.CGridView', array(
				'id'=>'semester-grid',
				'dataProvider'=>$model->search(),
				'filter'=>$model,
				'pager'=>array('cssFile'=>Yii::app()->baseUrl.'/css/formstyle.css'),
 				'cssFile' => Yii::app()->baseUrl . '/css/formstyle.css',
				'columns'=>array(
					array(
						'name'=>'name',
						'type'=>'raw',
						'value'=>array($model,'name'),
					),
					array(
						'name'=>'start_date',
						'filter'=>false,
						'value'=>array($model,'startdate'),
					),	
					array(
						'name'=>'end_date',
						'filter'=>false,
						'value'=>array($model,'enddate'),
					),
					array(
						'class'=>'CButtonColumn',
						'header'=>Yii::t('app','Action'),
					),
				),
			)); 	?>
            
 
 
 </div>
 </td>
    </tr>
</table>
<?php 
