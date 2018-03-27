<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'configurations-form',
	'enableAjaxValidation'=>true,
	'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); ?>
<p class="note"><?php echo Yii::t('app','Fields with'); ?> <span class="required">*</span><?php echo Yii::t('app','are required.'); ?></p>
<?php echo $form->errorSummary($model);

?>
<!-- School Information -->
<div class="formCon">
    <div class="formConInner">
    	<h3><?php echo Yii::t('app','School Information'); ?></h3>

        
        
        
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
        	<tr>
            
            	<td>
                	<?php  echo "<label>".Yii::t('app','School / College Name')."</label>";?>
                </td>
                <td> 
					<?php 
                    $val_1 = $model->findByPk(1);
                    echo CHtml::textField('collegename',$val_1->config_value,array()); 
                    echo CHtml::error($model, 'collegename');
                    ?>
				</td>
                <td>
                	<?php echo Yii::t('app','Registration ID');?>
                </td>
                <td> 
					<?php 
                    $val_2 = $model->findByPk(22);
                    echo CHtml::textField('registrationid',$val_2->config_value,array()); 
                    ?>
				</td>
            </tr>
            <tr>
            	<td colspan="4">&nbsp;</td>
            </tr>
            <tr>
            	<td>
                	<?php echo Yii::t('app','Founded On');?>
                </td>
                <td> 
					<?php 
					 $val_3 = $model->findByPk(23);
					 $val_17 = $model->findByPk(13);
					 $val_18 = $model->findByPk(14);
					$settings=UserSettings::model()->findByAttributes(array('user_id'=>Yii::app()->user->id));
						if($settings!=NULL)
						{
							$date = $settings->dateformat;
							$val_3->config_value= date($settings->displaydate,strtotime($val_3->config_value));
							$val_17->config_value= date($settings->displaydate,strtotime($val_17->config_value));
							$val_18->config_value= date($settings->displaydate,strtotime($val_18->config_value));
							
						}
						else
						{
							$date = 'mm-dd-yy';
							
						}
                   
                    //echo CHtml::textField('founded',$val_3->config_value,array()); 
					
						$this->widget('zii.widgets.jui.CJuiDatePicker', array(
						'name'=>'founded',
						//'attribute' => 'dob',
						'value' =>$val_3->config_value,
						'options' => array(
						//'showOn' => 'both', 
						'dateFormat' => $date,   // format of "2012-12-25"
						'showOtherMonths' => true,      // show dates in other months
						'selectOtherMonths' => true, 
						'yearRange' => (date('Y')-50).':'.(date('Y')+5),   // range of year   // can seelect dates in other months
						'changeYear' => true,           // can change year
						'changeMonth' => true,          // can change month
						/*'minDate' => '2000-01-01',      // minimum date
						'maxDate' => '2099-12-31',      // maximum date*/
						'showButtonPanel' => true,      // show button panel
					   ),
					   'htmlOptions' => array(
						'size' => '10',         // textField size
						'maxlength' => '10',    // textField maxlength
						'readonly' => 'readonly',
					   ),
					  ));
					  ?>
				</td>
                <td>
                	<?php echo Yii::t('app','Curriculum');?>
                </td>
                <td> 
					<?php 
                    $val_4 = $model->findByPk(27);
                    echo CHtml::textField('curriculam',$val_4->config_value,array()); 
                    ?>
				</td>
            </tr>
            <tr>
            	<td colspan="4">&nbsp;</td>
            </tr>
            <tr>
            	<td>
                	<?php echo Yii::t('app','Address');?>
                </td>
                <td> 
					<?php 
                    $val_5 = $model->findByPk(2);
                    echo CHtml::textArea('address',$val_5->config_value,array('style'=>'width:150px !important; height: 60px;')); 
                    ?>
				</td>
                <td>
                	<?php echo Yii::t('app','Zip code');?>
                </td>
                <td> 
					<?php 
                    $val_6 = $model->findByPk(24);
                    echo CHtml::textField('zipcode',$val_6->config_value,array()); 
                    ?>
				</td>
            </tr>
            <tr>
            	<td colspan="4">&nbsp;</td>
            </tr>
            <tr>
            	<td>
                	<?php echo Yii::t('app','Phone');?>
                </td>
                <td> 
					<?php 
                    $val_7 = $model->findByPk(3);
                    echo CHtml::textField('phone1',$val_7->config_value,array()); 
                    ?>
				</td>
                <td>
                	<?php echo Yii::t('app','Alternate Phone');?>
                </td>
                <td> 
					<?php 
                    $val_8 = $model->findByPk(28);
                    echo CHtml::textField('phone2',$val_8->config_value,array()); 
                    ?>
				</td>
            </tr>
            <tr>
            	<td colspan="4">&nbsp;</td>
            </tr>
            <tr>
            	<td>
                	<?php echo Yii::t('app','Email');?>
                </td>
                <td> 
					<?php 
                    $val_9 = $model->findByPk(25);
                    echo CHtml::textField('email',$val_9->config_value,array()); 
                    ?>
				</td>
                <td>
                	<?php echo Yii::t('app','Fax');?>
                </td>
                <td> 
					<?php 
                    $val_10 = $model->findByPk(26);
                    echo CHtml::textField('fax',$val_10->config_value,array()); 
                    ?>
				</td>
            </tr>
            <tr>
            	<td colspan="4">&nbsp;</td>
            </tr>
            <tr>
                <td><?php echo Yii::t('app','Upload Logo');?></td>
                <td colspan="2">
                    <div class="row">
                    <?php
                    $flag=0;
                    $filename=  Logo::model()->getLogo();
                    if($filename!=NULL)
                    {
                        $flag=1;
                        echo '<span class="remove_butt">'.CHtml::link(Yii::t('app','Remove'), array('Configurations/remove', 'id'=>$filename[1])).'</span>';
                        echo '<img src="'.Yii::app()->request->baseUrl.'/uploadedfiles/school_logo/'.$filename[2].'" alt="'.$filename[2].'" border="0" height="55" />';	 	                           
                    }                    
                                                                                                                           
                    if($flag==0)
                    {
                            echo $form->fileField($logo,'uploadedFile');  
                            echo $form->error($logo,'uploadedFile'); 
                    } 
                    ?> 
                         <strong><i><br><?php echo Yii::t('app','(supported formats : .jpg , .png ; max filesize: 60Kb,');?> <br/>
                    			<?php echo Yii::t('app','recommended size : 64*64');?>)</i></strong>
                    </div>
                   
				</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>
                    <?php echo Yii::t('app','Favicon'); ?>
                </td> 
                <td colspan="2">
                    <div class="row">
                    <?php
               //  $fav=  Favicon::model()->find();
			   $i=0;
				$favs=  Favicon::model()->findAll(array("order" => "id DESC","limit" => 1,));
				foreach($favs as $fav)
				{			
				
					$document_status= DocumentUploads::model()->fileStatus(8, $fav->id, $fav->icon);
                    //if(count($fav)!=0)
					if($document_status == true)
                    {
						$i=1;
                        echo '<span class="remove_butt">'.CHtml::link(Yii::t('app','Remove'), array('Configurations/favremove', 'id'=>$fav->primaryKey)).'</span>';							
			echo '<img src="'.Yii::app()->request->baseUrl.'/uploadedfiles/school_favicon/'.$fav->icon.'" alt="" border="0" height="55" />';	 	
                    }
				}
				
				if($i==0)
                    {
                        echo "<br/>";
                            echo $form->fileField($favicon,'icon',array('id'=>'icon','onChange'=>"validate(this.value)"));  
                            echo $form->error($favicon,'icon'); 
                    }
                    ?> 
                        <strong><i><br><?php echo Yii::t('app','(supported formats : .ico, .jpg');?> <br/>
                    <?php echo Yii::t('app','recommended size : 16*16');?>)</i></strong>
                    </div>
                    
				</td>
            </tr>
        </table>
    </div>
