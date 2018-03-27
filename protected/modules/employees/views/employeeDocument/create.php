
<?php
$this->breadcrumbs=array(
	Yii::t('app','Teacher Documents')=>array('index'),
	Yii::t('app','Create'),
);
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="247" valign="top">
    	<?php $this->renderPartial('/employees/left_side');?>
    </td>
    <td valign="top">
    	<div class="cont_right formWrapper">
        <?php  $employee = Employees::model()->findByAttributes(array('id'=>$_REQUEST['id'])); ?>
            <h1><?php echo Yii::t('app','Enrolment ');?></h1>

                <?php $this->renderPartial('application.modules.employees.views.employees.createtab');?>

            <?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
        </div>
    </td>
  </tr>
</table>


