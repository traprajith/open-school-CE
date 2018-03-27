<?php
$this->breadcrumbs=array(
	Yii::t('app','Academic Years')=>array('create'),
	$model->name,
);

/*$this->menu=array(
	array('label'=>'List AcademicYears', 'url'=>array('index')),
	array('label'=>'Create AcademicYears', 'url'=>array('create')),
	array('label'=>'Update AcademicYears', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete AcademicYears', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage AcademicYears', 'url'=>array('admin')),
);*/
?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
    	<td width="247" valign="top">
            <?php $this->renderPartial('left_side');?>        
        </td>
        <td valign="top">
            <div class="cont_right formWrapper">
            	<h1><?php echo Yii::t('app','View Academic Year'); ?></h1>
                
<div class="button-bg">
<div class="top-hed-btn-left"> </div>
<div class="top-hed-btn-right">
<ul>                                    
<li>
                        	<?php echo CHtml::link('<span>'.Yii::t('app','Edit').'</span>', array('update', 'id'=>$model->id),array('class'=>'a_tag-btn')); ?>
                        </li>
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
                <?php endif;
                 /* End Error Message */
                ?>
                <div class="table_listbx">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td width="20%">
                                <b><?php echo Yii::t('app','Name'); ?></b>
                            </td>
                            <td width="3%"><strong>:</strong></td>
                            <td width="77%">
                                <?php echo $model->name; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <b><?php echo Yii::t('app','Description'); ?></b>
                            </td>
                            <td><strong>:</strong></td>
                            <td>
                                <?php echo $model->description; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <b><?php echo Yii::t('app','Starts on'); ?></b>
                            </td>
                            <td><strong>:</strong></td>
                            <td>
                                <?php
                                $settings=UserSettings::model()->findByAttributes(array('user_id'=>Yii::app()->user->id));
                                if($settings!=NULL)
                                {	
                                    $model->start = date($settings->displaydate,strtotime($model->start));
                                    $model->end = date($settings->displaydate,strtotime($model->end));
                                    echo $model->start;
                
                                }
                                else
                                    echo $model->start;
                                ?>
                            </td>
                        </tr>
                        <tr>                             
                            <td>
                                <b><?php echo Yii::t('app','Ends on'); ?></b>
                            </td>
                            <td><strong>:</strong></td>
                            <td>
                                <?php echo $model->end; ?>
                            </td>
                        </tr>
                        <tr>                             
                            <td>
                                <b><?php echo Yii::t('app','Status'); ?></b>
                            </td>
                            <td><strong>:</strong></td>
                            <td>
                                <?php 
                                if($model->status == 1)
                                {
                                    echo Yii::t('app','Active'); 
                                }
                                else
                                {
                                    echo Yii::t('app','Inactive');
                                }
                                ?>
                            </td>
                        </tr>
                    </table>
            	</div> <!-- END div class="table_listbx" -->
			</div> <!-- END div class="cont_right formWrapper" -->
		</td>
    </tr>
</table>


