<style>
#jobDialog_comment{
	height:auto !important;
}

.ui-dialog .ui-dialog-title {
    float: left;
    color: #585858;
	font-weight: 300;    
	padding: 3px 7px;
}
.ui-dialog-titlebar {
    background: #c0def3!important;
    color: #000 !important;
}
.ui-dialog .ui-dialog-titlebar {
    padding: 2px 0px 2px 10px !important;
}
.ui-dialog-content {
	 text-align:center;
}

</style>

<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ui-style.css" />

<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
	'id'=>'jobDialog_image',
	'options'=>array(
		'title'=>Yii::t('app','Image'),
		'autoOpen'=>true,
		'modal'=>'true',
		'width'=>'323',
		'height'=>'auto',
		'resizable'=>false,
				
   ),
));

$model = DocumentUploads::model()->findByPk($id);
$path = DocumentUploads::model()->getFilePath($model->identifier, $model->file_id, $model->file_name);
echo '<img src="'.$path.'" height="250" width="250" alt="'.$model->file_name.'" />';

?>	



<?php $this->endWidget('zii.widgets.jui.CJuiDialog');?>