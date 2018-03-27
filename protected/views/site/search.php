
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="247" valign="top">
        <div id="othleft-sidebar">        
            <div class="lsearch_bar" >
            	<?php echo CHtml::beginForm(Yii::app()->createUrl('/site/search'),'post',array('name'=>'search')); ?>                            
                    <table width="90%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td><input name="char" type="text" class="lsearch_bar_left" value="Search"  onclick="this.value='';" /></td>
                            <td> <input src="images/sbut.png" type="image" name="555" value="submit"  /></td>                        
                        </tr>
                    </table>                
                <?php echo CHtml::endForm(); ?>             
            </div>
        </div>
    
    </td>
    <td valign="top">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td valign="top" width="75%">
        <div class="cont_right formWrapper">
          <h1><?php echo Yii::t('app','Search Result'); ?></h1><br /><br />
          <div class="formCon" style="width:100%">
            	<div class="formConInner">
                	<h3><?php echo Yii::t('app','Students'); ?></h3>
                    <div class="tableinnerlist">
<table width="96%" cellpadding="0" cellspacing="0">
<tr>
<th width="50%"><?php echo Yii::t('app','Name'); ?></th>
<th><?php echo Yii::app()->getModule('students')->fieldLabel("Students", "batch_id"); ?></th>
</tr>
<?php
if(count($list)!=0)
{
	foreach($list as $list_1)
	{ ?>
	<tr>
	<td width="50%"><?php echo CHtml::link($list_1->first_name.'  '.$list_1->middle_name.'  '.$list_1->last_name,array('students/students/view','id'=>$list_1->id)) ?></td>	
	<td><?php
        
            $criteria               =   new CDbCriteria;  
            $criteria->join         =   'LEFT JOIN batch_students t1 ON t1.batch_id = t.id';
            $criteria->condition    =   't.is_active=:is_active AND t.is_deleted=:is_deleted AND t1.student_id=:student_id AND t1.status=:status AND t1.result_status=:result_status';
            $criteria->params       =   array(':is_active'=>1, ':is_deleted'=>0, ':student_id'=>$list_1->id, ':status'=>1, ':result_status'=>0);   
            $criteria->order        =   't.id DESC';
            $criteria->select       =   't.name';
            $batches                  =   Batches::model()->findAll($criteria);            
            foreach ($batches as $batch){
                $student_batches.= $batch->name.", ";
            }
            echo rtrim($student_batches,',');
            ?></td>	
	<tr>
	<?php }
}
else
{
	echo '<tr>';
	echo '<td colspan="2">'.Yii::t('app','No Data found').'</td>';   
	echo '</tr>';
}
?>
</table>
</div>
<br />
<h3><?php echo Yii::t('app','Teachers'); ?></h3>
<div class="tableinnerlist">
<table width="96%" cellpadding="0" cellspacing="0">
<tr>
<th width="50%"><?php echo Yii::t('app','Name'); ?></th>
<th><?php echo Yii::t('app','Department');?></th>
</tr>
<?php
if(count($posts)!=0)
{
	foreach($posts as $posts_1)
	{ ?>
	<tr>
	<td width="50%"><?php echo CHtml::link($posts_1->first_name.'  '.$posts_1->middle_name.'  '.$posts_1->last_name,array('employees/employees/view','id'=>$posts_1->id)) ?></td>
    <td><?php
	$dept=EmployeeDepartments::model()->findByAttributes(array('id'=>$posts_1->employee_department_id));
	if($dept!=NULL)
	{
	 echo $dept->name;
	}
	else{ echo ' - ';}?>
     </td>		
	<tr>
	<?php }
}
else
{
	echo '<tr>';
	echo '<td colspan="2">'.Yii::t('app','No Data found').'</td>';   
	echo '</tr>';
}
?>
</table> </div>
					<div class="pagecon">
                        <?php
                          $this->widget('CLinkPager', array(
                          'currentPage'=>$pages->getCurrentPage(),
                          'itemCount'=>$item_count,
                          'pageSize'=>$page_size,
                          'maxButtonCount'=>5,
                          //'nextPageLabel'=>'My text >',
                          'header'=>'',
                        'htmlOptions'=>array('class'=>'pages'),
                        ));?>
                        
                        </div> <!-- END div class="pagecon" 2 -->
                        <div class="clear"></div>
                </div>
           </div>
        </div>
        </td>
        </tr>
        </table>
        </td>
        
        </tr>
        </table>
      