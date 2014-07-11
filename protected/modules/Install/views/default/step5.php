<?php $this->pageTitle = Yii::app()->name.' - Register';?>
<h1>Register with openschool</h1>
<?php
?>    
<div class="form">
    <h3></h3>
    <div class="content">
    <?php echo CHtml::beginForm('');?>
    <fieldset>
    <?php echo CHtml::errorSummary($model, null, null, array('class'=>'error')); ?>
    <div class="input">
        <?php echo CHtml::activeLabel($model, 'schoolname');?>
        <?php echo CHtml::activeTextField($model, 'schoolname', array('class' => 'text1'));?>
    </div>
    <div class="input">
        <?php echo CHtml::activeLabel($model, 'address');?>
        <?php echo CHtml::activeTextField($model, 'address', array('class' => 'text1'));?>
    </div>
    <div class="input">
        <?php echo CHtml::activeLabel($model, 'country');?>
        <?php echo CHtml::activeTextField($model, 'country',array('class' => 'text1'));?>
    </div>
    <div class="input">
        <?php echo CHtml::activeLabel($model, 'state');?>
        <?php echo CHtml::activeTextField($model, 'state', array('class' => 'text1'));?>
    </div>
    <div class="input">
        <?php echo CHtml::activeLabel($model, 'zip_postal_code');?>
        <?php echo CHtml::activeTextField($model, 'zip_postal_code', array('class' => 'text1'));?>
    </div>
    <div class="input">
        <?php echo CHtml::activeLabel($model, 'email');?>
        <?php echo CHtml::activeTextField($model, 'email', array('class' => 'text1'));?>
    </div>
    
    <div class="input">
        <?php echo CHtml::activeLabel($model, 'phone');?>
        <?php echo CHtml::activeTextField($model, 'phone', array('class' => 'text1'));?>
    </div>
    
    <div class="input">
        <?php echo CHtml::activeLabel($model, 'url');?>
        <?php echo CHtml::activeTextField($model, 'url', array('class' => 'text1'));?>
    </div>
    <div class="output">
        <?php  echo CHtml::submitButton('Register', array('name'=>'install', 'class'=>'button-2')); ?>
    </div>
    </fieldset>
    <?php echo CHtml::endForm();?>
    </div>
</div>