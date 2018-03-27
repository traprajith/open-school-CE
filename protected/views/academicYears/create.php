<?php
$this->breadcrumbs=array(
	Yii::t('app','Settings')=>array('/configurations'),
	Yii::t('app','Academic Years'),
	
);
?>


<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td width="247" valign="top">
            <?php $this->renderPartial('left_side');?>        
        </td>
        <td valign="top">
            <div class="cont_right formWrapper">
            	<h1><?php echo Yii::t('app','New Academic Year Setup'); ?></h1>
                <div class="button-bg">
<div class="top-hed-btn-left"> </div>
<div class="top-hed-btn-right">
<ul>                                    
            <li>
                <?php echo CHtml::link('<span>'.Yii::t('app','Manage Academic Years').'</span>', array('admin'),array('class'=>'a_tag-btn'));?>
            </li>                                   
</ul>
</div> 
</div>
                
                
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
                    <br />
                <?php endif;
                 /* End Error Message */
                ?>
                
                <!-- Current Academic Year Details -->
                <?php
				$current_year = AcademicYears::model()->findByAttributes(array('status'=>1));
				if($current_year)
				{
				?>
                    <div class="formCon">
                        <div class="formConInner">
                            <h3><?php echo Yii::t('app','Current Academic Year').' : '.$current_year->name; ?></h3>
                            <table width="80%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                	<td>
                                    	<b><?php echo Yii::t('app','Starts on').' :'; ?></b>
                                    </td>
                                    <td>
                                        <?php
										$settings=UserSettings::model()->findByAttributes(array('user_id'=>Yii::app()->user->id));
										if($settings!=NULL)
										{	
											$current_year->start = date($settings->displaydate,strtotime($current_year->start));
											$current_year->end = date($settings->displaydate,strtotime($current_year->end));
											echo $current_year->start;
				
										}
										else
											echo $current_year->start;
										?>
                                    </td>
                                    <td>
                                    	<b><?php echo Yii::t('app','Ends on').' :'; ?></b>
                                    </td>
                                    <td>
                                    	<?php echo $current_year->end; ?>
                                    </td>
                                </tr>
                                <tr>
                                	<td colspan="4">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td width="20%">
                                    	<b><?php echo Yii::t('app','Description').' :'; ?></b>
                                    </td>
                                    <td colspan="3">
                                    	<?php echo $current_year->description; ?>
                                    </td>
                                </tr>
							</table>
                        </div>
                    </div>
                <?php
				}
				else
				{
				?>
                  
                  <!-- Create a div for new academic year setup instruction -->
                    
                <?php
				}
				?>
                <!-- End Current Academic Year Details -->
				<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
            </div>
        </td>
    </tr>


</table>