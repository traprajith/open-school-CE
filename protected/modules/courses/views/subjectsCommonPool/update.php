<style>
#jobDialog
{
	height:auto !important;

}
</style>
<?php
$this->breadcrumbs=array(
	Yii::app()->getModule('students')->fieldLabel("Students", "batch_id")=>array('/courses'),
	Yii::t('app','Create'),
);

?>
 <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ui-style.css" />
<?php /*?><?php
$this->breadcrumbs=array(
	'Batches'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Batches', 'url'=>array('index')),
	array('label'=>'Manage Batches', 'url'=>array('admin')),
);
?><?php */?>
<!--<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="247" valign="top">
    
    
    <?php //$this->renderPartial('//courses/left_side');?>
    
    </td>
    <td valign="top">
    <div class="cont_right">-->
<!--<h1>Create Batches</h1>-->
<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
                'id'=>'jobDialog2',
                'options'=>array(
                    'title'=>Yii::t('app','Update Subject').' : '.$model->subject_name,
                    'autoOpen'=>true,
                    'modal'=>'true',
                    'width'=>'400',
                    'height'=>'auto',
					'resizable'=>false,
					
                ),
                ));
				?>
<h1></h1>
<?php echo $this->renderPartial('_form', array('model'=>$model,'sub_id'=>$_GET['sub_id'])); ?>
<?php $this->endWidget('zii.widgets.jui.CJuiDialog');?>
<!--	</div>
    </td>
  </tr>
</table>-->
