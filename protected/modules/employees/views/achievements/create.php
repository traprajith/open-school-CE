
<?php
$this->breadcrumbs=array(
	 Yii::t('app','Achievements'),
	Yii::t('app','Create'),
);
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="247" valign="top">
    	<?php $this->renderPartial('application.modules.employees.views.employees.profileleft');?>
    </td>
    <td valign="top">
    	<div class="cont_right formWrapper">
            <h1><?php echo Yii::t('app','Teacher Achievements');?></h1>
            <div class="emp_tab_nav">
              <?php $this->renderPartial('application.modules.employees.views.employees.tab');?>
            </div>
            <?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
        </div>
    </td>
  </tr>
</table>


