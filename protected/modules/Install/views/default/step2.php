<?php $this->pageTitle = Yii::app()->name.' - Environment Settings';?>
<h1>Environment settings</h1>
<p class="emphasize">All fields are required and case sensitive.</p>
<div class="form">
    <h3></h3>
<div class="content">
<?php echo CHtml::beginForm('');?>
<fieldset>
<?php echo CHtml::errorSummary($model, '', '', array('class'=>'error')); ?>
<div class="input">
    <?php echo CHtml::activeLabel($model, 'baseUrl'); ?>
    <?php 
    if ($model->baseUrl == 'http://') $model->baseUrl = Yii::app()->request->getBaseUrl(true);
    echo CHtml::activeTextField($model, 'baseUrl', array('class' => 'text1'));
    ?>
    <div class="note">Base url to your <?php echo Yii::app()->params['app_name']; ?> application.</div>
</div>
<div class="input">
    <?php echo CHtml::activeLabel($model, 'host'); ?>
    <?php echo CHtml::activeTextField($model, 'host', array('class' => 'text1')); ?>
    <div class="note">MySQL database server (usually localhost)</div>
</div>
<div class="input">
    <?php echo CHtml::activeLabel($model, 'port'); ?>
    <?php echo CHtml::activeTextField($model, 'port', array('class' => 'text1')); ?>
    <div class="note">Port to connect to you MySQL server (usually 3306)</div>
</div>
<div class="input">
    <?php echo CHtml::activeLabel($model, 'dbName'); ?>
    <?php echo CHtml::activeTextField($model, 'dbName', array('class' => 'text1')); ?>
    <div class="note"><?php echo Yii::app()->params['app_name']; ?> database name.</div>
</div>
<div class="input">
    <?php echo CHtml::activeLabel($model, 'username'); ?>
    <?php echo CHtml::activeTextField($model, 'username', array('class' => 'text1')); ?>
    <div class="note">Database username</div>
</div>
<div class="input">
    <?php echo CHtml::activeLabel($model, 'password'); ?>
    <?php echo CHtml::activeTextField($model, 'password', array('class' => 'text1')); ?>
    <div class="note">Database password.</div>
</div>
<div class="output">
    <?php echo CHtml::submitButton('Next', array('class'=>'button-2')); ?>
</div>
</fieldset>
<?php echo CHtml::endForm();?>
</div>
</div>