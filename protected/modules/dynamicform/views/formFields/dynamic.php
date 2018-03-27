<?php
$this->breadcrumbs=array(
    Yii::t('app','Settings')=>array('/configurations'),
	Yii::t('app','Form Fields')=>array('/dynamicform/formFields/list'),
	Yii::t('app','Update'),
);


?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td width="247" valign="top">
        	<?php $this->renderPartial('/default/left_side');?>
        </td>
        <td valign="top">
            <div class="cont_right formWrapper">
                <h1><?php echo Yii::t('app','Update Form Field');?></h1>
                <?php
				 echo $this->renderPartial('dynamic_form', array('model'=>$model)); ?>
				
				
            </div>
        </td>
    </tr>
</table>