<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'academic-years-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note"><?php echo Yii::t('app','Fields with'); ?>
     <span class="required">*</span><?php echo Yii::t('app',' are required.'); ?></p>



    
    <div class="formCon">
        <div class="formConInner">
        	<h3><?php echo Yii::t('app','Enter the details of the upcoming academic year'); ?></h3>
<div class="txtfld-col-btn">            
    <div class="txtfld-col">
        <?php echo $form->labelEx($model,'name'); ?> 
        <?php echo $form->textField($model,'name'); ?>
		<?php echo $form->error($model,'name'); ?>                   
	</div>
            
    <div class="txtfld-col">
        <?php echo $form->labelEx($model,'start'); ?>
              	<?php
                    	$settings=UserSettings::model()->findByAttributes(array('user_id'=>Yii::app()->user->id));
						if($settings!=NULL)
						{
							$date = $settings->dateformat;
						}
						else
						{
							$date = 'mm-dd-yy';
						}
                    	
						$this->widget('zii.widgets.jui.CJuiDatePicker', array(
							'attribute'=>'start',
							'model'=>$model,
							// additional javascript options for the date picker plugin
							'options'=>array(
								'showAnim'=>'fold',
								'dateFormat'=>$date, 
								'changeMonth'=> true,
								'changeYear'=>true,
								'yearRange'=>'1980:'.(date('Y')+5),
							),
							'htmlOptions'=>array(
								'style'=>'',
								'readonly'=>true
								),
							));
						?>
                    	<?php //echo $form->textField($model,'start'); ?>
						<?php echo $form->error($model,'start'); ?>                 
	</div> 

    <div class="txtfld-col">
        <?php echo $form->labelEx($model,'end'); ?> 
		<?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
        'attribute'=>'end',
        'model'=>$model,
        // additional javascript options for the date picker plugin
        'options'=>array(
        'showAnim'=>'fold',
        'dateFormat'=>$date, 
        'changeMonth'=> true,
        'changeYear'=>true,
        'yearRange'=>'1980:'.(date('Y')+5),
        ),
        'htmlOptions'=>array(
        'style'=>'',
        'readonly'=>true
        ),
        ));
        ?>
        <?php //echo $form->textField($model,'end'); ?>
        <?php echo $form->error($model,'end'); ?>                 
	</div>
	</div>      
    <div class="txtfld-col-btn">
        <?php echo $form->labelEx($model,'description'); ?> 
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>48)); ?>
        <?php echo $form->error($model,'description'); ?>                  
	</div> 
<div class="txtfld-col-btn">      
    <div class="txtfld-col">
        <?php echo $form->labelEx($model,'status'); ?> 
<?php echo $form->dropDownList($model,'status',array('1'=>Yii::t('app','Active'),'0'=>Yii::t('app','Inactive')),array('style'=>'')); ?>                 
	</div>
    </div> 
