 <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ui-style.css" />


<?php 

$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
                'id'=>'jobDialog',
                'options'=>array(
                    'title'=>Yii::t('job','<h2>Save Search</h2>'),
                    'autoOpen'=>true,
                    'modal'=>'true',
                    'width'=>'auto',
                    'height'=>'auto',
					'resizable'=>false,
                ),
                ));

echo $this->renderPartial('_form', array('model'=>$model,'url'=>$url,'type'=>$type)); ?>

<?php $this->endWidget('zii.widgets.jui.CJuiDialog');?>