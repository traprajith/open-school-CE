<?php
$this->breadcrumbs=array(
	Yii::t('app','Settings')=>array('index'),
	Yii::t('app','School Setup'),
);
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td width="247" valign="top">
        	<?php $this->renderPartial('//configurations/left_side');?>        
        </td>
        <td valign="top">
            <div class="cont_right formWrapper">
                <h1><?php echo Yii::t('app','Institution Configurations'); ?></h1>
                <?php
                Yii::app()->clientScript->registerScript(
                'myHideEffect',
                '$(".flashMessage").animate({opacity: 1.0}, 3000).fadeOut("slow");',
                CClientScript::POS_READY
                );
                ?>
                <?php
                /* Success Message */
                if(Yii::app()->user->hasFlash('successMessage')): 
				?>
                    <div class="flashMessage" style="background:#FFF; color:#C00; padding-left:200px; font-size:16px">
                    <?php echo Yii::app()->user->getFlash('successMessage'); ?>
                    </div>
                <?php endif;
                 /* End Success Message */
                ?>
                
                <?php
                /* Error Message */
                if(Yii::app()->user->hasFlash('errorMessage')): 
				?>
                    <div class="errorSummary">
                    <?php echo Yii::app()->user->getFlash('errorMessage'); ?>
                    </div>
                <?php endif;
                 /* End Error Message */
                ?>
                
                
                
                <?php echo $this->renderPartial('_form', array('model'=>$model,'logo'=>$logo,'favicon'=>$favicon)); ?>
            </div>
        </td>
    </tr>
</table>
