<?php
$this->breadcrumbs=array(
	'Buy Products'=>array('/store'),
	$model->id,
);
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="247" valign="top">

 <?php $this->renderPartial('/default/left_side');?>
 </td>
    <td valign="top">
     <div class="cont_right formWrapper">
<h1><?php echo Yii::t('store','Product Details');?></h1>

<?php $student=Students::model()->findByAttributes(array('id'=>$model->student_id));?>
<div class="pdtab_Con">
 <table width="100%" border="0" cellspacing="0" cellpadding="0">
 <tr class="pdtab-h">
 <td align="center"><?php echo Yii::t('store','Student Name');?></td>
 <td align="center"><?php echo Yii::t('store','Product Name');?></td>
 <td align="center"><?php echo Yii::t('store','Product Brand');?></td>
 <td align="center"><?php echo Yii::t('store','Issued date');?></td>
 </tr>
 <tr>
 <td align="center"><?php echo $student->first_name.' '.$student->last_name;?></td>
 <td align="center"><?php echo $model->pr_name;?></td>
 <td align="center"><?php echo $model->pr_brand;?></td>
 <td align="center"><?php 
 							$settings=UserSettings::model()->findByAttributes(array('user_id'=>Yii::app()->user->id));
								if($settings!=NULL)
								{	
									$date1=date($settings->displaydate,strtotime($model->issue_date));
									echo $date1;
		
								}
								
								
 						?></td>
 		</tr>
 	</table>
 	</div>
 	</div>
 </td>
 </tr>
 </table>