</div>
<!-- End School Information -->

<!-- Head of institution -->
<div class="formCon">
    <div class="formConInner">
    	<h3><?php echo Yii::t('app','Principal / Head of the Institution'); ?></h3>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
        	<tr>
                <td>
                    <?php echo Yii::t('app','Name of the Principal');?>
                </td>
                <td> 
                    <?php 
                    $val_11 = $model->findByPk(29);
                    echo CHtml::textField('principalname',$val_11->config_value,array()); 
                    ?>
                </td>
                <td>
                    <?php echo Yii::t('app','Email of the Principal');?>
                </td>
                <td> 
                    <?php 
                    $val_12 = $model->findByPk(30);
                    echo CHtml::textField('principalemail',$val_12->config_value,array()); 
                    ?>
                </td>
            </tr>
            <tr>
            	<td colspan="4">&nbsp;</td>
            </tr>
            <tr>
                <td>
                    <?php echo Yii::t('app','Phone');?>
                </td>
                <td> 
                    <?php 
                    $val_13 = $model->findByPk(31);
                    echo CHtml::textField('principalphone',$val_13->config_value,array()); 
                    ?>
                </td>
                <td>
                    <?php echo Yii::t('app','Mobile');?>
                </td>
                <td> 
                    <?php 
                    $val_14 = $model->findByPk(32);
                    echo CHtml::textField('principalmobile',$val_14->config_value,array()); 
                    ?>
                </td>
            </tr>
        </table>
	</div>