<div class="txtfld-col-btn">      
	<?php
    $previous_years = AcademicYears::model()->findAll("is_deleted=:x ORDER BY id DESC", array(':x'=>0));
    if($previous_years)
    {
    ?>
    
    <?php echo Yii::t('app','Do you want to import previous academic structure?');?>
    
    <?php 
    if(Yii::app()->session['importError'] == 1)
    {
    $check = 1;
    }
    else
    {
    $check = 0;
    }
    echo CHtml::radioButtonList('import',$check,array('1'=>Yii::t('app','Yes'),'0'=>Yii::t('app','No')),array('separator'=>';','style'=>'width:20px;')); ?>  	
    
    <?php
    }
    ?>
    </div>     
    
    
    
                  
            <?php /*?><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                	<td>
                		<?php echo $form->labelEx($model,'name'); ?>
                	</td>
                    <td>
                    	<?php echo $form->textField($model,'name'); ?>
						<?php echo $form->error($model,'name'); ?>
                    </td>
                    <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                	<td colspan="4">&nbsp;</td>
                </tr>
                <tr>
                	<td>
                    	<?php echo $form->labelEx($model,'start'); ?>
                	</td>
                    <td>
                    	<?php
                    	$settings=UserSettings::model()->findByAttributes(array('user_id'=>Yii::app()->user->id));
						if($settings!=NULL)
						{
							$date = $settings->dateformat;
						}
						else
						{
							$date = 'mm-dd-yy';
						}
                    	
						$this->widget('zii.widgets.jui.CJuiDatePicker', array(
							'attribute'=>'start',
							'model'=>$model,
							// additional javascript options for the date picker plugin
							'options'=>array(
								'showAnim'=>'fold',
								'dateFormat'=>$date, 
								'changeMonth'=> true,
								'changeYear'=>true,
								'yearRange'=>'1980:'.(date('Y')+5),
							),
							'htmlOptions'=>array(
								'style'=>'',
								'readonly'=>true
								),
							));
						?>
                    	<?php //echo $form->textField($model,'start'); ?>
						<?php echo $form->error($model,'start'); ?>
                    </td>
                    <td>
                    	<?php echo $form->labelEx($model,'end'); ?>
                	</td>
                    <td>
                    	<?php
						$this->widget('zii.widgets.jui.CJuiDatePicker', array(
							'attribute'=>'end',
							'model'=>$model,
							// additional javascript options for the date picker plugin
							'options'=>array(
								'showAnim'=>'fold',
								'dateFormat'=>$date, 
								'changeMonth'=> true,
								'changeYear'=>true,
								'yearRange'=>'1980:'.(date('Y')+5),
							),
							'htmlOptions'=>array(
								'style'=>'',
								'readonly'=>true
								),
							));
						?>
                    	<?php //echo $form->textField($model,'end'); ?>
						<?php echo $form->error($model,'end'); ?>
                    </td>
                </tr>
                <tr>
                	<td colspan="4">&nbsp;</td>
                </tr>
                <tr valign="top">
                	<td>
                    	<?php echo $form->labelEx($model,'description'); ?>
                    </td>
                    <td>
                    	<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>48)); ?>
                        <?php echo $form->error($model,'description'); ?>
                    </td>
                    <td>
                    	<?php echo $form->labelEx($model,'status'); ?>
                	</td>
                    <td>
                    	<?php echo $form->dropDownList($model,'status',array('1'=>Yii::t('app','Active'),'0'=>Yii::t('app','Inactive')),array('style'=>'width:150px !important;')); ?>
                    </td>
                </tr>
                <tr>
                	<td colspan="4">&nbsp;</td>
                </tr>
                
				<?php
                $previous_years = AcademicYears::model()->findAll("is_deleted=:x ORDER BY id DESC", array(':x'=>0));
                if($previous_years)
                {
                ?>
                <tr>
                    <td colspan="2">
                        <?php echo Yii::t('app','Do you want to import previous academic structure?');?>
                    </td>
                    <td colspan="2">
                    	<?php 
						if(Yii::app()->session['importError'] == 1)
						{
							$check = 1;
						}
						else
						{
							$check = 0;
						}
						echo CHtml::radioButtonList('import',$check,array('1'=>Yii::t('app','Yes'),'0'=>Yii::t('app','No')),array('separator'=>';','style'=>'width:20px;')); ?>  	
                    </td>
                </tr>                
                <?php
                }
                ?>
                
            </table><?php */?>
        </div>
    </div>
    
    <?php
	if(Yii::app()->session['importError'] == 1)
	{
		$style = 'display:block';
	}
	else
	{
		$style = 'display:none';
	}
	?>
    <div class="formCon" style=" <?php echo $style; ?> " id="import_form">
   		<!--<div class="formCon" id="import_form">-->
        <div class="formConInner">
        	<h3><?php echo Yii::t('app','Select the academic year and choose the details to be imported'); ?></h3>
            <table width="53%" border="0" cellspacing="0" cellpadding="0">
            	<tr>
                	<td>
                        <?php echo Yii::t('app','Academic Year');?>
                    </td>
                	<td colspan="2" align="left">
                    	<?php 
							$academic_years = CHtml::listData($previous_years,'id','name');
							
							echo CHtml::dropDownList('previous_year','',$academic_years,array(
									'style'=>'width:140px;','empty'=>Yii::t('app','Select')
								)); ?>
					</td>
                    <?php /*?><td style="color:#F00;">
                       <?php 
					   if(Yii::app()->session['yearError'] == 1)
					   {
							echo Yii::t('settings','Select an academic year'); 
					   }
					   ?>
                    </td><?php */?>
                </tr>
                <tr>
                	<td colspan="4">&nbsp;</td>
                </tr>
                </table>
                <div class="treeview1">
                	<ul>
                    	<li>
							<?php echo CHtml::checkBox('previous_course','',array('class' => 'checkgroup')); ?>
                        	<?php echo Yii::t('app','Course structure only');?>
                        </li>
                        <li>
                        	<?php echo CHtml::checkBox('previous_course_batch','',array('class' => 'checkgroup')); ?>
                        	<?php echo Yii::t('app','Course and').' '.Yii::app()->getModule('students')->fieldLabel("Students", "batch_id").' '.Yii::t('app',' structure');?>
                            <ul>
                            <li>
                                <?php echo CHtml::checkBox('previous_subject','',array('disabled'=>true)); ?>
                                <?php echo Yii::t('app','Subject Structure');?>
                                <ul>
                                	<li>
										<?php echo CHtml::checkBox('previous_subject_association','',array('disabled'=>true)); ?>
                                        <?php echo Yii::t('app','Subject - Teacher Association');?>
                                    </li>
                                </ul>
                            </li>
                            </ul>
                        </li>
                            
                        
                    </ul>
                </div>
                
            
        </div>
	</div>
    
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('app','Create') : Yii::t('app','Save'),array('class'=>'formbut','id'=>'submitbutton')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<script>
/* 
* Import form show and hide
*/

