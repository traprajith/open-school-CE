<?php
$this->breadcrumbs=array(
	Yii::t('app','Settings')=>array('index'),
	Yii::t('app','Semester Settings'),
);
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td width="247" valign="top">
        	<?php $this->renderPartial('//configurations/left_side');?>        
        </td>
        <td valign="top">
            <div class="cont_right formWrapper">
                <h1><?php echo Yii::t('app','Semester Settings'); ?></h1>
                <?php
					Yii::app()->clientScript->registerScript(
						'myHideEffect',
						'$(".flashMessage").animate({opacity: 1.0}, 3000).fadeOut("slow");',
						CClientScript::POS_READY
					);
                ?>
                <?php
                /* Success Message */
                if(Yii::app()->user->hasFlash('success')): 
				?>
                    <div class="flashMessage" style="background:#FFF; color:#C00; padding-left:200px; font-size:16px">
                    <?php echo Yii::app()->user->getFlash('success'); ?>
                    </div>
                <?php endif;
                 /* End Success Message */
                ?>
                
                <?php
                /* Error Message */
                if(Yii::app()->user->hasFlash('error')): 
				?>
                    <div class="errorSummary">
                    <?php echo Yii::app()->user->getFlash('error'); ?>
                    </div>
                <?php endif;
                 /* End Error Message */
                ?>
                
                <?php echo $this->renderPartial('_semester_form', array('model'=>$model)); ?>
            </div>
        </td>
    </tr>
</table>