</div>            
<!-- End Head of institution -->

<!-- Academic Year Setup -->
<div class="formCon">
    <div class="formConInner">
    	<h3><?php echo Yii::t('app','School Year Setup'); ?></h3>
        <?php 
		$academic_years = AcademicYears::model()->findAll(array('condition'=>'is_deleted=:is_deleted','order'=>'id DESC','params'=>array(':is_deleted'=>0)));
		?>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
        	<?php
            if($academic_years) // If academic year is present
			{
				$data = CHtml::listData($academic_years,'id','name');
				$val_16 = $model->findByPk(35);
			?>
        	<tr>
            	<td>
                    <?php echo Yii::t('app','Academic Year');?><span class="required">*</span>
                </td>
                <td> 
                    <?php
					echo CHtml::dropDownList('academic_year','',$data,array('prompt'=>Yii::t('app','Select'),'id'=>'year','options'=>array($val_16->config_value => array('selected'=>true))));  
					?> 
                   
                </td>
                <td colspan="2" align="left">
					<?php
                    echo CHtml::link('<b>'.Yii::t('app','Create New Academic Year').'</b>', array('/AcademicYears/create'));
                    ?>
                </td>
            </tr>
            <?php
			}
			else // If NO academic year is present, create a new one.
			{
			?>
            <tr>
            	<td colspan="4">
                <?php
				echo CHtml::link('<b>'.Yii::t('app','School Academic Year is not set. Save school settings and click here to setup a new academic year.').'</b>', array('/academicYears/create'));
				?>
                </td>
			</tr>
			<?php
			}
			?>
            <tr>
                <td colspan="4">&nbsp;</td>
            </tr>
            <tr>
                <td><?php echo Yii::t('app','Finance Year Start');?></td>
                <td> 
					<?php 
                   
                    
                    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    
                    'name'=>'financial_yr_start',
                    'value'=>$val_17->config_value,
                    // additional javascript options for the date picker plugin
                    'options'=>array(
					'dateFormat' => $date,   // format of "2012-12-25"
                    'showOtherMonths' => true,      // show dates in other months
                    'selectOtherMonths' => true, 
                    'yearRange' => (date('Y')-50).':'.(date('Y')+5),   // range of year   // can seelect dates in other months
                    'changeYear' => true,           // can change year
                    'changeMonth' => true,          // can change month
                    /*'minDate' => '2000-01-01',      // minimum date
                    'maxDate' => '2099-12-31',      // maximum date*/
                    'showButtonPanel' => true,      // show button panel
                    ),
                    'htmlOptions'=>array(
						'style'=>'',
						'readonly'=>true,
                    ),
                    ));
                    ?>
                </td>
                <td><?php echo Yii::t('app','Finance Year End');?></td>
                <td> 
                    <?php 
                    
                    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    
                    'name'=>'financial_yr_end',
                    'value'=>$val_18->config_value,
                    // additional javascript options for the date picker plugin
                    'options'=>array(
					'dateFormat' => $date,   // format of "2012-12-25"
                    'showOtherMonths' => true,      // show dates in other months
                    'selectOtherMonths' => true, 
                    'yearRange' => (date('Y')-50).':'.(date('Y')+5),   // range of year   // can seelect dates in other months
                    'changeYear' => true,           // can change year
                    'changeMonth' => true,          // can change month
                    /*'minDate' => '2000-01-01',      // minimum date
                    'maxDate' => '2099-12-31',      // maximum date*/
                    'showButtonPanel' => true,      // show button panel
                    ),
                    'htmlOptions'=>array(
						'style'=>'',
						'readonly'=>true,
                    ),
                    ));
                    ?>
                </td>
            </tr>

		</table>
	</div>
