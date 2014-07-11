<div id="ajax-updated-region">
<?php echo CHtml::link("name", array('/site/close1', 'xxx' => '', 'yyy' => '')); ?>
<?php echo CHtml::link("number", array('/site/close1', 'xxx' => '', 'zzz' => '')); ?>
</div>

<?php
Yii::app()->clientScript->registerScript('ajax-link-handler', "
$('body').on('click', '#ajax-updated-region a', function(event){
	alert(1);exit;
        $.ajax({
                'type':'get',
                'url':$(this).attr('href'),
                'dataType': 'html',
                'success':function(data){
                        $('#ajax-updated-region').html(data);
                }
        });
        event.preventDefault();
});
");
?>