<?php
$this->breadcrumbs=array(
	Yii::t('app','Themes')=>array('index'),
	'Create',
);
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
    	<td width="247" valign="top">
            <?php $this->renderPartial('/configurations/left_side');?>        
        </td>
        <td valign="top">
          <div class="cont_right">  
            <h1>Create Themes</h1>
            <?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
          </div>
        </td>
        </tr>
</table>
