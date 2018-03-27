<div id="othleft-sidebar">
	<?php
    $this->widget('zii.widgets.CMenu',array(
		'encodeLabel'=>false,
		'activateItems'=>true,
		'activeCssClass'=>'list_active',
		'items'=>array(
			array(
				'label'=>''.'<h1>'.Yii::t('app','Manage Form Fields').'</h1>'
			),
			    array(
				'label'=>Yii::t('app','Student Field Settings').' <span>'.Yii::t('app','List Form Fields').'</span>',
				'url'=>array('/dynamicform/formFields/list'),
				'linkOptions'=>array('class'=>'lbook_ico'),
				'active'=> ((isset(Yii::app()->controller->module->id) and Yii::app()->controller->module->id=="dynamicform" and Yii::app()->controller->id=='formFields' and Yii::app()->controller->action->id=="list"))
			),
			array(
				'label'=>Yii::t('app','Arrange Form Fields').' <span>'.Yii::t('app','Arrange Form Fields').'</span>',
				'url'=>array('/dynamicform/formFields/arrange'),
				'linkOptions'=>array('class'=>'mg_ico'),
				'active'=> ((isset(Yii::app()->controller->module->id) and Yii::app()->controller->module->id=="dynamicform" and Yii::app()->controller->id=='formFields' and Yii::app()->controller->action->id=="arrange"))
			),
		),
    ));
    ?>
</div>