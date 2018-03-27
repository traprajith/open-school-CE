<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ui-style.css" />
<style>
.partial_fee_heading{
	font-size:12px;
	font-weight:bold;
}
.formConInner table{
	color:#666666;	
}
.ui-dialog-content{
	 width:300px;	
}
.ui-widget label {
    font-size: 14px;
    letter-spacing: .001em;
    color: #666;
    font-weight: bold;
    padding: 17px 11px 8px 3px;
 display: inline-block;
}
.formConInner table{
margin-bottom: 18px;
    margin-top: 15px;
}
</style>

<?php 
	$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
		'id'=>'partial',
		'options'=>array(
			'title'=>Yii::t('app', 'Roll Number Settings'),
			'autoOpen'=>true,
			'modal'=>'true',
			'width'=>'500',
			'height'=>'auto',
		),
	));
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'rollno-settings-form',
	'enableAjaxValidation'=>true,
	'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); ?>
    
    <div class="formCon">
        <div class="formConInner">
            <label><?php echo Yii::t('app','Select Settings for Student Listing'); ?></label>
            <br />
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td> 
                        <?php
                            echo CHtml::radioButtonList('type', $model->config_value, array(1=>Yii::t('app', 'Roll No Only'), 2=>Yii::t('app', 'Admission No Only'), 3=>Yii::t('app', 'Both')), array('separator'=>' '));
                        ?>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div style="padding:0px 0 0 0px; text-align:left">
		<?php
			echo CHtml::ajaxSubmitButton(
				Yii::t('app','Save'),
				CHtml::normalizeUrl(array('configurations/rollnoSettings')),
				array(
					'dataType'=>'json',
					'success'=>'js:function(data) {									
						if(data.status == "success"){
							window.location.reload();        
						}
					}'
				),
				array(
					'id'=>'closeDialog',
					'name'=>'save'
				)
			); 
        ?>
    </div>
<?php $this->endWidget(); ?>

<?php $this->endWidget('zii.widgets.jui.CJuiDialog');?>