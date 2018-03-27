<?php
$this->breadcrumbs=array(
	Yii::t('app','Log Category')=>array('index'),
	Yii::t('app','Update'),
);


?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="247" valign="top">
    
    <?php $this->renderPartial('/employees/left_side');?>
    
    </td>
    <td valign="top">
    <div class="cont_right formWrapper">

<h1><?php echo Yii::t('app','Update Log Category');?></h1><br />
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>

 	</div>
    </td>
  </tr>
</table>