</div>                        
<!-- End Academic Year Setup -->

<!-- Other Settings -->
<div class="formCon">
    <div class="formConInner">
    	<h3><?php echo Yii::t('app','Application Settings'); ?></h3>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
        	<tr>
               
               
                <td><?php echo Yii::t('app','Currency');?></td>
                <td> 
					<?php 
                    $val_20 = $model->findByPk(5);
                    $data="";
                    if($val_20->config_value!=NULL)
                    {
                        $data= $val_20->config_value;
                    }
                    //echo CHtml::textField('currency',$val_20->config_value,array());
                    $criteria= new CDbCriteria;
                    $criteria->condition= 'code<>:val';
                    $criteria->params= array(':val'=>"");
                    $list= CHtml::listData(Currency::model()->findAll($criteria),'code','code');
                    echo CHtml::dropDownList('currency',$data,$list);
					?>
				</td> 
  			
           
           <td width="10"></td>
                
                <td><?php echo Yii::t('app','Language');?></td>
                <td>
                	<?php 
					$usersettings=UserSettings::model()->findByAttributes(array('user_id'=>Yii::app()->user->id));
					$languages = array(
								'en_us'=>'English', 
								'af'=>'Afrikaans',
								'sq'=>'shqiptar',
								'ar'=>'العربية',
								'cz'=>'中国的 ',
								'cs'=>'český', 
								'nl'=>'Nederlands', 
								'fr'=>'français', 
								'de'=>'Deutsch', 
								'el'=>'ελληνικά',
								'gu'=>'Γκουτζαρατικά',
								'hi'=>'हिंदी',
								'id'=>'Indonesia', 
								'ga'=>'Gaeilge',
								'it'=>'italiano',  
								'ja'=>'日本人',
								'kn'=>'ಕನ್ನಡ', 
								'ko'=>'한국의', 
								'la'=>'Latine',
								'ms'=>'Melayu', 
								'pt'=>'português', 
								'ru'=>'русский', 
								'es'=>'español',
								'ta'=>'தமிழ்',
								'te'=>'తెలుగు',
								'th'=>'ภาษาไทย',
								'uk'=>'Український',
								'ur'=>'اردو',
								'vi'=>'Việt',
								'vi_vn'=>'Tiếng Việt'
								);
					if($usersettings!=NULL)
   					{
						 echo CHtml::dropDownlist('language','',$languages,array('options'=>array($usersettings->language=>array('selected'=>true))));
					}
					else
					{
						echo CHtml::dropDownlist('language','',$languages,array('options'=>array()));
					}
					?>
                </td>
                </tr>
                 <tr>
                <td colspan="4">&nbsp;</td>
            </tr>
                <tr>
                <td><?php echo Yii::t('app','Date Format');?></td>
                <td>
				<?php
                if($usersettings!=NULL)
                {
                   
                   echo CHtml::dropDownlist('dateformat','',array('m/d/yy'=>'default ('.date('m/d/Y').' )','M d.yy'=>date('M d.Y'),'D, M d.yy'=>date('D, M d.Y'),'d M yy'=>date('d M Y'),'yy/m/d'=>date('Y/m/d'),'m/d/yy'=>date('m/d/Y')),array('options'=>array($usersettings->dateformat=>array('selected'=>true))));
                }
                else
                {
                   echo CHtml::dropDownlist('dateformat','',array('m/d/yy'=>'default ('.date('m/d/Y').' )','M d.yy'=>date('M d.Y'),'D, M d.yy'=>date('D, M d.Y'),'d M yy'=>date('d M Y'),'yy/m/d'=>date('Y/m/d'),'m/d/yy'=>date('m/d/Y')),array());
                }
                
                ?>
                </td>
				<td width="10"></td>
                <td><?php echo Yii::t('app','Time Zone');?></td>
                <td> 
					<?php 
                    if($usersettings!=NULL)
                    {
                       echo CHtml::dropDownlist('timezone','',CHtml::listData(Timezone::model()->findAll(),'id','timezone'),array('options'=>array($usersettings->timezone=>array('selected'=>true))));
                    }
                    else
                    {
                       echo CHtml::dropDownlist('timezone','',CHtml::listData(Timezone::model()->findAll(),'id','timezone'),array('options'=>array($usersettings->timezone=>array('selected'=>true))));
                    }
                    ?>
                </td>
            	
                
                <?php /*?><td><?php echo Yii::t('app','Time Format');?></td>
                <td>
				<?php 
				if($usersettings!=NULL)
                {
                  $timezone=Timezone::model()->findByAttributes(array('id'=>$usersettings->timezone ));
                    date_default_timezone_set($timezone->timezone); 
                   echo CHtml::dropDownlist('timeformat','',array('h:i A'=>'12-hour Format','H:i'=>'24-hour format'),array('options'=>array($usersettings->timeformat=>array('selected'=>true))));
                }
                else
                {
                   echo CHtml::dropDownlist('timeformat','',array('h:i A'=>'12-hour Format','H:i'=>'24-hour format'),array('options'=>array($usersettings->timeformat=>array('selected'=>true))));
                }
				?>
                </td><?php */?>
                </tr>
                 
            <?php /*?><tr>
                <td><?php echo Yii::t('settings','Student Attendance Type');?></td>
                <td>
					<?php 
                    $val_21 = $model->findByPk(4);
                    echo CHtml::dropDownlist('attentance','',array('Daily'=>'Daily','Subject Wise'=>'Subject Wise'),array('options'=>array($val_21->config_value=>array('selected'=>true)))); 
                    //echo CHtml::dropDownlist('attentance','',array('Daily'=>'Daily'),array('options'=>array($val_4->config_value=>array('selected'=>true))));
                    ?>
                </td>
                <td>
			</tr><?php */?>
            
            
   
		</table>
	</div>
</div>
<!-- End Other Settings -->
        
<div>
	<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('app','Apply') : Yii::t('app','Save'),array('id'=>'submit_button_form','class'=>'formbut','name'=>'submit')); ?>
</div>
<?php $this->endWidget(); ?>

<script type="text/javascript">
function validate(file) {

    var ext = file.split(".");
    ext = ext[ext.length-1].toLowerCase();   
    //alert(ext);
    var arrayExtensions = ["ico","jpg"];

    if (arrayExtensions.lastIndexOf(ext) == -1) {
        alert("Wrong Extension Type.");
        $("#icon").val("");
    }
}
</script>


