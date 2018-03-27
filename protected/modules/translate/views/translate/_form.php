<?php

$translator=TranslateModule::translator();
$languageKey=$translator::ID;
$id=$data->id;
$message=$messages[$id];

if($google)
    $tagId="{$languageKey}-{$id}";

echo CHtml::openTag('tr');

echo CHtml::tag('td',array(),
    CHtml::tag('span',array('margin:0 5px'),$message['category'])
);
echo CHtml::tag('td',array(),
    CHtml::tag('span',array(
            'margin:0 5px',
            'class'=>$languageKey."-google-message"
        ),$message['message']
    )
);
echo CHtml::tag('td',array(),
    CHtml::activeTextArea($data,"[$id]translation",array('id'=>$google ? $tagId : null,'class'=>"{$languageKey}-google-translation",'cols'=>35,'rows'=>2)).
    CHtml::activeHiddenField($data,"[$id]language")
);
if($google){
    echo CHtml::tag('td',array(),
            CHtml::ajaxLink(TranslateModule::t('Translate'),
                $this->createUrl('translate/googletranslate'),
                array(
                    'type'=>'post',
                    'data'=>array(
                        'message'=>$message['message'],
                        'language'=>Yii::app()->getLanguage(),
                        'sourceLanguage'=>Yii::app()->sourceLanguage
                    ),
                    'success'=>"js:function(response){
                        \$('#{$tagId}').val(response);
                        \$('#{$tagId}-button').hide();
                    }",
                    'error'=>'js:function(xhr){alert(xhr.responseText);}',
                ),
                array(
                    'margin:0 5px',
                    'class'=>"{$languageKey}-google-button",
                    'id'=>$tagId.'-button',
                )
            )
    );
}
echo CHtml::closeTag('tr');