<!--<script language="javascript">
function getid()
{
var id= document.getElementById('drop').value;
window.location = "index.php?r=classTimings/index&id="+id;
}
</script>-->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="247" valign="top">
    
   <?php $this->renderPartial('/batches/left_side');?>
    
    </td>
    <td valign="top">
    <div class="emp_right">
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
     <?php $this->renderPartial('/batches/tab');?>
        
    <div class="clear"></div>
    <div class="emp_cntntbx">
<div class="formCon">

<div class="formConInner" style="padding-top:10px; font-size:14px; font-weight:bold;">
<h3><?php echo Yii::t('Timing','View ClassTimings');?>Class Timings</h3>

<?php
                 //echo CHtml::dropDownList('mydropdownlist','mydropdownlist',
                     // CHtml::listData(Batches::model()->findAll(),
                      //'id', 'name'),array('onchange'=>'getid();','id'=>'drop','prompt'=>'Select Batch'));
                 ?> 


    <?php 
	if(isset($_REQUEST['id']))
	{
	echo CHtml::ajaxLink(Yii::t('job','Add'),$this->createUrl('ClassTimings/addnew'),array(
        'onclick'=>'$("#jobDialog").dialog("open"); return false;',
        'update'=>'#jobDialog','data' => array( 'batch_id' =>$_REQUEST['id']),'dataType' => 'text'
        ),array('id'=>'showJobDialog1'));
		
	  $timing=ClassTimings::model()->findAll("batch_id=:x", array(':x'=>$_REQUEST['id']));
	  if(count($timing)!=0)
	  {
	  ?><br /><br />
      <div class="tablelist">
          <table width="100%" cellpadding="0" cellspacing="0">
          <tr>
            <td><?php echo Yii::t('Timing','Name');?></td>
            <td><?php echo Yii::t('Timing','Start Time');?></td>
            <td><?php echo Yii::t('Timing','End Time');?></td>
            <td><?php echo Yii::t('Timing','Operations');?></td>
          </tr>  
          <?php	
          foreach($timing as $timing_1)
          {
            echo '<tr>';
            echo '<td>'.$timing_1->name.$timing_1->id.'</td>';  
            echo '<td>'.$timing_1->start_time.'</td>';  
            echo '<td>'.$timing_1->end_time.'</td>';  
            echo '<td>'.CHtml::ajaxLink(Yii::t('job','Edit'),$this->createUrl('ClassTimings/edit'),array('onclick'=>'$("#jobDialog1").dialog("open"); return false;',
        'update'=>'#jobDialog1','data' => array( 'id' =>$timing_1->id,'batch_id'=>$_REQUEST['id']),'dataType' => 'text'
        ),array('id'=>'showJobDialog12'.$_REQUEST['id'])).'&nbsp;|&nbsp;<a href="#">Delete</a></td>';  
            echo '</tr>';
          }
            ?>
        
        </table>
		<?php
	  }
     }   ?>
  <div id="jobDialog"></div>
    <div id="jobDialog1"></div>
    </div>
	</div>
    
</div>
</div></div></div>
</div>  
    </td>
  </tr>
</table>