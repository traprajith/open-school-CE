<?php $this->breadcrumbs = array(
	Yii::t('app','Rights')=>Rights::getBaseUrl(),
	Yii::t('app', 'Create :type', array(':type'=>Rights::getAuthItemTypeName($_GET['type']))),
); ?>

<div class="createAuthItem">

	<h1><?php echo Yii::t('app', 'Create :type', array(
		':type'=>Rights::getAuthItemTypeName($_GET['type']),
	)); ?></h1>

	<?php $this->renderPartial('_form', array('model'=>$formModel)); ?>

</div>