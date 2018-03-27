<style type="text/css">
.items input[type="text"]{ width:130px !important;}
</style>
<?php
$this->breadcrumbs=array(
	UserModule::t('Users'),
	UserModule::t('Manage'),
);

function getVisible($data){  //check for visibilty of delete buttons	
	return '($data->id != 1 && $data->id != 2)';			
}

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
    $('.search-form').toggle();
    return false;
});	
$('.search-form form').submit(function(){
    $.fn.yiiGridView.update('user-grid', {
        data: $(this).serialize()
    });
    return false;
});
");

?>
<script>
jQuery(document).ready(function () {
    //hide a div after 3 seconds
    setTimeout( "jQuery('.del_msg').hide();",3000 );
});
</script>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="247" valign="top">
<div id="othleft-sidebar">
<?php $this->renderPartial('//configurations/left_side');?>
  </div>
 </td>
 <td valign="top">
<div class="cont_right formWrapper">
<h1><?php echo UserModule::t("Manage Users"); ?></h1>


<div class="button-bg">
<div class="top-hed-btn-left"> </div>
<div class="top-hed-btn-right">
<ul>                                    
<li><?php echo '<span>'.CHtml::link('<span>'.Yii::t('user','Create User').'</span>',array('/user/admin/create'),array('class'=>'a_tag-btn')).'</span>';?></li>                                   
</ul>
</div> 

</div>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
    'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'user-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'pager'=>array('cssFile'=>Yii::app()->baseUrl.'/css/formstyle.css'),
 	'cssFile' => Yii::app()->baseUrl . '/css/formstyle.css',
	'columns'=>array(		
		array(
		'header'=>Yii::t('app','Name'),
			'name' => 'username',
			'type'=>'raw',
			'value' => array($model,'name'),
		),
		array(
			'header'=>Yii::t('app','Role'),
			'type'=>'raw',
			'value' => array($model,'role'),
		),
		array(
			'name'=>'email',
			'type'=>'raw',
			'value'=>'CHtml::link(UHtml::markSearch($data,"email"), "mailto:".$data->email)',
		),
		array(
            'name'=>'lastvisit_at',
			'filter'=>false,
            'value'=>array($model,'lastvisit'),
        ),		
		array(
			'class'=>'CButtonColumn',
			'header'=>Yii::t('app','Action'),
			'template'=>'{update}{view}{delete}',
			'buttons'=>array(
				'update'=>array(
					'visible'=>'true',
					'options'=>array('class'=>''),
				),
				'view'=>array(
					'visible'=>'true',
					'options'=>array('class'=>''),
				),
				'delete'=>array(
					'visible'=>getVisible($data),
					'options'=>array('class'=>'delete'),
				),
			)
		),
		
	),
)); ?>
</div>
 </td>
  </tr>
</table>