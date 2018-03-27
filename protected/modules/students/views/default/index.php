<?php
$this->breadcrumbs=array(
	$this->module->id,
);
?>
<h1><?php echo $this->uniqueId . '/' . $this->action->id; ?></h1>

<p>
<?php echo Yii::t('app','This is the view content for action'); ?> "<?php echo $this->action->id; ?>".
<?php echo Yii::t('app','The action belongs to the controller'); ?> "<?php echo get_class($this); ?>"
<?php echo Yii::t('app','in the'); ?> "<?php echo $this->module->id.'module.'; ?>"
</p>
<p>
<?php echo Yii::t('app','You may customize this page by editing'); ?> <tt><?php echo __FILE__; ?></tt>
</p>