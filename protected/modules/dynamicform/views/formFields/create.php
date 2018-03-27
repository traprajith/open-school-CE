<?php
$this->breadcrumbs=array(
        Yii::t('app','Settings')=>array('/configurations'),
	Yii::t('app','Form Fields')=>array('list'),
	Yii::t('app','Create'),
);


?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td width="247" valign="top">
        	<?php $this->renderPartial('/default/left_side');?>
        </td>
        <td valign="top">
            <div class="cont_right formWrapper">
                <h1><?php echo Yii::t('app','Create New Form Field');?></h1>

<div class="button-bg">
<div class="top-hed-btn-left"> </div>
<div class="top-hed-btn-right">
 <ul><li><?php echo CHtml::link('<span>'.Yii::t('app','Settings').'</span>', array('list'),array('class'=>'a_tag-btn')); ?></li></ul>
</div> 

</div>
                <?php
				 echo $this->renderPartial('_form', array('model'=>$model)); ?>
				
				
            </div>
        </td>
    </tr>
</table>