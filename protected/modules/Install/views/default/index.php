<?php
if (Yii::app()->user->hasFlash('error') === true) {
    echo '<div><h4>Error:</h4><p>'.Yii::app()->user->getFlash('error').'</p></div>';
}
?>
<h3>Database information</h3>
<p>
    <h4>Notes: Fowllowing folder must writable(chmod 777):</h4>
    <ul>
        <li>./assets - <?php echo $assetsPermit ? 'Fail' : 'OK';?></li>
        <li>./UploadFiles - <?php echo $uploadPermit ? 'Fail' : 'OK';?></li>
        <li>./protected/runtime - <?php echo $runtimePermit ? 'Fail' : 'OK';?></li>
        <li>./protected/config - <?php echo $configPermit ? 'Fail' : 'OK';?></li>
    </ul>
</p>
<?php echo CHtml::beginForm();?>
<div>
    <?php echo CHtml::activeLabel($model, 'baseUrl'); ?>
    <?php echo CHtml::activeTextField($model, 'baseUrl'); ?>
</div>
<div>
    <?php echo CHtml::activeLabel($model, 'host'); ?>
    <?php echo CHtml::activeTextField($model, 'host'); ?>
</div>
<div>
    <?php echo CHtml::activeLabel($model, 'port'); ?>
    <?php echo CHtml::activeTextField($model, 'port'); ?>
</div>
<div>
    <?php echo CHtml::activeLabel($model, 'dbName'); ?>
    <?php echo CHtml::activeTextField($model, 'dbName'); ?>
</div>
<div>
    <?php echo CHtml::activeLabel($model, 'username'); ?>
    <?php echo CHtml::activeTextField($model, 'username'); ?>
</div>
<div>
    <?php echo CHtml::activeLabel($model, 'password'); ?>
    <?php echo CHtml::activeTextField($model, 'password'); ?>
</div>
<div>
    <?php echo CHtml::submitButton('Next'); ?>
</div>
<?php echo CHtml::endForm();?>