$( "input[name=import]:radio" ).change(function() {
	if($(this).val() == 1)
	{
		$('#import_form').show("slow");
	}
	else
	{
		$('#import_form').hide("slow");
	}
});

/* 
* Import form validation
*/

$( "#submitbutton" ).click(function() {
	var radio = $('input:radio[name=import]:checked').val();
	if(radio == 1)
	{
		var previous_year = $( "#previous_year" ).val();
		if(previous_year == "")
		{
			alert('<?php echo Yii::t('app',"Select an academic year"); ?>');
			return false;
		}
		else
		{
			if($('#previous_course').is(':checked') || $('#previous_course_batch').is(':checked') || $('#previous_subject').is(':checked') || $('#previous_timetable').is(':checked'))
			{
				return true;
			}
			else
			{
				alert('<?php echo Yii::t('app',"Select atleast one parameter to import"); ?>');
				return false;
			}
		}
		
		
	}
	else
	{
		return true;
	}
});

/*
* To check either "Course structure only" or "Course and Batch structure" at a time. Only one will be selected at a time.
*/

$(function() { 
  $('input.checkgroup').bind('click',function() {
    $('input.checkgroup').not(this).prop("checked", false);
  });
});


/*
* To enable Subject Structure only if "Course and Batch structure" is checked.
*/

$("#previous_course_batch").click(function() {
    if($('#previous_course_batch').is(':checked')) {
        $( "#previous_subject" ).prop( "disabled", false );
    } else {
		 $( "#previous_subject" ).prop( "checked", false );
         $( "#previous_subject" ).prop( "disabled", true );
		 $( "#previous_subject_association" ).prop( "checked", false );
		 $( "#previous_subject_association" ).prop( "disabled", true );
		 $( "#previous_timetable" ).prop( "checked", false );
		 $( "#previous_timetable" ).prop( "disabled", true );
    }
});

/*
* To disable "Course and Batch structure", "Subjects", "Subject Association", "Timetable"
*/

$("#previous_course").click(function() {
	 $( "#previous_subject" ).prop( "checked", false );
	 $( "#previous_subject" ).prop( "disabled", true );
	 $( "#previous_subject_association" ).prop( "checked", false );
	 $( "#previous_subject_association" ).prop( "disabled", true );
	 $( "#previous_timetable" ).prop( "checked", false );
	 $( "#previous_timetable" ).prop( "disabled", true );
   
});


/*
* To enable Subject Association and Timetable only if Subject is checked.
*/



$("#previous_subject").click(function() {
    if($('#previous_subject').is(':checked')) {
        $( "#previous_subject_association" ).prop( "disabled", false );
		$( "#previous_timetable" ).prop( "disabled", false );
    } else {
		 $( "#previous_subject_association" ).prop( "checked", false );
         $( "#previous_subject_association" ).prop( "disabled", true );
		 $( "#previous_timetable" ).prop( "checked", false );
		 $( "#previous_timetable" ).prop( "disabled", true );
    }
}); 

/*
* To enable Timetable only if Subject Association is checked.
*/



$("#previous_subject_association").click(function() {
    if($('#previous_subject_association').is(':checked')) {
		$( "#previous_timetable" ).prop( "disabled", false );
    } else {
		 $( "#previous_timetable" ).prop( "checked", false );
		 $( "#previous_timetable" ).prop( "disabled", true );
    }
}); 


</script>