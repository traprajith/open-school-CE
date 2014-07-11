<h1>Yii CJuiDialog : Animation</h1>
<?php
/** Start Widget **/
$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
    'id'=>'dialog-animation',
    'options'=>array(
        'title'=>'Dialog box - Animation',
        'autoOpen'=>false,
        'show'=>array(
                'effect'=>'blind',
                'duration'=>1000,
            ),
        'hide'=>array(
                'effect'=>'explode',
                'duration'=>500,
            ),            
    ),
));
    echo 'Animation Dialog Content';
$this->endWidget('zii.widgets.jui.CJuiDialog');
/** End Widget **/
echo CHtml::button('Open Dialog', array(
   'onclick'=>'$("#dialog-animation").dialog("open"); return false;',
));
?>