<?php $this->pageTitle = Yii::app()->name.' - Database setup';?>

<h1>Database setup</h1>
<p class="emphasize">We have all information we need. Before continue, back up your database if you need as existing data might be lost.</p>
<div class="form">
    <h3></h3>
    <div class="content">
<?php
?>
    <?php echo CHtml::beginForm('');?>
    <fieldset>
    <?php if (Yii::app()->session->contains('env')===true) :?>
    <p>Installer cannot create environment.php file.
    Please upload <?php echo CHtml::link('this file', array('default/downloadEnvironment'));?> to <?php echo Yii::getPathOfAlias('application.config');?> folder.</p>
    <p><?php echo CHtml::link('Click here', array('default/step3'));?> to try again.</p>
    <?php endif;?>
    
    <?php if ($canConnect): ?>
        <div class="input">
            <?php echo CHtml::label('Install example data', 'example', array('style'=>'width:130px'));?>
            <?php echo CHtml::checkBox('example', false);?>
        </div>
        <div class="output">
		    <a href="<?php echo $this->createUrl('default/step2'); ?>">Back</a>
            <?php  echo CHtml::submitButton('Next', array('name'=>'install', 'class'=>'button-2')); ?>
        </div>
    <?php endif; ?>
    </fieldset>
    <?php echo CHtml::endForm();?>
    </div>
</div>
