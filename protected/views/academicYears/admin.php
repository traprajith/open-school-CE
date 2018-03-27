<style>
	.edit_bttns {
		right: 16px;	
	}
	
</style>

<?php
$this->breadcrumbs=array(
	Yii::t('app','Settings')=>array('/configurations'),
	Yii::t('app','Academic Years'),
);

/*$this->menu=array(
	array('label'=>'List AcademicYears', 'url'=>array('index')),
	array('label'=>'Create AcademicYears', 'url'=>array('create')),
);*/

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('academic-years-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>


<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
    	<td width="247" valign="top">
            <?php $this->renderPartial('left_side');?>        
        </td>
        <td valign="top">
            <div class="cont_right formWrapper">
            	<h1><?php echo Yii::t('app','Manage Academic Years'); ?></h1>

<div class="button-bg">
<div class="top-hed-btn-left"> </div>
<div class="top-hed-btn-right">
<ul>                                    
                        <li>
                            <?php echo CHtml::link('<span>'.Yii::t('app','Add Academic Year').'</span>', array('create'),array('class'=>'a_tag-btn'));?>
                        </li>                                  
</ul>
</div> 
</div>
                
                
                <?php
					$model->is_deleted = 0;  
					$this->widget('zii.widgets.grid.CGridView', array(
						'id'=>'academic-years-grid',
						'dataProvider'=>$model->search(),
						'pager'=>array('cssFile'=>Yii::app()->baseUrl.'/css/formstyle.css'),
						'cssFile' => Yii::app()->baseUrl . '/css/formstyle.css',
						'filter'=>$model,
						'columns'=>array(
							'name',
							array(
								'name'=>'start',
								'type'=>'raw',
								'filter' => false,
								'value'=>array($model,'convertStart'),
								'htmlOptions' => array('width' =>'500'),
								
							),
							array(
								'name'=>'end',
								'type'=>'raw',
								'filter' => false,
								'value'=>array($model,'convertEnd'),
								'htmlOptions' => array('width' =>'500'),
							),
							array(
								'name'=>'description',
								'filter' => false,
								'htmlOptions' => array('style'=>'width:800px;')
							),	
							array(
								'name'=>'status',
								'filter' => false,
								'htmlOptions' => array('style'=>'width:250px;'),
								'value'=>'$data->status == 1 ?'.Yii::t('app',"Active").' : '.Yii::t('app',"Inactive"),
							),							
							array(
								'header'=>Yii::t('app','Action'),
								'class'=>'CButtonColumn',
								'deleteConfirmation'=>Yii::t('app','Are you sure you want to delete this year ?'),
								'htmlOptions' => array('style'=>'width:400px;'),
								'headerHtmlOptions'=>array('style'=>'font-size:12px; font-weight:bold;')
							),
						),
					));
					
				?>
			</div>
		</td>
	</tr>
</table>



