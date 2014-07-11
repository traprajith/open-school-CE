<?php $this->pageTitle = Yii::app()->name.' - Site basic information';?>

<h1>Site basic information</h1>
<p class="emphasize">Your site name is used as default page title which is important for SEO.
The email you provide will be used to create administrator account.</p>
<div class="form">
    <h3></h3>
    <div class="content">
    <?php echo CHtml::beginForm(''); ?>
    <fieldset>
    <?php echo CHtml::errorSummary($model, null, null, array('class'=>'error')); ?>
    <div class="input">
        <?php echo CHtml::activeLabel($model, 'siteName'); ?>
        <?php echo CHtml::activeTextField($model, 'siteName', array('class' => 'text1')); ?>
    </div>
    <div class="input">
        <?php echo CHtml::activeLabel($model, 'adminEmail'); ?>
        <?php echo CHtml::activeTextField($model, 'adminEmail', array('class' => 'text1')); ?>
        <div class="note">Double-check your email address before continuing</div>
    </div>
    <div class="output">
        <?php echo CHtml::submitButton('Next', array('class'=>'button-2')); ?>
    </div>
    </fieldset>
    <?php echo CHtml::endForm();?>
    </div>
</div>