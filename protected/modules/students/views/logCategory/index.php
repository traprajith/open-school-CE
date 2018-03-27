<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="247" valign="top">
    
    <?php $this->renderPartial('/default/left_side');?>
    
    </td>
    <td valign="top">
    <div class="cont_right formWrapper">
<?php
 $this->breadcrumbs=array(
	 Yii::t('app','Students')=>array('/students'),
	 Yii::t('app','Log Category')=>array(''),
);
?>

<?php

$current_academic_yr = Configurations::model()->findByAttributes(array('id'=>35));
if(Yii::app()->user->year)
{
	$year = Yii::app()->user->year;
}
else
{
	$year = $current_academic_yr->config_value;
}
$is_create = PreviousYearSettings::model()->findByAttributes(array('id'=>1));
$is_edit = PreviousYearSettings::model()->findByAttributes(array('id'=>3));
$is_delete = PreviousYearSettings::model()->findByAttributes(array('id'=>4));
?>

<h1><?php echo Yii::t('app','Log Category');?> </h1>


<div>

<div class="button-bg">
                                <div class="top-hed-btn-left"></div>
                            <div class="top-hed-btn-right">
                                    <ul>                                    
                                        <li><?php
if(($year == $current_academic_yr->config_value) or ($year != $current_academic_yr->config_value and $is_create->settings_value!=0))
{
?>
 <?php echo CHtml::link(Yii::t('app','Create Log Category'), array('logCategory/create'),array('id'=>'','class'=>'a_tag-btn')) ?>
<?php
}
?></li>
                                 
                                    </ul>
                                </div> 

                                
                            </div>

<!--    <input id="add_finance-fee-collections" type="button" style="display:block; clear: both;"
           value="Create FinanceFeeCollections" class="client-val-form button">-->
  </div>

<?php 

if($year != $current_academic_yr->config_value and ($is_create->settings_value==0 or $is_edit->settings_value==0 or $is_delete->settings_value==0))
{
?>
	<div>
        <div class="yellow_bx" style="background-image:none;width:680px;padding-bottom:45px;">
            <div class="y_bx_head" style="width:650px;">
             <?php 
				echo Yii::t('app','You are not viewing the current active year.');
				if($is_create->settings_value==0 and $is_edit->settings_value!=0 and $is_delete->settings_value!=0)
				{ 
					echo Yii::t('app','To create a log category, enable Create option in Previous Academic Year Settings.');
				}
				elseif($is_create->settings_value!=0 and $is_edit->settings_value==0 and $is_delete->settings_value!=0)
				{
					echo Yii::t('app','To edit a log category, enable Edit option in Previous Academic Year Settings.');
				}
				elseif($is_create->settings_value!=0 and $is_edit->settings_value!=0 and $is_delete->settings_value==0)
				{
					echo Yii::t('app','To delete a log category, enable Delete option in Previous Academic Year Settings.');
				}
				else
				{
					echo Yii::t('app','To manage the log categories, enable the required options in Previous Academic Year Settings.');	
				}
            ?>
            </div>
            <div class="y_bx_list" style="width:650px;">
                <h1><?php echo CHtml::link(Yii::t('app','Previous Academic Year Settings'),array('/previousYearSettings/create')) ?></h1>
            </div>
        </div>
    </div>
<?php
}  

$template = '';
if(($year == $current_academic_yr->config_value) or ($year != $current_academic_yr->config_value and $is_edit->settings_value!=0))
{
	$template = $template.'{update}';
}

if(($year == $current_academic_yr->config_value) or ($year != $current_academic_yr->config_value and $is_delete->settings_value!=0))
{
	$template = $template.'{delete}';
}

?>  
  
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'log-category-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'filterPosition'=>'none',
'template'=>'{items}{summary}{pager}',
'pager'=>array('header'=>''),
	'pager'=>array('cssFile'=>Yii::app()->baseUrl.'/css/formstyle.css'),
 	'cssFile' => Yii::app()->baseUrl . '/css/formstyle.css',
	 'htmlOptions'=>array('class'=>'grid-view clear'),
	'columns'=>array(
		
		'name',
		
		array(
		'header'=>Yii::t('app','Action'),
			'class'=>'CButtonColumn',
			'deleteConfirmation'=>Yii::t('app','Are you sure you want to delete this log category?'),
			'template' => $template,
			
			
			
		),
	),
)); ?>

</div>
    </td>
  </tr>
</table>

