<!--<script language="javascript">
function getid()
{
var id= document.getElementById('drop').value;
window.location = "index.php?r=weekdays/index&id="+id;
}
</script>-->

<?php
$this->breadcrumbs=array(
	'Weekdays',
);
?>

  <?php if(isset($_REQUEST['id']) and $_REQUEST['id']!=NULL) {?>
  <div style="background:#FFF;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
   
    <td valign="top">
   <div style="padding:20px;">
    <!--<div class="searchbx_area">
    <div class="searchbx_cntnt">
    	<ul>
        <li><a href="#"><img src="images/search_icon.png" width="46" height="43" /></a></li>
        <li><input class="textfieldcntnt"  name="" type="text" /></li>
        </ul>
    </div>
    
    </div>-->
    
    
        
    <!--<div class="edit_bttns">
    <ul>
    <li>
    <a class=" edit last" href="#">Edit</a>    </li>
    </ul>
    </div>-->
   
    
    <div class="clear"></div>
    <div class="emp_right_contner">
    <div class="emp_tabwrapper">
    <?php if(isset($_REQUEST['id']) and $_REQUEST['id']!='NULL')
	{
		 $this->renderPartial('/batches/tab');
	}
	?>
        
    <div class="clear"></div>
    <div class="emp_cntntbx" style="padding-top:10px;">
    <div class="c_subbutCon" align="right" >
    <div class="edit_bttns" style="width:110px; top:15px;">
    <ul>
    <li>
    <?php echo CHtml::link('<span>'.Yii::t('weekdays','Time Table').'</span>', array('weekdays/timetable','id'=>$_REQUEST['id']),array('class'=>'addbttn last'));?>
    </li>
   
    </ul>
    <div class="clear"></div>
    </div>
    </div>
<div >

<div style="padding-top:10px; font-size:14px; font-weight:bold;">
<h3>Week Days</h3>
<?php
    Yii::app()->clientScript->registerScript(
       'myHideEffect',
       '$(".flash-success").animate({opacity: 1.0}, 3000).fadeOut("slow");',
       CClientScript::POS_READY
    );
?>
 
<?php if(Yii::app()->user->hasFlash('notification')):?>
    <div class="flash-success">
        <?php echo Yii::app()->user->getFlash('notification'); ?>
    </div>
<?php endif; ?>

<?php   

$models = Batches::model()->findAll("is_deleted=:x", array(':x'=>'0'));
				$data = array();
				$data['NULL'] = 'common';
				foreach ($models as $model_1)
				{
					$posts=Batches::model()->findByPk($model_1->id);
					$data[$model_1->id] = $model_1->name;
				}
	?>
     <div >
    <!--<h3>Set Weekdays For :&nbsp;-->
<?php
//echo CHtml::dropDownList('mydropdownlist','mydropdownlist',$data,array('onchange'=>'getid();','id'=>'drop','options'=>array($_REQUEST['id']=>array('selected'=>true))));
                 ?> <!--</h3>-->
 <?php $form=$this->beginWidget('CActiveForm', array('id'=>'courses-form','enableAjaxValidation'=>false,)); ?>
      <?php
	 
	  if($_REQUEST['id']!='NULL')
	  {
		  
		  $batch = $model->findAll("batch_id=:x", array(':x'=>$_REQUEST['id']));
		
		  if(count($batch)==0)
		  {
			 $batch = $model->findAll("batch_id IS NULL");
		  }
		  ?>
          <div >
         <table width="100%" cellpadding="0" cellspacing="0">
         <tr>
           <td width="4%"><?php
			  if($batch[0]['weekday']==1)
			  echo $form->checkBox($model,'sunday',array('value'=>'1','checked'=>'checked','class'=>'styled'));
			  else
			   echo $form->checkBox($model,'sunday',array('value'=>'1','class'=>'styled')); ?></td>
             <td width="85%" align="left"><?php echo Yii::t('weekdays','Sunday');?></td>
             <td width="11%">
              
             </td>
         </tr>
         <tr>
         	<td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
         </tr>
         <tr>
           <td><?php
			 if($batch[1]['weekday']==2)
			   echo $form->checkBox($model,'monday',array('value'=>'2','checked'=>'checked','class'=>'styled'));
			 else
			  echo $form->checkBox($model,'monday',array('value'=>'2','class'=>'styled')); ?></td>
             <td align="left"><?php echo Yii::t('weekdays','Monday');?></td>
             <td></td>
         </tr>
         <tr>
         	<td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
         </tr>
         <tr>
           <td><?php
			  if($batch[2]['weekday']==3)
			  echo $form->checkBox($model,'tuesday',array('value'=>'3','checked'=>'checked','class'=>'styled')); 
			  else
			   echo $form->checkBox($model,'tuesday',array('value'=>'3','class'=>'styled')); 
			  ?></td>
             <td align="left"><?php echo Yii::t('weekdays','Tuesday');?></td>
             <td></td>
         </tr>
         <tr>
         	<td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
         </tr>
         <tr>
           <td><?php
			 if($batch[3]['weekday']==4)
			  echo $form->checkBox($model,'wednesday',array('value'=>'4','checked'=>'checked','class'=>'styled'));
			  else
			  echo $form->checkBox($model,'wednesday',array('value'=>'4','class'=>'styled'));
			   ?></td>
             <td align="left"><?php echo Yii::t('weekdays','Wednesday');?></td>
             <td></td>
         </tr>
         <tr>
         	<td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
         </tr>
         <tr>
           <td><?php
			  if($batch[4]['weekday']==5)
			  echo $form->checkBox($model,'thursday',array('value'=>'5','checked'=>'checked','class'=>'styled'));
			  else
			  echo $form->checkBox($model,'thursday',array('value'=>'5','class'=>'styled'));
			   ?></td>
             <td align="left"><?php echo Yii::t('weekdays','Thursday');?></td>
             <td></td>
         </tr>
         <tr>
         	<td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
         </tr>
         <tr>
           <td><?php
			  if($batch[5]['weekday']==6)
			  echo $form->checkBox($model,'friday',array('value'=>'6','checked'=>'checked','class'=>'styled'));
			  else
			   echo $form->checkBox($model,'friday',array('value'=>'6','class'=>'styled'));
			   ?></td>
             <td align="left"><?php echo Yii::t('weekdays','Friday');?></td>
             <td></td>
         </tr>
         <tr>
         	<td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
         </tr>
         <tr>
           <td><?php
			  if($batch[6]['weekday']==7)
			  echo $form->checkBox($model,'saturday',array('value'=>'7','checked'=>'checked','class'=>'styled'));
			  else
			  echo $form->checkBox($model,'saturday',array('value'=>'7','class'=>'styled'));
				 ?></td>
             <td align="left"><?php echo Yii::t('weekdays','Saturday');?></td>
             <td></td>
         </tr>
         </table>
         </div>
         </div><br />
      <?php    
	  }
	  ?> 
      <!-- Default one -->
       <?php
	  if($_REQUEST['id']=='NULL')
	  {
		  
		  $batch = $model->findAll("batch_id IS NULL");
		  ?>
          <div  style="color:#000; font-size:14px;">
        
         <table width="100%" cellspacing="0" cellpadding="0">
         <tr>
           <td width="4%"><?php
			  if($batch[0]['weekday']==1)
			  echo $form->checkBox($model,'sunday',array('value'=>'1','checked'=>'checked','class'=>'styled'));
			  else
			   echo $form->checkBox($model,'sunday',array('value'=>'1','class'=>'styled')); ?></td>
             <td width="85%"><?php echo Yii::t('weekdays','Sunday');?></td>
             <td width="11%">&nbsp;</td>
         </tr>
         <tr>
           <td><?php
			 if($batch[1]['weekday']==2)
			   echo $form->checkBox($model,'monday',array('value'=>'2','checked'=>'checked','class'=>'styled'));
			 else
			  echo $form->checkBox($model,'monday',array('value'=>'2','class'=>'styled')); ?></td>
             <td><?php echo Yii::t('weekdays','Monday');?></td>
             <td>&nbsp;</td>
         </tr>
         <tr>
           <td><?php
			  if($batch[2]['weekday']==3)
			  echo $form->checkBox($model,'tuesday',array('value'=>'3','checked'=>'checked','class'=>'styled')); 
			  else
			   echo $form->checkBox($model,'tuesday',array('value'=>'3','class'=>'styled')); 
			  ?></td>
             <td><?php echo Yii::t('weekdays','Tuesday');?></td>
             <td>&nbsp;</td>
         </tr>
         <tr>
           <td><?php
			 if($batch[3]['weekday']==4)
			  echo $form->checkBox($model,'wednesday',array('value'=>'4','checked'=>'checked','class'=>'styled'));
			  else
			  echo $form->checkBox($model,'wednesday',array('value'=>'4','class'=>'styled'));
			   ?></td>
             <td><?php echo Yii::t('weekdays','Wednesday');?></td>
             <td>&nbsp;</td>
         </tr>
         <tr>
           <td><?php
			  if($batch[4]['weekday']==5)
			  echo $form->checkBox($model,'thursday',array('value'=>'5','checked'=>'checked','class'=>'styled'));
			  else
			  echo $form->checkBox($model,'thursday',array('value'=>'5','class'=>'styled'));
			   ?></td>
             <td><?php echo Yii::t('weekdays','Thursday');?></td>
             <td>&nbsp;</td>
         </tr>
         <tr>
           <td><?php
			  if($batch[5]['weekday']==6)
			  echo $form->checkBox($model,'friday',array('value'=>'6','checked'=>'checked','class'=>'styled'));
			  else
			   echo $form->checkBox($model,'friday',array('value'=>'6','class'=>'styled'));
			   ?></td>
             <td><?php echo Yii::t('weekdays','Friday');?></td>
             <td>&nbsp;</td>
         </tr>
         <tr>
           <td><?php
			  if($batch[6]['weekday']==7)
			  echo $form->checkBox($model,'saturday',array('value'=>'7','checked'=>'checked','class'=>'styled'));
			  else
			  echo $form->checkBox($model,'saturday',array('value'=>'7','class'=>'styled'));
				 ?></td>
             <td><?php echo Yii::t('weekdays','Saturday');?></td>
             <td>&nbsp;</td>
         </tr>
         </table>
         
         </div><br />
      <?php    
	  }
	  ?> 
      <?php echo CHtml::submitButton($model->isNewRecord ? 'Save' : 'Save',array('class'=>'formbut')); ?>          
   <?php $this->endWidget(); ?>              
</div>
</div>
</div>
</div>
</div>
</div></div>
    </td>
  </tr>
</table>
<?php } else
{ ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="247" valign="top">
    
  
   
   <?php 
		 $this->renderPartial('//configurations/left_side');
	
	?>
    
    </td>
    <td valign="top">
    <div class="cont_right formWrapper">
    <!--<div class="searchbx_area">
    <div class="searchbx_cntnt">
    	<ul>
        <li><a href="#"><img src="images/search_icon.png" width="46" height="43" /></a></li>
        <li><input class="textfieldcntnt"  name="" type="text" /></li>
        </ul>
    </div>
    
    </div>-->
    
    
        
    <!--<div class="edit_bttns">
    <ul>
    <li>
    <a class=" edit last" href="#">Edit</a>    </li>
    </ul>
    </div>-->
    
    
    <div class="clear"></div>
    <div class="emp_right_contner">
    <div class="emp_tabwrapper">
    
        
    <div class="clear"></div>
    <div class="emp_cntntbx" style="padding-top:10px;">
    
<div class="formCon">

<div class="formConInner" style="padding-top:10px; font-size:14px; font-weight:bold;">
<h3>Week Days</h3>
<?php
    Yii::app()->clientScript->registerScript(
       'myHideEffect',
       '$(".flash-success").animate({opacity: 1.0}, 3000).fadeOut("slow");',
       CClientScript::POS_READY
    );
?>
 
<?php if(Yii::app()->user->hasFlash('notification')):?>
    <div class="flash-success">
        <?php echo Yii::app()->user->getFlash('notification'); ?>
    </div>
<?php endif; ?>

<?php   

$models = Batches::model()->findAll("is_deleted=:x", array(':x'=>'0'));
				$data = array();
				$data['NULL'] = 'common';
				foreach ($models as $model_1)
				{
					$posts=Batches::model()->findByPk($model_1->id);
					$data[$model_1->id] = $model_1->name;
				}
	?>
     <div class="bbtb">
    <!--<h3>Set Weekdays For :&nbsp;-->
<?php
//echo CHtml::dropDownList('mydropdownlist','mydropdownlist',$data,array('onchange'=>'getid();','id'=>'drop','options'=>array($_REQUEST['id']=>array('selected'=>true))));
                 ?> <!--</h3>-->
 <?php $form=$this->beginWidget('CActiveForm', array('id'=>'courses-form','enableAjaxValidation'=>false,)); ?>
      
      <!-- Default one -->
       <?php
	  
		  
		  $batch = $model->findAll("batch_id IS NULL");
		  ?>
          <div class="bbtb" style="color:#000; font-size:14px;">
        
         <table width="100%" cellspacing="0" cellpadding="0">
         <tr>
           <td width="4%"><?php
			  if($batch[0]['weekday']==1)
			  echo $form->checkBox($model,'sunday',array('value'=>'1','checked'=>'checked','class'=>'styled'));
			  else
			   echo $form->checkBox($model,'sunday',array('value'=>'1','class'=>'styled')); ?></td>
             <td width="85%"><?php echo Yii::t('weekdays','Sunday');?></td>
             <td width="11%">&nbsp;</td>
         </tr>
         <tr>
         	<td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
         </tr>
         <tr>
           <td><?php
			 if($batch[1]['weekday']==2)
			   echo $form->checkBox($model,'monday',array('value'=>'2','checked'=>'checked','class'=>'styled'));
			 else
			  echo $form->checkBox($model,'monday',array('value'=>'2','class'=>'styled')); ?></td>
             <td><?php echo Yii::t('weekdays','Monday');?></td>
             <td>&nbsp;</td>
         </tr>
          <tr>
         	<td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
         </tr>
         <tr>
           <td><?php
			  if($batch[2]['weekday']==3)
			  echo $form->checkBox($model,'tuesday',array('value'=>'3','checked'=>'checked','class'=>'styled')); 
			  else
			   echo $form->checkBox($model,'tuesday',array('value'=>'3','class'=>'styled')); 
			  ?></td>
             <td><?php echo Yii::t('weekdays','Tuesday');?></td>
             <td>&nbsp;</td>
         </tr>
          <tr>
         	<td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
         </tr>
         <tr>
           <td><?php
			 if($batch[3]['weekday']==4)
			  echo $form->checkBox($model,'wednesday',array('value'=>'4','checked'=>'checked','class'=>'styled'));
			  else
			  echo $form->checkBox($model,'wednesday',array('value'=>'4','class'=>'styled'));
			   ?></td>
             <td><?php echo Yii::t('weekdays','Wednesday');?></td>
             <td>&nbsp;</td>
         </tr>
          <tr>
         	<td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
         </tr>
         <tr>
           <td><?php
			  if($batch[4]['weekday']==5)
			  echo $form->checkBox($model,'thursday',array('value'=>'5','checked'=>'checked','class'=>'styled'));
			  else
			  echo $form->checkBox($model,'thursday',array('value'=>'5','class'=>'styled'));
			   ?></td>
             <td><?php echo Yii::t('weekdays','Thursday');?></td>
             <td>&nbsp;</td>
         </tr>
          <tr>
         	<td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
         </tr>
         <tr>
           <td><?php
			  if($batch[5]['weekday']==6)
			  echo $form->checkBox($model,'friday',array('value'=>'6','checked'=>'checked','class'=>'styled'));
			  else
			   echo $form->checkBox($model,'friday',array('value'=>'6','class'=>'styled'));
			   ?></td>
             <td><?php echo Yii::t('weekdays','Friday');?></td>
             <td>&nbsp;</td>
         </tr>
          <tr>
         	<td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
         </tr>
         <tr>
           <td><?php
			  if($batch[6]['weekday']==7)
			  echo $form->checkBox($model,'saturday',array('value'=>'7','checked'=>'checked','class'=>'styled'));
			  else
			  echo $form->checkBox($model,'saturday',array('value'=>'7','class'=>'styled'));
				 ?></td>
             <td><?php echo Yii::t('weekdays','Saturday');?></td>
             <td>&nbsp;</td>
         </tr>
         </table>
         
         </div><br />
      
      <?php echo CHtml::submitButton($model->isNewRecord ? 'Save' : 'Save',array('class'=>'formbut')); ?>          
   <?php $this->endWidget(); ?>              
</div>
</div>
</div>
</div>
</div>
</div></div>
    </td>
  </tr>
</table>


<?php }
?>