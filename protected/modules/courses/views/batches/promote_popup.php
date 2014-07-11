<?php
$this->breadcrumbs=array(
	'Batches'=>array('/courses'),
	'Promote',
);
?>
<script type="text/javascript">
function formSubmit()
{
document.getElementById("checkform").submit();
}
</script>
 <?php $this->renderPartial('left_side');?>
<?php $this->beginWidget('zii.widgets.jui.CJuiDialog',array(
                'id'=>'jobDialog',
                'options'=>array(
                    'title'=>Yii::t('job','Promote'),
                    'autoOpen'=>true,
                    'modal'=>'true',
                    'width'=>'800px',
                    'height'=>'auto',
                ),
                )); ?>
<?php $batch=Batches::model()->findByAttributes(array('id'=>$_REQUEST['id'])); ?>
          


	<?php if($batch!=NULL)
		   {
			   ?>
   
    <?php $this->beginWidget('CActiveForm',array('id'=>'checkform')) ?>
    <div class="table_listbx">
    
     <?php
                if(isset($_REQUEST['id']))
                {
                $posts=Students::model()->findAll("batch_id=:x and is_deleted=:y and is_active=:z", array(':x'=>$_REQUEST['id'],':y'=>'0',':z'=>'1'));
				if($posts!=NULL)
				{
                ?>
                    <table width="100%" cellspacing="0" cellpadding="0" border="0">
                    <tr >
                    <td class="listbx_subhdng"></td>
                    <td class="listbx_subhdng"><?php echo Yii::t('Batch','Student Name');?></td>
                    <td class="listbx_subhdng" align="center"><?php echo Yii::t('Batch','Admission Number');?></td>
                    
                    </tr>
                        
						
						<tr><td colspan="3" width="10%">
                                       
                                        
										
										<?php 
		
		                                   
											$posts1=CHtml::listData($posts, 'id', 'Fullname');
											?>
										<?php
					
					 echo CHtml::checkBoxList('sid', '',$posts1, array('id'=>'1','template' => '{input}{label}</tr><tr><td width="10%">', 'checkAll' => 'All')); ?>
                                        
                                        </td>
                                        <td colspan="2">
                                        
                                        </td>
                                        </tr>
						
                            
                    </table>
                    
                    <?php $data1 = CHtml::listData(Batches::model()->findAll(array('order'=>'name DESC')),'id','name');
                          echo CHtml::dropDownList('batch_id','',$data1,array('prompt'=>'Select','id'=>'batch_id')); ?>
                    
                    <?php echo CHtml::submitButton(Yii::t('Batch','Promote'),array('name'=>'promote','onclick'=>'formSubmit()','class'=>'')); ?>
                    
                   
                    
                <?php    	
                }
				else
				{
					echo '<br><div class="notifications nt_red" style="padding-top:10px">'.Yii::t('Batch','<i>No Active Students In This Batch</i>').'</div>'; 
									
				}
				
				}
                ?>
    
    
   

 
    </div>
    
    
    
   
     <?php    	
                }
				else
				{
					 echo '<div class="emp_right" style="padding-left:20px; padding-top:50px;">';
					 echo '<div class="notifications nt_red"><i>Nothing Found!!</i></div>'; 
					 echo '</div>';
					
				}
                ?>
   
               
<?php $this->endWidget(); ?>

<?php $this->endWidget('zii.widgets.jui.CJuiDialog');?>


