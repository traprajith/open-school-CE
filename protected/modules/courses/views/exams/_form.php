
<script>
function new_1(id)
{
	var val = document.getElementById('max_mark').value;
	var i = 0;
	for(i=1;i<=id;i++)
	{
	    document.getElementById('max_mark_org'+i).value = val;
	}
}
function old_1(id)
{
	var val = document.getElementById('min_mark').value;
	var i = 0;
	for(i=1;i<=id;i++)
	{
	    document.getElementById('min_mark_org'+i).value = val;
	}
}
</script>
<div class="formCon">

<div class="formConInner">
<?php 
$check = ExamGroups::model()->findByAttributes(array('id'=>$_REQUEST['exam_group_id'],'batch_id'=>$_REQUEST['id']));
if($check!=NULL)
{ ?>
	<?php
if(isset($_REQUEST['id']))
{
	
  $posts=Subjects::model()->findAll("batch_id=:x AND no_exams=:y", array(':x'=>$_REQUEST['id'],':y'=>0))  ;
}

    ?>
    <?php if($posts!=NULL)
  { ?>
  

  <?php
$form=$this->beginWidget('CActiveForm', array(
	'id'=>'exams-form',
	'enableAjaxValidation'=>false,
)); ?>

<?php if(!isset($_REQUEST['exam_group_id']))
{?><table width="80%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><?php echo $form->labelEx($model_1,Yii::t('Exams','name')); ?></td>
    <td><?php echo $form->textField($model_1,'name',array('value'=>$_SESSION['name'])); ?>
		<?php echo $form->error($model_1,'name'); ?></td>
    <td><?php echo $form->labelEx($model_1,Yii::t('Exams','exam_type')); ?></td>
    <td><?php echo $form->textField($model_1,'exam_type',array('value'=>$_SESSION['type'])); ?>
		<?php echo $form->error($model_1,'exam_type'); ?></td>
  </tr></table>
  <?php }?>
  
    
    
		<?php echo $form->hiddenField($model,'exam_group_id'); ?>
		

 


      
    
   <h3><?php echo Yii::t('Exams',' Enter exam related details here:');?></h3>
    




<?php if(isset($_REQUEST['id']))
{
	
  $posts=Subjects::model()->findAll("batch_id=:x AND no_exams=:y", array(':x'=>$_REQUEST['id'],':y'=>0));
  if(count($posts)!=0)
  {
	  $c=count($posts);
	  $i=1;
	  $j=0;
	  
	  foreach($posts as $posts_1)
	  {
		  $c--;
		   
		  $checksub = Exams::model()->findByAttributes(array('exam_group_id'=>$_REQUEST['exam_group_id'],'subject_id'=>$posts_1->id));
		  if($checksub==NULL)
		  {
			  if($j==0)
			  {?> 
              <table width="60%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><?php echo $form->labelEx($model,Yii::t('Exams','max_mark')); ?></td>
    <td>&nbsp;</td>
    <td><?php echo $form->textField($model,'max_mark',array('id'=>'max_mark')); ?>
		          <?php echo $form->error($model,'max_mark'); ?></td>
  
    <td><?php echo $form->labelEx($model,Yii::t('Exams','min_mark')); ?></td>
    <td>&nbsp;</td>
    <td><?php echo $form->textField($model,'min_mark',array('id'=>'min_mark','onfocus'=>'new_1('.count($posts).');',
					'onmouseout'=>'old_1('.count($posts).');')); ?>
					<?php echo $form->error($model,'min_mark'); ?></td>
  </tr>
 
</table>

<br /><br />
    <div class="tableinnerlist">
             <table width="96%" cellspacing="0" cellpadding="0"> 
              <tr>
              <th width="20%"><?php echo Yii::t('Exams','Subject name');?></th>
              <th width="20%"><?php echo Yii::t('Exams','Max Marks');?></th>
              <th width="20%"><?php echo Yii::t('Exams','Min Marks');?></th>
              <th width="20%"><?php echo Yii::t('Exams','Start Time');?></th>
              <th width="20%"><?php echo Yii::t('Exams','End Time');?></th>
              </tr>
              </table>
              </div>
              
              <?php $j++;} ?>
			  <div class="tableinnerlist">
			  <table width="96%" cellspacing="0" cellpadding="0" style="border-top:0px;"> 
		<?php echo '<tr>';
		echo '<td width="20%">'.$posts_1->name.$form->hiddenField($model,'subject_id[]',array('value'=>$posts_1->id)).'</td>';
		echo '<td width="20%">'.$form->textField($model,'maximum_marks[]',array('size'=>3,'maxlength'=>3,'id'=>'max_mark_org'.$i)).'</td>';
		echo '<td width="20%">'.$form->textField($model,'minimum_marks[]',array('size'=>3,'maxlength'=>3,'id'=>'min_mark_org'.$i)).'</td>';
		echo '<td width="20%">';
		
		$settings=UserSettings::model()->findByAttributes(array('user_id'=>Yii::app()->user->id));
			if($settings!=NULL)
			{
				$date=$settings->dateformat;
		
			}
			else
	$date = 'dd-mm-yy';	
		$this->widget('application.extensions.timepicker.timepicker', array(
		'model' => $model,

       'name'=>'start_time',
	   'tabularLevel' => "[]",
	  'options'=>array(
	 'dateFormat'=>$date,
	  ),

));
		echo '</td>';
		echo '<td>';
		$this->widget('application.extensions.timepicker.timepicker', array(
		'model' => $model,

       'name'=>'end_time',
	   'tabularLevel' => "[]",
	    'options'=>array(
		 'dateFormat'=>$date,
	  ),


));
		echo '</td>';
		
		
		echo '</tr></table></div>';
		 $i++;


		 
		
		echo $form->hiddenField($model,'grading_level_id');
	     echo $form->error($model,'grading_level_id'); 
	
		
		echo $form->hiddenField($model,'weightage');
		echo $form->error($model,'weightage');

		
		echo $form->hiddenField($model,'event_id'); 
		echo $form->error($model,'event_id');

		
		echo $form->hiddenField($model,'created_at',array('value'=>date('Y-m-d')));
		echo $form->error($model,'created_at');

		
		echo $form->hiddenField($model,'updated_at',array('value'=>date('Y-m-d')));
		echo $form->error($model,'updated_at'); 
	  } 
	 
	  
  }
  
}}?>
	<br /><br />
<div align="left" >
		<?php if($i!=1)echo CHtml::submitButton($model->isNewRecord ? 'Save' : 'Save',array('class'=>'formbut')); ?>
	</div>
<br />
<?php if($i==1)
	  {
		 
		 echo '<div class="notifications nt_green">'.'<i>'.Yii::t('Exams','Exams Created For All Subjects').'</i></div>'; 
		
	  }
	  ?>



<?php $this->endWidget(); ?>

 
<?php }
	else{
		echo '<i>'.Yii::t('Exams','No Subjects').'</i>';
		 } ?>
<?php }
else
{
	echo '<i>'.Yii::t('Exams','No Such Exam Scheduled').'</i>';
	}?>

 </div>
 </div>
   
   
   
   
   
   
   
   
   
   
   
   
   
    
    <?php 
	$checkgroup = Exams::model()->findByAttributes(array('exam_group_id'=>$_REQUEST['exam_group_id']));
	if($checkgroup!=NULL)
	{?>
    <div>


    <?php $model1=new Exams('search');
	      $model1->unsetAttributes();  // clear any default values
		  if(isset($_GET['exam_group_id']))
			$model1->exam_group_id=$_GET['exam_group_id'];
	     
		 
		  ?>
          <h3> <?php echo Yii::t('Exams','Scheduled Subjects');?></h3>
          <?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'exams-grid',
	'dataProvider'=>$model1->search(),
	'pager'=>array('cssFile'=>Yii::app()->baseUrl.'/css/formstyle.css'),
 	'cssFile' => Yii::app()->baseUrl . '/css/formstyle.css',
	
	'columns'=>array(
		
		array(
		    'name'=>'subject_id',
			'value'=>array($model,'subjectname')
		
		),
		 array(            // display 'create_time' using an expression
            'name'=>'start_time',
			'type'=>'raw',
			'value'=>'ExamsController::convertTime($data->start_time)',

        ),
		 array(            // display 'create_time' using an expression
            'name'=>'end_time',
			'type'=>'raw',
			'value'=>'ExamsController::convertTime($data->end_time)',

        ),
		'maximum_marks',
		/*
		'minimum_marks',
		'grading_level_id',
		'weightage',
		'event_id',
		'created_at',
		'updated_at',
		*/
		array(
			'class'=>'CButtonColumn',
			'buttons' => array(
                                                     
														'update' => array(
                                                        'label' => 'update', // text label of the button
														
                                                        'url'=>'Yii::app()->createUrl("courses/exams/update", array("sid"=>$data->id,"exam_group_id"=>$data->exam_group_id,"id"=>$_REQUEST["id"]))', // a PHP expression for generating the URL of the button
                                                      
                                                        ),
														
                                                    ),
													'template'=>'{update} {delete}',
													'afterDelete'=>'function(){window.location.reload();}'
													
		),
		array(
                   'class' => 'CButtonColumn',
                    'buttons' => array(
                                                     
														'add' => array(
                                                        'label' => 'Exam Score', // text label of the button
														
                                                        'url'=>'Yii::app()->createUrl("courses/examScores/create", array("examid"=>$data->id,"id"=>$_REQUEST["id"]))', // a PHP expression for generating the URL of the button
                                                      
                                                        )
                                                    ),
                   'template' => '{add}',
				   'header'=>'Manage',
				   'htmlOptions'=>array('style'=>'width:17%'),
				   'headerHtmlOptions'=>array('style'=>'color:#FF6600')
            ),
	),
)); echo '</div>';}
else
{
	echo '<div class="notifications nt_red">'.'<i>'.Yii::t('Exams','Nothing Scheduled').'</i></div>'; 
	}?>

